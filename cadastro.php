<?php  

if (isset($_POST['submit'])) {
    include_once('config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $especialidade = $_POST['especialidade']; 
    $telefone = $_POST['telefone'];

    
    $result = mysqli_query($conexao, "INSERT INTO usuario(nome, senha, email, especialidade, telefone) 
    VALUES ('$nome', '$senha', '$email', '$especialidade', '$telefone')");

    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário com Imagem</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #003366;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            height: 100vh;
            background-color: #e1e1e1;
            position: relative; 
        }

        .container {
            display: flex;
            width: 100%;
            justify-content: space-between;
            padding: 20px;
            position: relative; 
        }

        .form-container {
            width: 50%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .image-sidebar {
            width: 30%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
            height: fit-content;
        }

        .image-sidebar h3 {
            text-align: center;
            font-size: 1.5em;
            color: #333;
        }

        .image-container img {
            width: 100%;
            height: auto;
            display: block;
            opacity: 0; /* Imagem inicial invisível */
            transition: opacity 1s ease-in-out; /* Transição suave para opacidade */
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 24px; /* Ajuste para as setas ficarem maiores */
        }

        .navigation-buttons button {
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 36px; /* Tamanho das setas */
            color: #4CAF50;
            transition: all 0.3s ease;
        }

        .navigation-buttons button:hover {
            transform: scale(1.2); 
        }

        fieldset {
            border: 2px solid #ccc;
            padding: 20px;
        }

        legend {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
        }

        .inputBox {
            position: relative;
            margin-bottom: 15px;
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

        /* Estilo para o texto de login no canto inferior direito */
        .login-text {
            position: fixed;
            bottom: 20px;  /* Posicionando no canto inferior */
            right: 20px;   /* Posicionando no canto direito */
            font-size: 1.2em;
            background-color: #fff;
            color: #4CAF50;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.5s forwards;
        }

        /* Animação de entrada (subindo de baixo para cima) */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-text:hover {
            background-color: #45a049;
            color: white;
        }

    </style>
</head>
<body>

    <div class="container">
        
        <div class="form-container">
            <form action="cadastro.php" method="POST">
                <fieldset>
                    <legend><b>Cadastro</b></legend>
                    <br>
                    <div class="inputBox">
                        <input type="text" name="nome" id="nome" class="inputUser" required>
                        <label for="nome" class="labelInput">Nome completo</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="password" name="senha" id="senha" class="inputUser" required>
                        <label for="senha" class="labelInput">Senha</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="text" name="email" id="email" class="inputUser" required>
                        <label for="email" class="labelInput">Email</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                        <label for="telefone" class="labelInput">Telefone</label>
                    </div>
                    <br><br>
                    <input type="submit" name="submit" id="submit">
                </fieldset>
            </form>
        </div>

        <div class="image-sidebar">
            <h3>Demonstração de Imagens</h3>

            <div class="navigation-buttons">
                <!-- Setas para navegação -->
                <button onclick="changeImage(-1)">&#8592;</button> <!-- Seta para a esquerda -->
                <button onclick="changeImage(1)">&#8594;</button> <!-- Seta para a direita -->
            </div>

            <div class="image-container">
                <img src="male-plumber-working-with-client-fix-kitchen-problems.jpg" alt="Imagem 1" id="demoImage">
            </div>
        </div>
    </div>

    <!-- Texto para redirecionamento ao login -->
    <div class="login-text" onclick="window.location.href='login.php';">
        Já possui um login? Clique aqui!
    </div>

    <script>
        const images = [
            "male-plumber-working-with-client-fix-kitchen-problems.jpg",
            "side-view-woman-working-as-plumber.jpg",
            "pexels-kindelmedia-8487370.jpg", 
        ];

        let currentImageIndex = 0;

        function changeImage(direction) {
            const demoImage = document.getElementById('demoImage');

            // Aplica fade-out
            demoImage.style.opacity = 0;

            // Espera o fade-out completar antes de alterar a imagem
            setTimeout(() => {
                currentImageIndex += direction;

                // Garante que o índice esteja dentro do intervalo
                if (currentImageIndex < 0) {
                    currentImageIndex = images.length - 1;
                } else if (currentImageIndex >= images.length) {
                    currentImageIndex = 0;
                }

                // Atualiza o src da imagem
                demoImage.src = images[currentImageIndex];

                // Aplica fade-in
                demoImage.style.opacity = 1;
            }, 1000); // Tempo do fade-out
        }
    </script>

</body>
</html>
