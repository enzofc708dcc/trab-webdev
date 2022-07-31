<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "urna_eletronica";

// $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

// $server = $url["host"];
// $username = $url["user"];
// $password = $url["pass"];
// $db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if(!$result = $conn->query("SELECT Nome, Votos FROM vereadores WHERE Nome != 'Nulo' and Nome != 'Branco' ORDER BY ;")) {
    echo "Select failed: (" . $conn->errno . ") " . $conn->error;
}

?>
