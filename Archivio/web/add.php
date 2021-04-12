<?php include('../bin/starter.php');?>
<?php include('../bin/reserved.php');?>
<!DOCTYPE html>
<html>
<?php include('../html/header.php');?>
<html>

<body style="background-color: lightgray">
    <?php
    error_reporting(0);
    include('../bin/codice_fiscale.php');
    include('../bin/config.php');
    session_start();
    $valid_input = true;
    if (isset($_GET['name'])) $name = $_GET['name'];
    else $valid_input = false;
    if (isset($_GET['surname'])) $surname = $_GET['surname'];
    else $valid_input = false;
    if (isset($_GET['gender'])) $gender = $_GET['gender'];
    else $valid_input = false;
    if (isset($_GET['date_of_birth'])) $date_of_birth = $_GET['date_of_birth'];
    else $valid_input = false;
    if (isset($_GET['place_of_birth'])) $place_of_birth = $_GET['place_of_birth'];
    else $valid_input = false;
    if (isset($_GET['initial'])) $initial = $_GET['initial'];
    else $valid_input = false;
    if (isset($_GET['password'])) $pwd = $_GET['password'];
    else $valid_input = false;
    if (isset($_GET['role'])){
        if ($_GET['role'] == 'utente'){
            $role = 'none';
        }else $role = $_GET['role'];
    }
    else $valid_input = false;
    if ($valid_input == false) {
        header("Location: add_user.php");
        exit();
    } else {
        $date_of_birth_normalized = new DateTime($date_of_birth);
        $codCatastale = (new CodiceCatastale)->calcola($place_of_birth, $initial);
        $CF = (new Calculator)->calcola($name, $surname, $gender, $date_of_birth_normalized, $codCatastale);
        $hashed_pwd = hash("sha512", $CF . $pwd);
        $stato = 0; // 0: Utente da aggiungere in DB, 1: Utente già Presente in DB -> modifica utente (password e ruolo)
        //$conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $query = "SELECT user_CF from Utenti WHERE user_CF='" . $CF . "'";
        //$user = $conn->query($query) or die($conn->error);
        //$normalized_user = $user->fetch_assoc();
        $normalized_user = query($query);
        if ($normalized_user == null) {
            $stato = 0;
        }else $stato = 1;
        //echo $stato . " " . $normalized_user;
        if ($stato == 0){
            $query = 'INSERT INTO Utenti (user_CF, user_name, user_surname, user_pwd, user_role) VALUES ("' . $CF . '", "' . $name . '", "' . $surname . '", "' . $hashed_pwd . '", "' . $role . '")'; 
            if ($conn->insert($query) === TRUE) {
                $added = true;
              } else {
                $added = false;
                $error_msg = "Error: " . $query . "<br>" . $conn->error;
            }
            if(!$added){
                ?>
                <center>
                    <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
                        <div id="text_div" class="container">
                            <h1 class="display-4">Errore di connessione.</h1>
                            <p class="lead">
                            <?php echo $error_msg; ?>
                            <br><button class="btn btn-outline-primary mb-2" id="redirectBtn">Redirect</button>
                            <script language="javascript">var redirect = document.getElementById("redirectBtn");
                            redirect.addEventListener("mousedown", function() {
                            // btn.setAttribute("disabled", true);
                            redirect.innerHTML = "Carico...<br>";
                            var newSpan = document.createElement("span");
                            newSpan.classList.add("spinner-border");
                            newSpan.classList.add("spinner-border-sm");
                            newSpan.setAttribute("role", "status");
                            newSpan.setAttribute("aria-hidden", "true");
                            redirect.appendChild(newSpan);
                            document.location.href = "homepage.php";
                            });
                            </script>
                        </div>
                    </div>
                </center>
            <?php    
            }else{
                // correctly done
                header("Location: auto_redirect_homepage.php");
                exit();
            }
        }else if ($stato == 1){
            $query = "SELECT * from Utenti WHERE user_CF='" . $CF . "'";
            //$user = $conn->query($query) or die($conn->error);
            //$normalized_user = $user->fetch_assoc();
            $normalized_user = query($query);
            $old_pwd = $normalized_user['user_pwd'];
            $del_query = "DELETE FROM Utenti WHERE user_CF='" . $CF . "'";
            if ($conn->insert($del_query) === TRUE) {
                $deleted = true;
            } else {
                $deleted = false;
                $error_msg = "Error: " . $del_query . "<br>" . $conn->error;
                
            }
            if($deleted){
                //echo $role;
                $query = 'INSERT INTO Utenti (user_CF, user_name, user_surname, user_pwd, user_role) VALUES ("' . $CF . '", "' . $name . '", "' . $surname . '", "' . $hashed_pwd . '", "' . $role . '")'; 
                if ($conn->query($query) === TRUE) {
                    $added = true;
                } else {
                    $added = false;
                    $error_msg = "Error: " . $query . "<br>" . $conn->error;
                }
                if(!$added){
                    ?>
                    <center>
                        <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%">
                            <div id="text_div" class="container">
                                <h1 class="display-4">Errore di connessione.</h1>
                                <p class="lead"> (
                                <?php echo $error_msg ?> 
                                )
                                <br>Premi il pulsante per essere reindirizzato alla homepage.</p>
                                <br><button class="btn btn-outline-primary mb-2" id="redirectBtn">Redirect</button>
                                <script language="javascript">var redirect = document.getElementById("redirectBtn");
                                redirect.addEventListener("mousedown", function() {
                                // btn.setAttribute("disabled", true);
                                redirect.innerHTML = "Carico...<br>";
                                var newSpan = document.createElement("span");
                                newSpan.classList.add("spinner-border");
                                newSpan.classList.add("spinner-border-sm");
                                newSpan.setAttribute("role", "status");
                                newSpan.setAttribute("aria-hidden", "true");
                                redirect.appendChild(newSpan);
                                document.location.href = "homepage.php";
                                });
                                </script>
                            </div>
                        </div>
                    </center>
                <?php    
                }else{
                    // correctly done
                    header("Location: auto_redirect_homepage.php");
                    exit();
                }
            }else{
                ?>
                    <center>
                        <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%">
                            <div id="text_div" class="container">
                                <h1 class="display-4">Errore di connessione.</h1>
                                <p class="lead">
                                <?php echo $error_msg ?>
                                <br>Premi il pulsante per essere reindirizzato alla homepage.</p>
                                <br><button class="btn btn-outline-primary mb-2" id="redirectBtn">Redirect</button>
                                <script language="javascript">var redirect = document.getElementById("redirectBtn");
                                redirect.addEventListener("mousedown", function() {
                                // btn.setAttribute("disabled", true);
                                redirect.innerHTML = "Carico...<br>";
                                var newSpan = document.createElement("span");
                                newSpan.classList.add("spinner-border");
                                newSpan.classList.add("spinner-border-sm");
                                newSpan.setAttribute("role", "status");
                                newSpan.setAttribute("aria-hidden", "true");
                                redirect.appendChild(newSpan);
                                document.location.href = "homepage.php";
                                });
                                </script>
                            </div>
                        </div>
                    </center>
                    <?php
            }
            
        }
    }
    ?>
</body>

</html>