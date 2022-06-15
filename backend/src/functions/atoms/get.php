<?php 

if (!defined('PATH')) exit;

/**
 * @version 3.0
 * 
 * @since 1.0 - Introduced
 * @since 2.0 - @method get_modules()
 * @since 3.0 - @method get_modules() - added @param variables (ARRAY) ]
 * 
 * @author Lucas Victor
 * 
 */

function get( $handle = '', $ext = '.php' )
{  
    global $TEMPLATE_DIRECTORY;
    if (file_exists($TEMPLATE_DIRECTORY . '/src/' . $handle . $ext)){
        require ( $TEMPLATE_DIRECTORY . '/src/' . $handle . $ext);
        return true;
    }
    else {
        ___a(sprintf('O arquivo <em>%s</em> não foi encontrado', $handle));
        return false;
    }
}

function get_modules( $file, $module = 'global', $variables = null )
{
    
    if ($variables){
        foreach ($variables as $key => $value){
            global $$key;
            $$key = $value;
        }
    }

    $mod = get( 
        sprintf(
            '/modules/%s/%s', 
            $module, 
            $file 
        ) 
    );

    if ($mod)
        return true;
    else
        return false;

}