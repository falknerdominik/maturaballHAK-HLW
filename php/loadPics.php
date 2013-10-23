<?php

	// Read GET-Parameter
	$dir = $_GET['dir'];
	
	// Find Random File
    $files = glob($dir . '*.jpg');
	$clouds = array();
	$i = 0;
	
	foreach ($files as $file) {
		// filter the ../ out
		$path = substr_replace($file, '', 0, 3);
		// give out img tag
		echo "<img href='" . $path . "' />";
		$i++;
	}
?>