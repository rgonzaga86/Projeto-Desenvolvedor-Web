<?php
include('conexao.php');

try{
    $sql = "SELECT * from clientes";
    $qry = $con->query($sql);
    $clientes = $qry->fetchAll(PDO::FETCH_OBJ);
    
} catch(PDOException $e){
    echo $e->getMessage();

}
?>

<!DOCTYPE html>
<html lang="en">
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
    
<h1>Lista de Clientes</h1>
<hr>
<a href="frmcliente.php">Novo Cadastro</a>
<a href= "index.html"> Home</a>
<hr>
<table border=1>
    <thead>
        <tr>
           <th>id</th> 
           <th>Cliente</th>
           <th>email</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($clientes as $cliente) { ?>
        
            
            <td><?php echo $cliente->idcliente ?></td>
            <td><?php echo $cliente->nome ?></td>
            <td><?php echo $cliente->email ?></td>
            <td><a href="frmcliente.php?idcliente=<?php echo $cliente->idcliente ?>"<button type=<button type="button" class="btn btn-warning">Editar</button></td>
            <td><a href="frmcliente.php?op=del&idcliente=<?php echo  $cliente->idcliente ?>""<button type="button" class="btn btn-danger">Excluir</a></td>
            

        </tr>
        <?php } ?>
    </tbody>
    
</table>
</body>
</html>