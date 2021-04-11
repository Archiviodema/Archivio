<?php include('../bin/starter.php');?>
<?php include('../bin/reserved.php');?>
<!DOCTYPE html>
<html>
<?php include('../html/header.php');?>
<link rel="stylesheet" href="css/insert_documents.css">
<body style="background-color: lightgray">

    <center>
    <div id="main_div" class="jumbotron jumbotron-fluid" style="width: 50%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
    <p>
        <?php
        //echo $_POST['test'];
        //if(isset($_POST['errore'])) {
        //    echo $_POST['errore'];
        //}
        ?>
    <p>
    <h1 class="display-4">Inserisci i dati del documento<br>da inserire.</h1><br>
    <hr class="my-4"><br>
    <form  class='center' style="display: inline" class="form-inline" action="insert.php" enctype = "multipart/form-data" method="POST">
        <div class="form-group">
            <div id="left_div" class="form-group">
                <br><label for="document_name" class="mr-sm-2">Nome del documento:</label>
                <input class="form-control " name='document_name' placeholder="Inserisci il Nome del Documento." id="document_name"
                    style='width: 25%' autocomplete="off" required>
            </div>
            <div id="left_div" class="form-group">
                <label for="form_tipologia_documento">Tipologia documento.</label>
                <select id="form_tipologia_documento" name="document_typology" class="form-control" style="width: 25%">
                    <option id="A" >A - Amministrazione</option>
                    <option id="B" >B - Didattica</option>
                </select>
            </div>
            <div id="right_div" class="form-group">
                <label for="form_categoria_documento">Categoria documento.</label>
                <select id="form_categoria_documento" name="document_category" class="form-control" style="width: 25%">
                    <option id="A1" >A1 – Norme, disposizioni organizzative e ispezioni</option>
                    <option id="A2" >A2 - Organi collegiali e direttivi</option>
                    <option id="A3" >A3 - Carteggio ed atti</option>
                    <option id="A4" >A4 - Contabilità</option>
                    <option id="A5" >A5 – Edifici e impianti</option>
                    <option id="A6" >A6 - Inventari dei beni</option>
                    <option id="A7" >A7 - Personale docente e non docente</option>
                    <option id="A8" >A8 – Alunni</option>
                    <option id="B1" >B1 - Documentazione ufficiale dell'attività didattica</option>
                    <option id="B2" >B2 - Attività didattiche specifiche</option>
                </select>
            </div>
        </div>
        <div id="container_div" class="form-group">
            <div id="left_div" class="form-group">
                <label for="form_indice_documento">Indice documento.</label>
                <select id="form_indice_documento" name="document_index" class="form-control" style="width: 25%">
                <?php for($i = 1; $i < 48; $i++) { echo '<option id="' . $i . '">' . $i . '</option>'; } ?>
                </select>
            </div>
            <div id="right_div" class="form-group">
                <?php $current_year = strftime("%Y", time()); ?>
                <label for="publishment_date">Data documento.</label>
                <input class="form-control" type="date" id="publishment_date" name="publishment_date" min="1950-01-01" max="<?php echo date("Y-m-d") ?>" style='width: 25%' required>
            </div>
        </div>
        <div id="container_div" class="form-group"><br>
            <label for="document_file">Inserisci il file del Documento (formato richiesto: PDF):</label><br>
            <input type="file"
                id="document_file" 
                name="document_file"
                accept=".pdf"
                required>
        </div>
        <div class="form-group">
                <br><br>
                <span>
                    <input type="hidden" name="test" value="yes">
                    <button type="reset" class="btn btn-outline-primary mb-2" id="reset_btn">Reimposta</button>
                    <button type="submit" class="btn btn-outline-primary mb-2" id="insert_btn">Inserisci</button>
                </span>
        </div>
    </form>
    </center>

</body>

</html>