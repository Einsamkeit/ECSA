<?php namespace Ecco\Ecsa;

use Illuminate\Support\ServiceProvider;

class EcsaServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('ecco/ecsa');
                // - > Carga Archivos
                $this->loadFiles();
                // Definimos el idioma default
                $this->app->setLocale('es');
                //--> Configuracion DB
                $this->SettingsDB();
                // --> Configuramos Zona Horaria (Mexico)
                $this->app['config']['app.timezone'] = 'America/Mexico_City';
                
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
            // --> Configuramos la Cokie Default
            $this->app['config']['session.cookie'] = 'ECSASystem_';
            // --> Configuramos Zona Horaria (Mexico)
            $this->app['config']['app.timezone'] = 'America/Mexico_City';
            // --> Registramos los alias de la aplicacion
            $this->registerAliasClasses();
            
            // --> Registramos los modelos de la app
            $this->registerModels();
            
            $this->app['ecsa:user'] = $this->app->share(function($app)
            {
                return new Commands\UserSeedCommand($app);
            });

            $this->app['ecsa:install'] = $this->app->share(function($app)
            {
                return new Commands\InstallCommand($app);
            });

            $this->app['ecsa:update'] = $this->app->share(function($app)
            {
                return new Commands\UpdateCommand($app);
            });
            
            $this->commands('ecsa:user');
            $this->commands('ecsa:install');
            $this->commands('ecsa:update');
            
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}
        
        /*
         *  Carga Archivos Necesarios de la Aplicacion
         */
        public function loadFiles()
        {
            $files = array(
                'filters',
                'routes'
            );
            foreach ($files as $file) {
                $file = __DIR__.'/../../'.$file.'.php';
                if(file_exists($file)) include($file);
            }
        }
        
        /*
         *  Funcion que Registra Clases
         */
        function registerAliasClasses()
        {
            // --> Compartimmos alias de la Clase Sentry
            $this->app['sentry'] = $this->app->share(function () {
                return new \Cartalyst\Sentry\Sentry();
            });
            $this->app->booting(function (){
                $alias = \Illuminate\Foundation\AliasLoader::getInstance();
                $alias->alias('Sentry', 'Cartalyst\Sentry\Facades\Laravel\Sentry');
            });
            // -------------------------------------------------------------------------
            // --> Compartimos alias de la Clase Security
            $this->app['security'] = $this->app->share(function () {
                return new \GrahamCampbell\Security\Classes\Security();
            });
            $this->app->booting(function () {
                $alias = \Illuminate\Foundation\AliasLoader::getInstance();
                $alias->alias('Security', 'GrahamCampbell\Security\Facades\Security');
            });
            //-------------------------------------------------------------------------    
            // --> Compartimos alias para Image
            $this->app['image'] = $this->app->share(function () {
                return new \Intervention\Image\Image();
            });
            $this->app->booting(function (){
                $alias = \Illuminate\Foundation\AliasLoader::getInstance();
                $alias->alias('Image', 'Intervention\Image\Facades\Image' );
            });
        }
        
        /*
         *  Configuracion de la Bd
         */
        public function SettingsDB(){
            $this->app['config']['database.connections'] = array_merge(
                $this->app['config']['database.connections'],
                \Config::get('ecsa::connections')
            );
        }
        
        /*
         *  Registramos los modelos 
         */
        public function registerModels()
        {
           // --> Compartimos alias de la Clase Organization
            $this->app['organizationProvider'] = $this->app->share(function () {
                return new \Ecco\Ecsa\Models\Organizations\OrganizationProvider();
            });
            $this->app->booting(function () {
                $alias = \Illuminate\Foundation\AliasLoader::getInstance();
                $alias->alias('Organization', 'Ecco\Ecsa\Facades\OrganizationProvider' );
            });
            //------------------------------------------------------------------------- 
            // --> Compartimos alias de la Clase Cliente
            $this->app['clienteProvider'] = $this->app->share(function () {
                return new \Ecco\Ecsa\Models\Clientes\ClienteProvider();
            });
            $this->app->booting(function () {
                $alias = \Illuminate\Foundation\AliasLoader::getInstance();
                $alias->alias('Cliente', 'Ecco\Ecsa\Facades\ClienteProvider' );
            });
            //------------------------------------------------------------------------- 
        }
}
