<?php
    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Quote"]);
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a symbol.");
        }
        else
        {
            // validate symbol
            $stock = lookup($_POST["symbol"]);
            
            if (!$stock) {
                apologize("You didn't provide a valid symbol.");
            }
            //render stock name and price on stock.php
            else {
                render("stock.php", ["price" => number_format($stock["price"], 2, '.', ','), "name" => ($stock["name"])]);
            }
        }
    }
?>