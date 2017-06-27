Esta es una traducción al español del fichero original que puede encontrar como README_eng.md
Traducción: Jesús Enrique Rojas Niño,  sael.udistrital@gmail.com,  UOC

Acerca de
---------
Jobskee Spanish es un Job Board Open Source Traducido al español de configuración mínima y de tamaño relativamente pequeño

Autor
-----
Elinore Tenorio (elinore.tenorio@gmail.com)  
Manila, Philippines

Traducción al español
---------------------
Jesús Enrique Rojas Niño (sael.udistrital@gmail.com)
UOC
Bogotá, Colombia

Pilas utilizadas
-----------

* Slim Microframework
* RedBeanPHP
* Bootstrap 3 UI
* PHPMailer
* Markdown
* etc.

Requisitos
------------
* PHP 5.3 y superior
* MySQL
* mod_rewrite habilitado

Instalación
------------
1. Exportar el fichero sql
2. Actualizar la tabla admin con el nombre de usuario y la contraseña deseados (sha1)
3. Cargar los archivos
4. Actualizar el fichero config.php con la configuración deseada
5. Cambiar los permisos de los archivos /assets/images y /assets/attachments a 777
6. Compruebe que todos los archivos .htaccess se hayan cargado

Información de inicio de sesión de administrador predeterminada:
Correo electrónico: admin@example.com
Contraseña: admin

Notas de Instalación
------------------

### Habilite PHP5.3+ usando .htaccess

Algunos antiguos proveedores de alojamiento aún utilizan la versión PHP5.2, tenga en cuenta que Jobskee no se ejecutará en esta versión antigua.

Para usar PHP5.3 +, puede editar el archivo .htaccess en la carpeta raíz y descomentar (quitar el signo de numeral (#) al inicio) esta línea:

﻿`AddType application/x-httpd-php53 .php`


### Importando jobskee.sql

Cuando descargue Jobskee, encontrará un archivo de base de datos incluido que necesita importar a una base de datos MySQL.

Sin embargo, antes de importar, puede editar el archivo para actualizar varias cosas:

CUENTA ADMIN

Puede buscar esta línea en el archivo .sql

﻿`INSERT INTO admin (id, email, password) VALUES
(1, 'admin@example.com', 'd033e22ae348aeb5660fc2140aec35850c4da997')`;

Y cámbielo con los valores que desea:

﻿`INSERT INTO admin (id, email, password) VALUES
(1, 'your desired admin email address', sha1('your desired admin password'))`;

También puede personalizar los valores predeterminados para Categorías y ciudades con los valores que desea antes de importar jobskee.sql a su propia base de datos.

### Configuración de su Job Board Jobskee

Después de descargar Jobskee y configurar su base de datos y corregir el permiso de carpeta en `assets/attachments` y`assets/images`, ahora puede configurar su Job Board abriendo el archivo `config.php` que se encuentra en la carpeta raíz.

Me gustaría mencionar algunos valores importantes en el `config.php` que debe configurar para poder ejecutar correctamente su Job Board:

APP_MODE - actualmente predeterminado como 'development'. Debe configurar esto como "production" cuando su sitio está en modo de producción, ya que afecta a varias otras configuraciones (por ejemplo, base de datos, depuración, etc.)

APP_THEME - actualmente establecido en 'default'. Este es el tema por defecto utilizado por Jobskee. Si desea personalizar este tema, se recomienda que copie `/views/default` en su nuevo tema (es decir,`/views/my_theme`) y configure APP_THEME en 'my_theme'. Esto garantizará que pueda volver al tema predeterminado, si la personalización del tema produce un error que no puede recuperarse.

AJUSTES SMTP: la configuración predeterminada de SMTP es compatible con Gmail y debería funcionar de inmediato cuando proporcione la información correcta de Gmail. Para otras configuraciones, como utilizar el host de correo predeterminado de su propio alojamiento, debe configurarlo correctamente para que las notificaciones por correo electrónico funcionen.

Estos son los ajustes recomendados:

Usando "localhost"

﻿// SMTP SETTINGS  
define('SMTP_ENABLED', true);  
define('SMTP_AUTH', false);  
define('SMTP_URL', 'localhost');  
define('SMTP_USER', 'email@example.com');  
define('SMTP_PASS', '');  
define('SMTP_PORT', 25);  
define('SMTP_SECURE', '');  

y usando Gmail

// SMTP SETTINGS  
define('SMTP_ENABLED', true);  
define('SMTP_AUTH', true);  
define('SMTP_URL', 'smtp.gmail.com');  
define('SMTP_USER', 'email@gmail.com');  
define('SMTP_PASS', 'gmail password);  
define('SMTP_PORT', 465);  
define('SMTP_SECURE', 'ssl');  

APPLICATION URL PATHS - como se ha comentado en el archivo, debe proporcionar su URL completa incluyendo las barras inclinadas finales.

SHARETHIS_PUBID - para habilitar el uso compartido de medios sociales para los trabajos, debe registrar una ID de publicación en www.sharethis.com

CRON_TOKEN: se utiliza para ejecutar cron job para expirar empleos. Proporciona un token único que puede utilizar para expirar empleos utilizando la ruta: `/cron/jobs/expire/:cron_token`

GA_TRACKING: obtenga información sobre su Job Board agregando aquí un ID de seguimiento de Google Analytics.

### Cambiar idioma

Comentar las líneas del idioma activo y descomentar las líneas para cambiar la traducción al idioma deseado

PHP CAPTCHA Script
------------------
Nombre : Securimage V.3.6.4
Author Drew Phillips drew@drew-phillips.com
Licencia: BSD
Descarga: phpcaptcha.org
Código fuente: https://github.com/dapphp/securimage
Documentación en Securimage/README.md y en https://www.phpcaptcha.org/documentation/
