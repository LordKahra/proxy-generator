<?php

require_once 'scripts/database_connection.php';
require 'scripts/view.php';

$select_name_set =
    "SELECT card_id, name, setname " .
    "FROM cards";

$result_name_set = mysql_query($select_name_set);

page_start("Manage Binder", "stylesheet.css");

?>

Set | Name<br>

<?php
    while ($card = mysql_fetch_array($result_name_set)) {
        ?>
        <div class="update<?php echo $card['card_id']; ?>" style="display: block;">
        <form id='update_form' action='scripts/update_card.php' method='POST' enctype='multipart/form-data'>
            <fieldset>
                <input type="text" name="setname" size="25" value="<?php echo $card['setname'] ?>" /> 
                <input type="text" name="name" size="25" value="<?php echo $card['name']; ?>" /> 
                <input type="hidden" name="card_id" value="<?php echo $card['card_id']; ?>" />
                <input type='submit' value='Update.' /> 
                <a href="scripts/delete_card.php?card_id=<?php echo $card['card_id'] ?>"><img class="delete" src="images/delete.png"></a>
                </fieldset></form></div>
        <?php                
    }
?>

<form id="add_form" action="scripts/add_card.php" method="POST" enctype="multipart/form-data">
    <fieldset>
        <input type="text" name="setname" size="25" />
        <input type="text" name="name" size="25" />
        <input type="submit" value="Add." />
        <input type="reset" value="Reset." />
    </fieldset>
    <fieldset>
        
    </fieldset>
</form>
        
<?php page_end(); ?>