<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: flex-start; 
            align-items: center; 
            height: 100vh;
            margin: 0;
            background-color: white;
            background-image: url('chrome-team-bargain-health-work.jpg');
            background-size: cover;
        }
        .container {
            background-color: #ffffff5a;
            padding: 20px;
            border-radius: 9px;
            box-shadow: 0 10px 9px rgba(0, 0, 0, 0.2);
            width: 310px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ccc;
            border-radius: 6px;
        }
        .inputSubmit {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: rgba(255, 255, 255, 0.969);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .inputSubmit:hover {
            background-color: #45a049;
        }
        .link-cadastro {
            display: block;
            margin-top: 15px;
            color: darkgreen;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: transform 0.3s ease, color 0.3s ease;
        }
        .link-cadastro:hover {
            text-decoration: underline;
            color: #45a049;
            transform: scale(1.1); /* Aumenta o tamanho do texto quando passar o mouse */
        }
        .navbar {
            width: 100%;
            background-color: #333;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }
  
        .navbar a {
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 16px;
        }
    
        .navbar a:hover {
            background-color: #575757;
            border-radius: 5px;
        }

    </style>
</head>
<body>

    <div class="container">
        <h2>Login</h2>
        <form action="testelogin.php" method="POST">
            <input type="text" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input class="inputSubmit" type="submit" name="submit" value="Entrar">
        </form>
        
        <p><a class="link-cadastro" href="cadastro.php">Deseja se cadastrar?</a></p>
    </div>

</body>
</html>