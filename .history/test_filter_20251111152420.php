<?php
require_once 'App/Models/mobil.php';

$mobil = new Mobil();

// Test filter with automatic transmission
$result = $mobil->filterMobil(null, 'automatic', null, null, 10, 0);
if ($result !== null) {
    echo 'Filter result count: ' . count($result) . PHP_EOL;

    if (!empty($result)) {
        echo 'First result: ' . PHP_EOL;
        var_dump($result[0]);
    } else {
        echo 'No results found' . PHP_EOL;
    }
} else {
    echo 'Filter returned null' . PHP_EOL;
}

// Test count
$count = $mobil->countFilterMobil(null, 'automatic', null, null);
echo 'Count result: ' . $count . PHP_EOL;
?>
