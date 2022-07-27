## xaminaweb


# xaminaweb
# xaminaweb


26/ de Julio / Agregué entidad Rubro


php artisan infyom:scaffold Artesano SIN ARCHIVO JSON

php artisan infyom:rollback Artesano scaffold  PARA DESHACER ULTIMA GENERACION

php artisan infyom:scaffold Artesano --fieldsFile Artesano.json PARA GENERAR DESDE ARCHIVO JSON


TIPS
https://bestofphp.com/repo/InfyOmLabs-laravel-generator-php-developer-tools

input value onkeyup="this.value = this.value.toUpperCase();"

Como generar los Select Options
https://labs.infyom.com/laravelgenerator/docs/5.8/fields-input-guide


-
php artisan infyom:scaffold Rubro

php artisan infyom:scaffold Rubro --fieldsFile Rubro.json      PARA GENERAR DESDE ARCHIVO JSON

php artisan infyom:rollback Tipopieza scaffold  PARA DESHACER ULTIMA GENERACION


27/7/2022

Modificar vista Login
C:\xampp\htdocs\xaminaweb\resources\views\auth\login.blade.php
Para cambiar textos que quedaron parametrizados mal con LANG().


Entidad Cheques

php artisan infyom:scaffold Cheque

        "name": "numero",
        "dbType": "integer",
        "htmlType": "text",
        "validations": "unique:cheques,numero",

        "name": "fecha",
        "dbType": "date",
        "htmlType": "date",
        "validations": "required",

        "name": "depositado",
        "dbType": "boolean",
        "htmlType": "checkbox",

Entidad Recibos

Crear Recibos y RecibosLineas por separado, luego copiar modelo de Facturas de u2

Elijo la palabra linea y no renglon, o item, porque es más regular su pluralidad
para favorecer la generación automática.
También tendremos las entidades FacturasLineas y RemitosLineas

php artisan infyom:scaffold Recibo

php artisan infyom:scaffold RecibosLineas

Creé la entidad RecibosLineas para generar algunos recursos, pero no necesitaré la entrada al menú ni las vistas.

