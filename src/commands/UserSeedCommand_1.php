<?php namespace Ecco\Ecsa\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Config;

class UserSeedCommand extends Command 
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ecsa:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un nuevo usuario';

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
        $this->info("## Bienvenido a la Crecion de Usuarios De ECSA ##");
        $this->info("--- Todos los Usuarios son Administradores");
        $this->info("--------------------------------------------------------");
        $userdata['first_name']  = $this->ask('¿Cual es tu Nombre? ');
        $userdata['last_name']   = $this->ask('¿Cual es tu Apellido? ');
        $userdata['email']       = $this->ask('¿Cual es tu Correo Electronico ? ');
        $userdata['username']    = $this->ask('¿Ingresa tu Nombre de Usuario ? ');
        $userdata['permissions'] = array('superuser' => 1);
        $password = \Str::random(8);
        $userdata['password'] = $password;
        \Mail::send('ecsa::_layouts.mail', array('nombre'=>$userdata['first_name'],
            'pass'=>$password), function ($message) use ($userdata){
            $message->subject('Datos de Reegistro Sistema ECSA');
            $message->from('no-reply@ecco.com','Ecco Comercializadora');
            $message->to($userdata['email']);
        });
        $user = \Sentry::register($userdata);
        $activationCode = $user->getActivationCode();
        $user->attemptActivation($activationCode);
        
        
        $this->info('<info>Bienvenido ' . $userdata['first_name'] . ' ' . $userdata['first_name'] . '.</info>');
        $this->info('<info>Tus Password ha sido enviada a tu correo electronico');
        $this->info('************       Gracias           *************');
    }

}