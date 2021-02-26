<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digital-arc";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM utenti";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo $row["user_CF"];
  }
} else {
  echo "0 results";
}
$conn->close();