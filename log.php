<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="cssIndexPages.css" media="screen">
	<style>
		input[type=text], input[type=password]{
			width: 100%;
			padding :12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		form{
			width: 100%;
			padding: 20px;
			border: 1px solid #f1f1f1;
            border-radius: 4px;
			background: #fff;
			box-shadow: 0 0 20px 0 rgba(0,0,0,0.2), 0 5px 5px rgba(0,0,0,0.24);
            -webkit-animation-name: etu-log-animation; 
            -webkit-animation-duration: 1s; 
            animation-name: etu-log-animation;
            animation-duration: 1s;
            position: relative;
		}
        body{
            color: #fff;
            background:url(/pictures/ucp-SaintMartin.jpg);
            -webkit-animation-name: etu-log-backgroundanim; 
            -webkit-animation-duration: 2s; 
            animation-name: etu-log-backgroundanim;
            animation-duration: 2s;
            position: relative;
            background-position: center;
        }
	</style>
</head>
<body>
	<div id="contain">
        <form action="session.php" method="post">
			<h1>Connexion</h1>

			<label><b>Login :</b></label>
			<input type="text" name="login" placeholder="Entrez votre login" required="" <?php 
			if(!empty($_COOKIE['log']['login'])){
			echo 'value="'.$_COOKIE['log']['login'].'">';
			}else{ echo '>';} ?>
                   
			<label><b>Password :</b></label>
			<input type="password" name="pass" placeholder="Entrez votre mot de passe" required="" <?php 
			if(!empty($_COOKIE['log']['psw'])){
			echo 'value="'.$_COOKIE['log']['psw'].'">';
			}else{ echo '>';} ?>

			<br /><input type="checkbox" id="remember" name="remember">
			<label style="color:black;" for="remember">Se souvenir de moi</label>

			<input type="submit" name="valid" value="LOGIN">
		</form>
    </div>
    <a href="/index.php"><button class="button" autofocus=""></button></a>
</body>
</html>