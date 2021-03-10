<?php include('../bin/starter.php');?>
<?php include('../bin/reserved.php');?>
<?php

    if(isset($_POST['document_name'])) $nome_doc = $_POST['document_name']; else $valid_input = false;
    if(isset($_POST['document_typology'])) $tipologia_doc = $_POST['document_typology']; else $valid_input = false;
    if(isset($_POST['document_category'])) $categoria_doc = $_POST['document_category']; else $valid_input = false;
    if(isset($_POST['document_index'])) $indice_doc = $_POST['document_index']; else $valid_input = false;
    if(isset($_POST['publishment_date'])) $data_doc = $_POST['publishment_date']; else $valid_input = false;
    if ($valid_input){
        $timestamp = strtotime($data_doc);
        $day = date("d", $timestamp);
        $month = date("m", $timestamp);
        $year = date("Y", $timestamp);
        $table = "DocumentiDidattica";
        if (startsWith($tipologia_doc, "A")) {
            $table = "DocumentiAmministrazione";
        }
        $filename = Path::create_path($nome_doc . $data_doc);
        $destination = $target_dir . basename($filename); // si usa basename per prevenire gli attacchi
        $file = $_FILES['document_file']['tmp_name']; // Directory traversal attack
        if (move_uploaded_file($file, $destination)){
            $sql = 'INSERT INTO ' . $table . ' (document_name, pathToFile, document_category, document_index, document_day, document_month, document_year) VALUES ("' . $nome_doc . '", "'. $destination . '", "' . $categoria_doc . '", "' . $indice_doc . '", "' . $day . '", "' . $month . '", "' . $year . '")';
            if ($conn->insert($sql)){
                // correctly done
                header("Location: insert_documents.php");
                exit();
            }   
            else{
                ?> 
                <form action="insert_documents.php" method="POST">
                    <input type="text" value="errore" name="errore">
                </form>

                <?php
                header("Location: insert_documents.php");
                exit();
            }
        } else{
            header("Location: insert_documents.php");
            exit();
        }
    }else{
        header("Location: insert_documents.php");
        exit();
    }
?>