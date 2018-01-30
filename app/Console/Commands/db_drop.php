<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class db_drop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drops the database while removing foreign key constraints';

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
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirm('CONFIRM DROP ALL TABLES IN THE CURRENT DATABASE? [Y|N]')) {
            exit('Drop Tables command aborted');
        }
        foreach(\DB::select('SHOW TABLES') as $table) {
            $table_array = get_object_vars($table);
            \Schema::drop($table_array[key($table_array)]);
        }
        $this->comment(PHP_EOL."If no errors showed up, all tables were dropped".PHP_EOL);
    }
}
