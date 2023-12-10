<?php
include("config/connection.php");
include("config/main_connection.php");

$languageArray = ($_SESSION['language_array']);


function getEnglishKey($englishkey) {
	$translationsArray = $_SESSION['language_array'];
    foreach ($translationsArray as $translation) {
        if ($translation['english'] === $englishkey) {
            return $translation['arabic'];
        }
    }

    // Return a default value or handle the case when the Arabic key is not found
    return $englishkey;
}


echo getEnglishKey('From Bill No');



