1. Copiar la carpeta de plantilla.
2. Abrimos terminal bash, e introducimos el comando id. Esto nos devuelve un uuid y el nombre de usuario.
3. Abrimos el docker-compose.yml e introducimos nuestro uuid y nuesto nombre de usuario.
4. Abrimos terminal que no sea bash(en mac terminal y windows el powershell) e introducimos docker-compose up -d.
5. Introducimos el comando "docker-compose exec -u (nombreUsuario) php bash" para entrar en la terminal bash del contenedor de php
6. Una vez dentro de la terminal del contenedor ejecutamos el comando "composer install" con el cual instalaremos todas las librerias
En este punto tenemos lo minimo para empezar a trabajar en nuestro proyecto.
7. "composer require annotations". Instalamos la libreria annotations la cual nos ayuda a gestionar las rutas.
8. "composer require twig". Instalamos la libreria de twig.
9. "composer require doctrine". Insatala doctrine (libreria que comunica con la base de datos).
10. "composer require synfony/assets". Instala libreria para la gestión del css.
11. "composer require maker --dev". Libreria que facilita la creacción de clases, formularios, etc. Se instala solo para desarrollo.
12. "composer require profiler --dev". Herramienta para desarrolladores que nos ayuda a la hora de ver el estado de la aplicacion(peticiones, usuario logueado, etc.)

P.D. Para salir de la terminal bash de php hay que introducir el comando exit.
Una vez fuera del contendor php introducimos docker-compose down para cerrar/bajar los contendores.


funcion en user (Request $request, EntityManagerInterface $doctrine, UserPasswordEncoderInterface $encoder,GuardAuthenticatorHandler $guard, LoginAuthenticator $formAuthenticator)

para el form de user:

$builder
            ->add('email')
            //->add('roles')
            ->add('password',RepeatedType::class,
            [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ]       
            )
        ;


