<?php include('../bin/starter.php');?>
<?php include('../bin/reserved.php');?>
<!DOCTYPE html>
<html>
<?php include('../html/header.php');?>
<body style="background-color: lightgray">
    <?php
        //include('../bin/config.php');
        //session_start();
        //$valid_session = true;
        //echo count($_SESSION);
            //$session_user = $_SESSION['session_user'];
            ?>
                <center>
                <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
                    <div id="text_div" class="container">
                        <h1 class="display-4">Cambio password.</h1>
                        <br><hr class="my-4">
                    </div><br>
                    <center>
                    <form  class='center' style="display: inline" class="form-inline" action="do_change_pwd.php" method="POST">
                        <div class="jumbotron jumbotron-fluid">
                            <label for="old_pwd" class="col-sm-2 col-form-label">Vecchia Password:</label>
                            <input class="form-control mb-2 mr-sm-2" name='old_pwd' placeholder="Inserisci la password precedente." id="old_pwd"
                                style='width: 27%' type="password" autocomplete="off" required>
                            <label for="new_pwd" class="col-sm-2 col-form-label">Nuova Password:</label>
                            <input class="form-control mb-2 mr-sm-2" name='new_pwd' placeholder="Inserisci la nuova password." id="new_pwd"
                                style='width: 27%' type="password" autocomplete="off" required>
                            <br><br>
                            <button type="submit" class="btn btn-outline-primary mb-2" id="change_pwd">Cambia</button>
                        </div>
                    </form>
                    </center>
                </div>
                
                </center>
</body>

</html>