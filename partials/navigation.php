<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/navigation.css"> <!-- aqui conecta o CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <nav>

        <ul>

    <!-- Aqui dependendo se estiver logado aparece uma opção diferente-->
    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>

            <a href="admin.php">Admin</a>



            <a href="logout.php">Logout</a>


    <?php else: ?>


            <a href="register.php">Register</a>



            <a href="login.php">login</a>


    <?php endif; ?>

        </ul>

    </nav>
    
</body>
</html>




