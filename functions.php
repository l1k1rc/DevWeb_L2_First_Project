<?php
    /*Allows to list each file in a repository and then, create a menu "nav"*/
    function parseDirectory($path){
        $tab=array();
        if($dossier = opendir($path))
        {
            while(false !== ($fichier = readdir($dossier)))
            {
                if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
                {
                    $tab[]=$path.''.$fichier.'/';//slash important
                 } 
             } 
            closedir($dossier);
        }
        else
             echo 'Le dossier n\' a pas pu être ouvert';
         return $tab;
    }
    /*Allows to research a name in the tree view and display a list relative*/
    function lister($chemin,$nomARechercher)
    {
       $valuesFind=array();
       $nom_repertoire = $chemin;
       $pointeur = opendir($nom_repertoire);
       while ($fichier = readdir($pointeur))
       {
          if(($fichier != '.') && ($fichier != '..'))
          {
             if (is_dir($nom_repertoire.'/'.$fichier))
             {
                lister($nom_repertoire.'/'.$fichier,$nomARechercher);
             }
             else
             {
                if(strpos($fichier,$nomARechercher) !== FALSE){
                    $valuesFind[]=$nom_repertoire.'/'.$fichier;
                }
             }
          }
       }
       echo '<ul>';     
       foreach ($valuesFind as $val) {
           echo '<li style="color:black;">'.sortForLister($val).'</li>';
       }

       echo '</ul>';
       closedir($pointeur);
    }
    function sortForLister($name){
        $another=explode("/", $name);
        $newname=$another[1].':'.$another[2].':'.$another[3];
        return $newname;
    }
    /*Allows to read a csv file and get each value*/
    function readCSVFile(){
        $line=1;
        $file=fopen("file.csv", "a+");
        $values=array();
        while($tab=fgetcsv($file,1024,';')){
            $field=count($tab);
            $line++;

            for($i=0;$i<$field;$i++){
                $values[]=$tab[$i];
            }
        }
        return $values;
    }
    /*Display the list with each pathway for the student*/
    function displayChoiceForStudents(){
        echo '<div class="select-style">';
        echo '<select name="choice">';
        parseRootDirectoryListVersion('uploads/');
        echo '</select></div>';
    }
    function parseRootDirectoryListVersion($way){
        $value=array();
        $value=parseDirectory($way);
        for($i=0;$i<sizeof($value);$i++){
            echo '<optgroup label="'.$value[$i].'" >';
            parseAfterRootDirectoryListVersion($value[$i]);
            echo '</optgroup>';
        }

    }
    function parseAfterRootDirectoryListVersion($way){
        $value=array();
        $value=parseDirectory($way);
        for($i=0;$i<sizeof($value);$i++){
            echo '<option value="'.$value[$i].'">'.$value[$i].'</option>';
        }
    }
    /*and of the list build*/
?>
