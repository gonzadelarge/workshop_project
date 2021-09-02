1. Copiar la carpeta de plantilla.
2. Abrimos terminal bash, e introducimos el comando id. Esto nos devuelve un uuid y el nombre de usuario.
3. Abrimos el docker-compose.yml e introducimos nuestro uuid y nuesto nombre de usuario.
4. Abrimos terminal que no sea bash(en mac terminal y windows el powershell) e introducimos docker-compose up -d.
5. Introducimos el comando "docker-compose exec -u (nombreUsuario) php bash" para entrar en la terminal bash del contenedor de php
6. Una vez dentro de la terminal del contenedor ejecutamos el comando "composer install" con el cual instalaremos todas las librerias
7. "composer require annotations". Instalamos la libreria annotations la cual nos ayuda a gestionar las rutas.
8. "composer require twig". Instalamos la libreria de twig.
9. "composer require doctrine". Insatala doctrine (libreria que comunica con la base de datos).
10. 


