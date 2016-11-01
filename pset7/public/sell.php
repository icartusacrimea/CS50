<?php

require("../includes/config.php"); 


    if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //datebase query creating variable to first make sure user has any stocks
        $anystocks = CS50::query("SELECT symbol FROM Portfolio WHERE user_id = ?", $_SESSION["id"]);
        if (count($anystocks) == 0) {
            apologize("You don't have any stocks.");
        } else {
            // else render form
            render("sell_form.php", ["title" => "Sell"]);
        }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //set transaction type for history
        $transaction = 'SELL';

        //check if user submits a stock
        if (empty($_POST["symbol"]))
            {
                apologize("You must provide a stock.");
            }
        // look up the stock's name
        $stock = lookup($_POST["symbol"]);
        if ($stock === false)
        {
            apologize("That's not a valid stock symbol.");
        }
        // query database for number of shares
        $rows = CS50::query("SELECT shares FROM Portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], strtoupper($_POST["symbol"]));
        //check if user has any shares of the stock provided
        if (count($rows) === 0) {
            
            apologize("You don't own any shares of that stock.");
            
        } else {
            //set number of shares and value of all combined
            $shares = $rows[0]["shares"];
            
            $value = $stock["price"] * $shares;
            
            //delete all shares of stock from database
            $query = CS50::query("DELETE FROM Portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], strtoupper($_POST["symbol"]));
            //add value of stocks sold to user's cash
            $query = CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $value, $_SESSION["id"]);
            
            //insert this transaction into History table
            $query = CS50::query("INSERT INTO History (id, transaction, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], $transaction, $_POST["symbol"], $shares, $stock["price"]);
            
            if ($query === false) {
                apologize("An error has occurred.");
            }
            
            //return to portfolio
            redirect("/");
        }
    }


?>