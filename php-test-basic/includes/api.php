<?php
// Fetch countries from API
function fetch_countries()
{
    $url = 'https://restcountries.eu/rest/v2/?fullText=true';
    $response = json_decode(@file_get_contents($url));
        
    if (!$response) {
        echo 'There is a problem with the API. Please try again later';
        die();
    }
    return $response;
}
