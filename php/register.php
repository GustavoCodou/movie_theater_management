<?php
//Aqui conectamos o banco
include 'db.php';
session_start();

$error= "";

/* 🔹 session_start()
O PHP tem um recurso chamado sessão, que serve para armazenar informações
enquanto o usuário navega entre páginas.
Depois que a sessão está ativa, você pode salvar dados nela usando $_SESSION:
$_SESSION['username'] = "Kaiba"; 
$_SESSION['tipo'] = "admin";
*/

// O POST faz uma requisição vinda do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // 1. Verifica se as senhas são iguais
    if ($password !== $confirm_password) {
        $error = "As senhas não coincidem!";
    } else {
        // 2. Criptografa a senha antes de salvar
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // 3. Verifica se já existem usuários cadastrados
        $check = $conn->query("SELECT * FROM usuarios");
        if ($check->num_rows === 0) {
            // Se não existe ninguém → primeiro usuário é admin
            $tipo = "admin";
        } else {
            $tipo = "usuario";
        }

        // 4. Salva no banco
        $sql = "INSERT INTO usuarios (username, email, password, tipo) 
                VALUES ('$username', '$email', '$hash', '$tipo')";
        if ($conn->query($sql) === TRUE) {
            
            // 5. Cria sessão do usuário registrado
            $_SESSION["username"] = $username;
            $_SESSION["tipo"] = $tipo;

            // 6. Redireciona para admin ou usuário
            if ($tipo == "admin") {
                header("Location: admin.php");
                exit;
            } else {
                header("Location: usuario.php");
                exit;
            }

        } else {
            $error = "Erro no cadastro: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css"> <!-- aqui conecta o CSS -->
    <title>Document</title>
</head>
<body>

<?php include "../partials/header.php" ?>

<?php if($error): ?>
    <p style="color:red">
        <?php echo $error; ?>
    </p>
<?php endif; ?>

<form method="POST" action="">
    <h2>Create your Account</h2>

    <label for="username">Username:</label>
    <input placeholder="Enter your username" type="text" name="username" required>

    <label for="email">Email:</label>
    <input placeholder="Enter your email" type="email" name="email" required>

    <label for="password">Password:</label>
    <input placeholder="Enter your password" type="password" name="password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input placeholder="Confirm your password" type="password" name="confirm_password" required>

    <input type="submit" value="Register">
</form>
    
</body>
</html>

<?php mysqli_close($conn); ?>
