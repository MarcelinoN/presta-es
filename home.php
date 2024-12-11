<?php
if (isset($_POST['submit'])) {
    include_once('config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $especialidade = $_POST['especialidade']; 
    $telefone = $_POST['telefone'];
    
    // Upload da foto do técnico
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoTmpName = $_FILES['foto']['tmp_name'];
        $fotoName = $_FILES['foto']['name'];
        $fotoPath = 'usuario/' . basename($fotoName);  // Alterado para o diretório 'usuario'
        
        // Move o arquivo da foto para o diretório de armazenamento 'usuario'
        if (move_uploaded_file($fotoTmpName, $fotoPath)) {
            // Inserir dados no banco de dados
            $result = mysqli_query($conexao, "INSERT INTO tecnico (nome, email, senha, especialidade, telefone, foto) 
                                              VALUES ('$nome', '$email', '$senha', '$especialidade', '$telefone', '$fotoPath')");
            header('Location: home.php');
        } else {
            echo "Erro no upload da foto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Técnicos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #003366; /* Azul marinho */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            color: white;
            flex-direction: column;
        }

        /* Navbar fixa no topo */
        nav {
            background-color: #333;
            padding: 10px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000; /* Garante que a navbar fique acima de outros elementos */
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        /* Espaçamento para evitar que o conteúdo fique sobre a navbar */
        .container {
            margin-top: 80px; /* Adiciona um espaço para não sobrepor a navbar */
            background-color: #fff;
            color: black;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 60%;
            text-align: center;
        }

        .inputBox {
            margin-bottom: 15px;
            position: relative;
        }

        .inputUser {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            box-sizing: border-box;
        }

        .labelInput {
            position: absolute;
            top: 10px;
            left: 15px;
            font-size: 1em;
            color: #999;
            pointer-events: none;
            transition: 0.3s;
        }

        .inputUser:focus + .labelInput,
        .inputUser:not(:focus):valid + .labelInput {
            top: -10px;
            font-size: 0.8em;
            color: #333;
        }

        #submit {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
        }

        #submit:hover {
            background-color: #45a049;
        }

        .foto-container {
            margin-bottom: 15px;
        }

        .foto-container input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .option-select {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .navigation {
            margin-top: 20px;
        }

        .navigation a {
            color: #4CAF50;
            text-decoration: none;
            font-size: 1.2em;
        }

        .navigation a:hover {
            color: #45a049;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav style="background-color: #333; padding: 10px;">
    <ul style="list-style: none; margin: 0; padding: 0; display: flex; justify-content: space-around;">
        <li><a href="home.php" style="color: white; text-decoration: none; font-size: 18px;">Home</a></li>
        <li><a href="gerenciamento.php" style="color: white; text-decoration: none; font-size: 18px;">Gerenciar Técnicos</a></li>
        <li><a href="servicos.php" style="color: white; text-decoration: none; font-size: 18px;">Serviços</a></li> <!-- Novo link -->
    </ul>
</nav>

<!-- Formulário de cadastro -->
<div class="container">
    <h2>Cadastro de Técnico</h2>
    <form action="home.php" method="POST" enctype="multipart/form-data">
        <div class="inputBox">
            <input type="text" name="nome" id="nome" class="inputUser" required>
            <label for="nome" class="labelInput">Nome completo</label>
        </div>

        <div class="inputBox">
            <input type="email" name="email" id="email" class="inputUser" required>
            <label for="email" class="labelInput">Email</label>
        </div>

        <div class="inputBox">
            <input type="password" name="senha" id="senha" class="inputUser" required>
            <label for="senha" class="labelInput">Senha</label>
        </div>

        <div class="inputBox">
            <input type="text" name="especialidade" id="especialidade" class="inputUser" required>
            <label for="especialidade" class="labelInput">Especialidade</label>
        </div>

        <div class="inputBox">
            <input type="tel" name="telefone" id="telefone" class="inputUser" required>
            <label for="telefone" class="labelInput">Telefone</label>
        </div>

        <div class="foto-container">
            <input type="file" name="foto" accept="image/*" required>
        </div>

        <input type="submit" name="submit" id="submit" value="Cadastrar Técnico">
    </form>
</div>

</body>
</html>
