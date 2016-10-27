<?php

//require_once 'scripts/database_connection.php';
require_once 'scripts/view.php';
require_once 'src/Card.php';

$cards = trim($_POST['cards']);
$stylesheet = $_POST['stylesheet'];
$pictures = $_POST['pictures'];
$colors = $_POST['colors'];
$images = $_POST['images'];

// TODO: Evading stylesheet.
page_start("", "css/new.css"); ?>

<?php

if (isset($cards)) {
    $newarray = explode("\n", $cards);
    $newarray = array_filter($newarray, 'trim');
    $cardarray = array();
    foreach ($newarray as $line) {
        if (is_numeric(substr($line, 0, strpos($line, " ")))) {
            for ($i=0; $i<substr($line, 0, strpos($line, " ")); $i++) {
                $cardarray[] = substr($line, strpos($line, " "));
            }
        }
        else {
            $cardarray[] = $line;
        }
    }
    $index = 0;
    $i = 0;
    $linestartone = "\n    <div class=\"container one\">";
    $linestarttwo = "\n    <div class=\"container two\">";
    $linestartthree = "\n    <div class=\"container three\">";
    $lineend = "    </div>";
    $pagestart = "<div class=\"container\">";
    $pageend = "\n</div>";
    echo $pagestart;

    $cards = array();

    foreach ($cardarray as $line) {
        $line = trim($line);
        $exists = array_key_exists($line, $cards);

        $card = ($exists ? $cards[$line] : Card::getCard($line));

        if ($exists) {
            $cards[] = $card;
        } else {
            $cards[$line] = $card;
        }
    }

    //foreach ($cardarray as $line) {
    foreach ($cards as $card) {
        /*$position = 0;
        $count = 1;
        $text = $line;
        if (is_numeric(substr($line, 0, strpos($line, " ")))) {
            $position = strpos($line, " ");
            $count = substr($line, 0, $position);
            $text = substr($line, $position);
        }
        for ($k=0; $k<$count; $k++) {*/
        $index++;
        //$card = Card::getCard($line);
        echo $card->toHTML();

            /*switch ($i % 3) {
                case 0:
                    if ($i+1 === count($cardarray)) { echo $linestartone; }
                    else if ($i+2 === count($cardarray)) { echo $linestarttwo; }
                    else { echo $linestartthree; }
                    if ($stylesheet == "proxysheet.css") { EchoCardPrintBoxFromName(trim($line), "cardprintboxleft"); }
                    else { EchoPictureCardPrintBoxFromName(trim($line), "cardprintbox left"); }
                    break;
                case 1:
                    if ($stylesheet == "proxysheet.css") { EchoCardPrintBoxFromName(trim($line), "cardprintboxcenter"); }
                    else { EchoPictureCardPrintBoxFromName(trim($line), "cardprintbox center"); }
                    break;
                case 2:
                    if ($stylesheet == "proxysheet.css") { EchoCardPrintBoxFromName(trim($line), "cardprintboxright"); }
                    else { EchoPictureCardPrintBoxFromName(trim($line), "cardprintbox right"); }
                    echo $lineend;
                    break;
            }*/
        
            if ($i % 9 === 8 && $index < count($cardarray)) {
                //echo $pageend;
                //echo $pagestart;
            }
            $i++;
        /*}*/
    }
    echo $pageend;
}

?>

<?php page_end(); ?>