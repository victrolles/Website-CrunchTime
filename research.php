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
            <h2 class="title">Rechercher</h2>
        </div>
            <div class="main3">

                <form class="form3" action="#" method="post">

                    <div class="type">
                        <h4 class="title">Type :</h4>
                        <div class="field input">
                            <select name="type" id="type">
                                <option value="2">Canne Anglaise</option>
                                <option value="1" selected>Déambulateur</option>
                            </select>
                        </div>
                    </div>
            
                    <div class="service">
                        <h4 class="title">Service :</h4>
                        <div class="field input">
                            <select name="service" id="service">
                                <option value="1" selected>Neurologie</option>
                                <option value="2">Diabétologie</option>
                                <option value="3">Pédiatrie</option>
                            </select>
                        </div>
                    </div>

                    <div class="search">
                        <div class="field input">
                            <input type="submit" name="submit" value="Rechercher...">
                        </div>
                    </div>
                </form>
                    


                <div class="reserve">
                    <h4 class="title">Réserve :</h4>
                    <?php
                        if (isset($_POST['submit'])) {
                            if (isset($_POST['type']) && isset($_POST['service'])) {
                                $_SESSION['type'] = $_POST['type'];
                                $_SESSION['service'] = $_POST['service'];
                                displayReserve();
                            }
                        }
                    ?>
                </div>

                <div class="chambre">
                    <h4 class="title">Chambre :</h4>
                    <?php
                        if (isset($_POST['submit'])) {
                            if (isset($_POST['type']) && isset($_POST['service'])) {
                                $_SESSION['type'] = $_POST['type'];
                                $_SESSION['service'] = $_POST['service'];
                                displayChambre();
                            }
                        }
                    ?>
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