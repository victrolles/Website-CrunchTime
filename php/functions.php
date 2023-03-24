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

    function displayChambre() {
        global $conn;
        
        $type = $_SESSION['type'];
        $service = $_SESSION['service'];

        $sql = "SELECT MAT.num_rfid, MAT.num_chambre, MAT.etat_valide, MAT.utiliser FROM materiel MAT WHERE num_chambre IN (SELECT num_chambre FROM localisation WHERE id_service = '$service') AND etat_valide = 1 AND utiliser = 1  AND id_type = '$type'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Chambre n° ".$row['num_chambre']."<br>";
            }
        } else {
            echo "Aucune chambre n'est disponible";
        }

        
    }

    function displayReserve() {
        global $conn;
        
        $type = $_SESSION['type'];
        $service = $_SESSION['service'];

        $sql = "SELECT MAT.num_rfid, MAT.num_chambre, MAT.etat_valide, MAT.utiliser FROM materiel MAT WHERE id_type = '$type' AND num_chambre IN (SELECT num_chambre FROM localisation WHERE id_service = '$service') AND etat_valide = 1 AND utiliser = 0";
        $result = $conn->query($sql);
        $number = 0;
        while ($row = $result->fetch_assoc()) {
            $number++;
        }

        $sql = "SELECT num_reserve FROM service WHERE id = '$service'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $reserve = $row['num_reserve'];

        echo "Réserve $reserve : $number disponible(s)";
    }
?>