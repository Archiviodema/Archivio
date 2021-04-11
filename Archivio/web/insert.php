<?php include('../bin/starter.php');?>
<?php include('../bin/reserved.php');?>
<?php include('../html/header.php');?>
<?php
    $valid_input = true;
    //print_r($_POST['test']);
    if(isset($_POST['document_name'])) $nome_doc = $_POST['document_name']; else { $valid_input = false ; }//print_r("document_name ".$valid_input);}
    if(isset($_POST['document_typology'])) $tipologia_doc = $_POST['document_typology']; else { $valid_input = false ;} //print_r("document_typology ".$valid_input);}
    if(isset($_POST['document_category'])) $categoria_doc = $_POST['document_category']; else { $valid_input = false ;} //print_r("document_category ".$valid_input);}
    if(isset($_POST['document_index'])) $indice_doc = $_POST['document_index']; else { $valid_input = false ;} //print_r("document_index ".$valid_input);}
    if(isset($_POST['publishment_date'])) $data_doc = $_POST['publishment_date']; else { $valid_input = false ;} //print_r("publishment_date ".$valid_input);}
    print_r($valid_input);
    if ($valid_input){
        $percorso_doc = (new Path)->create_path($nome_doc . $data_doc);
        $timestamp = strtotime($data_doc);
        $day = date("d", $timestamp);
        $month = date("m", $timestamp);
        $year = date("Y", $timestamp);
        $table = "DocumentiDidattica";
        if (startsWith($tipologia_doc, "A")) {
            $table = "DocumentiAmministrazione";
        }
        $filename = (new Path)->create_path($nome_doc . $data_doc);
        //$filename = Path::create_path($nome_doc . $data_doc);
        $destination = $target_dir . basename($filename); // si usa basename per prevenire gli attacchi
        $file = $_FILES['document_file']['tmp_name']; // Directory traversal attack
        if (move_uploaded_file($file, $destination)){
            $sql = 'INSERT INTO ' . $table . ' (document_name, pathToFile, document_category, document_index, document_day, document_month, document_year) VALUES ("' . $nome_doc . '", "'. $destination . '", "' . $categoria_doc . '", "' . $indice_doc . '", "' . $day . '", "' . $month . '", "' . $year . '")';
            if ($conn->insert($sql)){
                // correctly done
                //print_r("query true");
                //header("Location: insert_documents.php");
                exit();
            }   
            else{
                ?> 
                <div class="card">
                    <div class="card-body">
                        <form class='center' class="form-inline" style='margin-top:1%'action="insert_documents.php" method="POST">
                            <input type="hidden" value="errore" name="errore">
                            <span>Errore, premere per ritornare all'inserimento</span>
                            <button type="submit" class="btn btn-primary">invia</button>
                        </form>
                    </div>
                </div>

                <?php
                //header("Location: insert_documents.php");
                exit();
            }
        } else{
            ?> 
                <div class="card">
                    <div class="card-body">
                        <form class='center' class="form-inline" style='margin-top:1%'action="insert_documents.php" method="POST">
                            <input type="hidden" value="errore" name="errore">
                            <span>Errore, premere per ritornare all'inserimento</span>
                            <button type="submit" class="btn btn-primary">invia</button>
                        </form>
                    </div>
                </div>

                <?php
            //header("Location: insert_documents.php");
            exit();
        }
    }else{
        ?> 
                <div class="card">
                    <div class="card-body">
                        <form class='center' class="form-inline" style='margin-top:1%'action="insert_documents.php" method="POST">
                            <input type="hidden" value="errore" name="errore">
                            <span>Errore, premere per ritornare all'inserimento</span>
                            <button type="submit" class="btn btn-primary">invia</button>
                        </form>
                    </div>
                </div>

                <?php
        //header("Location: insert_documents.php");
        exit();
    }
?>