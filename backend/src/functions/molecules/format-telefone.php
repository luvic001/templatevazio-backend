<?php 

if (!defined('PATH'))
    exit;

function telefone($param){
    $phone_leng = strlen($param);
    if ($phone_leng == 10)
    {
        $error = false;
        $format = array (
            substr( $param, 0, 2 ),
            substr( $param, 2, 4 ),
            substr( $param, 6, 4 )
        );
        $telefone = "({$format[0]}) {$format[1]}-{$format[2]}";
    }

    elseif($phone_leng == 11)
    {
        $error = false;
        $format = array (
            substr( $param, 0, 2 ),
            substr( $param, 2, 5 ),
            substr( $param, 7, 4 )
        );
        $telefone = "({$format[0]}) {$format[1]}-{$format[2]}";
    }
    else {
        $error = true;
    }

    if ($error)
        return false;
    else
        return( $telefone );

}