<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ImetCore\Jobs;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;


class InitDB extends Command
{
    use Utils;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imet:init_db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize IMET offline database';

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
        $sql_files = Storage::disk('imet_db_sql')->files();
        sort($sql_files);
        foreach ($sql_files as $sql_file){
            $this->dispatch(Jobs\ApplySQL::class, $sql_file);
        }

        $this->dispatch(Jobs\PopulateMetadata::class);
        $this->dispatch(Jobs\PopulateSpecies::class);
        return 0;
    }
}
