<!DOCTYPE html>
<html>

<?php include('../bin/startup.php');?>
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
                    action='homepage.php' method='POST'>
                    <!--
                    <label for="name" class="mr-sm-2">Nome:</label>
                    <input class="form-control mb-2 mr-sm-2" name='name' maxlength='20' placeholder="Inserisci il Nome"
                        id="name" style='width: 50%' autocomplete="off" required>
                    <label for="surname" class="mr-sm-2">Cognome:</label>
                    <input class="form-control mb-2 mr-sm-2" name='surname' maxlength='20'
                        placeholder="Inserisci il Cognome" id="surname" style='width: 50%' autocomplete="off" required>
                    -->
                    <label for="CF" class="mr-sm-2">Codice Fiscale:</label>
                    <input class="form-control mb-2 mr-sm-2" name='CF' placeholder="Inserisca il suo Codice Fiscale." id="CF"
                        style='width: 50%' autocomplete="off" required maxlength='16'>
                    <br><label for="pwd" class="mr-sm-2">Password:</label>
                    <input type="password" class="form-control mb-2 mr-sm-2" name='pwd'
                        placeholder="Inserisca la Password." id="pwd" style='width: 50%' maxlength='20' required>
                        <input class="form-check-input" type="checkbox" onclick="showPassword()"> Mostra Password.
                       <script>
                           
                           function showPassword() {
  var x = document.getElementById('pwd');
  //if (x.type === "password")  x.type = "text";
  //else x.type = "password";
  x.type === "password" ? x.type.setAttribute("text") :x.type.setAttribute("password");
  //condizione ? espressione1 : espressione2
}
                    </script>
                    <br><br><button type="submit" class="btn btn-outline-primary mb-2" onclick='login_btn_clicked()'
                        id='login_btn'>Invia</button>
                </form>
            </div>
        </div>
    <!--</center>-->
</body>

</html>