<?php
    /*Allows to know if a name/family_name is included in the actual tree view*/
    function itExist($chemin,$nomARechercher)
    {
       $valuesFind=array();
       $nom_repertoire = $chemin;
       $pointeur = opendir($nom_repertoire);
       while ($fichier = readdir($pointeur))
       {
        //execpt '.' and '..' folders
          if(($fichier != '.') && ($fichier != '..'))
          {
             if (is_dir($nom_repertoire.'/'.$fichier))
             {
                itExist($nom_repertoire.'/'.$fichier,$nomARechercher);
             }
             else
             {
                if(strpos($fichier,$nomARechercher) !== FALSE){
                    $valuesFind[]=$nom_repertoire.'/'.$fichier;
                }
             }
          }
       }
        if(!empty($valuesFind)){
            unlink($valuesFind[0]);
            sayOk('avec suppression de votre ancien trombinoscope.');
        }
       closedir($pointeur);
    }
    function getDimension(){
        $image_size=getimagesize($_FILES['image']['tmp_name']);
        if($image_size[0]>100 OR $image_size[1] > 100){
            echo "image trop grande";
        }
    }
    /*Allows to know if the name/family_name in the forms are correct*/
    function acceptChar(){
      if ( preg_match ( " \^[a-zA-Z0-9_]{3,16}$\ " , $_POST['name'] ) )
        {
        echo "Le pseudo ou login est valide";
        }
    }
    /*Treatment function to send a file from temporary folder to treeview*/
    function sendFile(){
            $content_dir = $_POST['choice']; 
            acceptChar();
            if(!is_dir($content_dir)){
                sayWarning("Ce n'est pas une image");
            }
            $tmp_file = $_FILES['image']['tmp_name'];

            if( !is_uploaded_file($tmp_file) ){
                sayWarning("Erreur survenue");
            }

            itExist('uploads',$_POST['family_name'].'_'.$_POST['name']);
            
            $type_file = $_FILES['image']['type'];

            if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png') ){
                sayWarning("Le fichier n'est pas une image !");
            }

            $name_file = $_FILES['image']['name'];
            $ext=$_FILES['image']['name'];
            $new_name=$_POST['family_name'].'_'.$_POST['name'];
            //Don't forget to get the extension part
            if( !move_uploaded_file($tmp_file, $content_dir . $new_name.'.'.pathinfo($ext,PATHINFO_EXTENSION)) ){
                sayWarning("Impossible de copier le fichier dans $content_dir");
            }
            sayOk();
    }
    /*Function to redirect in HTML version, the user if the file-opload is correct*/
    function sayOk($deleted=''){
        echo '<body onLoad="alert(\'Votre inscription a bien été prise en compte '.$deleted.'.\')">';
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }
    /*Function to redirect in HTML version, the user if the file-opload isn't correct*/
    function sayWarning($deleted=''){
        echo '<body onLoad="alert(\'Attention ! '.$deleted.'.\')">';
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
        exit();
    }
    /*Allows to detect cookie and display the image in function of this one*/
    function forcookie(){
        if(isset($_COOKIE['imageSaved'])){
          echo '<img id="output" src="'.$_COOKIE['imageSaved'].'" style="max-width: 180px; margin: 10px;" alt="" />';
        }else{
          echo '<img id="output" style="max-width: 180px; margin: 10px;" src="pictures/userimage.png" alt=""/>';
        }
    }
    /*Allows to detect cookie and display the family_name in function of this one*/
    function forcookieFamilyName(){
        if(isset($_COOKIE['imageSaved'])){
          echo '<input type="text" name="family_name" id="family_name" value="'.$_COOKIE['string']['familyName'].'" placeholder="Nom de famille" required="">';
        }else{
          echo '<input type="text" name="family_name" id="family_name" placeholder="Nom de famille" required="">';
        }
    }
    /*Allows to detect cookie and display the name in foncton of this one*/
    function forcookieName(){
        if(isset($_COOKIE['imageSaved'])){
          echo '<input type="text" name="name" id="name" value="'.$_COOKIE['string']['name'].'" placeholder="Prénom" required="">';
        }else{
          echo '<input type="text" name="name" id="name" placeholder="Prénom" required="">';
        }
    }
    
    //If we validate the registration, a cookie is created with its new path, which will serve to redisplay the image formerly sent by the user via the use of the COOKIE variable, since the path is changed by the file-upload, this operation is necessary
    if(isset($_POST['valid'])){
       setcookie('imageSaved',$_POST['choice'].$_POST['family_name'].'_'.$_POST['name'].'.'.pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION), (time() + 3600));
       setcookie('string[familyName]',$_POST['family_name']);
       setcookie('string[name]',$_POST['name']);

       sendFile();
    }

?>