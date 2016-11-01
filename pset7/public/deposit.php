<?php
require("../includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
      
    render("deposit_form.php", ["title" => "Deposit Funds"]);
 
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $deposit = $_POST["deposit"];
        
        //check that amount is non-negative integer
        if (preg_match("/^[1-9][0-9]{0,9}$/", $_POST["deposit"]) == false) 
        {
            apologize("Deposit amount must be a non-negative integer, 10 digits or fewer, no decimals.");
        }
        
        //add value of deposit to user's cash
        $query = CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $deposit, $_SESSION["id"]);
        
        //return to portfolio
            redirect("/");
    }
?>