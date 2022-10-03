██╗███╗   ██╗███████╗██╗   ██╗ ██████╗ ███╗   ███╗
██║████╗  ██║██╔════╝╚██╗ ██╔╝██╔═══██╗████╗ ████║
██║██╔██╗ ██║█████╗   ╚████╔╝ ██║   ██║██╔████╔██║
██║██║╚██╗██║██╔══╝    ╚██╔╝  ██║   ██║██║╚██╔╝██║
██║██║ ╚████║██║        ██║   ╚██████╔╝██║ ╚═╝ ██║
╚═╝╚═╝  ╚═══╝╚═╝        ╚═╝    ╚═════╝ ╚═╝     ╚═╝
                                                  

InfyOm


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

para un SELECT  

        {
        "name": "artesano_id",
        "dbType": "integer",
        "htmlType": "selectTable:artesanos:nombre,id",
        "validations": "required",
        "searchable": true,
        "fillable": true,
        "primary": false,
        "inForm": true,
        "inIndex": true,
        "inView": true
    },        


        Elijo la palabra linea y no renglon, o item, porque es más regular su pluralidad
para favorecer la generación automática.
También tendremos las entidades FacturasLineas y RemitosLineas

php artisan infyom:scaffold Recibo

php artisan infyom:scaffold RecibosLineas

Remitos: id, Descripción, Fecha Remito, Depósito Desde , Depósito Hacia, user_name

Remitos Renglones: id, remito_id, inventario_id,


Al migrar, responder que no y despues migrar así

php artisan migrate --path='./database/migrations/2022_10_01_112129_create_remitos_table.php.php'



- PARA DESHACER ULTIMO scaffold
php artisan infyom:rollback Remito scaffold

- Para rehacer desde JSON
php artisan infyom:scaffold Remito --fieldsFile Remito.json


php artisan migrate --path='./database/migrations/2022_10_01_112129_create_remitos_table.php'
2022_10_01_112129_create_remitos_table.php


remito_lineas

2022_10_01_113026_create_remito_lineas_table
php artisan migrate --path='./database/migrations/2022_10_01_113026_create_remito_lineas_table.php'