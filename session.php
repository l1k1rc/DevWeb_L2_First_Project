<?php
	require('functions.php');
	/*Allows to set the "remember me"*/
	if(isset($_POST['remember'])){
		setcookie('log[login]',$_POST['login']);
		setcookie('log[psw]',$_POST['pass']);
	}else{
		setcookie('log[login]', NULL, -1);//delete the cookie
		setcookie('log[psw]', NULL, -1);//delete the seccond cookie
	}
	/*Allows to open a new session and direct the user to another page*/
	if (isset($_POST['login']) && isset($_POST['pass'])) {
		if (in_array($_POST['login'], readCSVFile()) && in_array($_POST['pass'], readCSVFile())) {
			
	   		session_start ();
	    		
	   		$_SESSION['login'] = $_POST['login'];
	   		$_SESSION['pass'] = $_POST['pass'];
	    		
	     	header ('location: acces.php');
	   		}
	    else {
	    	echo '<body onLoad="alert(\'Membre non reconnu...\')">';
	    	echo '<meta http-equiv="refresh" content="0;URL=log.php">';
	    	}
	}
    else {
    	echo 'Les variables du formulaire ne sont pas déclarées.';
	}
?>