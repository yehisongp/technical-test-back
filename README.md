## Manual de instalación

### Requerimientos del sistema
- PHP: 8.1.22 o superior
- Composer: 2.5.7

1. <b>Instalar los paquetes de Laravel </b>: Deberá ejecutar el siguiente comando para descargar los paquetes de Laravel, necesarios para su funcionamiento <code>composer install</code>
2. <b>Creación y configuración de DB</b>: Debe crear una base de datos y especificar el nombre de ésta en la variable de entorno <i>DB_DATABASE</i> ubicada en el archivo .env de la carpeta raíz. Si tiene credenciales de autenticación, las deberá indicar en las variables <i>DB_USERNAME</i> y <i>DB_PASSWORD</i>
3. <b>Ejecutar migraciones</b>: Ejecutar el siguiente comando para crear la estructura de la base de datos, necesaria para el funcionamiento del proyecto <code>php artisan migrate</code>
4. <b>Ejecutar seeds</b>: Ejecutar el siguiente comando para alimentar la base de datos anteriormente creada <code>php artisan db:seed</code>

