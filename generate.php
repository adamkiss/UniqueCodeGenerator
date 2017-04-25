<?php
	list($count, $length, $name, $format) = array_pad(array_slice($argv, 1), 4, null);

	if (is_null($count)) { $count = 20; }
	if (is_null($length)) { $length = 6; }
	if (is_null($name)) { $name = 'output-'.time(); }
	if (is_null($format)) { $format = 'xlsx'; }

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

	require_once __DIR__ . '/vendor/autoload.php';
	$output_file = __DIR__ . "/output/$name.$format";
	switch ($format) {
		case 'xlsx': case 'xls':
			$output = [];
			foreach($UNIQUE as $u){
				$output []= ['kod'=>$u, 'pouzitie'=>' '];
			}
			$opts = [
				'title' => "{$count} unikatnych kodov pre {$name}",
				'subject' => "{$count} unikatnych kodov pre {$name}",
				'creator' => 'Unique Code Generator v1'
			];
			\DPRMC\Excel::simple($output, [], 'Kody', $output_file, $opts);
		break; default:
			file_put_contents($output_file, implode("\n", $UNIQUE));
	}