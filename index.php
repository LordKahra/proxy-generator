<?php

//require_once 'scripts/database_connection.php';
require 'scripts/view.php';

/*$select_name_set =
    "SELECT name, setname " .
    "FROM cards";

$result_name_set = mysql_query($select_name_set);*/

page_start("", "stylesheet.css"); ?>
    
    Enter cards below, one per line. I'll add number functionality soon/eventually/later. >.>;;
    
    <br>
    
    <form id="card_form" action="show_proxies.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <textarea name="cards" rows="15" cols="50" value=""></textarea><br>
            
            <input type="hidden" name="stylesheet" value="proxy-standard">
            <input type="hidden" name="pictures" value="-pictures">
            <input type="hidden" name="images" value="false">
            
            <input type="checkbox" name="images" value="true" checked="checked">Include pictures. (TODO. For now, in Chrome's print dialog under "Options" uncheck "Background colors and images."
            <br>
            <br><input name="colors" type="radio" value="true" checked="checked">Color 
            <br><input name="colors" type="radio" value="false">Grayscale
            <br>
            <br><input name="stylesheet" type="radio" value="new" checked="checked">New
            <br><input name="stylesheet" type="radio" value="proxy-standard">Standard
            <br><input name="stylesheet" type="radio" value="proxy-barebones">Barebones
            <!-- <br><input name="stylesheet" type="radio" value="" disabled="disabled">No Picture
            <br><input name="stylesheet" type="radio" value="" disabled="disabled">Something Else -->
            
            <br><br><input type="submit" value="Submit." />
        </fieldset>
    </form>

    <br><br>
    
    Tested for Chrome.
    
<?php page_end(); ?>