<?php

 
// ean13($argv[1] );
 

// return false;


function NombreMes($nMes)
{
    $cNombreMes = "Error";
    //dd($nMes);

    

    switch ($nMes) {
        case  1:  $cNombreMes = 'January';     break;
        case  2:  $cNombreMes = 'February';     break;
        case  3:  $cNombreMes = 'March';     break;
        case  4:  $cNombreMes = 'April';     break;
        case  5:  $cNombreMes = 'May';     break;
        case  6:  $cNombreMes = 'June';     break;
        case  7:  $cNombreMes = 'July';     break;
        case  8:  $cNombreMes = 'August';     break;
        case  9:  $cNombreMes = 'September';     break;
        case 10:  $cNombreMes = 'October';     break;
        case 11:  $cNombreMes = 'Novembre';     break;
        case 12:  $cNombreMes = 'Diciembre';     break;

        
        default: $cNombreMes = 'Error';     break;

    }
    return $cNombreMes ;

}


function Val($cNumero)
{
    $integer = (int)$cNumero;
    return $integer;


}


 

//$americandate_venc = french2american( $request->date_venc ) ;
// // DD/MM/AAAA    AAAA-MM-DD  
function french2american( $frenchdate)
{
$dia = substr($frenchdate,0,2);
$mes = substr($frenchdate,3,2);
$ano = substr($frenchdate,6,4);

//dd($ano.'-'.$mes.'-'.$dia) ;
return $ano.'-'.$mes.'-'.$dia;

}

function american2french( $americandate)
{
    //2022-12-31
    $dia = substr($americandate,8,2);
    $mes = substr($americandate,5,2);
    $ano = substr($americandate,0,4);
    
    //dd($ano.'-'.$mes.'-'.$dia) ;
    return $dia.'/'.$mes.'/'.$ano; 
 
return $dtdate;

}




        //$dt2 = Carbon::createFromDate(1987, 4, 23);
        //$dt = Carbon::createFromDate( $cYear, $cMonth, $day);
        //$dtdate =$dt->format('Y-m-d');



///// FUNCIONES GENERALES FUERA DE LA CLASE

function Fecha()
{

    $date = Carbon::today();
    $fecha = $date->format('Ymd');   
    // Esto debe devolver AAAAMMDD por ejemplo  "20190909"

    //dd($fecha);

    echo $fecha;
    return $fecha;
}

function zeros($cadena,$longitud)
{

    $zeros =  substr("00000000".$cadena,-1 * $longitud ,$longitud);
    //dd($zeros);
    return $zeros;
}


// *--------------------------------------------------------------------------
// * FUNCTION _StrToEan13(tcString, .T.)
// *--------------------------------------------------------------------------
// * Convierte un string para ser impreso con
// * fuente True Type EAN-13
// * PARAMETROS:
// *   tcString: Caracter de 12 dígitos (0..9)
// *   tlCheckD: .T. Solo genera el dígito de control
// *             .F. Genera dígito y caracteres a imprimir
// * USO: _StrToEan13("123456789012")
// * RETORNA: Caracter
// * AUTOR: Luis María Guayán
// *--------------------------------------------------------------------------
//FUNCTION _StrToEan13(tcString, tlCheckD)

function strToEan13($tcString)
{

//    LOCAL lcLat, lcMed, lcRet, lcJuego, ;
//       lcIni, lcResto, lcCod, ;
//       lnI, lnCheckSum, lnAux, laJuego(10), lnPri

   //lcRet=ALLTRIM(tcString)

   $lcRet=trim ($tcString);

   //echo ($lcRet);


   //strlen($str)
//    if (strlen($lcRet)<>12)
//    {
//         echo "error";
//         return "";
//    }
   


//    IF LEN(lcRet) # 12
//       *--- Error en parámetro
//       *--- debe tener un len = 12
//       RETURN ""
//    ENDIF


//    *--- Genero dígito de control
//    lnCheckSum=0
      $lnCheckSum = 0 ;

//    FOR lnI = 1 TO 12
//       IF MOD(lnI,2) = 0
//          lnCheckSum = lnCheckSum + VAL(SUBS(lcRet,lnI,1)) * 3
//       ELSE
//          lnCheckSum = lnCheckSum + VAL(SUBS(lcRet,lnI,1)) * 1
//       ENDIF
//    ENDFOR


for ($i = 1; $i <= 1; $i++) {

    //echo $i;

    if ( $i % 2 == 0 )
    {
     
        $lnCheckSum = $lnCheckSum + ( ( (int) substr($lcRet,$i,1) )  * 3 );
        echo "par".substr($lcRet,$i,1);
      
    }
    else
    {
   
        $lnCheckSum = $lnCheckSum + ( ( (int) substr($lcRet,$i,1) ) * 1 );        
        echo "impar".substr($lcRet,$i,1) ;      
          
    }
     
}

//echo $lnCheckSum;
//    lnAux = MOD(lnCheckSum,10)

$lnAux = $lnCheckSum % 10 ;

// lcRet = lcRet + ALLTRIM(STR(IIF(lnAux = 0, 0, 10-lnAux)))

if ( $lnAux == 0)
{
    $lcRet = $lcRet . ( '0');
    
}
else
{
// lcRet = lcRet + STR( 10-lnAux ))    
   $lcRet = $lcRet . strval( 10 - $lnAux )  ;  
}

echo $lcRet ;


die();

 }


