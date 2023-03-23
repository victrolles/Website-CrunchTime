<?php
    function ConnectDatabase(){
        // Create connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "crunch";
        global $conn;
        
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
    }

    function rfidRecognition(){
        $img = $_POST['image'];
        $folderPath = "uploads/";
    
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
    
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
    
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
    
        echo "QR code n°$fileName has been recognized";
        // $_SESSION['qr'] = $fileName;
        $_SESSION['num_rfid'] = '1a2b3c';
        return true;
    }
    
    function checkNumRfid(){
        ConnectDatabase();
        global $conn;
        $num_rfid = $_SESSION['num_rfid'];
        $sql = "SELECT * FROM materiel WHERE num_rfid = '$num_rfid'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
?>