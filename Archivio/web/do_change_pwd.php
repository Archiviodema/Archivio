<?php include('../bin/starter.php');?>
<?php include('../bin/reserved.php');?>
<!DOCTYPE html>
<html>
<?php include('../html/header.php');?>
<link rel="stylesheet" href="css/insert_documents.css">
<body style="background-color: lightgray">
    
    <?php
    //error_reporting(0);//deactivate <show error message>
    //include('../bin/config.php');
    //session_cache_limiter('private, must-revalidate');
    //session_cache_expire(60);
    //session_start();
        $old_pwd_is_correct = true;
        //$conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $query = "SELECT user_pwd FROM Utenti WHERE user_CF='" . $_SESSION['CF'] . "'";
        // echo 'QUERY : ' . $query;
        //$pwd = $conn->insert($query) or die($conn->error);
        //$pwd_normalized = $pwd->fetch_assoc()['user_pwd'];
        $pwd_normalized  = $conn->query($query)['user_pwd'];
        print_r("$pwd_normalized <br>");
        $salt =  $_SESSION['CF'];
        //print_r("$pwd_normalized <br>");
        print_r(hash("sha512", $salt. $_POST['old_pwd'])."<br>");
        //$pwd_normalized = $pwd->fetch_assoc()['user_pwd'];
        //$pwd_normalized = $_SESSION['PWD'];
        if ($pwd_normalized != hash("sha512", $salt. $_POST['old_pwd'])){
            //print_r($pwd_normalized);
            $old_pwd_is_correct = false;
            print_r("porco dio non é uguale");
        }
        //print_r("porco dio é uguale");
        
        // echo $old_pwd_input . " " . $pwd_normalized . " " . $new_pwd;
        if ($old_pwd_is_correct){
            
            $query = "UPDATE Utenti SET user_pwd='" . hash("sha512", $salt . $_POST['new_pwd']) . "' WHERE user_CF='" . $_SESSION['CF'] . "'";
            // echo 'QUERY :' . $query;
            if ($conn->insert($query) === TRUE) {
                $changed = true;
            } else {
                $changed = false;
                $error_msg = "Error: " . $query . "<br>" . $conn->error;
            }
            if ($changed){
                header("Location: auto_redirect_index.php");
                exit();
            }else{
                ?>
                    <center>
                        <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
                            <div id="text_div" class="container">
                                <h1 class="display-4">Errore di connessione.</h1>
                                <p class="lead">
                                
                                <?php
                                echo $error_msg 
                                ?>
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
        }else{
            ?>
            <center>
            <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8"">
                <div id="text_div" class="container">
                    <h1 class="display-4">La password inserita<br>non è corretta.</h1>
                    <p class="lead">
                    <?php
                    echo $error_msg
                    ?>
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
        ?>
    </body>
</html>