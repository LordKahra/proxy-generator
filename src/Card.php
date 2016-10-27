<?php

//require_once SITE_ROOT . "scripts/gatherer.php";

class Card {
    public $name;
    public $manacost;
    public $type;
    public $text;
    public $pt;
    public $loyalty;
    public $manaimage;
    public $color;
    public $image;

    static function getCard($name) {
        $data = GathererDataFetcher::getData($name);
        return new Card(
            self::getCardName($data),
            self::getManaCost($data),
            self::getCardType($data),
            self::getCardText($data),
            self::getPowerToughness($data),
            self::getLoyalty($data),
            self::getManaCostImage($data)
            );
    }

    function __construct($name, $manacost, $type, $text, $pt, $loyalty, $manaimage) {
        // Store data.
        $this->name = $name;
        $this->manacost = $manacost;
        $this->type = $type;
        $this->text = $text;
        $this->pt = $pt;
        $this->loyalty = $loyalty;
        $this->manaimage = $manaimage;
        $this->color = self::getColor($manacost);
        $this->image = GathererDataFetcher::getImage($name);
    }

    function toHTML() {
        $html =
             '<div class="card">' .
             '    <div class="title">' .
             '        <div data-key="name">' . $this->name . '</div>' .
             '        <div data-key="mana">' . $this->manaimage . '</div>' .
             '    </div>' .
             '    <div data-key="type">'      . $this->type       . '</div>' .
             '    <div data-key="text">'      . $this->text       . '</div>' .
             '    <div data-key="pt">'        . $this->pt         . '</div>' .
             '    <div data-key="loyalty">'   . $this->loyalty    . '</div>' .
             '</div>';

        return $html;
    }

    // STATIC PARSERS

    static function getCardName($data) {
        $position = strpos($data, INFO_NAME_PREFIX);
        if ($position) {
            $full = substr($data, $position); // String that starts with INFO_NAME_PREFIX.
            $position = strpos($full, INFO_START_PATH);
            $start = substr($full, $position + 21);

            // $start = substr($data, $position + 91); // String that starts with Card Name.
            $endpos = strpos($start, INFO_NAME_SUFFIX); // Length of Card Name.

            $name = substr($start, 0, $endpos);
            return trim($name);
        }
        return "";
    }

    static function getManaCost($data) {
        $position = strpos($data, INFO_MANA_PREFIX);
        if ($position) {
            $start = substr($data, $position + 91); // String that starts with Mana Cost.
            $endpos = strpos($start, INFO_SUFFIX); // Length of Mana Cost.

            $manadata = substr($start, 0, $endpos);
            $manacost = "";

            while ($position = strpos($manadata, "alt")) {
                $manadata = substr($manadata, $position + 5);
                $endpos = strpos($manadata, "\"");

                $symbol = substr($manadata, 0, $endpos);
                switch ($symbol) {
                    case "Variable Colorless":
                        $manacost .= "X";
                        break;
                    case "Red or White":
                        $manacost .= "{R/W}";
                        break;
                    case "Red or Green":
                        $manacost .= "{R/G}";
                        break;
                    case "White":
                        $manacost .= "W";
                        break;
                    case "Blue":
                        $manacost .= "U";
                        break;
                    case "Black":
                        $manacost .= "B";
                        break;
                    case "Red":
                        $manacost .= "R";
                        break;
                    case "Green":
                        $manacost .= "G";
                        break;
                    default:
                        $manacost .= $symbol;
                }
            }
            return trim($manacost);
        }
        return "";
    }

    static function getCardType($data) {
        $position = strpos($data, INFO_TYPE_PREFIX);
        if ($position) {
            $full = substr($data, $position); // String that starts with INFO_TYPE_PREFIX.
            $position = strpos($full, INFO_START_PATH);
            $start = substr($full, $position + 21); // String that starts with Card Type.
            $endpos = strpos($start, INFO_SUFFIX); // Length of Card Type.

            $cardtype = substr($start, 0, $endpos); // Card Type.
            return trim($cardtype);
        }
        return "";
    }

