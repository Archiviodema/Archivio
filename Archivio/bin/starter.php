<?php
//entry point
//avvio sessione, inclusione config e database e creazione database
session_cache_limiter('private, must-revalidate');
session_cache_expire(60);
session_start();

include 'config.php';
include 'database.php';

$conn = New Database();