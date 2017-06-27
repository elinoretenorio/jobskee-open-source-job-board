Esta es una traducción al español del fichero original que puede encontrar como
README_eng.md.
Se dejan las notas de Copyright en el idioma original.
Traducción: Jesús Enrique Rojas Niño,  sael.udistrital@gmail.com,  UOC

## Nombre:

**Securimage** - Una clase de PHP para crear imágenes y audio captcha  con
muchas opciones.

## Versión:

**3.6.4**

## Autor:

Drew Phillips <drew@drew-phillips.com>

## Descarga:

La última versión siempre se puede encontrar en
[phpcaptcha.org](https://www.phpcaptcha.org)

## Documentation:

Se puede encontrar documentación en línea de la clase, métodos y variables
en http://www.phpcaptcha.org/Securimage_Docs/

## Requiremientos:

* PHP 5.2 o superior
* GD  2.0
* FreeType (Requerido, para fuentes TTF)
* PDO (si usa Sqlite, MySQL, o PostgreSQL)

## Synopsis:

**Dentro de su formulario HTML**

    <form method="post" action="">
    .. form elements

    <div>
        <?php
            require_once 'securimage.php';
            echo Securimage::getCaptchaHtml();
        ?>
    </div>
    </form>


**Dentro de su procesador de formularios PHP**

    require_once 'securimage.php';

    // Code Validation

    $image = new Securimage();
    if ($image->check($_POST['captcha_code']) == true) {
      echo "Correct!";
    } else {
      echo "Sorry, wrong code.";
    }

## Descripción:

¿Qué es ** Securimage **?

Securimage es una clase PHP que se utiliza para generar y validar imágenes
CAPTCHA.

Las clases usan una sesión existente de PHP o crean las propias si no se
encuentra ninguna para almacenar el código CAPTCHA. Además, se puede utilizar
una base de datos en lugar del almacenamiento de sesiones.

Las variables dentro de la clase se utilizan para controlar el estilo y la
visualización de la imagen. La clase utiliza fuentes TTF y efectos para reforzar
la seguridad de la imagen.

También crea códigos audibles que se usan para usuarios visualmente impedidos.

## NOTAS DE ACTUALIZACIÓN:

** 3.6.3 y siguientes: **
Securimage 3.6.4 corrigió una vulnerabilidad XSS en example_form.ajax.php.
Se recomienda actualizar a la última versión o eliminar example_form.ajax.php
desde el directorio securimage de su sitio web.

** 3.6.2 y superiores: **

Si está actualizando a 3.6.2 o superior * AND * está utilizando el
almacenamiento de la base de datos, la estructura de la tabla ha cambiado en
3.6.2 agregando una columna de audio_data para almacenar archivos de audio en la
base de datos con el fin de soportar peticiones de rango HTTP. Elimine las
tablas y haga que Securimage las vuelva a crear o vea la función
createDatabaseTables () en securimage.php para la nueva estructura, dependiendo
del backend de la base de datos que esté utilizando y cambie las tablas según
sea necesario. Si utiliza SQLite, simplemente sobrescriba su archivo
securimage.sq3 existente con el de esta versión.

* Si no está utilizando tablas de base de datos para el almacenamiento, ignore este aviso. *

## Copyright:
Script
    Copyright (c) 2016 Drew Phillips
    All rights reserved.

    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:

    - Redistributions of source code must retain the above copyright notice,
      this list of conditions and the following disclaimer.
    - Redistributions in binary form must reproduce the above copyright notice,
      this list of conditions and the following disclaimer in the documentation
      and/or other materials provided with the distribution.

    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
    ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
    LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
    CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
    SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
    INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
    CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
    ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
    POSSIBILITY OF SUCH DAMAGE.

## Licencias:

**WavFile.php**

    The WavFile.php class used in Securimage by Drew Phillips and Paul Voegler
    is used under the BSD License.  See WavFile.php for details.
    Many thanks to Paul Voegler (http://www.voegler.eu/) for contributing to
    Securimage.
Script
---------------------------------------------------------------------------

**Código Flash para Securimage**

Código Flash creado por Age Bosma & Mario Romero (animario@hotmail.com)
Muchas gracias por lanzar esto al proyecto!

---------------------------------------------------------------------------

**HKCaptcha**

Porciones de Securimage contienen código de Han-Kwang Nienhuys 'PHP captcha

    Han-Kwang Nienhuys' PHP captcha
    Copyright June 2007

    This copyright message and attribution must be preserved upon
    modification. Redistribution under other licenses is expressly allowed.
    Other licenses include GPL 2 or higher, BSD, and non-free licenses.
    The original, unrestricted version can be obtained from
    http://www.lagom.nl/linux/hkcaptcha/

---------------------------------------------------------------------------

**AHGBold.ttf**

    AHGBold.ttf (AlteHaasGroteskBold.ttf) fuente fue creada por Yann Le Coroller
    y se distribuye como freeware.

    Alte Haas Grotesk Es una tipografía que parece una helvética impresa en un
    viejo libro Muller-Brockmann.

    Estas fuentes son freeware y se pueden distribuir siempre y cuando estén
    junto con este archivo de texto.

    Apreciaría mucho ver lo que usted ha hecho con él de todos modos.

    yann le coroller
    www.yannlecoroller.com
    yann@lecoroller.com

---------------------------------------------------------------------------

**PopForge Flash Library**

orciones de securimage_play.swf utilizan la biblioteca flash PopForge para
reproducir audio

    /**
     * Copyright(C) 2007 Andre Michelle and Joa Ebert
     *
     * PopForge is an ActionScript3 code sandbox developed by Andre Michelle
     * and Joa Ebert
     * http://sandbox.popforge.de
     *
     * PopforgeAS3Audio is free software; you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation; either version 3 of the License, or
     * (at your option) any later version.
     *
     * PopforgeAS3Audio is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
     * GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License
     * along with this program. If not, see <http://www.gnu.org/licenses/>
     */

--------------------------------------------------------------------------

**Gráficos**

Algunos gráficos usados ​​son del Humility Icon Pack de WorLord

     License: GNU/GPL (http://findicons.com/pack/1723/humility)
     http://findicons.com/icon/192558/gnome_volume_control
     http://findicons.com/icon/192562/gtk_refresh

--------------------------------------------------------------------------


**Los archivos de sonido de ruido de fondo son de SoundJay.com**

http://www.soundjay.com/tos.html

     All sound effects on this website are created by us and protected under
     the copyright laws, international treaty provisions and other applicable
     laws. By downloading sounds, music or any material from this site implies
     that you have read and accepted these terms and conditions:

     Sound Effects
     You are allowed to use the sounds free of charge and royalty free in your
     projects (such as films, videos, games, presentations, animations, stage
     plays, radio plays, audio books, apps) be it for commercial or
     non-commercial purposes.

     But you are NOT allowed to
     - post the sounds (as sound effects or ringtones) on any website for
       others to download, copy or use
     - use them as a raw material to create sound effects or ringtones that
       you will sell, distribute or offer for downloading
     - sell, re-sell, license or re-license the sounds (as individual sound
       effects or as a sound effects library) to anyone else
     - claim the sounds as yours
     - link directly to individual sound files
     - distribute the sounds in apps or computer programs that are clearly
       sound related in nature (such as sound machine, sound effect
       generator, ringtone maker, funny sounds app, sound therapy app, etc.)
       or in apps or computer programs that use the sounds as the program's
       sound resource library for other people's use (such as animation
       creator, digital book creator, song maker software, etc.). If you are
       developing such computer programs, contact us for licensing options.

     If you use the sound effects, please consider giving us a credit and
     linking back to us but it's not required.
