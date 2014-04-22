<?php namespace Ecco\Ecsa\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Sentry;

class InstallCommand extends Command 
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ecsa:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comanado de Instalacion ECSA';

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
        $this->info('## Bienvenido a la Instalacion del Sistema ECSA ##');
        $this->info('#### ECSA esta configurando los Archivos Necesarios ####');
        $this->info('--------------------------------------------------------------------');
        
        $this->info('-- Inicia el proceso de Dependencias --');
        $this->info('----- Importando Archivos de Configuración -----');
        
        $this->call('config:publish', array('package' => 'cartalyst/sentry' ) );
        $this->call('config:publish', array('package' => 'mcamara/laravel-localization' ) );
        $this->call('config:publish', array('package' => 'ecco/ecsa' ) );
        
        $this->info('---- Importando ASSETS de ECSA -----');
        $this->call('asset:publish', array('package' => 'ecco/ecsa' ) );

        $this->info('-- Inicia el proceso de Base de Datos --');
        $this->info('----- Importando Archivos de Configuración en Base de Datos-----');
        $this->info('----- Creando Tablas Necesarias -----');
        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'cartalyst/sentry' ) );
        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'ecco/ecsa' ) );
        
        $this->info('## Instalacion de ECSA Correcta ##');
        $this->info('Ahora Tienes que crear un Usuario!. ');
        
    }
}