<?php 


/**
 * Registra os votos no banco de dados.
 *
 * Recebe dois valores, o tipo do voto e o valor do voto.
 * 
 * O tipo do voto diz em qual etapa a votação está. 
 * 
 * Já o número, indica o número do candidato, ou se o voto é nulo ou branco.
 *
 * PHP version 8.1.8
 *
 * @file registra_voto.php
 *
 * @category  Application
 * @author    Felipe Pestana Rosa <fpestana@dcc.ufrj.br> && Enzo Ferreira Carnevali <enzofc@dcc.ufrj.br>
 * @copyright 2023 Felipe Pestana Rosa && Enzo Ferreira Carnevali
 * @link      https://github.com/enzofc708dcc/trab-webdev/blob/master/registra_voto.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/resultado.php
 * @see       https://github.com/enzofc708dcc/trab-webdev/blob/master/fill_json.php
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

$data = json_decode(file_get_contents('php://input'), true);

$numVoto = $data["numero"];
$titulo = $data["titulo"];

/**
 * De acordo com a etapa da votação e o o número do voto, faz um update no banco de dados.
 * O update consiste em somar em 1 os votos do candidato ou dos votos nulos ou brancos.
 */
if($titulo == "vereador"){
    if($numVoto == "branco"){
        if(!$result = $conn->query("UPDATE vereadores SET Votos = Votos + 1 WHERE Nome = 'Branco';")) {
            echo "Update failed: (" . $conn->errno . ") " . $conn->error;
        }
    }
    else if($numVoto == "nulo"){
        echo "wtf pq eu entrei?";
        if(!$result = $conn->query("UPDATE vereadores SET Votos = Votos + 1 WHERE Nome = 'Nulo';")) {
            echo "Update failed: (" . $conn->errno . ") " . $conn->error;
        }
    }
    else{
        if(!$stmt = $conn->prepare("UPDATE vereadores SET Votos = Votos + 1 WHERE Numero = ?;")) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }

        if (!$stmt->bind_param("s", $numVoto)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }
}
/**
 * De acordo com a etapa da votação e o o número do voto, faz um update no banco de dados.
 * O update consiste em somar em 1 os votos do candidato ou dos votos nulos ou brancos.
 */
else if($titulo == "prefeito"){
    if($numVoto == "branco"){
        if(!$result = $conn->query("UPDATE prefeitos SET Votos = Votos + 1 WHERE Nome = 'Branco';")) {
            echo "Update failed: (" . $conn->errno . ") " . $conn->error;
        }
    }
    else if($numVoto == "nulo"){
        if(!$result = $conn->query("UPDATE prefeitos SET Votos = Votos + 1 WHERE Nome = 'Nulo';")) {
            echo "Update failed: (" . $conn->errno . ") " . $conn->error;
        }
    }
    else{
        echo("cheguei aqui");
        if(!$stmt = $conn->prepare("UPDATE prefeitos SET Votos = Votos + 1 WHERE Numero = ?;")) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }

        if (!$stmt->bind_param("s", $numVoto)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }
    if(!$result = $conn->query("")) {
        echo "Update failed: (" . $conn->errno . ") " . $conn->error;
    }
}


$conn->close();

?>