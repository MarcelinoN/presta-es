<?php
// Incluindo o arquivo de configuração para conexão com o banco de dados
include_once('config.php');

// Consultar as empresas com técnicos alocados
$result = mysqli_query($conexao, "
    SELECT e.id_empresa, e.nome_empresa, e.projeto, e.estado_projeto, e.prazo_fim, e.descricao_projeto, e.local_projeto, e.valor_estimado, e.valor_final, e.tecnico_id, t.nome AS tecnico_nome, t.id
    FROM empresa e
    JOIN tecnico t ON e.tecnico_id = t.id
");

// Verificar se a consulta foi bem-sucedida
if (!$result) {
    die('Erro na consulta SQL: ' . mysqli_error($conexao));
}

// Consultar todos os técnicos disponíveis
$tecnicos_result = mysqli_query($conexao, "SELECT * FROM tecnico");

// Verificar se o formulário de edição foi enviado
if (isset($_POST['editar'])) {
    $id_empresa = $_POST['id_empresa'];
    $descricao_projeto = $_POST['descricao_projeto'];
    $local_projeto = $_POST['local_projeto'];
    $valor_estimado = $_POST['valor_estimado'];
    $valor_final = $_POST['valor_final'];
    $estado_projeto = $_POST['estado_projeto'];
    $tecnico_id = $_POST['tecnico_id'];

    // Atualizar os dados da empresa no banco de dados
    $update_query = "UPDATE empresa 
                     SET descricao_projeto = '$descricao_projeto', 
                         local_projeto = '$local_projeto', 
                         valor_estimado = '$valor_estimado', 
                         valor_final = '$valor_final', 
                         estado_projeto = '$estado_projeto',
                         tecnico_id = '$tecnico_id' 
                     WHERE id_empresa = $id_empresa";
    if (mysqli_query($conexao, $update_query)) {
        echo "Informações atualizadas com sucesso!";
    } else {
        echo "Erro ao atualizar informações: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
<nav>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="gerenciamento.php">Gerenciar Técnicos</a></li>
        <li><a href="servicos.php">Serviços</a></li>
    </ul>
</nav>

<!-- Container -->
<div class="container">
    <h2>Serviços - Empresas com Técnicos Alocados</h2>

    <!-- Tabela com os serviços e técnicos -->
    <table>
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Projeto</th>
                <th>Estado do Projeto</th>
                <th>Prazo de Término</th>
                <th>Técnico</th>
                <th>Valor Estimado</th>
                <th>Valor Final</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while($empresa = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $empresa['nome_empresa']; ?></td>
                    <td><?php echo $empresa['projeto']; ?></td>
                    <td><?php echo $empresa['estado_projeto']; ?></td>
                    <td><?php echo $empresa['prazo_fim']; ?></td>
                    <td><?php echo $empresa['tecnico_nome']; ?></td>
                    <td><?php echo number_format($empresa['valor_estimado'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($empresa['valor_final'], 2, ',', '.'); ?></td>
                    <td>
                        <!-- Link para editar as informações -->
                        <a href="#" onclick="document.getElementById('edit-form-<?php echo $empresa['id_empresa']; ?>').style.display='block'">Editar</a>
                    </td>
                </tr>

                <!-- Formulário de edição (invisível por padrão) -->
                <tr id="edit-form-<?php echo $empresa['id_empresa']; ?>" style="display:none;">
                    <td colspan="8">
                        <form method="POST" action="servicos.php">
                            <input type="hidden" name="id_empresa" value="<?php echo $empresa['id_empresa']; ?>">
                            <label for="descricao_projeto">Descrição do Projeto:</label>
                            <textarea name="descricao_projeto" rows="4" cols="50"><?php echo $empresa['descricao_projeto']; ?></textarea><br><br>
                            <label for="local_projeto">Local do Projeto:</label>
                            <input type="text" name="local_projeto" value="<?php echo $empresa['local_projeto']; ?>"><br><br>
                            <label for="valor_estimado">Valor Estimado:</label>
                            <input type="text" name="valor_estimado" value="<?php echo number_format($empresa['valor_estimado'], 2, ',', '.'); ?>"><br><br>
                            <label for="valor_final">Valor Final:</label>
                            <input type="text" name="valor_final" value="<?php echo number_format($empresa['valor_final'], 2, ',', '.'); ?>"><br><br>
                            <label for="estado_projeto">Estado do Projeto:</label>
                            <select name="estado_projeto">
                                <option value="Em andamento" <?php if ($empresa['estado_projeto'] == 'Em andamento') echo 'selected'; ?>>Em andamento</option>
                                <option value="Concluído" <?php if ($empresa['estado_projeto'] == 'Concluído') echo 'selected'; ?>>Concluído</option>
                                <option value="Pendente" <?php if ($empresa['estado_projeto'] == 'Pendente') echo 'selected'; ?>>Pendente</option>
                            </select><br><br>
                            <label for="tecnico_id">Técnico:</label>
                            <select name="tecnico_id">
                                <?php while ($tecnico = mysqli_fetch_assoc($tecnicos_result)) { ?>
                                    <option value="<?php echo $tecnico['id']; ?>" <?php if ($empresa['tecnico_id'] == $tecnico['id']) echo 'selected'; ?>>
                                        <?php echo $tecnico['nome']; ?>
                                    </option>
                                <?php } ?>
                            </select><br><br>
                            <input type="submit" name="editar" value="Salvar alterações">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
