<?php

if(!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] == false) {
    header("Location: index.php");
    exit();
}