<?php
$server = "localhost";
$username = "urna_app";
$password = "urna_app";
$db = "urna_eletronica";

// $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

// $server = $url["host"];
// $username = $url["user"];
// $password = $url["pass"];
// $db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);
$targetJson = [];

$fp = fopen('lidn.txt', 'w');
fwrite($fp, $numVoto);
fwrite($fp, $titulo);
fclose($fp);

if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if(!$result = $conn->query("SELECT Nome, Numero, Partido, Url_Foto FROM vereadores WHERE Nome != 'Nulo' and Nome != 'Branco';")) {
    echo "Select failed: (" . $conn->errno . ") " . $conn->error;
}

$targetJson["0"] = [];
$targetJson["0"]["titulo"] = "vereador";
$targetJson["0"]["numeros"] = 5;
$targetJson["0"]["candidatos"] = [];

while($row = $result->fetch_assoc()){
    $candNum = $row["Numero"];
    $targetJson["0"]["candidatos"][$candNum]["nome"] = $row["Nome"];
    $targetJson["0"]["candidatos"][$candNum]["partido"] = $row["Partido"];
    $targetJson["0"]["candidatos"][$candNum]["foto"] = $row["Url_Foto"];
}

$result->close();

if(!$result = $conn->query("SELECT p.Nome pNome, p.Numero pNumero, p.Partido pPartido, p.Url_Foto pUrl_Foto, v.Nome vNome, v.Partido vPartido, v.Url_Foto vUrl_Foto FROM prefeitos p JOIN vice_prefeitos v on p.ViceID = v.ID WHERE p.Nome != 'Nulo' and p.Nome != 'Branco';")) {
    echo "Select failed: (" . $conn->errno . ") " . $conn->error;
}

$targetJson["1"] = [];
$targetJson["1"]["titulo"] = "prefeito";
$targetJson["1"]["numeros"] = 2;
$targetJson["1"]["candidatos"] = [];

while($row = $result->fetch_assoc()){
    $candNum = $row["pNumero"];
    $targetJson["1"]["candidatos"][$candNum]["nome"] = $row["pNome"];
    $targetJson["1"]["candidatos"][$candNum]["partido"] = $row["pPartido"];
    $targetJson["1"]["candidatos"][$candNum]["foto"] = $row["pUrl_Foto"];
    $targetJson["1"]["candidatos"][$candNum]["vice"]["nome"] = $row["vNome"];
    $targetJson["1"]["candidatos"][$candNum]["vice"]["partido"] = $row["vPartido"];
    $targetJson["1"]["candidatos"][$candNum]["vice"]["foto"] = $row["vUrl_Foto"];
}

$result->close();
$conn->close();

echo json_encode($targetJson, JSON_FORCE_OBJECT);

?>