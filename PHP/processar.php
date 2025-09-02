<?php

    function inserir($nome, $cpf, $endereco, $connection){
        $sql = $connection->prepare("INSERT INTO prog_2.pessoa (nome, cpf, endereco) values (?, ?, ?)");
        $sql->bind_param("sis", $nome, $cpf, $endereco);

        if ($sql->execute()) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . $sql->error;
            error_log("Erro ao inserir dados: " . $sql->error);
        }
    } 
    
    
    function selecionar($connection){
        $sql = $connection->prepare("SELECT * FROM pessoa");
        
        if($sql===false){
            echo "Erro ao preparar consulta: " . $connection->error;
            return;
        }

        if($sql->execute()){
            $result = $sql->get_result();

            if ($result -> num_rows > 0){
                echo "
                    <table border='1'>
                        <tr>
                            <th>ID</th>
                            <th>nome</th>
                            <th>cpf</th>
                            <th>endereco</th>
                            <th>Ações</th>
                        </tr>";

                foreach($result as $linha){
                    echo "
                            <tr>
                                <td>{$linha['id_pessoa']}</td>
                                <td>{$linha['nome']}</td>
                                <td>{$linha['cpf']}</td>
                                <td>{$linha['endereco']}</td>
                                <td>
                                    <button onclick='editarUsuario({$linha['id_pessoa']}, \"{$linha['nome']}\", {$linha['cpf']}, \"{$linha['endereco']}\")'>Editar</button>
                                    <form action='' method='POST' style='display:inline;'>
                                        <input type='hidden' name='delete' value='{$linha['id_pessoa']}'>
                                        <button type='submit' name='submit' value='DELETAR' onclick='return confirm(\"Tem certeza que deseja excluir esta pessoa?\")'>Excluir</button>
                                    </form>
                                </td>
                            </tr>
                    ";
                }
                echo "</table>";
            }else{
                echo "Nao tem dados";
            }
        }else{
            echo "Erro ao selecionar dados: " . $sql->error;
            error_log("Erro ao inserir dados: " . $sql->error);
        }
    }
    

    function excluirUser($id, $connection){
        $sql = $connection->prepare("DELETE FROM pessoa WHERE id_pessoa = (?)");
        $sql->bind_param("i", $id);
        
        if($sql->execute()){
            echo "Exclusão feita com sucesso!";
        }else{
            echo "Erro ao tentar excluir";
        }
    }

    function atualizarUser($id, $nome, $cpf, $endereco, $connection){
        $sql = $connection->prepare("UPDATE pessoa SET nome = ?, cpf = ?, endereco = ? WHERE id_pessoa = ?");
        $sql->bind_param("sisi", $nome, $cpf, $endereco, $id);
        
        if($sql->execute()){
            echo "Dados atualizados com sucesso!";
        }else{
            echo "Erro ao tentar atualizar: " . $sql->error;
        }
    }
?>