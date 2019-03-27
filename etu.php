<?php 
   require('functions.php');
   require('traitement.php');
   /*Student part for inscription.*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Etudiant</title>
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
      -webkit-animation-name: etu-log-animation; /* Safari 4.0 - 8.0 */
      -webkit-animation-duration: 1s; /* Safari 4.0 - 8.0 */
      animation-name: etu-log-animation;
      animation-duration: 1s;
      position: relative;
    }
    body{
        color: #fff;
        background:url(/pictures/ucp.jpg);
        -webkit-animation-name: etu-log-backgroundanim; /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 2s; /* Safari 4.0 - 8.0 */
        animation-name: etu-log-backgroundanim;
        animation-duration: 2s;
        position: relative;
        background-position: center;
    }
  </style>
</head>
<body>
	<div id="inscrip">
    <form action="traitement.php" method="post" enctype="multipart/form-data">
      <h1>Inscription</h1>
      <label><b>Votre nom :</b></label>
      <?php forcookieFamilyName(); ?>

      <label><b>Votre prénom :</b></label>
      <?php forcookieName(); ?>

      <label><b>Votre année :</b></label><br /><br />
      <?php displayChoiceForStudents(); ?>
      <br />
      <label><b>Votre photo :</b></label>
      <input type="file" accept="image/*" onchange="loadFile(event)" name="image" id="image" required="">
      <br />
      <?php 
        forcookie();
      ?>
        <script>
            var loadFile = function(event) 
            {
            var reader = new FileReader();
            reader.onload = function()
              {
                var output = document.getElementById('output');
                  output.src = reader.result;
              };
            reader.readAsDataURL(event.target.files[0]);
           };
          </script>
      <input type="submit" name="valid" value="Inscription">
    </form>
  </div>
  <a href="/index.php"><button class="button" autofocus=""></button></a>
</body>
</html>
