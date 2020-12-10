<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeTransformer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $databaseName  = config('database.connections.mysql.database');
        $userName      = config('database.connections.mysql.username');
        $password      = config('database.connections.mysql.password');

        \Spatie\DbDumper\Databases\MySql::create()
        ->setDbName($databaseName)
        ->setUserName($userName)
        ->setPassword($password)
        ->dumpToFile('public/kanboard.sql');
    }
}
