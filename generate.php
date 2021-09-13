<?php

require_once __DIR__ . '/common.php';
list($count, $length, $name) = getArgs($argv);

// GENERATOR
$UNIQUE = [];
$md5_base = time();

while (count($UNIQUE) < $count) {
	$new_code = null;
	do {
		$new_code = substr(md5($name.$md5_base), 0, $length);
		$md5_base++;
	}
	while (array_key_exists($new_code, $UNIQUE));

	$UNIQUE []= $new_code;
}

// OUTPUT
outputXLS($UNIQUE, $name);
outputCSV8($UNIQUE, $name);
outputCSV16($UNIQUE, $name);
