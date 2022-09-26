<?php

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