<?php
$servername = "localhost";
$username = "thecrabb_crabbys";
$password = "yuda63136";
$dbname = "thecrabb_crabbys";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "UPDATE `tabel_produk` SET `in_stock` = 0";
$conn->query($sql);

$conn->close();
