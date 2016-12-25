<?php

    require(__DIR__ . "/../includes/config.php");

    
    $places = [];
    
    $geo = $_GET["geo"];
    $geo = str_replace(",", " ", $geo);
    $geo = trim($geo);
    $geo = explode(" ", $geo);
    $count = count($geo);
   
    if ($count > 1) {
    	// Re-assemble into one string
    	$geo = implode(" ", $geo);
    	// Search across columns
    	$places = CS50::query("SELECT * FROM places WHERE MATCH(postal_code, place_name, admin_name1, admin_code1) AGAINST (?)", $geo);
    } else if ($count < 1) {
        print("You must enter a query.");
    } elseif ($count === 1) {
        $geo = $geo[0];
    	// Check if length of query = zip code
    	if(strlen($geo) === 5)
    	{
    		$places = CS50::query("SELECT * FROM places WHERE postal_code = ?", $geo);	
    	}
    	elseif(strlen($geo) == 2)
    	{
    		// Check state abbreviation (admin_code1)
    		$places = CS50::query("SELECT * FROM places WHERE admin_code1 = ?", strtoupper($geo));
    	}
    	else
    	{
    		// Check city (place_name)
    		$places = CS50::query("SELECT * FROM places WHERE place_name LIKE ?", $geo);
    	}
    	
    	if(empty($places))
    	{
    		// Check state (admin_name1)
    		$places = CS50::query("SELECT * FROM places WHERE admin_name1 LIKE ?", $geo);
    	}
        
    }
    
    
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>