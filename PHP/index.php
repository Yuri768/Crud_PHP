<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
        <h1>Menu Principal</h1>
        <label for="nome">Nome: </label>
        <input name="nome" id="nome" type="text"> <br> <br>   
    
        <label for="cpf">CPF:</label>
        <input name="cpf" id="cpf" type="number"><br><br>

        <label for="endereco">Endereço:</label>
        <input name="endereco" id="endereco" type="text"><br><br>

        <button type="submit" name="submit" value="INSERIR">Cadastrar</button>
    </form>

    <div id="edit-form" class="edit-form" style="display: none;">
        <h2>Editar Pessoa</h2>
        <form action="" method="post">
            <input type="hidden" name="id_pessoa_edit" id="id_pessoa_edit">
            
            <label for="nome_edit">Nome: </label>
            <input name="nome_edit" id="nome_edit" type="text"> <br> <br>   
        
            <label for="cpf_edit">CPF:</label>
            <input name="cpf_edit" id="cpf_edit" type="number"><br><br>

            <label for="endereco_edit">Endereço:</label>
            <input name="endereco_edit" id="endereco_edit" type="text"><br><br>

            <button type="submit" name="submit" value="ATUALIZAR">Atualizar</button>
            <button type="button" onclick="cancelEdit()">Cancelar</button>
        </form>
    </div>


    <?php
        require_once 'processar.php';
        $connection = require('dbfactory.php');

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            if(isset($_POST['submit']) && $_POST['submit'] === 'INSERIR'){
               inserir($_POST['nome'], $_POST['cpf'], $_POST['endereco'], $connection); 
            }
            
            if(isset($_POST['submit']) && $_POST['submit'] === 'DELETAR'){
                excluirUser($_POST['delete'], $connection);
            }

            if(isset($_POST['submit']) && $_POST['submit'] === 'ATUALIZAR'){
                atualizarUser(
                    $_POST['id_pessoa_edit'], 
                    $_POST['nome_edit'], 
                    $_POST['cpf_edit'], 
                    $_POST['endereco_edit'], 
                    $connection
                );
            }

        }

        selecionar($connection);
    ?>
    
</body>
<script>
function editarUsuario(id, nome, cpf, endereco) {
    document.getElementById('id_pessoa_edit').value = id;
    document.getElementById('nome_edit').value = nome;
    document.getElementById('cpf_edit').value = cpf;
    document.getElementById('endereco_edit').value = endereco;
    
    document.getElementById('edit-form').style.display = 'block';
    
    document.getElementById('edit-form').scrollIntoView({ behavior: 'smooth' });
}

function cancelEdit() {
    document.getElementById('edit-form').style.display = 'none';
    
    document.getElementById('id_pessoa_edit').value = '';
    document.getElementById('nome_edit').value = '';
    document.getElementById('cpf_edit').value = '';
    document.getElementById('endereco_edit').value = '';
}
</script>
</html>