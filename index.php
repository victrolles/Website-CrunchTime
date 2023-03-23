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
            <h2 class="title">Scanner</h2>
        </div>
        <div class="main">
            <div class="row">
                <div class="col">
                  <h4 class="title">Avec Scanner</h4>
                  <div id="reader"></div>
                </div>
                <div class="other">
                    <h4 class="title">Sans Scanner</h4>
                    <p>Vous pouvez rentrer la référence manuellement : </p>
                    <form class="scan" action="#" method="post">
                      <div class="field input">
                          <label>Référence : </label>
                          <input type="text" name="num_rfid" placeholder="Numéro du matériel">
                      </div>
                    </form>
                    <form class="noscan" action="#" method="post">
                      <div class="field button">
                          <input type="submit" name="submit" value="Valider">
                      </div>
                    </form>
                  </div>
                <!-- <div class="col" style="padding: 30px">
                  <h4>Scan Result </h4>
                  <div id="result">
                    Result goes here
                  </div>
                </div> -->

              </div>
              <!-- partial -->
                <script src='https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.2.0/html5-qrcode.min.js'></script><script  src="./javascript/script.js"></script>
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
        if (isset($_POST['num_rfid']) && !empty($_POST['num_rfid'])){
            $_SESSION['num_rfid'] = $_POST['num_rfid'];
        }
    }
?>



<?php
    if (isset($_SESSION['num_rfid'])){
        header("Location: ./userform.php");
    }
?>