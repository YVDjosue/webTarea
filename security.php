<?php

//archivo de seguridad
session_start();

if($_SESSION['logeado']!='si'){
	header('Location: login.html');
}

?>