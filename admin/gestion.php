<?php require('../parseDir.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Gestion</title>
	<link rel="stylesheet" type="text/css" href="/cssIndexPages.css" media="screen">
	<style type="text/css">
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
			background: #fff;
			box-shadow: 0 0 20px 0 rgba(0,0,0,0.2), 0 5px 5px rgba(0,0,0,0.24);
		}
        body{
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
	<div id="inscrip">
		<form action="searcher.php" method="post" enctype="multipart/form-data" >
			<h1>Paramétrage</h1>
			<label><b>Ajouter une filière  :</b></label>
			<input type="text" name="newPathway" placeholder="Nom de l'année">
			<input type="submit" name="valid1" value="Ajouter l'année">
			<label><b>Ajouter un groupe de TD : </b></label>
			<input type="text" name="newPathwayGroup" placeholder="Nom du groupe de TD (ex: 'Licence1/TDB' )">
			<input type="submit" name="valid2" value="Ajouter le groupe">
			<label><b>Supprimer un dossier (Filière ou année)  :</b></label>
			<input type="text" name="rmDirectory" placeholder="Nom de l'année ou du groupe de TD">
			<input type="submit" name="valid3" value="Supprimer l'année">
		</form>
	</div>
	<div id="treeView">
		<?php parseRootDirectory('../uploads/'); ?>
	</div>
</body>
</html>
