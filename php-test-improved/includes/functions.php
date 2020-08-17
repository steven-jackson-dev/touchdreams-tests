<?php
function filter_countries_by_character($response, $begin = 'a', $end = 'a')
{
    // Gaurd Clauses
    // Check if the required parameter exists and if it is a array
    if (!$response || !is_array($response)) {
        return 0;
    }

    // Check if optional parameters is great than a single character and if it is not a string
    if (!is_string($begin) || !is_string($end) ||  strlen($begin) > 1 ||  strlen($end) > 1) {
        return 0;
    }
    // End Gaurd Clauses

    $begin = strtolower($begin);
    $end = strtolower($end);
    $filterCountries = [];

    // Loops through response parameter
    foreach ($response as $key => $value) {
        $countryName = strtolower($response[$key]->name);
        $countryLength = strlen($countryName);
        $firstCharacter = substr($countryName, 0, 1);
        $lastCharacter = substr($countryName, $countryLength - 1, $countryLength);

        // Checks if the encoding is in ASCII and continues the loop
        if (mb_detect_encoding($firstCharacter, 'auto') !== 'ASCII') {
            continue;
        }

        // If both the first and last character match the inputted characters. Push to array
        if ($firstCharacter ===  $begin && $lastCharacter ===  $end) {
            array_push($filterCountries, $response[$key]->name);
        }
    }

    return $filterCountries;
}

// Performance test function
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
