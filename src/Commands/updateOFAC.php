<?php

namespace AndreaMarelli\ImetCore\Commands;

use ErrorException;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\QueryException;

class updateOFAC extends Command
{
    use Utils;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:update_ofac';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply SQL files to OFAC to update database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $path = base_path('vendor/andreamarelli/imet-core/database/');

        $sql_files =  [
            'IMET.27-marine_imet.sql',
            'IMET.31-authorization.sql',
            'IMET.34-ownership_type_in_non_wdpa.sql',
            'IMET.35-OECM_v11.sql',
            'IMET.36-OECM-modifications_v4.sql',
            'IMET.37-OECM-modifications_v4.sql',
            'IMET.38-OECM-modifications_v1.sql',
            'IMET.39-regions_countries.sql',
            'IMET.40-sync_imet_records.sql',
            'IMET.41-OECM-modifications.sql',
            'IMET.41-OECM-modifications_v5.sql',
        ];


        foreach ($sql_files as $sql_file){
            try{

                print ($path.$sql_file);
//                $this->dispatch(Jobs\ApplySQL::class, $path . $sql_file);

                return self::SUCCESS;


            } catch (FileNotFoundException $e) {
                $this->error('File not found at ' . $path . $sql_file. '. Cannot apply SQL!!');
                return self::FAILURE;
            } catch (QueryException|ErrorException $e) {
                $this->error('Error applying file ' . $sql_file. '!!');
                return self::FAILURE;
            }
        }

    }

}
