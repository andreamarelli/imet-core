<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ImetCore\Controllers\Imet\ControllerV1;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet;
use AndreaMarelli\ImetCore\Models\ProtectedArea;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ModularForms\Helpers\File\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ConvertSQLite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:convert_sqlite {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert old SQLIte base IMET databases to JSON.';

    private $storage;
    private $db_connection;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->storage = Storage::disk(File::PUBLIC_STORAGE);
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Throwable
     */
    public function handle(): int
    {

        $sqlite_db_file = $this->argument('filename');
        $basename = basename($sqlite_db_file);

        // Input file not found
        if(!$this->storage->exists($basename)){
            $this->error('File not found at ' . $this->storage->path($basename));
            return 1;
        }

        // Set up connection
        $this->db_connection = $this->db_connection($basename);

        // Retrieve IMET forms from SQLITE file
        $imets = $this->db_connection
            ->table("ProtectedAreas_ProtectedAreaForm")
            ->select()
            ->orderByDesc('Year')
            ->orderBy('Country')
            ->orderBy('ProtectedAreaID')
            ->get();
        if(count($imets)>0){
            foreach ($imets as $imet){
                $this->convert($imet);
            }
        } else {
            $this->error('No IMET found');
            return 0;
        }
        return 0;
    }


    /**
     *  Create connection to SQLITE file
     *
     * @param $filename
     * @return \Illuminate\Database\ConnectionInterface
     */
    private function db_connection($filename)
    {
        Config::set("database.connections.sqlite_old", [
            "driver" => 'sqlite',
            "database" => $this->storage->path($filename),
        ]);
        return DB::connection('sqlite_old');
    }


    /**
     * Identify PA (wdpa or name)
     *
     * @param $imet
     * @return array|null[]
     */
    private function identify($imet)
    {
        // Using ProtectedAreaID
        $knowledge_base = $this->db_connection->table('knowledgebase_protectedareas')
            ->select()
            ->where('id', $imet->ProtectedAreaID)
            ->first();
        if($knowledge_base){
            $wdpa = trim($knowledge_base->WDPA);
            if(!empty($wdpa)
                && $pa = ProtectedArea::where('wdpa_id', $wdpa)->first()){
                return [$wdpa, $pa->name];
            }
        }

        // Using "GeneralInfo" WDPA
        $generalInfo = $this->db_connection->table('ProtectedAreas_GeneralInfo')
            ->select(['CompleteName', 'CompleteNameWDPA', 'UsedName', 'WDPA'])
            ->where('FormID', $imet->FormID)
            ->first();
        if($generalInfo){
            $wdpa = trim($generalInfo->WDPA);
            if(!empty($wdpa)
                && $pa = ProtectedArea::where('wdpa_id', $wdpa)->first()){
                return [$wdpa, $pa->name];
            }

            // NO valid WDPA: return only name (from "GeneralInfo")
            return [null, $generalInfo->CompleteNameWDPA
                ?? $generalInfo->CompleteName
                ?? $generalInfo->UsedName];
        }

        return [null, null];
    }

    /**
     * Convert IMET
     *
     * @param $imet
     * @return void
     */
    private function convert($imet)
    {
        // Retrieve WDPAID
        [$wdpa, $pa_name] = $this->identify($imet);

        if(!empty($wdpa)){
            $this->info('(year) ' . $imet->Year . ' (country) ' . $imet->Country . ' (WDPA) ' . $wdpa);

            $form = new Imet();
            $form->name = $pa_name;
            $form->wdpa_id = $wdpa;
            $form->Country = $imet->Country;
            $form->version = 'v1';

            $json = ControllerV1::export($form, false, false);

            dump($json['Imet']);

            return;
        }
        if(!empty($pa_name)){
            $this->warn('(year) ' . $imet->Year . ' (country) ' . $imet->Country . ' (name) ' . $pa_name);

            $form = new Imet();
            $form->name = $pa_name;
            $form->wdpa_id = ProtectedAreaNonWdpa::generate_fake_wdpa();
            $form->Country = $imet->Country;
            $form->version = 'v1';

            $json = ControllerV1::export($form, false, false);
            $json['NonWdpaProtectedArea']['name'] = $pa_name;
            $json['NonWdpaProtectedArea']['country'] = $imet->Country;

            dump($json['Imet']);
            dump($json['NonWdpaProtectedArea']);

            return;
        }

        $this->error('(year) ' . $imet->Year .
                         ' (country) ' . $imet->Country .
                         ' (protected area ID) ' . $imet->ProtectedAreaID .
                         '  -  Cannot identify Protected Area ');
    }

}
