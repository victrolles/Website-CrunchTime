<?php
session_start();
include "functions.php";
ConnectDatabase();
global $conn;

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    echo "$id    ";
    
    $sql = "SELECT * FROM materiel WHERE num_rfid = '$id'";
    $result = $conn->query($sql);
    //check if the id is valid
    if ($result->num_rows > 0) {
        $_SESSION['num_rfid'] = $id;
        echo "id is valid";
    } else {
        echo "0 results";
    }
}