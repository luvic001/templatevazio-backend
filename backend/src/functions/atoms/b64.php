<?php

if (!defined('PATH')) exit;

function b64($param)
{ return str_ireplace('=', '', base64_encode($param)); }

function unb64($param)
{ return base64_decode($param); }