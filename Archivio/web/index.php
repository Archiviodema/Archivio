<?php include('../bin/starter.php');?>
<?php

if(isset($_POST['login'])) {
    $valid_login = true;
    $valid_session = false;
    $session_user = new User;
    if (isset($_POST['CF'])) {
        $temp_CF = strtoupper($_POST['CF']);
        $session_user->set_CF($temp_CF);
        //echo $session_user->get_CF(); 
    } else {
        $valid_login = false;
    }
    if (isset($_POST['pwd'])) {
        $salt = $temp_CF;
        $pwd = $salt . $_POST['pwd'];
        $pwd = hash("sha512", $pwd);  //  Previene SQL Injections provienienti dal Login (../index.php)
        $session_user->set_pwd($pwd);
        //echo $session_user->get_pwd();
    } else {
        $valid_session = true;
        if(count($_SESSION) == 0){
            $valid_session = false;
        }
        foreach($_SESSION as $key => $value){
            if ($value == null) $valid_session = false;
            // echo $key . ' ' . $value;
        }
    }
    if ($valid_session){
        $session_user->set_CF($_SESSION['session_user']->get_CF());
        $session_user->set_pwd($_SESSION['session_user']->get_pwd());
        $valid_login = true;
    }
    //echo 'CF: ' . $session_user->get_CF() . '   PWD: ' . $session_user->get_pwd();
    $query = "SELECT user_CF, user_name, user_surname, user_pwd, user_role from Utenti WHERE user_CF='" . $session_user->get_CF() . "' and user_pwd='" . $session_user->get_pwd() . "'";
    $normalized_user = $conn->query($query) ;

    if ($normalized_user == null) {
        $valid_login = false;
    }
    if ($valid_login == true) {
        $_SESSION['authenticated'] = true;
        $_SESSION['session_user'] = $session_user;
        $_SESSION['user_name'] = $normalized_user['user_name'];
        $_SESSION['user_surname'] = $normalized_user['user_surname'];
        $_SESSION['user_role'] = $normalized_user['user_role'];
        $_SESSION['CF'] = $temp_CF;
        $_SESSION['PWD'] = $pwd;
        header("Location: homepage.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>

<?php include('../html/header.php');?>
<body>
    <!--<center>-->
        
        <div id='main_div' class="jumbotron jumbotron-fluid">
            <div id='text_div' class='container'>
                <h1 class="display-1">Digital Arc</h1>
                <br><p class="lead" style="font-style: italic">Nati dai documenti, per i documenti</p> <!-- Slogan Digital-Arc -->
                <hr class="my-4">
            </div>
            <div id='input_div' class="jumbotron jumbotron-fluid">
                <form class='center' class="form-inline" style='margin-top:1%' onsubmit='return validate()'
                    action='index.php' method='POST'>
                    <!--
                    <label for="name" class="mr-sm-2">Nome:</label>
                    <input class="form-control mb-2 mr-sm-2" name='name' maxlength='20' placeholder="Inserisci il Nome"
                        id="name" style='width: 50%' autocomplete="off" required>
                    <label for="surname" class="mr-sm-2">Cognome:</label>
                    <input class="form-control mb-2 mr-sm-2" name='surname' maxlength='20'
                        placeholder="Inserisci il Cognome" id="surname" style='width: 50%' autocomplete="off" required>
                    -->

                    <?php 
                        //segnalazione errore inserimento dati login login si valido no
                        if(isset($_POST['login']) && $valid_login == false) {
                            print "<p>Errore, dati di accesso sbagliati</p>";
                        }
                    ?>
                    <label for="CF" class="mr-sm-2">Codice Fiscale:</label>
                    <input class="form-control mb-2 mr-sm-2" name='CF' placeholder="Inserisca il suo Codice Fiscale." id="CF"
                        style='width: 50%' autocomplete="off" required maxlength='16'>
                    <br><label for="pwd" class="mr-sm-2">Password:</label>
                    <input type="password" class="form-control mb-2 mr-sm-2" name='pwd'
                        placeholder="Inserisca la Password." id="pwd" style='width: 50%' maxlength='20' required>
                        <input class="form-check-input" type="checkbox" onclick="showPassword()"> Mostra Password.
                    <br><br><input type="hidden" name="login" value="true" /><button type="submit" class="btn btn-outline-primary mb-2" onclick='login_btn_clicked()'
                        id='login_btn'>Invia</button>
                </form>
            </div>
        </div>
    <!--</center>-->
</body>

</html>