<?php

	if($_GET['admin']!='ok'){
		error_reporting(0);	
	}


	/* BEGIN CONNECTION */
		if($_SERVER['HTTP_HOST']=='domain.com'){
			// prod
			define('DB_SERVER','');
			define('DB_USER','');
			define('DB_PASSWORD','');
			define('DB_NAME','');
		}else{
			// dev
			define('DB_SERVER','localhost');
			define('DB_USER','root');
			define('DB_PASSWORD','root');
			define('DB_NAME','dbplatform');
		}


		$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
	/* END CONNECTION	*/

    if (!$link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

?>