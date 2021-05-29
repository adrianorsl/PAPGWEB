<!DOCTYPE html>
<?php
    $a1 = (isset($_POST['a1']) ? $_POST['a1'] : 0);
    $quantidade = (isset($_POST['quantidade']) ? $_POST['quantidade'] : 0);
    $razao = (isset($_POST['razao']) ? $_POST['razao'] : 0);
    $resultado = PG($a1, $razao, $quantidade, $resultado);

    PA($a1, $razao, $quantidade, $resultado);
    function PA($n1, $razao, $quantidade, $resultado){  
        for ($x = 0; $x < $quantidade; $x++){
            $resultado[$x] = $n1 + $razao;
            $n1 = $resultado[$x];
        }
        return $resultado;
    }
    function PG($n1, $razao, $quantidade, $resultado){
        for ($x = 0; $x < $quantidade; $x++){
            $resultado[$x] = $n1 * $razao;
            $n1 = $resultado[$x];
        }
        return $resultado;
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <fieldset>
    <legend>Informe o valor</legend>
        <label for="a1">a1</label>
        <input type="int" name="a1" id="a1" placeholder="Digite o a1" >
    </fieldset>
    <fieldset>
    <legend>Informe a quantidade</legend>
        <label for="quantidade">Quantidade</label>
        <input type="int" name="quantidade" id="quantidade" placeholder="Digite a quantidade" >
    </fieldset>
    <fieldset>
    <legend>Informe a razão</legend>
        <label for="razao">Razao</label>
        <input type="int" name="razao" id="razao" placeholder="Digite a razao" >
    </fieldset>
    <fieldset>
        <input type="submit" name="ok" id="ok" value="ok" >
    </fieldset>
    <?php
        for($i = 0; $i < count($resultado); $i++){
            echo $resultado[$i]."<br>";
        }
    ?>
</body>
</html>
