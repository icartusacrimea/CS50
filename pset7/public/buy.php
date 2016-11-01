<?php
require("../includes/config.php");

 //variable for checking user's cash
    $anycash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      //first check that user's cash is > $0
        if (count($anycash) == 0) {
            apologize("You don't have any cash.");
        } else {
            // else render form
            render("buy_form.php", ["title" => "Buy"]);
        }
 
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //set transaction type for history
        $transaction = 'BUY';
        
     //look up stock and determine value of requested shares of that stock   
        $stock = lookup($_POST["symbol"]);
        $value = $stock["price"] * $_POST["shares"];
        
        if ($anycash < $value) {
            apologize("You don't have enough cash.");
        }
        if (empty($_POST["symbol"]) || (empty($_POST["shares"]))) 
        {
            apologize("You must provide a symbol and number of shares.");
        }
        if ($stock === false)
        {
            apologize("That's not a valid stock symbol.");
        }
        if (preg_match("/^\d+$/", $_POST["shares"]) == false) 
        {
            apologize("Amount of stocks you wish to buy must be a non-negative integer.");
        } else 
        {
            //make sure symbol is capitalized
            $_POST["symbol"] = strtoupper($_POST["symbol"]);
            
            //update Portfolio to reflect purchased stocks
            $query = CS50::query("INSERT INTO Portfolio (user_id, symbol, shares) VALUES(?, ?, ?) 
                ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"]);
            
            //delete cash spent on new stocks from user's total cash
            $query = CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $value, $_SESSION["id"]);
            
            //insert this transaction into History table
            $query = CS50::query("INSERT INTO History (id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], $transaction, $_POST["symbol"], $_POST["shares"], $stock["price"]);
            
            if ($query === false) {
                apologize("An error has occurred.");
            }
            
            //redirect to Portfolio
            redirect("/"); 
        }
    }

?>
