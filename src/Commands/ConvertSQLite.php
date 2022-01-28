<?php

namespace AndreaMarelli\ImetCore\Commands;

use AndreaMarelli\ModularForms\Helpers\File\File;
use Illuminate\Console\Command;
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
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Throwable
     */
    public function handle(): int
    {

        $sqlite_db_file = $this->argument('filename');
        $basename = basename($sqlite_db_file);

        // Input file not found
        if(!Storage::exists($sqlite_db_file)){
            $this->error('File not found at ' . Storage::disk(File::PUBLIC_STORAGE)->path($basename). '.');
            return 1;
        }




        return 0;
    }
}
