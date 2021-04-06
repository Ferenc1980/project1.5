<?php
require_once "config.php";

if(isset($_POST['beSubmit'])){
	extract($_POST);
	$sql="select azonosito,nev,jog from szemelyek where nev='{$nev}' and jelszo='{$password}'";
	$stmt=$db->query($sql);
	if($stmt->rowCount()==1){
		$row=$stmt->fetch();
		$role=$row["jog"]=="admin" ? "adminisztrator" : "";
		$_SESSION['user']=$row['nev']." ".$role;
		$_SESSION['id']=$row['azonosito'];
		unset($_SESSION['msg']);
	}else{
		$_SESSION['msg']=$_POST['nev']."- Rossz név/jelszó páros!";
		unset($_SESSION['user']);
	}
	header('Location:index.php');
}

if(isset($_POST['kiSubmit'])){
	session_destroy();
	header('Location:index.php');
}
?>
<div class="row justify-content-center">
<div class="col-md-4 border p-2">
    <form class="form-signin p-2" method="post">
	   <h1 class="h3 mb-3 font-weight-normal text-center">Bejelentkezés</h1>
      <label for="inputEmail" class="sr-only">Név</label>
      <input type="text" id="fnev" name="nev" class="form-control mb-2" placeholder="Add meg a neved" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control mb-2" placeholder="jelszo" required>
      <button class="btn btn-lg btn-primary btn-block" name="beSubmit" type="submit">Bejelentkezés</button>
	</form>
	
	<form class="form-signout p-2 border" method="post">
		<button class="btn btn-lg btn-secondary btn-block" name="kiSubmit" type="submit">Kijelentkezés</button>
	</form>
 </div>
</div>