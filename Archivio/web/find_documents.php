<?php include('../bin/starter.php');?>
<?php include('../bin/reserved.php');?>
<!DOCTYPE html>
<html>
<?php include('../html/header.php');?>
<link rel="stylesheet" href="css/find_documents.css">
<body onload="bind_btns()" style="background-color: lightgray">

<center>
<div id="main_div" class="jumbotron jumbotron-fluid" style="width: 50%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
    
    <h1 class="display-4">Inserisci i dati del documento<br>da cercare.</h1><br>
    <hr class="my-4"><br>
    <form  class='center' style="display: inline" class="form-inline" action="find.php" method="POST">
        <div class="form-group">
                <div id="left_div" class="form-group">
                <label for="form_tipologia_documento">Tipologia documento (obbligatorio).</label>
                <select id="form_tipologia_documento" name="document_tipology" class="form-control form-control-sm" style="width: 25%">
                    <option>A - Amministrazione</option>
                    <option>B - Didattica</option>
                </select>
            </div>
            <div id="left_div" class="form-group">
                <label for="document_name" class="mr-sm-2">Parole chiave: (lasciare vuoto per ottenere tutti i documenti).</label>
                <input class="form-control form-control-sm" name='keywords' placeholder='Inserisci delle parole chiave separate da "-".' id="keywords"
                    style='width: 50%' autocomplete="off">
            </div>
            <div id="right_div" class="form-group">
                <label for="form_categoria_documento">Categoria documento.</label>
                <select id="form_categoria_documento" name="document_category" class="form-control form-control-sm" style="width: 25%">
                    <option></option>
                    <option>A1 – Norme, disposizioni organizzative e ispezioni</option>
                    <option>A2 - Organi collegiali e direttivi</option>
                    <option>A3 - Carteggio ed atti</option>
                    <option>A4 - Contabilità</option>
                    <option>A5 – Edifici e impianti</option>
                    <option>A6 - Inventari dei beni</option>
                    <option>A7 - Personale docente e non docente</option>
                    <option>A8 – Alunni</option>
                    <option>B1 - Documentazione ufficiale dell'attività didattica</option>
                    <option>B2 - Attività didattiche specifiche</option>
                </select>
            </div>
        </div>
        <div id="container_div" class="form-group">
            <div id="left_div" class="form-group">
                <label for="form_indice_documento">Indice documento.</label>
                <select id="form_indice_documento" name="document_index" class="form-control form-control-sm" style="width: 25%">
                <option></option>
                <?php for($i = 1; $i < 48; $i++) echo '<option>' . $i . '</option>'; ?>
                </select>
            </div>
            <div id="right_div" class="form-group">
                <?php $current_year = strftime("%Y", time()); ?>
                <label for="publishment_date">Data documento.</label>
                <input class="form-control" type="date" id="publishment_date" name="publishment_date" min="1950-01-01" max="<?php echo date("Y-m-d") ?>" style='width: 25%' required>
            </div>
        </div>
        <div class="form-group">
                <br><br><button type="submit" class="btn btn-outline-primary mb-2" id="insert_btn">Cerca</button>
        </div>
    </form>
</center>

</body>
</html>