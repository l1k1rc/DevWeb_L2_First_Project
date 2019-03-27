<?php
    require('functions.php');
    /*Access part with the session mechanism and the building of the page*/
    session_start ();
    function generatePage($way){
        if(!empty($_SESSION['login'])){
            echo '<!DOCTYPE html><html lang="fr">';
            echo '<head>';
            echo '<meta charset="UTF-8" />';
            echo '<title>Page de notre section membre</title>';
            echo '<link rel="stylesheet" type="text/css" href="../cssIndexPages.css" media="screen">';
            echo '<style>
                    body{
                        width: 100%;
                        height:100%;
                        margin:auto;
                        color: #fff;
                        background: linear-gradient(-45deg,#E73C7E,#f19551,#ed1111,#9527b8);/*for different colors gradation*/
                        background-size: 1000% 1000%;
                        -webkit-animation: Gradient 15s ease infinite;/* call the different gradient*/
                        -moz-animation: Gradient 15s ease infinite;
                        animation: Gradient 15s ease infinite;
                        }
                </style>';
            echo '</head>';
            echo '<body>';
            
            echo '<br />';
            //echo '<header><h1>Accès aux année universitaire</h1></header>';
            //
            echo '<div id="bodyuserinterface">';
            /*navuser*/
            echo '<div id="navuser">';
            echo '<div id="userImage">';
            echo '</div>';
            echo '<p id="logger"> '.$_SESSION['login'].'  </p>';
            echo '<form action="acces.php" method="post" name="searcher" id="searcher">';
            echo '<input type="text" name="search" id="search" placeholder="Rech..">';
            echo '</form>';
            echo '<a href="./admin/gestion.php">';
            echo '<div id="treemanager">';
            echo '<p>Modifier Fillière</p>';
            echo '</div>';
            echo '</a>';
            echo '<a href="acces.php"><div style="margin-top:217%;" class="disconnected"><p>Menu</p></div></a>';
            echo '<a href="./logout.php">';
            echo '<div class="disconnected">'; 
            echo '<p>Déconnexion</p>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
            /*end navuser*/
            for($i=0;$i<20;$i++){//Mettre une grande valeur, ne pouvant pas récupérer la taille du tableau facilement, on place une valeur importante ici, car théoriquement, il ne peut y avoir + de 20 groupe de TD ou Année.
                if(isset($_POST['valid'.$i])){
                    $way = $_POST['hid'.$i];
                    //generateFormMenu($_POST['hid'.$i]);//contient le chemin suivant
                }
            }
            if(isset($_POST['search']) && !empty($_POST['search'])){
                echo '<div id="resultOfSearch">';
                lister('uploads',$_POST['search']);
                echo '</div>';
            }
            else{
                generateFormMenu($way);
            }
            echo '</div>';
            echo '</body></html>';
        }
        //prevent the Ctrl-Z after the logout
        else{
            header('Location: index.php');
            exit();
        }
    }
    /*Display the content of the directory sent to the function in the alphabetic order*/
    function affRep($rep){ 
        date_default_timezone_set('Europe/Paris');
        $repertory = opendir($rep) or die('Erreur : répertoire non trouvé : '.$rep);
        $count=0;
        echo '<div id="galery">';
        echo '<div id="labelusergalery">';
        echo '<p style="color:white;">Liste des Etudiants de '.sortForTheRep($rep).'</p>';
        echo '</div>';
        while($fRead = @readdir($repertory)) {
           if(!(is_dir($rep.'/'.$fRead)&& $fRead != '.' && $fRead != '..')) {
                $extension=strtolower(strrchr($fRead,'.'));
                if (in_array ($extension, array ('.gif','.jpg','.jpeg','.png'))){
                  echo '<div id="case" class="tooltip">';
                  echo '<img class="tooltip" style="border: 3px solid #3d9af5; border-radius: 3px; box-shadow: 0 0 20px 0 rgba(0,0,0,0.2), 0 5px 5px rgba(0,0,0,0.24);" src="'.$rep.''.$fRead.'" alt=""/>';
                  echo '<p id="etuName">'.sortFileName($fRead).'</p>';
                  echo '<span class="tooltiptext">Ajouter le '.date("F d Y H:i:s.",filemtime($rep.$fRead)).'</span>';
                  echo '</div>';
                  $count++;
                }
            }
        }
        echo '<p>Il y a <strong>'.$count.'</strong> étudiant.e(s) dans le groupe.</p>';
        echo '</div>';

        closedir($repertory);  
    }
    /*Function which allows to sort each filename sent in argument in order to simplify the display*/
    function sortFileName($name){
        $removeExt=explode(".", $name);
        $newFileName=$removeExt[0];
        $element=explode("_", $newFileName);
        $newName=$element[0].' '.$element[1];

        return $newName;
    }
    function sortForTheRep($rep){
        $removeS=explode("/", $rep);
        $newName=$removeS[1].' '.$removeS[2];

        return$newName;
    }
    /*
    The idea of this function is to set up a form division as long as the user browses the tree, however, if it falls on a file and not a folder, the call ends.
    */
    function generateFormMenu($way){
    $tab=array();
        if($tab=parseDirectory($way)){// si le dossier est "parcourable" (=parsable)
            if(get_file_ext($tab[0])=='jpg' || get_file_ext($tab[0])=='jpeg' || get_file_ext($tab[0])=='png' || get_file_ext($tab[0])=='bmp'){
                affRep($way);// display the content of the folder with the name
            }
            else{
                    $length=array();
                    $length=parseDirectory($way);
                    echo '<div id="form">';
                    echo '<div id="labeluserinterface">';
                    echo '<p>Espace Personnel</p>';
                    echo '</div>';
                    echo '<form action="acces.php" method="post" id="menu">';
                    for($i=0;$i<sizeof($length);$i++){
                           echo '<input type="hidden" name="hid'.$i.'" value="'.$length[$i].'" />';
                           echo '<input class="but" type="submit" name="valid'.$i.'" value="'.setTheRealName($length[$i]).'"/>';
                    }
                    echo "</form></div>";
                }
        }else{
            echo '<div id="contain">
            Aucun fichier
            </div>';
        }
    }
    /*Complementary function witch @generateFormMenu(), it allows to build another form under the main one to display the tree view*/
    /*function whatDoYouDoFor(){
        for($i=0;$i<20;$i++){//Mettre une grande valeur, ne pouvant pas récupérer la taille du tableau facilement, on place une valeur importante ici, car théoriquement, il ne peut y avoir + de 20 groupe de TD ou Année.
            if(isset($_POST['valid'.$i])){
                generateFormMenu($_POST['hid'.$i]);//contient le chemin suivant
            }
        }
    }*/
    /*Allows to get the file extension*/
    function get_file_ext($file)
    {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        return $ext;
    }
    /*Allows to simplify a filename to avoid to display the absolute path in front of the user */
    function setTheRealName($name){
        $tab=explode("/", $name);
        $length=sizeof($tab);
        $newName=$tab[$length-2];
        return $newName;
    }
    function movePhoto(){
        displayChoiceForStudents();
    }
    generatePage("uploads/");
    
?>
