<?php

function GetManaCostImageFromDataOld($data) {
    $position = strpos($data, INFO_MANA_PREFIX);
    if ($position) {
        $full = substr($data, $position);
        $position = strpos($full, INFO_START_PATH);
        $full = substr($full, $position + 21);
        $position = strpos($full, INFO_MANA_SUFFIX);
        $full = substr($full, 0, $position);
        
        $manacost = "";
        
        while ($position = strpos($full, "<img")) {
            $full = substr($full, $position + 11);
            $endpos = strpos($full, "\"");
            
            $manacost .= "<img class=\"manasymbol\" src=\"" . MANA_SYMBOL_START . substr($full, 0, $endpos) . "\">";
        }
        return trim($manacost);
    }
    return "";
}

function EchoCardPrintBoxFromNameOld ($name, $class) {
    $data = GetCardDataFromName($name);
    
    //$cardname = GetCardNameFromData($data);
    $cardname = GetCardInfoFromData($data, INFO_NAME_PREFIX, INFO_NAME_SUFFIX);
    $cardmana = GetManaCostImageFromData($data);
    $cardtype = GetCardInfoFromData($data, INFO_TYPE_PREFIX, INFO_TYPE_SUFFIX);
    $cardtext = GetCardTextFromData($data);
    $powertoughness = GetCardInfoFromData($data, INFO_PT_PREFIX, INFO_PT_SUFFIX);
    $loyalty = GetCardInfoFromData($data, INFO_LOYALTY_PREFIX, INFO_LOYALTY_SUFFIX);
    
    $box = <<<EOD
        <div class="cardprintnamemana">
            <div class="cardprintname">$cardname</div>
            <div class="cardprintmana">$cardmana</div>
        </div>
        <div class="cardprinttype">$cardtype</div>
        <div class="cardprinttext">$cardtext</div>
        <div class="cardprintpt">$powertoughness</div>
        <div class="cardprintloyalty">$loyalty</div>
    </div>
EOD;
    
    echo "<div class=\"" . $class . "\">";
    echo $box;
}

?>