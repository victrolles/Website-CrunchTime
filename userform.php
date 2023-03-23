<!DOCTYPE html>
<html>
  <head>
    <title>
      HNFC
    </title>
    <link rel="stylesheet" href="./Css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <?php 
        include "php/functions.php"; 
        session_start();
        ConnectDatabase();
        global $conn;
    ?>
  </head>
  <body>
    <div class="container">
        <div class="header">
            <h1>HNFC</h1>
            <h2 class="title">Renseigner</h2>
        </div>
        <div class="main">
            <div class="info">
                <?php
                    if (isset($_SESSION['num_rfid'])){
                        $num_rfid = $_SESSION['num_rfid'];
                        $sql = "SELECT MAT.num_rfid, TYP.name, MAT.num_chambre, MAT.etat_valide, MAT.utiliser, MAT.date_attribution FROM materiel MAT INNER JOIN type TYP ON MAT.id_type = TYP.id WHERE MAT.num_rfid = '$num_rfid'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        echo "<div class='field input'>";
                        echo "Num rfid: ".$row['num_rfid']."<br>";
                        echo "Type: ".$row['name']."<br>";
                        echo "</div>";

                    }
                ?>
            </div>
            <div class="form">
                <form method="POST" action="#">
                  <div class="field input">
                      <label>Numéro de chambre : </label>
                      <input type="text" name="num_chambre" placeholder="Numéro de chambre" required>
                  </div>
                  <div class="field input">
                      <label>Nom et Prénom : </label>
                      <input type="text" name="nom" placeholder="Nom" required>
                      <input type="text" name="prenom" placeholder="Prénom" required>
                  </div>
                  <div class="field input">
                      <label>Etat : </label>
                      <select id="etat" name="etat">
                          <option value="1">En état</option>
                          <option value="0" selected>Endommagé</option>
                      </select>
                  </div>
                  <div class="field button">
                      <input type="submit" name="submit" value="Valider">
                  </div>
                </form>
            </div>
          </div>
          <div class="curve">
          <div class="custom-shape-divider-bottom-1679502066">
              <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                  <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
              </svg>
          </div>
          </div>
          <div class="footer spacer layer1">
                    
          </div>

    </div>
  </body>
</html>

<?php
    if (isset($_POST['submit'])){
        $num_chambre = $_POST['num_chambre'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $etat_valide = $_POST['etat'];
        $utiliser = "1";

        $sql = "INSERT INTO patient (numero, nom, prenom) VALUES ('$num_chambre', '$nom', '$prenom')";
        $result = $conn->query($sql);

        $sql = "SELECT id FROM patient WHERE nom = '$nom' AND prenom = '$prenom'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id_patient = $row['id'];

        $sql = "UPDATE materiel SET id_patient='$id_patient', num_chambre = '$num_chambre', etat_valide = '$etat_valide', utiliser = '$utiliser' WHERE num_rfid = '$num_rfid'";
        $result = $conn->query($sql);
        if ($result){
            echo "Success";
        }else{
            echo "Error";
        }
    }
?>