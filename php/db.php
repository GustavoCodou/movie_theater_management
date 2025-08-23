<?php
$conn = mysqli_connect("localhost", "root", "", "cinema", 3308);

// Checa a conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
