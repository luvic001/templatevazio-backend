<?php

function is_lh()
{
	
	$sv = $_SERVER['HTTP_USER_AGENT'];
	if (strpos($sv, 'Lighthouse'))
		return true;
	else
		return false;

}

function is_safari()
{
	
	$sv = $_SERVER['HTTP_USER_AGENT'];
	if (strpos($sv, 'Safari'))
		return true;
	else
		return false;

}