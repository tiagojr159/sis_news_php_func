<?php
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';

$con = new conexao();
$con->connect();

@$getId = $_GET['id'];
if (@$getId) {
    $consulta = mysqli_query($con->connect(), "SELECT * FROM jornalista WHERE id = + $getId");
    $campo = mysqli_fetch_array($consulta);
}

if (isset($_POST['login'])) {
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $crud = new crud('jornalista');
    $crud->login( "telefone = '$telefone' and senha = '$senha' ", $con->connect());
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body background="images/grey-padlock-on-a-white_small.jpg">
    <center>
        <form action="" method="post">
            <center> <img src="login.png" height="150" ></center>

            <table border="0">
                <tr>
                    <td>Telefone:</td><td> <input name="telefone" value="" placeholder="(81) 9 9999 9999"  type="text"/></td>
                </tr>   
                <tr>
                    <td>Senha: </td><td> <input name="senha" value="" type="password"/></td>
                </tr>
                <tr><td>  </td><td><input type="submit" name="login" value="Entrar" /></td></tr>
                </tr>

            </table>

        </form>
    </center>
</body>
</html>

<br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?php
$con->disconnect(); // fecha conexao com o banco ?>