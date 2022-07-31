<?php

/**
 * Calcula o resultado da eleição e retorna os candidatos vencedores de cada etapa.
 * 
 * Caso haja um empate, ele retorna quais candidatos empataram.
 *
 * 
 * PHP version 5.3+
 *
 * @file resultado.php
 *
 * @category  Application
 * @author    Felipe Pestana Rosa <fpestana@dcc.ufrj.br> && Enzo Ferreira Carnevali <enzofc@dcc.ufrj.br>
 * @copyright 2023 Felipe Pestana Rosa && Enzo Ferreira Carnevali
 * @link      https://github.com/enzofc708dcc/trab-webdev/blob/master/resultado.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/fill_json.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/registra_voto.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/index.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/script.js
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/util.js
 * @since     31/07/2022
 */

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
