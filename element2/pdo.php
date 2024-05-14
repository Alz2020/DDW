<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 
   'bobby', 'qwerty');
   
// Setting PDO attributes for error handling

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



