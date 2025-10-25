
<?php
require "CRUDemPHP.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
</head>
<body> 
    <p>Aqui iremos deletar um registro da tabela cadastro:</p>
    <form action="Delete.php" method="POST">
        Digite o rm do aluno que quer deletar: <input type="text" name="rm"><br><br>
        <input type="submit">
    </form>
</body>
</html>
<?php
require "conn.php";
/*
$stmt = $conn->prepare("SEL");
$stmt->execute();
bind_param("sss", $firstname, $lastname, $email);
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $rm = $_POST["rm"];

if ($rm == null) {
    throw new Exception("Digite o rm. ");
} else {
  
  $query = "SELECT * FROM cadastro WHERE rm =" . $rm;
  $execute = mysqli_query($conn, $query);
  $result = mysqli_fetch_assoc($execute);

 if ($result["RM"] == null) {
    throw new Exception("Não existe um registro com este rm. ");
  } else {

    $stmt = $conn->prepare("DELETE FROM cadastro WHERE rm = (?)");
    $stmt->execute([$rm]);

    echo "O aluno foi deletado. ";
  }
}
}



?>