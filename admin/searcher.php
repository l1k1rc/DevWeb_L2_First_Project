<?php
	/*Page gestion*/
	function createPathway($newPathway){
		if(!empty($_POST['newPathway']) || !empty($_POST['newPathwayGroup'])){
			if(!is_dir('../uploads/'.$newPathway)){//Si ce n'est pas déjà un rep' qui existe
				mkdir('../uploads/'.$newPathway);
			}
		}else{
			exit("error");
		}
		header('Location: gestion.php');
	}
	function rmRecursive($path) {
	    
	}
	if(isset($_POST['valid1'])){
		createPathway($_POST['newPathway']);
	}
	if(isset($_POST['valid2'])){
		createPathway($_POST['newPathwayGroup']);
	}
	if(isset($_POST['valid3'])){
		rmRecursive($_POST['rmDirectory']);
	}
?>