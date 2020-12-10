<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create repository and interface';


    protected $type = 'Repository';



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
    $name = $this->argument('name');
    $nameRepositoryInterfaceName = $name.'RepositoryInterface';
    $nameRepositoryName = $name.'Repository';
    $repositoriesContents =
    <<<EOT
    <?php
    
    namespace App\Repository;
    
    class $nameRepositoryName  implements  $nameRepositoryInterfaceName
    {
    
    }

EOT;

$repositoriesInterfaceContents =
    <<<EOT
    <?php

    namespace App\Repository\Contracts;
    
    interface $nameRepositoryInterfaceName
    {
    
    }

EOT;

    $repositoryFile = \Storage::put('Repository/'.$name.'Repository.php', $repositoriesContents);
    $repositoryInterfaceFile = \Storage::put('Repository/Contracts/'.$name.'RepositoryInterface.php', $repositoriesInterfaceContents);


    if($repositoryFile && $repositoryInterfaceFile) {
        $this->info('Created new Repository '.$name.'Repository.php in App\Repository.');
        $this->info('Created new Repository Interface '.$name.'RepositoryInterface.php in App\Repository\Contracts.');
    } else {
        $this->info('Something went wrong');
    }
        
}

}
