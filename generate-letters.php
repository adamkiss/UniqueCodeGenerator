<?php

require_once __DIR__ . '/common.php';
list($count, $length, $name) = getArgs($argv);

// GENERATOR
$UNIQUE = [];
$md5_base = time();
$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

while (count($UNIQUE) < $count) {
	$new_code = null;
	do {
		$new_code = implode('', array_map(function () use ($letters) {
			return $letters[rand(0, strlen($letters) - 1)];
		}, range(1, $length)));
	} while (array_key_exists($new_code, $UNIQUE));

	$UNIQUE []= $new_code;
}

// OUTPUT
outputXLS($UNIQUE, $name);
outputCSV8($UNIQUE, $name);
outputCSV16($UNIQUE, $name);
