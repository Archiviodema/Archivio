<html>

<?php include('../html/header.php');?>

<body style="background-color: lightgray">
    <?php
            echo '
            <center>
                <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
                    <div id="text_div" class="container">
                        <h1 class="display-4"> Il log-in non è stato effettuato<br>o non è valido.</h1>
                        <p class="lead">Premi il pulsante per essere reindirizzato alla pagina di log-in.</p>
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
                        document.location.href = "index.php";
                        });
                        </script>
                    </div>
                </div>
            </center>';
        ?>
</body>

</html>