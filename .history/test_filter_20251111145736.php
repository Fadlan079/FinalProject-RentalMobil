<?php
require_once 'App/Models/mobil.php';

$mobil = new Mobil();

// Test filter with automatic transmission
$result = $mobil->filterMobil('semua', 'automatic', 'semua', 'semua', 10, 0);
echo 'Filter result count: ' . count($result) . PHP_EOL;

if (!empty($result)) {
    echo 'First result: ' . PHP_EOL;
    var_dump($result[0]);
} else {
    echo 'No results found' . PHP_EOL;
}

// Test count
$count = $mobil->countFilterMobil('semua', 'automatic', 'semua', 'semua');
echo 'Count result: ' . $count . PHP_EOL;
?>
