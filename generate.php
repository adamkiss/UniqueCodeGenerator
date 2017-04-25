<?php
	$args = array_pop($argv);
	list($count, $length, $name, $format) = $args;

	if (is_null($count)) { $count = 20; }
	if (is_null($length)) { $length = 6; }
	if (is_null($name)) { $name = 'output-'.time(); }
	if (is_null($format)) { $format = 'xls'; }

	$UNIQUE = [];
	$md5_base = time();

	while (count($UNIQUE) < $count) {
		$new_code = null;
		do {
			$new_code = substr(md5($md5_base), 0, $length);
			$md5_base++;
		}
		while (array_key_exists($new_code, $UNIQUE));

		$UNIQUE []= $new_code;
	}