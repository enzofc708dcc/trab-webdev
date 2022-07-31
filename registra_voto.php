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

$data = json_decode(file_get_contents('php://input'), true);

$numVoto = $data["numero"];
$titulo = $data["titulo"];

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