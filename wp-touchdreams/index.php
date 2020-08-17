<?php
/*
 * Plugin Name: TouchDreams Test
 * Description: Test provided from TouchDreams. USAGE: Add [sj_touchdreams] to any page
 * Version: 1.0
 * Author: Steven Jackson
 * Author URI: https://www.linkedin.com/in/steven-jackson-199978b3/
 * Text Domain: sj-test
 */

 
if (!function_exists('add_action')) {
    echo "You cannot access this plugin directly";
    exit;
}

include('includes/api.php');
include('includes/functions.php');

function sj_touchdreams_list_countries()
{
    $response = fetch_countries();
    $filterCountries = filter_countries_by_character($response);


    if (!$filterCountries) {
        echo 'Could not find any Countries matching your filter';
        die();
    }
    $html = "<h4>WP Plugin - Steven Jackson</h4>";
    $html .= "<ul>";

    foreach ($filterCountries as $value) {
        $html .= "<li>$value</li>";
    }
    return $html .= "</ul>";
}

add_shortcode('sj_touchdreams', 'sj_touchdreams_list_countries');
