<?php 

$idvendedor = isset($_GET["idvendedor"]) ? $_GET["idvendedor"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;


    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  vendedor where idvendedor= :idvendedor";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedor",$idvendedor);
            $stmt->execute();
            header("Location:listarvendedor.php");

        }

        if($idvendedor){

            //estou buscando os dados do cliente no BD

            $sql = "SELECT * FROM  vendedor where idvendedor= :idvendedor";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedor",$idvendedor);
            $stmt->execute();
            $vendedor = $stmt->fetch(PDO::FETCH_OBJ);

           

        }

        if($_POST){
            if($_POST["idvendedor"]){
                $sql = "UPDATE vendedor SET vendedor=:vendedor, dataadmissao=:dataadmissao WHERE idvendedor=:idvendedor";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedor", $_POST["idvendedor"]);
                $stmt->bindValue(":dataadmissao", $_POST["dataadmissao"]);
                $stmt->execute(); 

            } else {

                $sql = "INSERT INTO vendedor(vendedor,dataadmissao) VALUES (:vendedor,:dataadmissao)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedor", $_POST["vendedor"]);
                $stmt->bindValue(":dataadmissao", $_POST["dataadmissao"]);
                $stmt->execute(); 

            }
            header("Location:listarvendedor.php");
        } 
    } catch(PDOException $e){
         echo "erro".$e->getMessage;

        }


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>

<body>

<h1>Cadastro de Vendedores</h1>

<form method="POST">
Vendedor    <input type="text" name="vendedor"        required value="<?php echo isset($vendedor) ? $vendedor->vendedor: null ?>"><br>
Data de Admissão <input type="date" name="dataadmissao"           required value="<?php echo isset($vendedor) ? $vendedor->dataadmissao: null ?>"><br>
<input type="submit">
</form>
<a href="listarvendedor.php">voltar</a>
</body>
</html>