<?php //database
$servername = "freelovedb-do-user-11110282-0.b.db.ondigitalocean.com";
$database = "freelove";
$username = "doadmin";
$password = "AVNS_7M4XkSb100N0owa";

$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
$mysqli->ssl_set(NULL, NULL, "ca-certificate.crt", NULL, NULL);
$mysqli->real_connect($servername, $username, $password, $database, 25060);

if ($mysqli->connect_error) {
die("Connection failed: " . $mysqli->connect_error);
}