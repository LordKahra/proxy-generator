<?php

require_once 'gath_definitions.php';
require_once 'gath_cardbox.php';
require_once 'gath_dataparse.php';
require_once 'gath_symbols.php';

class GathererDataFetcher {

    static function getData($name) {
        return file_get_contents(CARD_DETAILS_START . urlencode(trim($name)));
    }

    static function getID ($name) { // Functional.
        //$url = CARD_DETAILS_START . urlencode($name);
        $data = self::getData($name);
        $position = strpos($data, ID_PREFIX); // Multiverse location.
        $start = substr($data, $position + 13); // String that starts after multiverse.
        $endpos = strpos($start, ID_SUFFIX); // Position of " after multiverse.

        $ID = substr($start, 0, $endpos); // String with text between "multiverse=" and final quotation.
        return $ID;
    }

    static function getImage ($name) { // Functional.
        $image = "";
        $image .= IMG_START . self::getID ($name) . IMG_END;
        return $image;
    }

}

// ID GETTERS /////
function EchoIDFromName ($name) { // Functional.
    $url = CARD_DETAILS_START . urlencode($name);
    $data = file_get_contents($url); // $URL will be here.
    $position = strpos($data, ID_PREFIX); // Multiverse location.
    $start = substr($data, $position + 13); // String that starts after multiverse.
    $endpos = strpos($start, ID_SUFFIX); // Position of " after multiverse.
    
    $ID = substr($start, 0, $endpos); // String with text between "multiverse=" and final quotation.
    echo $ID;
}

function EchoIDFromNameAndSet ($name, $set) { // Functional.
    $url = CARD_DETAILS_START . urlencode($name);
    $data = file_get_contents($url); // $URL will be here.
    $position = strpos($data, SET_PREFIX . $set); // Post-ID Image Prefix location.
    $start = substr($data, $position - 25, 23); // String that ends with ID.
    $endpos = strpos($start, ID_PREFIX); // Pre-ID Prefix location.
    
    $ID = substr($start, $endpos + 13);
    echo $ID;
}

// CARD IMAGE URL GETTERS /////

function EchoImageFromID ($ID) { // Functional.
    echo HTML_IMG_START;
    echo IMG_START;
    echo $ID;
    echo IMG_END;
    echo HTML_IMG_END;
}

function EchoImageFromName ($name) { // Functional.
    echo HTML_IMG_START;
    echo IMG_START;
    EchoIDFromName ($name);
    echo IMG_END;
    echo HTML_IMG_END;
}

function getImage ($name) { // Functional.
    $image = "";
    $image .= IMG_START . GetIDFromName ($name) . IMG_END;
    return $image;
}

function GetIDFromName ($name) { // Functional.
    $url = CARD_DETAILS_START . urlencode($name);
    $data = file_get_contents($url); // $URL will be here.
    $position = strpos($data, ID_PREFIX); // Multiverse location.
    $start = substr($data, $position + 13); // String that starts after multiverse.
    $endpos = strpos($start, ID_SUFFIX); // Position of " after multiverse.
    
    $ID = substr($start, 0, $endpos); // String with text between "multiverse=" and final quotation.
    return $ID;
}

function EchoImageFromNameAndSet ($name, $set) { // Functional.
    echo HTML_IMG_START;
    echo IMG_START;
    EchoIDFromNameAndSet ($name, $set);
    echo IMG_END;
    echo HTML_IMG_END;
}

// SET SYMBOL GETTERS /////

function EchoSetSymbolFromAbbreviation ($abbreviation) { // Functional.
    echo HTML_IMG_START;
    echo SET_SYMBOL_START;
    echo $abbreviation;
    echo SET_SYMBOL_END;
    echo HTML_IMG_END;
}

// CARD TEXT PRINTERS /////



function EchoCardInfoFromName ($name) {
    $url = CARD_DETAILS_START . urlencode($name);
    $data = mb_convert_encoding(file_get_contents($url), "HTML-ENTITIES", "UTF-8");
    
    echo GetCardNameFromData($data);
    
    echo "\n\n<br><br>\n\n";
    
    echo GetManaCostFromData($data);
    
    echo "\n\n<br><br>\n\n";
    
    echo GetCardTypeFromData($data);
    
    echo "\n\n<br><br>\n\n";
    
    echo GetCardTextFromData($data);
    
    echo "\n\n<br><br>\n\n";
    
    echo GetPowerToughnessFromData($data);
    
    echo "\n\n<br><br>\n\n";
    
    echo GetLoyaltyFromData($data);
}

?>