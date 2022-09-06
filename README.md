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





