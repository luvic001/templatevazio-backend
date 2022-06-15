<?php

if (!defined('PATH')) exit;

if (CONNECT_DB)
{
    try 
    {
        global $db;
        $db = 
            new PDO(
                sprintf
                (
                    'mysql:host=%s;dbname=%s;charset=utf8',
                    DB_HOST,
                    DB_NAME
                ), 
                DB_USER, 
                DB_PASS
            );
    }
    catch( PDOException $e )
    {
        die( $e->getMessage() );
    }
}