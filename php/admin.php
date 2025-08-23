<?php
session_start();

/* Verifica se o usuário logado é admin
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.php"); // Se não for admin, manda pro login
    exit();
}
    */

include 'db.php'; // Conexão com banco
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Filmes</title>
    <link rel="stylesheet" href="style.css"> <!-- usa o mesmo css ou cria um novo -->
</head>
<body>
    <h1>Painel Administrativo - Gerenciar Filmes</h1>

    <!-- Formulário para adicionar novo filme -->
    <h2>Adicionar Filme</h2>
    <form action="admin.php" method="POST">
        <input type="text" name="titulo" placeholder="Título do filme" required>
        <input type="text" name="genero" placeholder="Gênero" required>
        <input type="number" name="ano" placeholder="Ano" required>
        <button type="submit" name="add">Adicionar</button>
    </form>

    <hr>

    <!-- Lista de filmes cadastrados -->
    <h2>Lista de Filmes</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Gênero</th>
            <th>Ano</th>
            <th>Ações</th>
        </tr>

        <?php
        // Se o admin adicionar filme
        if (isset($_POST['add'])) {
            $titulo = $_POST['titulo'];
            $genero = $_POST['genero'];
            $ano = $_POST['ano'];

            $sql = "INSERT INTO filmes (titulo, genero, ano) VALUES ('$titulo', '$genero', '$ano')";
            $conn->query($sql);
        }

        // Se o admin remover filme
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $sql = "DELETE FROM filmes WHERE id=$id";
            $conn->query($sql);
        }

        // Mostrar os filmes
        $result = $conn->query("SELECT * FROM filmes");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['titulo']}</td>
                    <td>{$row['genero']}</td>
                    <td>{$row['ano']}</td>
                    <td>
                        <a href='admin.php?delete={$row['id']}'>Remover</a> |
                        <a href='editar.php?id={$row['id']}'>Editar</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
