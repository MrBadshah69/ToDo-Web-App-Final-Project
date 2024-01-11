<?php

$SERVER = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE = "todophp";


$conn = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE);

if (!$conn) {
    die("databse is not connected" . mysqli_connect_error());
};

$db = "CREATE DATABASE IF NOT EXISTS " . $DATABASE;

$con_db = mysqli_query($conn, $db);

$resignation_table = "CREATE TABLE IF NOT EXISTS `resignation`(
        `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `Username` varchar(225) NOT NULL,
        `Email` varchar(225) NOT NULL,
        `Password` varchar(255) NOT NULL
      )";       

$create_table = mysqli_query($conn, $resignation_table);

if (!$create_table) {
    echo "resignation table already exists";
};

$todo_app = "CREATE TABLE IF NOT EXISTS `Todoapp`(
        `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `Task_name` VARCHAR(255) NOT NULL,
        `Task_description` VARCHAR(255) NOT NULL,
        `Date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `User_ID` INT (50)
        
      )";

$create_table1 = mysqli_query($conn, $todo_app);

if (!$create_table1) {
    echo "Todoapp table already exists";
};
