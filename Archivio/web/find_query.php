<?php include('../bin/starter.php');?>
<?php include('../bin/reserved.php');?>
<!DOCTYPE html>
<html>
<?php include('../html/header.php');?>
    <body style="background-color: lightgray">
    <?php
        $valid_input = true;
        $kws_exist = true;
        if(isset($_POST['keywords'])) $keywords = $_POST['keywords']; else $kws_exist = false;
        if(isset($_POST['document_tipology'])) $tipologia_doc = $_POST['document_tipology']; else $valid_input = false;
        if(isset($_POST['document_category'])) $categoria_doc = $_POST['document_category']; else $valid_input = false;
        if(isset($_POST['document_index'])) $indice_doc = $_POST['document_index']; else $valid_input = false;
        if(isset($_POST['document_year'])) $anno_doc = $_POST['document_year']; else $valid_input = false;
        if(isset($_POST['document_month'])) $mese_doc = $_POST['document_month']; else $valid_input = false;
        if(isset($_POST['document_day'])) $giorno_doc = $_POST['document_day']; else $valid_input = false;
        // echo $anno_doc . ' ' . $mese_doc . ' ' . $giorno_doc;
        if ($valid_input){
            //$conn = new mysqli($servername, $username, $password, $dbname);
            // non serve creare ogni volta una connesione
            $keywords = strtolower($keywords);
            $keywords = explode("-", $keywords);
            /*foreach($keywords as $kw){
                echo $kw . " | ";
            }
            echo "<br><br>";*/
            $table = "DocumentiDidattica";
            if (startsWith($tipologia_doc, "A")){
                $table = "DocumentiAmministrazione";
            }

            $query = 'SELECT * FROM ' . $table .' WHERE ';
            
            if ($kws_exist && count($keywords)) {
                $query .= "(";
                $a = 0;
                foreach($keywords as $kw){  // per ogni parola chiave
                    if($a > 0) { $query .= " OR"; }
                    $query .= " document_name LIKE '%".$kw."%' ";
                    $a++;
                }
                $query .= ") ";
            }
            //echo $categoria_doc;
            if ($categoria_doc != ''){
                $query .= " AND document_category = '".$categoria_doc."' ";
            }
            //echo $indice_doc;
            if ($indice_doc != ''){
                $query .= " AND document_index = '".$indice_doc."' ";
            }
            if ($anno_doc != ''){
                $query .= " AND document_year = '".$anno_doc."' ";
            }
            if ($mese_doc != ''){
                $query .= " AND document_month = '".$mese_doc."' ";
            }
            if ($giorno_doc != ''){
                $query .= " AND document_day = '".$giorno_doc."' ";
            }
            
            $valid_docs = $conn->query($query);
            ?>

            <center>
            <div id="main_div" class="jumbotron jumbotron-fluid" style="margin-left: 25%; margin-right: 25%; margin-top:1%; border-style: solid; border-width: 1px; border-color: #b8b8b8">
                <h1 class="display-4"> Risultati Ricerca </h1><br>
                <hr class="my-4"><br>
                <div id="table_div" class="container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col"><center>ID</center></th>
                                <th scope="col"><center>Nome Documento</center></th>
                                <th scope="col"><center>Data (YYYY/mm/gg)</center></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($valid_docs as $doc){
                            echo '<tr><th scope="row">' . $doc["documentID"] . '</th>';
                            echo '<td>' . $doc["document_name"] . '</td>';
                            $year = $doc['document_year'];
                            $month = $doc['document_month'];
                            $day = $doc['document_day'];
                            $date = $year . "/" . $month . "/" . $day;
                            echo '<td>' . $date . '</td>';
                            echo '<td>' . '<center>
                                            <a href="' . $doc['pathToFile'] . '" download="">
                                                <button type="button" class="btn btn-outline-primary">Download</button>
                                            </a>
                                            </center>' . '<td></tr>'; 
                        } 
                        ?>
                        </tbody>
                </div>
            </div>
            </center>
        
        <?php
        }else{
            header("Location: redirect_homepage.php");
        exit();
        }
        ?>
    </body>
</html>