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

if(!$result = $conn->query("SELECT Nome, Votos FROM vereadores WHERE Nome != 'Nulo' and Nome != 'Branco' and Votos = (SELECT Votos FROM vereadores WHERE Nome != 'Nulo' and Nome != 'Branco' order by Votos desc LIMIT 1);")) {
    echo "Select failed: (" . $conn->errno . ") " . $conn->error;
}

$response = [];

if($result->num_rows > 1){
    $response["vereador"]["result"] = "empate";
    $vencedores = [];
    $votos = 0;
    while($row = $result->fetch_assoc()){
        array_push($vencedores, $row["Nome"]);
        $votos = $row["Votos"];
    }
    $response["vereador"]["vencedor"] = $vencedores;
    $response["vereador"]["numVotos"] = $votos;
}
else if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $response["vereador"]["result"] = "vitoria";
    $response["vereador"]["vencedor"] = $row["Nome"];
    $response["vereador"]["numVotos"] = $row["Votos"];
}
else{
    $response["vereador"]["result"] = "error";
}

if(!$result = $conn->query("SELECT p.Nome, p.Votos, v.Nome as vNome FROM prefeitos p JOIN vice_prefeitos v on p.ViceID = v.ID WHERE p.Nome != 'Nulo' and p.Nome != 'Branco' and p.Votos = (SELECT Votos FROM prefeitos WHERE Nome != 'Nulo' and Nome != 'Branco' order by Votos desc LIMIT 1);")) {
    echo "Select failed: (" . $conn->errno . ") " . $conn->error;
}

if($result->num_rows > 1){
    $response["prefeito"]["result"] = "empate";
    $vencedores = [];
    $votos = 0;
    while($row = $result->fetch_assoc()){
        array_push($vencedores, $row["Nome"]);
        $votos = $row["Votos"];
    }
    $response["prefeito"]["vencedor"] = $vencedores;
    $response["prefeito"]["vice"] = "Houve um empate na eleição para prefeitos.";
    $response["prefeito"]["numVotos"] = $votos;
}
else if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $response["prefeito"]["result"] = "vitoria";
    $response["prefeito"]["vencedor"] = utf8_encode($row["Nome"]);
    $response["prefeito"]["vice"] = utf8_encode($row["vNome"]);
    $response["prefeito"]["numVotos"] = $row["Votos"];
}
else{
    $response["prefeito"]["result"] = "error";
}

echo json_encode($response, JSON_FORCE_OBJECT);

?>
