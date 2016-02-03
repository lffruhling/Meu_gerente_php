<?php
$addr = $_SERVER['SERVER_ADDR'];
$host = "http://$addr/dmp_desenv/";

session_name('userlogin');
//session_id();
session_start();
$_SESSION['autenticado'] = 'SO';
unset($_SESSION['ultimoacesso']);
header("location:$host");
?>