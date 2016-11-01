<?php

    require("../includes/config.php");
    $users = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    // check if user logged in
    if(isset($_SESSION["id"])) {
        
        $rows = CS50::query("SELECT * FROM Portfolio WHERE user_id = ?", $_SESSION["id"]);
        
        if(count($rows) > 0)
        {
            $positions = [];
            foreach ($rows as $row)
            {
                $stock = lookup($row["symbol"]);
                if ($stock !== false)
                {
                    $positions[] = [
                        "name" => $stock["name"],
                        "price" => money_format("$%i", $stock["price"]),
                        "shares" => $row["shares"],
                        "symbol" => $row["symbol"],
                    ];
                }
            }
    
            render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "users" => $users]);
        }
        else
        {
            render("portfolio.php", ["title" => "Portfolio", "users" => $users]);
        }
    }
?>