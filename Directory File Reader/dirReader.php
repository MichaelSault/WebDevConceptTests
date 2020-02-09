<?php
	$handler = opindir("images"); //read files from images directory
	$filesarray = array();	//
	while ($filename = readdir($handler)) {
		if (substr(strtolower($filename), -4) === '.bpm') { //traverse through file names
			$title = preg_replace('/(\w+).bpm/i', '$1', $filename);	//
			array_push($filesarray, "<img src=\"images/".$filename."\" alt=\"".title."\">\n"); //add file name to directory
		}
	}
	closedir($handler); //close the directory

	sort($filesarray);
	echo($filesarray);
	foreach ($filesarray as $value) {
		echo($value);
	}

?>