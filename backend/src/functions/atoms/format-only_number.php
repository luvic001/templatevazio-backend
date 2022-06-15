<?php 

if (!defined('PATH')) exit;

// I love only numbers <3

function only_number( $param )
{

    $data = preg_replace( '/\D/', '', $param );

    return( $data );

}