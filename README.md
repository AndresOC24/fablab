# Sistema de Inventario para el FABLAB SANTA CRUZ

<p align="center"><a href="https://fablabscz.org/" target="_blank"><img src="/public/images/FabLab_logo.png" width="400" alt="Laravel Logo"></a></p>

## Sobre el Proyecto
El proyecto es un sistema de inventario desarrollado con [Filament](https://filamentphp.com/) y [Laravel](https://laravel.com/) para el laboratorio de [FabLab](https://fablabscz.org/) en la Universidad Privada Franz Tamayo, [UNIFRANZ](https://unifranz.edu.bo/).

## Herramientas
* PhpMyAdmin 
* Laragon
* Laravel
* PHP
* Filament

## Versiones de herramientas utilizadas
* Laravel Framework 11.32.0
* PHP 8.3.10
* Filament 3.2

## Modulos del Sistema
* Gestión de usuarios
* Gestión de Materiales
* Gestión de áreas
* Gestión de máquinas
* Gestión de Voluntarios

## Proceso de instalación del Sistema
### Paso 1
Debes de clonar el repositorio en la carpeta donde tengas almacenandos tus proyectos, y donde se pueda ejecutar tu servidor local.

Para ello ejecuta el comando de `git clone https://github.com/AndresOC24/fablab.git`, y procedera a copiar todo el proyecto en la ruta que indicaste.

### Paso 2
Debemos de configurar nuestra conexión con la Base de datos de preferencia, lo hacemos desde el archivo `.env`. Cuando hayamos clonado el proyecto, nos aparecera un archivo `.env example`, debemos de copiar ese archivo y cambiar el nombre a `.env`, y en ese nuevo archivo que hemos creado realizar las configuraciones respectivas, ya que ahí es donde tenemos nuestra variables de entorno para nuestro proyecto. Normalmente se configura en el siguiente apartado: <br>
<img src="/database/image.png" width="350" heigth="350" alt="Configuración .env">

Y en la parte de `APP_URL=`, debes de ponerle `http://127.0.0.1:8000` para que se ejecute en tu entorno local cuando ejecutes el servidor.

También podemos cambiar a español la configuración si lo deseamos, para ellos configuramos por lo siguiente: <br>
`APP_LOCALE=es`<br>
`APP_FALLBACK_LOCALE=es`<br>
`APP_FAKER_LOCALE=es_ES`<br>
Y para ajustar la hora a la hora Boliviana, cambiamos la siguiente variable: <br>
`APP_TIMEZONE=America/La_Paz`

## Paso 3
Una vez ya haya terminado de copiar, abre la terminal dentro de tu proyecto y procederemos a instalar todas las dependencias necesarias para el proyecto, para ellos ejecutamos el siguiente comando `composer require install`, esto instalará todas las dependencias y configuraciones necesarias para el proyecto.

Cuando termine de instalar los paquetes debes de generar una `key` para el proyecto. Para ellos ejecutamos el comando de `php artisan key:generate` y se generará una llave

## Paso 4
Debemos de ejecutar las migraciones junto a los seeders, para ello ejecutamos el comando de `php artisan migrate:fresh --seed`, esto reiniciará la base de datos y cargara las migraciones, junto a los seeders.
Y luego ejecuta el comando de `php artisan storage:link`, esto es para que no tengas errores al momento de cargar alguna imagen a tu sistema.


Una vez hayamos hecho eso, ya podremos acceder al sistema ejecutando `php artisan serve` y las credenciales de acceso por defecto son las siguientes:

Email:`admin@admin.com`<br>
Contraseña:`admin`


