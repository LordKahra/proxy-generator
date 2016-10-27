<?php

function EchoCardPrintBoxFromName ($name, $class) {
    $data = GetCardDataFromName($name);
    $array = GetCardArrayFromData($data);
    
    $box = <<<EOD
\n            <div class="cbtitle$array[color]">
                <div class="cardprintname">$array[name]</div>
                <div class="cardprintmana">$array[manaimage]</div>
            </div>
            <div class="cardprinttype">$array[type]</div>
            <div class="cardprinttext">$array[text]</div>
            <div class="cardprintpt">$array[pt]</div>
            <div class="cardprintloyalty">$array[loyalty]</div>
        </div>\n
EOD;
    
    echo "\n        <div class=\"" . $class . " box" . $array['color'] . "\">";
    echo $box;
}

function EchoPictureCardPrintBoxFromName ($name, $class) {
    $data = GetCardDataFromName($name);
    $array = GetCardArrayFromData($data);
    
    $box = <<<EOD
        <div class="cbtitle boxtitle$array[color]">
            <div class="cardprintname">$array[name]</div>
            <div class="cardprintmana">$array[manaimage]</div>
        </div>
        <div class="cardprintimage" style="background-image: url('$array[image]')"></div>
        <div class="cardprinttype boxtitle$array[color]">$array[type]</div>
        <div class="cardprinttext textbox$array[color]">$array[text]</div>
        <div class="cardprintpt textbox$array[color]">$array[pt]</div>
        <div class="cardprintloyalty textbox$array[color]">$array[loyalty]</div>
    </div>
EOD;
    
    echo "<div class=\"" . $class . " box" . $array['color'] . "\">";
    echo $box;
}

?>