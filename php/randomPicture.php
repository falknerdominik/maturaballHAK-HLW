<?php

	// Read GET-Parameter
	$class = $_GET['class'];

	// change randomgen seed
	mt_srand();
	
	// Variables
	if($class == 0){
		$showClass = mt_rand(1, 7);
	}
	else {
		$showClass = $class;
	}
	$classPrefix = '';
	
	// Pick a class on random
	switch($showClass){
		  		case 1:
		  			$classPrefix = "VaIT/";
		  			break;
		  		case 2:
		  			$classPrefix = "VbIT/";
		  			break;
		  		case 3:
		  			$classPrefix = "V_IM/";
		  			break;
		  		case 4:
		  			$classPrefix = "V_DB/";
		  			break;
		  		case 5:
		  			$classPrefix = "VaHL/";
		  			break;
		  		case 6:
		  			$classPrefix = "VbHL/";
		  			break;
		  		case 7:
		  			$classPrefix = "VcHL/";
		  			break;
	 }
	
	// Add classPrefix
	$dir = "../img/maturanten/" . $classPrefix;	

	// Find Random File
    $files = glob($dir . '*.JPG');
    $file = array_rand($files);
	$path = substr_replace($files[$file], '', 0, 3);
	
	echo $path;
	
?>