<?php
require_once(dirname(__FILE__) . '/includes/api.php');
require_once(dirname(__FILE__) . '/includes/functions.php');
$time_start = microtime_float();

$response = fetch_countries();
$filterCountries = filter_countries_by_character($response);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Basic Test</title>
</head>
<body>

<main>

<h1>PHP - Basic Test</h1>

<?php

if (!$filterCountries) {
    echo 'Could not find any Countries matching your filter';
    die();
}
?>

<ul>
<?php

foreach ($filterCountries as $value) {
    echo "<li>$value</li>";
}

?>
</ul>

<h3>Performance:</h3>
<?php
$time_end = microtime_float();

echo "Time Start: $time_start <br/>";
echo "Time End: $time_end <br/>";

$time = $time_end - $time_start;

echo "Did nothing in $time seconds";
?>
</main>

</body>
</html>