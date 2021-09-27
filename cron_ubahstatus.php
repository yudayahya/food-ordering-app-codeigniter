<?php
$servername = "localhost";
$username = "thecrabb_crabbys";
$password = "yuda63136";
$dbname = "thecrabb_crabbys";

$conn = new mysqli($servername, $username, $password, $dbname);

$time = date("Y-m-d H:i:s");
$sql = "UPDATE `tabel_transaksi` SET `status`=7 WHERE `status`=1 AND `waktu_batas` < '$time' AND `for_event`=1";
$conn->query($sql);

$conn->close();
