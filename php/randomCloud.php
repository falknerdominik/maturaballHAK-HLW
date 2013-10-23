<?php

	// Read GET-Parameter
	$dir = $_GET['dir'];
	
	// change randomgen seed
	mt_srand();
	
	// Variables
	$showClass = mt_rand(1, 7);
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
	$dir .= $classPrefix;

	// Find Random File
    $files = glob($dir . '*.JPG');
	// choose file ond random
    $file = array_rand($files);
	
	// filter the ../ out
	$path = substr_replace($files[$file], '', 0, 3);
	
	// filter name
	$nameInklExtension = substr_replace($files[$file], '', 0, 23);
	$name = str_replace('_', ' ', substr($nameInklExtension, 0, -4));

	// Put element together
	$element = "<div><a href='" . $path . "' title='" . $name . "' rel='lightbox'>" . 
					"<img src='" . $path . "' alt='Maturant/in' /></a>" . 
					"<img src='img/site/miniwolkeEinschnitt.png' class='cut' alt='Einschnitt' /></div>";
	
	// Ausgabe
	echo $element;
?>