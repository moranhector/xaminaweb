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

27/1/2022
-- Ahora viene el trabajo de hacer el formulario de Recibo basado en la Factura de U2.

El trabajo de programar un formulario con renglones se hace con Jquery
Conservo los métodos, vistas, y rutas originales generados por Infyom con la finalidad de tener 
posteriormente algunas funciones de administración que puedan editar fuera de las reglas las entidades como Administrador.


El código jquery que hace toda la magia armar los renglones está en
C:\xampp\htdocs\xaminaweb\resources\views\layouts\app.blade.php

Me gustaría que estuviera en otro archivo más vinculado a los recibos.
Lo ideal sería que este código sea tan útil y flexible para ser utilizados tambie´n
en Facturas y Remitos y otras entidades tipo documento con renglones.

En la función que agrega Renglones Agregar tengo variables Javascript que toman sus valores equivalentes desde HTML
Para no confundirlas les antepongo un guión _precio

        function agregar(){
            //window.alert("agregar");
            //datosProducto = document.getElementById('id_producto').value.split('_');
   
            //id_producto= datosProducto[0];
            //producto= $("#id_producto option:selected").text();


            let _id_producto = $("#id_producto").val();
            console.log('_id_producto',_id_producto);         
            
            let _descrip     = $("#id_producto").val();
            
            _descrip = _descrip.substring(11,40);
            console.log('_descrip',_descrip);         


            let _cantidad= $("#cantidad").val();
            console.log('_cantidad',_cantidad);


            let _precio= $("#precio").val();
            console.log('_precio',_precio);            



En la grilla de renglone hay que hacer que sean readonly

                       concat('<i class="fa fa-times fa-2x"></i></button></td>',
                               '<td><input type="text" name="_descrip"  value="'+_descrip     +'"></td>',
                               '<td><input type="text" name="_precio"   value="'+_precio      +'"></td>',
                               '<td><input type="text" name="_cantidad" value="'+_cantidad    +'"></td>',
                               '<td><input type="text" name="_subtotal" value="'+_subtotal    +'"></td></tr>');

Para mañana me queda grabar los renglones y la cabecera.

Para el ruteo bauticé la ruta como preparar_recibo para
Route::get('preparar_recibo','App\Http\Controllers\ReciboController@preparar')->name('preparar.recibo');   

Para no confundirlo con las rutas de Recibos originales.

Ya lo agregué en el menu de

C:\xampp\htdocs\xaminaweb\resources\views\layouts\menu.blade.php

<li class="nav-item">
    <a href="{{ route('preparar.recibo') }}"
       class="nav-link {{ Request::is('preparar.recibo*') ? 'active' : '' }}">
        <p>Registrar Recibo</p>
    </a>
</li>
