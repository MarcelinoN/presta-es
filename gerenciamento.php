<?php
// Incluindo o arquivo de configuração para conexão com o banco de dados
include_once('config.php');

// Recuperando os técnicos cadastrados no banco de dados
$result = mysqli_query($conexao, "SELECT * FROM tecnico");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Técnicos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        nav {
            background-color: #333;
            padding: 10px;
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
        
        .container {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        .foto img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .actions button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 14px;
            margin: 5px;
        }

        .actions button:hover {
            background-color: #45a049;
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


<!-- Container -->
<div class="container">
    <h2>Lista de Técnicos Cadastrados</h2>

    <!-- Tabela com os técnicos cadastrados -->
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Especialidade</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while($tecnico = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td class="foto"><img src="<?php echo $tecnico['foto']; ?>" alt="Foto do técnico"></td>
                    <td><?php echo $tecnico['nome']; ?></td>
                    <td><?php echo $tecnico['email']; ?></td>
                    <td><?php echo $tecnico['especialidade']; ?></td>
                    <td><?php echo $tecnico['telefone']; ?></td>
                    <td class="actions">
                        <!-- Aqui você pode adicionar ações como editar ou excluir -->
                        <button>Editar</button>
                        <button>Excluir</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
