## xaminaweb




26/ de Julio / Agregué entidad Rubro


php artisan infyom:scaffold Artesano SIN ARCHIVO JSON

php artisan infyom:rollback Artesano scaffold  PARA DESHACER ULTIMA GENERACION
php artisan infyom:rollback Estudiante scaffold  PARA DESHACER ULTIMA GENERACION

php artisan infyom:scaffold Artesano --fieldsFile Artesano.json PARA GENERAR DESDE ARCHIVO JSON
php artisan infyom:scaffold Estudiante --fieldsFile Estudiante.json PARA GENERAR DESDE ARCHIVO JSON


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
![Alt text](https://github.com/moranhector/xaminaweb/blob/main/_out_of_project/tipopiezas.png?raw=true "Title")



10/8/2022 
Título Laravel -> XaminaWeb
Logo ? Gobierno de Mendoza

Logout section Logo

Filtros de búsqueda ?

Traducción secciones inglés. 

LOGO OFICIAL
Assets
C:\xampp\htdocs\xaminaweb\public\images


Archivo: 
C:\xampp\htdocs\xaminaweb\resources\views\layouts\sidebar.blade.php
Linea 4

C:\xampp\htdocs\xaminaweb\resources\views\layouts\app.blade.php

Linea 57

                 <!-- SECCION DE LOGO -->
                    <img src="images/usuario.jpg" class="user-image img-circle elevation-2" alt="User Image">
                     
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- IMAGEN DEL USUARIO -->
                    <li class="user-header bg-primary">
                        <img src="images/usuario.jpg"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>@lang('auth.app.member_since') {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>

# FILTROS DE BUSQUEDA

Hice el prototipo de búsqueda con INVENTARIO

C:\xampp\htdocs\xaminaweb\resources\views\inventarios\index.blade.php

Caja de búsqueda


            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inventarios</h1>
                    <div class="col-sm">
                        <nav class="navbar navbar-light bg-light">
                        <form class="form-inline" method {{route('inventarios.index')}} >
                            <input name='namepieza' class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                        </form>
                    </nav>                     
                </div>
            </div>


En el controlador de Inventario

C:\xampp\htdocs\xaminaweb\app\Http\Controllers\InventarioController.php


    public function index(Request $request)
    {

        $namepieza  = $request->get('namepieza');

        if($namepieza)
        {        
            $inventarios = DB::table('inventarios')
            ->where('namepieza','like','%'.$namepieza.'%' )  
            ->get();          
        } 
        else
        {
            $inventarios = Inventario::all();
        }


        return view('inventarios.index')
            ->with('inventarios', $inventarios);
    }

![Alt text](https://github.com/moranhector/xaminaweb/blob/main/_out_of_project/buscador_inventarios.jpg?raw=true "Title")


Próximo Paso: Migrar inventario ( Piezas )

Implementar Filtros en otras entidades

Factura de Ventan

11/8/2022 Jueves


# Migración de Inventarios desde Xamina 

Carpeta VFP
Ejecutar
migrar_inventario.prg

# Paginado de Index de Inventarios 

Uso de la función Paginate  


    public function index(Request $request)
    {

        $namepieza  = $request->get('namepieza');

        if($namepieza)
        {        
            $inventarios = DB::table('inventarios')
            ->where('namepieza','like','%'.$namepieza.'%' ) 
            ->paginate( 100 ) ;   

            $data['inventarios'] = $inventarios;     
            $data['namepieza'] = $namepieza;     

            return view('inventarios.index',["inventarios"=>$inventarios,"namepieza"=>$namepieza]);            
        } 
        else
        {
            //$inventarios = Inventario::all()->paginate(25);
            $inventarios = DB::table('inventarios')->paginate(25);
        }
        return view('inventarios.index')
            ->with('inventarios', $inventarios);
    }

En Blade usar Links $inventarios->links()
C:\xampp\htdocs\xaminaweb\resources\views\inventarios\index.blade.php




    <div class="content px-3">
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="card">
            <div class="card-body p-0">
                @include('inventarios.table')
                <div class="card-footer clearfix">
                    <div class="float-right">
                    </div>
                </div>
            </div>
        </div>
         {{ $inventarios->links() }} 
    </div>


# Datatables - Plugin para grillas con buscador, filtro y paginador

21/8/2022 

En Artesanos

En index de Artesanos incorporar secciones de CSS y JS

C:\xampp\htdocs\xaminaweb\resources\views\artesanos\index.blade.php


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" >
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" >
@endsection


@section('js')


@endsection


Esta última sección no me tomaba los javascript y los tuve que mover a el Layout App

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>


        $(document).ready(function () {
            console.log('entra1');            
            $('#artesanos-table').DataTable();
            console.log('entra');
         });   


En el controlador de Artesanos no tuve que tocar nada.

En la vista de artesanos de la tabla
C:\xampp\htdocs\xaminaweb\resources\views\artesanos\table.blade.php

Tuve que poner id a la tabla 

    <table class="table" id="artesanos-table">

También encuadré todo dentro de un CARD

<div class="card">
    <div class="card-body">



Y comenté todos los botones y action




![Alt text](https://github.com/moranhector/xaminaweb/blob/main/_out_of_project/datatablesartesanos.png?raw=true "Title")


No me toma el responsive.


            $('#artesanos-table').DataTable(
            //   responsive : true  
            );


Traducción de datatables.

https://datatables.net/examples/basic_init/language.html



Próximo paso ... Ver los botones en Datatable

23/8/2022

Deshice los cambios de los datatables.
Prefiero mantener la simplicidad del mantenimiento del sistema.
Las ventajas de datatable son: Búsqueda por Ajax, y por múltiples columnas. 
La primera característica no es crítica. 
La segunda, si hace falta, se puede programar en la búsquda tradicional. 
Me quedo con la duda de implementar datatable en el buscador de artesanos anexo a Recibos. 


29/8/2022 

Seleccionar Cheque en el Recibo




Generar Entidad Talonario

php artisan infyom:scaffold Artesano SIN ARCHIVO JSON

php artisan infyom:rollback Artesano scaffold  PARA DESHACER ULTIMA GENERACION

php artisan infyom:scaffold Artesano --fieldsFile Artesano.json PARA GENERAR DESDE ARCHIVO JSON


Problemas para separar 
   public function Actualizar($tipo, $UltimoDoc)

   Quedó acoplado en ReciboController: refactorizar.




30/8/2022 -

Avances con funciones DescontarSaldo en Cheques y ActualizarTalonarios

Lecciones del día

-los nombre de los campos son Case Sensitive OJO !

-Tinker no recarga automáticamente el código modificado, hay que salir y volver a entrar.

-Las funciones a ser llamadas desde otra clase deben ser ubicadas en el Modelo y no en el controller.


Próximo Paso: Rendición de Cheque e ingreso de Piezas en Inventario. 



1/9/2022 -

Sería bueno diseñar una página homepage para Xamina. Buscar alguna plantilla.

En el fondo de Login cambiar el color.

Colores de Xamina.??

Rendiciones

Las rendiciones están directamente vinculadas a los Cheques

Se rendirá desde la grilla de cheques.

La entidad de los renglones de rendicion se llamará rendicion



Tabla Cheques
Agrego campo rendido_at


Voy por acá 
Ya logré armar una colleccion de
app\Http\Controllers\ChequeController.php



Ya estoy mostrando la rendición en pantalla.

Hay un problema con la numeración, porque me salen los elementos de la collection CLONADOS. El

Ya estoy mandando a grabar pero falta

    public function rendicion_guardar(Request $request)



Próximo paso grabar la rendición.


5/9/2022  

Lunes

Resuelto el tema de la Colleccion que se clonaba identicamente. 

La solución es usar push(clone ...)

        $nRenglon = 0;
        foreach ($recibosr as $recibos) {
       
            for ($i = 1; $i <= $recibos->cantidad ; $i++) {
                
                $registro = $recibosr[$nRenglon]; 
                $renglones = $renglones->push(clone $registro);
            }
            $nRenglon = $nRenglon + 1 ;
        }        


Ya estoy grabando piezas de la rendición........


6/9/2022

Rendiciones

Grabar cabecera en Cheque
Completar grabación de inventario
Grabar renglones de Rendición

Ya grabo la cabecera y los renglones.
Hay que ver de grabar correctamente cada dato de inventario.
Imprimir rendición. PDF

12/9/2022 -

Trabajo sobre los cheques

Botón registrar cheques

project://app\Http\Controllers\ChequeController.php
project://resources\views\cheques\index.blade.php
project://resources\views\cheques\index.blade.php


AUTONUMERAR CHEQUES

project://app\Http\Controllers\ChequeController.php

        $proximo_numero = $talonario->proximodocumento('CHEQUE');    


resources\views\cheques\fields.blade.php

<div class="form-group col-sm-6">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', $proximo_numero, ['class' => 'form-control']) !!}
</div>

Cheque saved successfully. -> EN ESPAÑOL


En Index cambiar formato de fecha

2022-08-09 00:00:00

Número de cuenta para los Cheques



TALONARIOS -> ADD NEW, FORMATO DE CALENDARIO.


Talonarios: mostrar ultima modificacion


Mejoré el alta de Cheques
Numeración automática
Toma el valor de la cuenta bancaria automaticamente

Mejoré la función de talonarios
Función actualizar en Modelo talonarios

___________________________________________________________

15 de Septiembre
Jueves

Refinar reglas de validación de registro de cheques
No se puede grabar importes incorrectos 

    public static $rules = [
        'numero' => 'unique:cheques,numero',
        'fecha' => 'required',
        'importe' => 'required|numeric|min:0.01|max:9999999',
        'ncuenta' => 'required',
        'saldo' => 'nullable'
    ];


Refactorización de Método destroy
el programa advierte con ALERT + NUMERO DE CHEQUE
despues de eliminado muestra el NÚMERO de cheque eliminado 
Graba el nombre del usuario.

        $cheque->delete();
        $user = Auth::user();
        $cheque->user_name = $user->name;
        $cheque->save();
        
        Flash::success('Cheque '.$numero_cheque.' eliminado.');

16 de Septiembre.
viernes


Correcciones de Vistas index con Filtros

Mañana, quitar los soft deletes



17 de Septiembre.
Sabado

php artisan migrate --path='./database/migrations/2022_07_27_124824_create_cheques_table.php'
php artisan migrate --path='./database/migrations/2022_10_21_230201_create_estudiantes_table.php'
php artisan migrate --path='./database/migrations/2022_07_26_142920_create_tipopiezas_table.php'
C:\xampp\htdocs\xaminaweb\database\migrations\2022_10_21_230201_create_estudiantes_table.php

php artisan migrate --path='./database/migrations/2022_07_27_124824_create_cheques_table.php'
php artisan migrate --path='./database/migrations/2022_07_27_143317_create_recibos_table.php'
php artisan migrate --path='./database/migrations/2022_07_27_145153_create_recibos_lineas_table.php'
php artisan migrate --path='./database/migrations/2022_08_29_221728_create_talonarios_table.php'
php artisan migrate --path='./database/migrations/2022_08_03_133202_create_depositos_table.php'
php artisan migrate --path='./database/migrations/2022_08_03_135409_create_inventarios_table.php'
php artisan migrate --path='./database/migrations/2022_09_05_225228_create_rendicions_table.php'
php artisan migrate --path='./database/migrations/2022_07_25_153123_create_artesanos_table.php'
php artisan migrate --path='./database/migrations/2022_07_27_124824_create_cheques_table.php'
database\migrations\2022_07_25_153123_create_artesanos_table.php




19/9/2022.
Lunes


Generar Facturas y Faclineas

Con infyomlabs

Evitar el SoftDelete de

project://config\infyom\laravel_generator.php#131

Me gustaría probar la opción 

        'tables_searchable_default' => true,


https://infyom.com/open-source/laravelgenerator/docs/fields-input-guide




php artisan infyom:scaffold Rubro

php artisan infyom:scaffold Rubro --fieldsFile Rubro.json      PARA GENERAR DESDE ARCHIVO JSON

php artisan infyom:rollback Tipopieza scaffold  PARA DESHACER ULTIMA GENERACION


# crear entidad en singular
php artisan infyom:scaffold Factura



#primero crear entidad Clientes

\resources\model_schemas\Cliente.json


php artisan infyom:scaffold Cliente --fieldsFile Cliente.json


Para ejecutar una sola migración de la
php artisan migrate --path='./database/migrations/2022_09_19_214911_create_clientes_table.php'

php artisan infyom:rollback Cliente scaffold


#Facturas de

php artisan infyom:scaffold Factura --fieldsFile Factura.json
php artisan migrate --path='./database/migrations/2022_09_19_222411_create_facturas_table.php'

Faclineas

php artisan infyom:scaffold Faclinea --fieldsFile Faclineas.json
php artisan migrate --path='./database/migrations/2022_09_19_223003_create_faclineas_table.php'





20 de Septiembre.
Martes

Creé la entidad Existencia.json
Modifiqué la importación de inventarios para que inserte las existencias de depositos.

Existencia
php artisan infyom:scaffold Existencia --fieldsFile Existencia.json

Qué sigue?

Hacer la transaccion de Factura
Hacer la transaccion de Remito
Modificar la rendicion para ingrese la pieza a existencia

21 de Septiembre
Miércoles

Como obtener el inventario de

-- INVENTARIO ACTUAL
SELECT * FROM inventarios i
INNER JOIN existencias e
ON i.id = e.inventario_id
WHERE i.vendido_at IS NULL

SELECT i.id, i.codigo12, i.npieza,i.namepieza FROM inventarios i
INNER JOIN existencias e
ON i.id = e.inventario_id
WHERE i.vendido_at IS NULL
AND e.deposito_id = 1


Necesito la copia actual del inventario y del programa.




Logré la primera factura de XaminaWeb

Próximos pasos: 

Refinar la grabación de la factura.
Descontar del Inventario al vender.
Tener en cuenta el depósito de venta.

Ir a Mercado Artesanal y obtener una copia de la base y del programa.
Pedir numero de expediente.
Preguntar a Felipe si se implementa la CONSIGNACION.



22/9/2022.

Vamos a implementar un formulario Modal para insertar artículos.




php artisan migrate --path='./database/migrations/2022_09_22_192913_create_students_table.php'



24 septiembre

        <form action="{{ route('student.save') }}" method="post" id="main_form">
        @csrf
            <div class="form-group">
                 <label>Name</label>
                 <input type="text" class="form-control" name="name" placeholder="Enter your name">
                 <span class="text-danger error-text name_error"></span>
            </div>

            
Logré la interactividad buscada en insertar renglones con Jquery Ajax.


Controlador

    // http://localhost:8000/fetch-pieza/090981
    // esto anda ok

    public function fetchpieza($pieza)
    {
        
        
        //dd($pieza);

        $inventario = DB::table('inventarios')
        ->where('npieza',$pieza ) 
        ->get( ) ;   

        return response()->json([
            'piezas'=>$inventario,
        ]);
    }


 

25/9/2022.

Qué sigue?

En insertar renglones, validar si la pieza existe.
Si existe pero no está en existencia porque fue vendida.
Si existe pero está en otro depósito.
Validar que no inserten otros caracteres que dígitos numéricos.
Validar que ya no esté cargada en la factura.
Longitud del código de pieza. Validar.
Probar con Lector de Código de Barras.

Revisar la grabación de la factura.

Descargar pieza de Existencia.

Eduardo Barressi: Pedir Lector, Pedir copia de facturas de venta.
Consultar cómo registra la factura en Afip.
Posibilidad de Importar los archivos extraídos de Afip.



Cargar datos de Cliente en Forma Rápída.


Refinar Index de Facturas, filtro, paginado, etc.



Ya validar si la pieza existe.
Ya valida si fue vendida.

26/6/2022.
Lunes

Reunion M.A. J.F: Lo de consignación va.


Implementar con depósitosy piezas en consignación.
Pedir CUIT del Artesano y Factura de Compra.

Para mañana:

Eduardo Barressi: 
Pedir Lector, 
Pedir copia de facturas de venta.
Consultar cómo registra la factura en Afip.
Posibilidad de Importar los archivos extraídos de Afip.
Pedir número de Expediente.
Copiar Base de Xamina y Programa.
Sacar fotos a Facturas de Afip.
fotos de recibos.
Recibos en consignación fotos.
Facturas en consignación fotos.




Hoy: -
-Refinar la Factura de Venta.
-Revisar la grabación de la factura.
-Descargar pieza de Existencia.

-Reporte de Inventario entre fecha.


Incorporé la función inventario_fecha.

Controller
public function inventario_fecha(Request $request)


Ruta:
Route::get('inventario_fecha','App\Http\Controllers\InventarioController@inventario_fecha')->name('inventario_fecha');;

Vista:
resources\views\inventarios\inventario_fecha.blade.php
C:\xampp\htdocs\xaminaweb\resources\views\inventarios\table_inventario_fecha.blade.php

Para mañana ... Dar consistencia al informe de inventario a Fecha.
Incorporar botones de Excel y PDF.



Factura:
Permitir editar el número de documento y nombre del Cliente

Al grabar, si no existe, dar de alta el cliente.
En formulario: descrip

No limpiar formulario.

Botón de eliminar renglones.

Ojo: Problema, al no seleccionar cliente, da el error y borra la grilla.

ERROR No está increntando el total a pagar


28 de septiembre.

Mejoras en aspecto.
Traducción de etiquetas en Inglés.
Mejoras a Index de Existencias. Filtro en Existencias. Paginado.
Creación de Vista vw_existencias.


SELECT e.inventario_id,i.npieza, i.namepieza,i.tipopieza_id,t.descrip, e.deposito_id , d.nombre,
e.documento, e.fecha_desde, e.documento_sal , e.fecha_hasta
FROM existencias e
INNER JOIN inventarios i
ON e.inventario_id= i.id
INNER JOIN tipopiezas t
ON i.tipopieza_id= t.id
INNER JOIN depositos d
ON e.deposito_id = d.id ;

SELECT * FROM vw_existencias



Mejoras en Facturas.
Puede registrar un cliente en línea.

29 DE SEPTIEMBRE DE 2022
Jueves
Prueba con Lector de Código de Barras
Al usarlo introduce un Enter.
Para evitarlo en resources\views\layouts\app.blade.php

        //TECLA ENTER DESHABILITADA

            $("input").keydown(function (e){
        // Capturamos qué tecla ha sido
        var keyCode= e.which;
        // Si la tecla es el Intro/Enter
        if (keyCode == 13){
            // Evitamos que se ejecute eventos
            event.preventDefault();
            // Devolvemos falso
            return false;
        }
        });   


Funciones que están faltando

-Remitos / Renglones de Remitos / Movimiento de Piezas entre depósitos.
            -Baja por Inventario Físico. ( Remito Especial)
-Impresión de Obleas
-Inventario Físico: Cierre, Conteo.
-Planilla de Ventas entre Fechas.

-Consignaciones: 
    Recibo de Piezas, 
    Informe de Piezas en Consignación, 
    Venta de piezas en Consignación.


-Usuarios y Roles.


-Impresión PDF y EXCEL en Indexes.

-Corregir problema de logos css pisados?



________________________________________________

Remitos: id, Descripción, Fecha Remito, Depósito Desde , Depósito Hacia, user_name

Remitos Renglones: id, npieza, inventario_id, 

2020-10-01 sabado.

Remitos !

Probar insertar javascript con

@push('page_scripts')

@endpush




3/10/2022.

Lunes

Completar funcionalidad Remitos.

Grabar la cantidad de renglones

Avancé con la vista Index de Remitos.
Corregí el problema de las imagenes de Logo y Side bar con Assets
Agregué validación en Remito con Throw exception.


Miércoles 5

En Remito

Cantidad de Piezas

Fecha: solo fecha

Descripción Por favor describa.

Grabar movimiento de pieza.


CORREGI PROBLEMA DE TENER TODOS LOS SCRIP ALOJADOS EN LAYOUT.APP

USE STACK(FORMULARIO) DENTRO DE LAYOUT.APP Y PUSH() @push('formularios') EN VISTA

CORREGI PROBLEMAS DE DATEPICKER, USO EL DATEPICKER POR DEFECTO, COMENTE EL QUE VIENE EN APP.



7/10/2022

Proximos pasos: Mejorar aspecto de Inicio, wallpaper, dashboard.


REMITOS
Cantidad de piezas
Consulta de Remito.
Crear remito en base a devolución de Remito.
Formato de Fecha de Remito en Index. Poner en French.
Validar si es posible un movimiento de pieza.
Fecha: solo fecha
Descripción Por favor describa.
Grabar movimiento de pieza.
Cómo se consulta la posición de una pieza?

Siempre tiene que haber al menos un registro de Existencia de las piezas con el depósito
    y no puede haber más de uno abierto.

En la migración de inventario dejar las fechas_hasta como NULL.
    UPDATE existencias SET fecha_hasta = NULL  WHERE fecha_hasta = '0000-00-00 00:00:00'
    en el campo fecha_vendido tambien dejar NULL


En la consulta por INVENTARIO mostrar el historial de las piezas.

Cada Factura o Remito debe fijar desde qué depósito realiza los movimientos. Agregar Campo.

Existirá un depósito llamado Vendida, y otro llamado Baja por inventario físico.

Esta será la consulta completa de una pieza

SELECT i.id,i.npieza, i.namepieza,d.nombre AS deposito, 
t.descrip AS tipopieza, t.tecnica, a.nombre, a.lugar,
i.comprado_at, i.costo,i.precio, i.vendido_at
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id
WHERE i.id = 126523
AND e.fecha_hasta IS NULL ;

/////////////////////////////////////////////////////////////////////////////////////////

REFINAMIENTO DE FUNCIONALIDADES OCTUBRE.
________________________________________



ARTESANOS: 
CAMPO DE ARTESANO ACTIVO
Alta de artesano: falta campo Lugar, campo activo. ok

Consulta: Piezas compradas por Artesano.
en Index falta campo Lugar. Filtro de Artesanos activos, 
Permitir borrar solo si no tiene recibos, ni piezas a su nombre.
Campos en Columna

NO INCORPORÉ EL CAMPO ACTIVO, EN SU LUGAR MODIFIQUE LA MIGRACIONES
DE ARTESANOS PARA QUE DEPURE Y SOLO DEJE LOS ARTESANO CON PIEZAS SIN VENDER.


RUBROS:

Consulta de Inventario por Rubros.
Consulta de Tipo de Piezas por Rubro.
Borrar: condición que no exista el rubro en ninguna pieza.

TIPOPIEZAS:

Index: Mostrar la descripción del Rubro NO EL ID
Consulta: piezas por tipo pieza.
Borrar: solo si el tipopieza no esta en uso.
Alta en columna.


CHEQUES:

Migrar Cheques desde Xamina.

RECIBOS:

Index: Fecha en French.
    Nombre artesano.

Borrar: permitir solo si no está rendido. Y hay que devolver plata al cheque.
Editar: no es válido.
Consulta del Recibo con renglones.


DEPOSITOS:

Inventario por Depósito.
Borrar: si no está en uso.
Editar: solo la descripción.
Index: quitar campo user name.
Agregar VENDIDA, BAJA, 


INVENTARIO / PIEZAS

el id de la pieza será npieza PARA SIMPLIFICAR MANTENIMIENTO
quito el AUTOINCREMENT DEL ID de la pieza

Index, mostrar consulta maestra.
borrar: no válido.
Editar: solo descripciones.
view: Mostrar movimientos 

TALONARIOS:

Quitar campo punto de venta.
Index: fecha vencimiento en FRENCH

Alta y Editado en columnas.
Labels: corregir.

BUG: PERMITE GRABAR DOS VECES EL MISMO TIPO DE DOCUMENTO.

CLIENTES:

Consulta de facturas por Cliente, 

Piezas vendidas por cliente.
Ultima compra.

Botón de Alta ADDNEW.
BORRAR SI NO ESTA EN USO.

Alta automática desde Factura.

FACTURAS:

index: fecha french.
    Cliente, cuit, nombre.
Consulta de Factura
Validar existencia en deposito. ajax_pieza_deposito



NOTAS DE CREDITO:
    Para revertir facturas.



REPORTES:

Ventas entre fechas:
Compras entre fechas: 

Inventario: Cantidad de Piezas. 


REMITOS

Cantidad de Piezas

Fecha: solo fecha OK

Descripción Por favor describa. PLACEHOLDER

Grabar movimiento de pieza.

OJO, Si cambia deposito_from despues de haber cargado piezas, puede causar problemas.

Poner una fecha por default OK

bug Al tocar boton agregar renglon en vacio agrega un renglon.
bug al grabar valida que los depositos no pueden ser iguales, pero se vació la grilla.



/////////////////////////////////////////////////////////////////////////////////////////

consulta de inventario

SELECT i.id,i.npieza, i.namepieza,d.nombre AS deposito, 
t.descrip AS tipopieza, t.tecnica, a.nombre, a.lugar,
i.comprado_at, i.costo,i.precio, i.vendido_at, i.factura
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id
WHERE i.vendido_at IS NULL 


8/10/2022
Sábado

Remito ahora graba movimientos de existencia

Hay que modificar metodo ajax y pasar como parametro el deposito base para validar.

12/10/2022
Miércoles


Artesanos: Show ahora muestra las piezas del artesano.

Hice la depuración de artesanos con la existencia de inventarios.
Mejoré la migración, solo va a migrar al artesano si tiene piezas en existencia.


20/10/2022
Jueves

Pantalla Registrar usuarios login

PERDIDA DE LA BASE DE DE DATOS !!

Tuve que recuperar la base de datos a partir de las migraciones. 

Moraleja: Hacer backup de las bd aunque sean en testing de proyecto.


Hice correcciones a varios mensajes en INGLES de FLASH en varios controllers.

Proximo paso:

Artesano, agregar departamento, CUIT, fecha de nacimiento y sexo.


21/10/2022
Viernes

Dashboard ? 
Artesanos , beneficiados este mes, $ invertidos
Compras  $, piezas compradas artesanos, beneficiados
Ventas $ Hoy, Ayer, Ultimos 30 dias, cantidad de ventas 
Piezas vendidas $ Hoy, Ayer, Ultimos 30 dias, en existencia

Admin

Reinstalar el Admin de ejemplo
Agregar Laravel Spatie en XaminaWeb



7:59
GITBASH
php artisan migrate:fresh
php artisan serve

Despues de un migrate refresh hay que hacer un seed

ARTESANO
No admitir artesano con mismo número de documento.
Corregir migracion de artesanos



22/10/2022
Resolví problemas en los select option para alta y edicion.
Resolvi problemas con la validacion de unicidad de documento en Alta y Edicion.
