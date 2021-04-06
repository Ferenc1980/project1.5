<?php
ob_start();

if(!preg_match('/\badminisztrator\b/', $_SESSION['user']))
    header("Location:index.php");

	//require_once 'config.php';

if(isset($_GET['editId']))
	include "szabadsag\\edit.php";
else if(isset($_GET['deleteId']))
	include "szabadsag\\delete.php";
else{
	include "szabadsag\\szabadsagAdmin.php";
}	
?>
                      