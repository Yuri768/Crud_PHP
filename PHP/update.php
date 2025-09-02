<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {   
    $connection = require("dbfactory.php");
    
    $putData = json_decode(file_get_contents('php://input'), true);
    
    $id = $putData['id'];
    $nome = $putData['nome'];
    $cpf = $putData['cpf'];
    $endereco = $putData['endereco'];
    
    $sql = $connection->prepare("UPDATE pessoa SET nome = ?, cpf = ?, endereco = ? WHERE id_pessoa = ?");
    $sql->bind_param("sisi", $nome, $cpf, $endereco, $id);
    
    if ($sql->execute()) {
        $response = [
            'success' => true,
            'message' => 'Dados atualizados com sucesso',
            'data' => $putData
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Erro ao atualizar dados',
            'error' => $sql->error
        ];
    }
    
    $connection->close();
    echo json_encode($response);
        
} else {
    $response = [
        'success' => false,
        'message' => 'Método não permitido'
    ];
    echo json_encode($response);
}
?>