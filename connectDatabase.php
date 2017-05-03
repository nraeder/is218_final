<?php
	
	date_default_timezone_set('America/New_York');
	
	$hostname = 'sql.njit.edu'; // Change this to your server settings. E.g., sql2.njit.edu
	$database = 'nar28';		// This should be your UCID (same as username)
	$username = 'nar28';		// This should be your UCID (same as database name)
	$password = 'sHDnzTOEZ';	// This is your NJIT mySQL password. It is likely different from your UCID password.

	
    try {
        
        $db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        http_error(500, "Internal Server Error", "We couldn't connect to a Heroku MySQL database.");
        header('HTTP/1.1 500 Internal Server Error');
		exit("ERROR: There was an error connecting to the mySQL database. Error message: ".$error_message);
    }
    
    
    // Runs SQL query and returns results (if valid)
    function runQuery($query) {

		global $db;

	    try {
    
			$q = $db->prepare($query);
			$q->execute();
			$results = $q->fetchAll();
			$q->closeCursor();

			return $results;
			
		} catch (PDOException $e) {

			http_error(500, "Internal Server Error", "There was a SQL error:\n\n" . $e->getMessage());
			
		}	
	    
	}
?>