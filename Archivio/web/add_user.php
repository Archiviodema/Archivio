<?php include('../bin/starter.php');?>
<?php include('../bin/reserved.php');?>
<!DOCTYPE html>
<html>
<?php include('../html/header.php');?>
<html>

<body onload="bind_btn()" style="background-color: lightgray">
    <?php
            //$conn = new mysqli($servername, $username, $password, $dbname);
            $query = "SELECT user_CF, user_name, user_surname, user_pwd, user_role from Utenti WHERE user_CF='" . $session_user->get_CF() . "' and user_pwd='" . $session_user->get_pwd() . "' and user_role='admin'";
            $_is_admin = $conn->query($query);
            //$is_admin = $_is_admin->fetch_assoc();
            if($is_admin != null){
                // the current user is an admin
                ?>

                <center>
                    <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
                        <div id="text_div" class="container">
                            <h1 class="display-4">Inserimento Utente.</h1>
                            <p class="lead">Inserisci i dati dell\'utente.</p>
                            <hr class="my-4">
                            <div id='input_div'>
                                <form  class='center' style="display: inline" class="form-inline" action="add.php" method="GET">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Nome:</label>
                                    <input class="form-control mb-2 mr-sm-2" name='name' placeholder="Inserisci il Nome." id="name"
                                        style='width: 25%' autocomplete="off" >
                                    <label for="surname" class="col-sm-2 col-form-label">Cognome:</label>
                                    <input class="form-control mb-2 mr-sm-2" name='surname' placeholder="Inserisci il Cognome." id="surname"
                                        style='width: 25%' autocomplete="off" >
                                </div>
                                <div class="form-check row">
                                    <div id="gender_div">
                                        <input type="radio" id="male" name="gender" value="M" >
                                        <label class="form-check-label" for="male">Maschio</label><br>
                                        <input type="radio" id="female" name="gender" value="F" >
                                        <label class="form-check-label" for="female">Femmina</label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="date_of_birth">Data di Nascita:</label>
                                    <input class="form-control" type="date" id="date_of_birth" name="date_of_birth" style='width: 25%' >
                                    <label for="place_of_birth" class="col-sm-2 col-form-label">Luogo di Nascita:</label>
                                    <input class="form-control mb-2 mr-sm-2" name='place_of_birth' placeholder="Inserisci il Luogo di Nascita." id="place_of_birth"
                                        style='width: 25%' autocomplete="off" >
                                    <label for="initial" class="col-sm-2 col-form-label">Sigla:</label>
                                    <input class="form-control mb-2 mr-sm-2" name='initial' placeholder="Inserisci la Sigla della Provincia" id="initial"
                                        style='width: 25%' autocomplete="off" >
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="password">Password Temporanea:</label>
                                    <input class="form-control" type="text" id="password" name="password" style='width: 25%' autocomplete="off" >
                                    <label class="col-sm-2 col-form-label" for="select_role">Ruolo:</label>
                                    <select class="form-control mb-2 mr-sm-2" id="select_role" name="role" style="width:25%" >
                                        <option id="select_admin">admin</option>
                                        <option id="select_utente">utente</option>
                                    </select>
                                </div>
                                    <br><button type="submit" class="btn btn-outline-primary mb-2" id="add_user_btn">Aggiungi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </center>
            <?php
            }else{
                header("Location: redirect.php");
                exit();
            }
        
        ?>
</body>

</html>