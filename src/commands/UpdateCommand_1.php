<?php

namespace Ecco\Ecsa\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Sentry;

class UpdateCommand extends Command 
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ecsa:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando de Actualizacion de ECSA';

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
     * @return void
     */
    public function fire()
    {
        $this->info('## Proceso de Actualizacion Iniciado ##');
        $this->info('## Actualizando Dependencias ##');
        
        $this->call('asset:publish', array('package' => 'ecco/ecsa' ) );

        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'cartalyst/sentry' ) );
        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'ecco/ecsa' ) );
        
        $this->info('## Proceso de Actualizacion Terminado ##');
        $this->info('## ECSA esta actualizado! ##');
        
    }
}
