<?php
//SYSTEM SETTINGS
$base_url = 'http://' . $_SERVER['SERVER_ADDR'];
//$signin_url = substr($base_url . $_SERVER['PHP_SELF'], 0, -(6 + strlen(basename($_SERVER['PHP_SELF']))));
$signin_url = $base_url . "/login/";
//DO NOT CHANGE
$ip_address = $_SERVER['REMOTE_ADDR'];
