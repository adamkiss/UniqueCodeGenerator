<?php

require_once __DIR__ . '/vendor/autoload.php';

function getArgs($argv) {
	list($count, $length, $name) = array_pad(array_slice($argv, 1), 4, null);

	return [
		$count ?? 20,
		$length ?? 6,
		$name ?? 'output-' . time()
	];
}

function getOutputName($name, $ext = 'csv') {
	return __DIR__ . "/output/{$name}.{$ext}";
}

function outputXLS($codes, $name)
{
	$file = getOutputName($name, 'xlsx');
	$output = array_map(fn($code) => ['kod' => $code, 'pouzitie'=>' '], $codes);
	$opts = [
		'title' => sprintf('%d unikatnych kodov pre %s', count($codes), $name),
		'subject' => sprintf('%d unikatnych kodov pre %s', count($codes), $name),
		'creator' => 'Unique Code Generator v2'
	];
	\DPRMC\Excel\Excel::simple($output, [], 'Kody', $file, $opts);
}

function outputCSV8($codes, $name)
{
	$file = getOutputName("{$name}-utf8", 'csv');
	$output = implode("\n", ['kod', ...$codes]);
	file_put_contents($file, $output);
}

function outputCSV16($codes, $name)
{
	$file = getOutputName("{$name}-utf16", 'csv');
	$output = iconv("UTF-8", "UTF-16LE", implode("\n", ['kod', ...$codes]));
	file_put_contents($file, $output);
}
