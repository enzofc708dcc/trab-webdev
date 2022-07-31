<?php

/**
 * Recupera os candidatos do banco de dados.
 *
 * Faz queries para o banco de dados, recuperando os candidados e os formatando em um arquivo json, que será consumido pelo frontend.
 * 
 * PHP version 5.3+
 *
 * @file fill_json.php
 *
 * @category  Application
 * @author    Felipe Pestana Rosa <fpestana@dcc.ufrj.br> && Enzo Ferreira Carnevali <enzofc@dcc.ufrj.br>
 * @copyright 2023 Felipe Pestana Rosa && Enzo Ferreira Carnevali
 * @link      https://github.com/enzofc708dcc/trab-webdev/blob/master/fill_json.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/resultado.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/registra_voto.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/index.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/script.js
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/util.js
 * @since     31/07/2022
 */

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);
$targetJson = [];

if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

/**
 * Faz as consultas dos candidatos, recuperando seu nome, número, partido e foto.
 * No caso dos prefeitos, também recupera a informação dos seus vices.
 */
if(!$result = $conn->query("SELECT Nome, Numero, Partido, Url_Foto FROM vereadores WHERE Nome != 'Nulo' and Nome != 'Branco';")) {
    echo "Select failed: (" . $conn->errno . ") " . $conn->error;
}

$targetJson["0"] = [];
$targetJson["0"]["titulo"] = "vereador";
$targetJson["0"]["numeros"] = 5;
$targetJson["0"]["candidatos"] = [];

while($row = $result->fetch_assoc()){
    $candNum = $row["Numero"];
    $targetJson["0"]["candidatos"][$candNum]["nome"] = utf8_encode($row["Nome"]);
    $targetJson["0"]["candidatos"][$candNum]["partido"] = utf8_encode($row["Partido"]);
    $targetJson["0"]["candidatos"][$candNum]["foto"] = utf8_encode($row["Url_Foto"]);
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
    $targetJson["1"]["candidatos"][$candNum]["nome"] = utf8_encode($row["pNome"]);
    $targetJson["1"]["candidatos"][$candNum]["partido"] = utf8_encode($row["pPartido"]);
    $targetJson["1"]["candidatos"][$candNum]["foto"] = utf8_encode($row["pUrl_Foto"]);
    $targetJson["1"]["candidatos"][$candNum]["vice"]["nome"] = utf8_encode($row["vNome"]);
    $targetJson["1"]["candidatos"][$candNum]["vice"]["partido"] = utf8_encode($row["vPartido"]);
    $targetJson["1"]["candidatos"][$candNum]["vice"]["foto"] = utf8_encode($row["vUrl_Foto"]);
}

$result->close();
$conn->close();

echo json_encode($targetJson, JSON_FORCE_OBJECT);

?>
