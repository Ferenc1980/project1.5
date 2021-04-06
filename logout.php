<?php
if(isset($_GET['p'])=='logout.php'){
	session_destroy();
	header('Location:index.php');
}
?> 

         