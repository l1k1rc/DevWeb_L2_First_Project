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
            border-radius: 4px;
			background: #fff;
			box-shadow: 0 0 20px 0 rgba(0,0,0,0.2), 0 5px 5px rgba(0,0,0,0.24);
             -webkit-animation-name: indexanimation; 
            -webkit-animation-duration: 1s;
            animation-name: indexanimation;
            animation-duration: 1s;
            position: relative;
		}
        body {
            width: 100%;
            margin:auto;
            color: #fff;
            background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);/*for different colors gradation*/
            background-size: 400% 400%;
            -webkit-animation: Gradient 15s ease infinite;/* call the different gradient*/
            -moz-animation: Gradient 15s ease infinite;
            animation: Gradient 15s ease infinite; 
        }
	</style>
</head>
<body>
    <div id="contain">
        <form action="session.php" method="post">
            <h1>Qui êtes vous ?</h1>
            <a href="etu.php" >
                <div id="leftbutton">
                    <p>Etudiant</p>
                </div>
            </a>
            <a href="log.php" >
                <div id="rightbutton">
                    <p>Personnel</p>
                </div>
            </a>
        </form>
    </div>
</body>
</html>