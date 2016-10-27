<?php

function GetTypeSymbolFromName ($name) {
    return HTML_TYPE_IMG_START . $name . HTML_TYPE_IMG_END;
}

function EchoManaSymbolFromName($name, $size = NULL) {
    echo HTML_IMG_STK_CUBE_START;
    echo GetManaSymbol($name, $size);
    echo HTML_IMG_STK_CUBE_END;
}

function GetManaSymbol ($name, $size = NULL) {
    if (!(!is_null($size) && strlen($size) > 0)) {
        $size = "large"; }
    $url = MANA_SYMBOL_FETCH_START . $size . MANA_SYMBOL_MID . $name . MANA_SYMBOL_FETCH_END;
    return $url;
}

?>