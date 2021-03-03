<?php include('../bin/starter.php');?>
<?php include('../bin/reserved.php');?>
<!DOCTYPE html>
<html>
<?php include('../html/header.php');?>

<body onload="bind_btns()">

    <center>
    <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 17.5%; margin-right: 17.5%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
        <div id="text_div" class="container">
            <h1 class='display-4'>Ciao<br><?php echo $_SESSION['user_name'].' '.$_SESSION['user_surname']; ?></h1>
            <br><hr class="my-4">
            <?php if ($normalized_user['user_role'] == 'admin'){ ?>
                <div class="form-group">
                    <p class="lead">Aggiungi un utente.</p>
                    <form style="display: inline-block" class="form-inline" action="add_user.php" method="GET">
                        <button type="submit" class="btn btn-outline-primary mb-2" id="add_user_btn">Vai</button>
                    </form>
                </div>
            <?php } ?>

            <br><div id="change_pwd_div">
            <p class="lead">Cambia password.</p>
            <form style="display: inline-block" class="form-inline" action="change_pwd.php" method="GET">
                <button type="submit" class="btn btn-outline-primary mb-2" id="change_pwd_btn">Vai</button>
            </form>
        </div>
        <div id="container_div" class="jumbotron">
            <div id="left_div">
                <hr class="my-4">
                <p class="lead">Ricerca un Documento.</p>
                <div class="form-group">
                    <form  class='center' style="display: inline" class="form-inline" action="find_documents.php" method="GET">
                        <br><button type="submit" class="btn btn-outline-primary mb-2" id="find_btn">Ricerca</button>
                    </form>
                </div>
            </div>
            <div id="right_div">
                    <hr class="my-4">
                <p class="lead">Inserisci un Documento.</p>
                <div class="form-group">
                    <form  class='center' style="display: inline" class="form-inline" action="insert_documents.php" method="GET">
                        <br><button type="submit" class="btn btn-outline-primary mb-2" id="search_btn">Inserisci</button>
                    </form>
                </div>
            </div>
    </div>
    </center>
    
</body>

</html>