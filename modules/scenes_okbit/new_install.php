<?php
	
	
	//require "../../config.php";
	
	
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
		or die("Ошибка " . mysqli_error($link));
		
	
	 
	$query ="CREATE TABLE IF NOT EXISTS `event`
	(
		ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		SERIAL VARCHAR(200) NULL,
		SERIAL_ID VARCHAR(200) NULL,
		HASH_NEW VARCHAR(200) NULL,
		HASH_OLD VARCHAR(200) NULL,
		STATE VARCHAR(200) NULL
	)";
	
	$result = mysqli_query($link, $query); //or die("Ошибка " . mysqli_error($link)); 
	if($result)
	{		
		//echo "Создание таблицы прошло успешно";
	}
	
	mysqli_close($link);
	
?>