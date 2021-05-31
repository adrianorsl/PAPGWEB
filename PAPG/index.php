<!DOCTYPE html>
<?php
    $a1 = (isset($_POST['a1']) ? $_POST['a1'] : 0);
    $quantidade = (isset($_POST['quantidade']) ? $_POST['quantidade'] : 0);
    $razao = (isset($_POST['razao']) ? $_POST['razao'] : 0);
    $tipo = (isset($_POST['papg']) ? $_POST['papg'] : "");
    $nome = (isset($_POST['nome']) ? $_POST['nome'] : "") .".json";
    $menu = (isset($_POST['menu']) ? $_POST['menu'] : "");;
    

    function PA($n1, $razao, $quantidade){  
        for ($x = 0; $x < $quantidade; $x++){
            if ($x == 0){
                $resultado[$x] = $n1;
            }else{
                $resultado[$x] = $n1 + $razao;
                $n1 = $resultado[$x];
            }
        }
        return $resultado;
    }

    function PG($n1, $razao, $quantidade){
        for ($x = 0; $x < $quantidade; $x++){
            if ($x == 0){
                $resultado[$x] = $n1;
            }else{
                $resultado[$x] = $n1 * $razao;
                $n1 = $resultado[$x];
            } 
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
    <select name="menu" id="menu">
        <option value=""></option>
        <option value="ver">Ver dados</option>
        <option value="checar">Checar dados</option>
        <fieldset>
            <input type="submit" name="ok" id="ok" value="ok" >
        </fieldset>
    </select>
    <?php
        if ($menu == "ver"){
            header('Location: verJson.php');
            exit;
        }else if ($menu == "checar"){
            header('Location: checar.php');
            exit;
        }else{
            
        }
    ?>
    <form action="" method="post">
    <fieldset>
    <legend>Informe o nome do arquivo</legend>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" placeholder="Digite o nome" >
    </fieldset>
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
    <input type="radio" name="papg" id="papg" value="PA">PA;
    <input type="radio" name="papg" id="papg" value="PG">PG;
    <fieldset>
        <input type="submit" name="ok" id="ok" value="ok" >
    </fieldset>
    <?php
        if ($tipo == "PA"){
            $resultado = PA($a1, $razao, $quantidade);
            $dados_json = json_encode($resultado);
            $fp = fopen($nome, "w");
            fwrite($fp, $dados_json);
            fclose($fp);
            for($i = 0; $i < count($resultado); $i++){
                echo $resultado[$i]."<br>";
            }
        }else if($tipo == "PG") {
            $resultado = PG($a1, $razao, $quantidade);
            $dados_json = json_encode($resultado);
            $fp = fopen($nome, "w");
            fwrite($fp, $dados_json);
            fclose($fp);
            for($i = 0; $i < count($resultado); $i++){
                echo $resultado[$i]."<br>";
            }
        }
    ?>
    <?php
        $menu = (isset($_POST['menu']) ? $_POST['menu'] : "");
        
    ?>
    
        
        

</body>
</html>
