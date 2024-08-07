<?php
// Receber os parâmetros via GET
$host = $_GET['host']; // Linha pra receber IP do Host
//$port = $_GET['port']; // Linha para receber a porta
$port = isset($_GET['port']) ? $_GET['port'] : 22; // Linha pra receber a porta caso não seja a padrão
$user = $_GET['user']; // Linha pra receber o Usuario
$password = $_GET['password']; // Linha pra receber a Senha
$commands = explode('<br>', $_GET['commands']); // Separar comandos por <br>

// Conectar ao servidor SSH
$connection = ssh2_connect($host, $port);
ssh2_auth_password($connection, $user, $password);

// Executar os comandos sequencialmente com intervalos
foreach ($commands as $command) {
    $stream = ssh2_exec($connection, $command);
    sleep(4); // Intervalo de 4 segundos entre os comandos
}

// Fim da conexão Bebe kkkk
ssh2_disconnect($connection);
//Segue nos la no insta @fox.networks ou @salomao_j_r
echo 'Comandos executados com sucesso';
?>
