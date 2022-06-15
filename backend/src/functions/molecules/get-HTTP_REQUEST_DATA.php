<?php

/**
 *
 * @author Lucas Victor
 *
 * @package GBL
 * @subpackage EASY HTTP REQUEST DATA
 *
 * @version 3.0.0
 *
 * @since 1.0.0 - Introduced
 * @since 2.0.0 - CURLOPT_HTTPHEADER option added
 *              - CURLPOT_HEADER dynamic
 * @since 2.0.1 - @param http_header and @param header inverted
 * @since 2.1.0 - @return OBJECT - response code and content
 * @since 3.0.0 - @method get_file_content()
 *              - @requires JSON.PHP
 *
 */

function HTTP_REQUEST_DATA( $method, $url, $datas = NULL, $payloadJson = false, $http_header = NULL, $header = 0, $to_json = true )
{

    $metodo = $method == true ? 1: 0;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, $header);

    if ($http_header)
        curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    curl_setopt($ch, CURLOPT_POST, $metodo);


    if( $datas ) {
        if ($payloadJson)
            curl_setopt($ch, CURLOPT_POSTFIELDS, json($datas) );
        else
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($datas) );
    }

    $dados = curl_exec($ch);

    if ($to_json)
        $dados = json_decode($dados);

    $data['content'] = $dados;
    $data['info'] = curl_getinfo($ch);
    curl_close($ch);

    return( to_object($data) );

}

function get_file_content($url, $json = true)
{
    /**
     *
     * @requires get-HTTP_REQUEST_DATA.php --- @version 3.0.0
     *
     */
    $file_content = file_get_contents($url);
    if ($json)
        return unjson($file_content);
    else
        return $file_content;
}