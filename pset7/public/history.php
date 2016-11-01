<?php
    require("../includes/config.php");
     
    // create array to store info for History table
    $table = CS50::query("SELECT * FROM History WHERE id = ?", $_SESSION["id"]);
    
    // render history form and $table data
    render("history_form.php", ["title" => "History", "table" => $table]);

?>