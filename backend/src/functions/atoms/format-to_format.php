<?php

if (!defined('PATH')) exit;

function to_object($array)
{
    return(
        json_decode(
            json_encode($array)
        )
    );
}

function to_array($object)
{
    return(
        json_decode(
            json_encode($object),
            true
        )
    );
}