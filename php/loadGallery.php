<?php

	// Read GET-Parameter
	$dir = $_GET['dir'];
	
	// Find Random File
    $files = glob($dir . '*.JPG');
	$clouds = array();
	$i = 0;
	
	foreach ($files as $file) {
		// filter the ../ out
		$path = substr_replace($file, '', 0, 3);
		
		// filter name
		$nameInklExtension = substr_replace($file, '', 0, 23);
		$name = str_replace('_', ' ', substr($nameInklExtension, 0, -4));
		
		// add to cloud array
		$clouds[$i] = "<div class='galleryCloud'><a href='" . $path . "' title='" . $name . "' rel='lightbox'>" . 
				  "<img src='" . $path . "' alt='Maturant/in' /></a>" . 
				  "<img src='img/site/miniwolkeEinschnitt.png' class='cut' alt='Einschnitt' /></div>";
		echo $clouds[$i];
		$i++;
	}
?>