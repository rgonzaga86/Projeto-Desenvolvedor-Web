<?php
include('conexao.php');
try{
    $sql = "SELECT * from produto";
    $qry = $con->query($sql);
    $produto = $qry->fetchAll(PDO::FETCH_OBJ);

    //echo "<pre>";

    //print_r($clientes);

    //die();

} catch(PDOException $e){
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bo"></script>

</head>
<body>
 
<h1>Lista de Produtos</h1>
<hr>
<a href="frmprodutos.php">Novo Cadastro</a> |
<a href="index.html">Home</a>
<hr>

<table border=1>
    <thead>
        <tr>
           <th>id</th> 
           <th>Produto</th>
           <th>preco</th>
           <th>Estoque Atual</th>
           <th>Estoque Máx</th>
           <th>Estoque Mín</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>

        <?php foreach($produto as $produto) { ?>
        <tr>
            <td><?php echo $produto->idproduto ?></td>
            <td><?php echo $produto->produto ?></td>
            <td><?php echo $produto->preco ?></td>
            <td><?php echo $produto->estoqueatual ?></td>
            <td><?php echo $produto->estoquemax ?></td>
            <td><?php echo $produto->estoquemin ?></td>
            <td><a href="frmprodutos.php?idproduto=<?php echo $produto->idproduto ?>>"<button type=<button type="button" class="btn btn-warning">Editar</button></td>
            <td><a href="frmprodutos.php?op=del&idproduto=<?php echo  $produto->idproduto ?>" <button type="button" class="btn btn-danger">Excluir</a></td>


        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>