## xaminaweb


# xaminaweb
# xaminaweb


26/ de Julio / Agregué entidad Rubro

RECORTE.TXT

 php artisan infyom:scaffold Artesano

Specify fields for the model (skip id & timestamp fields, we will add it automat
ically)
Read docs carefully to specify field inputs)
Enter "exit" to finish

 Field: (name db_type html_type options) []:
 > nombre string text

 Enter validations:  []:
 > required

 Field: (name db_type html_type options) []:
 > documento

Invalid Input. Try again

 Field: (name db_type html_type options) []:
 > documento string numeric

 Enter validations:  []:
 > required

 Field: (name db_type html_type options) []:
 > direccion string text

 Enter validations:  []:
 > required

 Field: (name db_type html_type options) []:
 > exit

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