//    lcRet = lcRet + ALLTRIM(STR(IIF(lnAux = 0, 0, 10-lnAux)))

//    IF tlCheckD
//       *--- Si solo genero dígito de control
//       RETURN lcRet
//    ENDIF

//    *--- Para imprimir con fuente True Type EAN13
//    *--- 1er. dígito (lnPri)
//    lnPri = VAL(LEFT(lcRet, 1))
//    *--- Tabla de Juegos de Caracteres
//    *--- según "lnPri" (¡NO CAMBIAR!)
//    laJuego(1) = "AAAAAACCCCCC"   && 0
//    laJuego(2) = "AABABBCCCCCC"   && 1
//    laJuego(3) = "AABBABCCCCCC"   && 2
//    laJuego(4) = "AABBBACCCCCC"   && 3
//    laJuego(5) = "ABAABBCCCCCC"   && 4
//    laJuego(6) = "ABBAABCCCCCC"   && 5
//    laJuego(7) = "ABBBAACCCCCC"   && 6
//    laJuego(8) = "ABABABCCCCCC"   && 7
//    laJuego(9) = "ABABBACCCCCC"   && 8
//    laJuego(10) = "ABBABACCCCCC"   && 9

//    *--- Caracter inicial (fuera del código)
//    lcIni = CHR(lnPri + 35)
//    *--- Caracteres lateral y central
//    lcLat = CHR(33)
//    lcMed = CHR(45)

//    *--- Resto de los caracteres
//    lcResto = SUBS(lcRet, 2, 12)
//    FOR lnI = 1 TO 12
//       lcJuego = SUBS(laJuego(lnPri + 1), lnI, 1)
//       DO CASE
//          CASE lcJuego = "A"
//             lcResto = STUFF(lcResto, lnI, 1, CHR(VAL(SUBS(lcResto, lnI, 1))+48))
//          CASE lcJuego = "B"
//             lcResto = STUFF(lcResto, lnI, 1, CHR(VAL(SUBS(lcResto, lnI, 1))+65))
//          CASE lcJuego = "C"
//             lcResto = STUFF(lcResto, lnI, 1, CHR(VAL(SUBS(lcResto, lnI, 1))+97))
//       ENDCASE
//    ENDFOR

//    *--- Armo código
//    lcCod = lcIni + lcLat + SUBS(lcResto,1,6) + lcMed + SUBS(lcResto,7,6) + lcLat
//    RETURN lcCod
// ENDFUNC




function ean13($digits){
    //first change digits to a string so that we can access individual numbers
    $digits =(string)$digits;
    // 1. Add the values of the digits in the even-numbered positions: 2, 4, 6, etc.
    $even_sum = $digits{1} + $digits{3} + $digits{5} + $digits{7} + $digits{9} + $digits{11};
    // 2. Multiply this result by 3.
    $even_sum_three = $even_sum * 3;
    // 3. Add the values of the digits in the odd-numbered positions: 1, 3, 5, etc.
    $odd_sum = $digits{0} + $digits{2} + $digits{4} + $digits{6} + $digits{8} + $digits{10};
    // 4. Sum the results of steps 2 and 3.
    $total_sum = $even_sum_three + $odd_sum;
    // 5. The check character is the smallest number which, when added to the result in step 4,  produces a multiple of 10.
    $next_ten = (ceil($total_sum/10))*10;
    $check_digit = $next_ten - $total_sum;
    //echo $digits . $check_digit;
    return $digits . $check_digit ;
    }



////////////////////////////////////////////        

function hayDuplicados( $array_escaneado ) {

    $arr = $array_escaneado;
    $unique = array_unique($arr);
    $duplicates = array_diff_assoc($arr, $unique);

//dd($duplicates);

 
    return !empty($duplicates) ;
}