    static function getCardText($data) {
        $position = strpos($data, INFO_TEXT_PREFIX);
        if ($position) {
            $full = substr($data, $position); // String that starts with INFO_TEXT_PREFIX.
            $position = strpos($full, INFO_START_PATH);
            $position = strpos(substr($full, $position + 21), ">");
            $start = substr($full, $position + 1); // String that starts with Card Text.
            $start = substr(
                $start,
                strpos(
                    $start,
                    ">"
                ) + 1
            );
            $endpos = strpos($start, INFO_TEXT_SUFFIX); // Length of Card Text.

            $cardtext = substr($start, 0, $endpos); // Card Text, Unmodified.

            $cardtext = str_replace("<img src=", "<img class=\"manasymbol\" src=", $cardtext); // Card Text, Image Class "manasymbol" Added.
            $cardtext = str_replace("Image.ashx?size=small", "Image.ashx?size=large", $cardtext); // Mana Symbols upsized.
            $cardtext = str_replace("/Handlers/", "http://gatherer.wizards.com/Handlers/", $cardtext); // Card Text, Image URLs Modified.

            // Replace divs.
            $cardtext = str_replace(INFO_TEXT_DIV_PREFIX, "<p>", $cardtext);
            $cardtext = str_replace(INFO_TEXT_DIV_SUFFIX, "</p>", $cardtext);

            return trim($cardtext);
        }
        return "";
    }

    static function getPowerToughness($data) {
        $position = strpos($data, INFO_PT_PREFIX);
        if ($position) {
            $full = substr($data, $position); // String that starts with INFO_PT_PREFIX.
            $position = strpos($full, INFO_START_PATH);
            $start = substr($full, $position + 21); // String that starts with Power/Toughness.
            $endpos = strpos($start, INFO_SUFFIX); // Length of Power/Toughness.

            $powertoughness = substr($start, 0, $endpos); // Power/Toughness.
            return trim($powertoughness);
        }
        return "";
    }

    static function getLoyalty($data) {
        $position = strpos($data, INFO_LOYALTY_PREFIX);
        if ($position) {
            $start = substr($data, $position + 89); // String that starts with Loyalty.
            $endpos = strpos($start, INFO_LOYALTY_SUFFIX); // Length of Loyalty.

            $loyalty = substr($start, 0, $endpos); // Loyalty.
            return trim($loyalty);
        }
        return "";
    }

    static function getManaCostImage($data) {
        $position = strpos($data, INFO_MANA_PREFIX);
        if ($position) {
            $start = substr($data, $position + 91); // String that starts with Mana Cost.
            $endpos = strpos($start, INFO_SUFFIX); // Length of Mana Cost.

            $manadata = substr($start, 0, $endpos);
            $manacost = "";

            while ($position = strpos($manadata, "name")) {
                $manadata = substr($manadata, $position + 5);
                $endpos = strpos($manadata, "&");

                $symbol = substr($manadata, 0, $endpos);

                $manacost .= "<img class=\"manasymbol\" src=\"images/color/" . $symbol . ".gif\">";
            }
            return trim($manacost);
        }
        return "";
    }

    static function getColor($manacost) {
        $colors = 0;
        $text = "";
        if (strpos($manacost, "W") !== false) { $colors += 1; $text .= "white"; }
        if (strpos($manacost, "U") !== false) { $colors += 1; $text .= "blue"; }
        if (strpos($manacost, "B") !== false) { $colors += 1; $text .= "black"; }
        if (strpos($manacost, "R") !== false) { $colors += 1; $text .= "red"; }
        if (strpos($manacost, "G") !== false) { $colors += 1; $text .= "green"; }

        if ($colors > 1) {
            return "gold";
        }

        else if ($colors == 1) {
            return $text;
        }

        return "artifact";
    }
}

?>