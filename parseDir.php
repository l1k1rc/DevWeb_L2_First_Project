<?php
	require('functions.php');
	
	/*DIsplay the tree view for the gestion page*/
    function parseRootDirectory($way){
    	$value=array();
    	$value=parseDirectory($way);
    	for($i=0;$i<sizeof($value);$i++){
    		echo '<br />'.$value[$i].'<br />';
    		parseAfterRootDirectory($value[$i]);
    	}

    }
    function parseAfterRootDirectory($way){
    	$value=array();
    	$value=parseDirectory($way);
    	for($i=0;$i<sizeof($value);$i++){
    		echo '..'.$value[$i].'<br />';
    	}
    }
?>