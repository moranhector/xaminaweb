## xaminaweb




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



En la grilla de renglones hay que hacer que sean readonly

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


Viernes 29/7/2022 

Empecé a grabar recibos.

Tuve algunos problemas. Estuve estancado un rato largo porque no grababa. Resulta que Infyom intenta hacer STORE
con un REQUEST personalizado que es un CreateRecibosLineasRequest
Hice un método guardar para preservar el Store original y poder usarlo en un sistema de ADMINISTRADOR.

_______________________ formulario de busqueda __________________________________________



Escribí un formulario de búsqueda de artesanos basado en el buscador de clientes de u2.
Remplazando nombres de variables se resolvió la mayor parte del código.

Tiene 5 partes


1 C:\xampp\htdocs\xaminaweb\resources\views\recibos\form.blade.php

Codigo javascript que se activa en el botón de Busqueda de

function abre_buscador() { 
   var nwin = window.open("{{ route('seleccionar_artesanos') }}","abookpopup","width=400,height=500,resizable=yes,scrollbars=yes;location=no");
  if((!nwin.opener) && (document.windows != null))
   nwin.opener = document.windows;
}

2 C:\xampp\htdocs\xaminaweb\resources\views\artesanos\seleccionar.blade.php

Contiene la plantilla blade y códigos Javascript

    function copiar_cerrar($docum,$nombre) {
        copiar_celdas($docum,$nombre);
        parent.close();
    }
    function copiar_celdas($documento,$nombre) {
        var prefix    = "";
        var pwintype = typeof parent.opener.document;
        if (pwintype != "undefined") {
                parent.opener.document.getElementById("documento").value  = $documento;
                parent.opener.document.getElementById("nombre").value  = $nombre;                

        }
    }

3 Una plantilla Blade en Layout
 C:\xampp\htdocs\xaminaweb\resources\views\layouts\miniapp.blade.php

4 Ruta del buscador: 
Route::get('/seleccionarartesanos', 'App\Http\Controllers\ArtesanoController@seleccionar')->name('seleccionar_artesanos');

5 En el controlador de Artesanos el método Seleccionar
C:\xampp\htdocs\xaminaweb\app\Http\Controllers\ArtesanoController.php

    public function seleccionar(Request $request)
    {
         if($request){

            $sql=trim($request->get('buscarTexto'));
            $artesanos=DB::table('artesanos')
            ->where('nombre','LIKE','%'.$sql.'%')
            ->orwhere('documento','LIKE','%'.$sql.'%')
            ->orderBy('id','asc')
            ->paginate(8);
            return view('artesanos.seleccionar',["artesanos"=>$artesanos,"buscarTexto"=>$sql]);
            //return $clientes;
        }
    }
_______________________________________________________________________________________________

https://vscode.dev/github/moranhector/xaminaweb/blob/a0b69fb311cea1ff0817048a28b9558338ff6519/README.md#L197


--- PROXIMOS PASOS ---

1/8/2022 LUnes 
Terminar Alta de Recibos

18:53 Ya puedo grabar Lineas de recibos pero aún falta terminar detalles
Los problemas principales los tuve en que no sabía como enviar datos Array desde HTML hacia PHP
Aprendí que en el form los datos tipo array deben venir con CORCHETES

    <div class="col-md-2">
            <label class="form-control-label" for="precio_venta">Precio</label>
            
            <input type="text"  id="precio_venta" name="precio_venta[]" class="form-control" placeholder="Precio de compra" >
    </div>



    <div class="col-md-2">
            <label class="form-control-label" for="cantidad">Cantidad</label>
            
            <input type="text"   id="cantidad" name="cantidad[]" class="form-control" placeholder="Cantidad" pattern="[0-9]{0,15}">
    </div>

Me queda la duda de porqué en el programa u2 no lo tenía de esa manera. 
-----
Otra cosa muy importante, a los modelos hay que pasarle muy bien los campos enumerados en FILLABLE
de lo contrario hace errores inesperados al armar los insert que llevan a diagnósticos desviados. 
--- Otro tema resuelto hoy fue Poblar campos al seleccionar el Select Option

Con jquery queda ................
        // ACA CAMBIO EL VALOR DEL PRECIOS SEGUN EL SELECT
        $('#id_producto').on('change', function() {
           
   
            var articulos_data = $("#id_producto").val();

            articulos_data = articulos_data.split('_');
            //console.log('en el select',articulos_data);       
            $("#precio_venta").val( articulos_data[1]  );         <--- Esta es la clave ... no hay signo igual, es función.
        
       
        });

--- PARA MAÑANA

Terminarl el alta de Recibos y sus renglones.

-------------------------------------------------------------

2/8/2022 Martes
Objetivo: Terminar Recibo con Renglones

Precio: Toma el precio de la lista y no el editado.
No subtotaliza
Los items no deberían ser editables.
El recibo no graba el total.
En recibolineas debe grabar importe.

# Validar y devolver Errores


En plantilla blade preparar.blade.php 

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

También inserté un flash de messages en form.blade.php
Habría que ver si se hace falta o eliminarlo.

# ULTIMO REGISTRO CON ELOQUENT
-- En método preparar armo el FORMULARIO por Default
             //PROXIMO NUMERO DE FORMULARIO
             $ultimo_formulario = Recibo::latest()->first();              //// Método Eloquent muy útil
             $valor_proximo_formulario = $ultimo_formulario->formulario + 1;
             $proximo_formulario = zeros($valor_proximo_formulario,8);



# TRY CATCH
El método guardar de Recibos ahora Hace Try Catch


--- Lo que sigue - Entidad Deposito  e Inventario

4/8/2022 Miércoles
# ENTIDAD DEPOSITO E INVENTARIO

# MIGRACIONES DESDE XAMINA FOX

Carpeta VFP
Ejecutar
DO c:\xampp\htdocs\xaminaweb\vfp\migrar_xamina.prg

ARTESANOS
migrar_artesanos.prg

![Alt text](https://github.com/moranhector/xaminaweb/blob/main/_out_of_project/2022-08-03.png?raw=true "Title")

# MIGRACIONES de tipo de piezas

migrar_tipopiezas.prg




