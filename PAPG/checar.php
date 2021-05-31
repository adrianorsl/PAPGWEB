<!DOCTYPE html>
    <?php
        $nome2 = (isset($_POST['nome2']) ? $_POST['nome2'] : "") .".json";
        $menu = (isset($_POST['menu']) ? $_POST['menu'] : "");
        

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
        function a1($json){
            if(progressao($json) == "Pa"){
            $a1 = $json[quantidade($json) - 1] - (quantidade($json) - 1) * razao($json);
            return $a1;
            }else{
                $a1 = $json[quantidade($json) - 1] / (pow(razao($json), (quantidade($json)-1)));
                return $a1; 
            }
        }
        function quantidade($json){
            $quantidade = 0;
            for ($x = 0; $x < count($json); $x++) {
                $quantidade += 1;
            }
            return $quantidade;
        }
        function razao($json){
            if (progressao($json) == "Pa"){
                $quant = quantidade($json);
                $a = $json[0];
                $b = $json[$quant - 1];
                $razao = ($b - $a) / ($quant - 1);
                return $razao;
            }else{
                $quant = quantidade($json);
                for($x = 0; $x < $quant - 1; $x++ ){
                   $a[$x] = $json[$x + 1] / $json[$x]; 
                }
                for($x = 0; $x < count($a) - 1; $x++){
                    if ($a[$x] == $a[$x + 1]){
                        $valor = $a[$x];
                    }else{
                    }
                }
                return $valor;
            }
            
        }
        function progressao($json){
            $quantidade2 = quantidade($json) - 1;
            $valor = 0;
            $valor2 = 0;
            for ($x = 0; $x < quantidade($json) / 2; $x++){
                $a = $json[$x] + $json[$quantidade2];
                $b = $json[$x + 1] + $json[$quantidade2 - 1];
                $quantidade2 = $quantidade2 - 1;
                if($a == $b){
                    $valor = $valor + 1;
                }else{
                    $valor2 = $valor2 + 1;
                }
            }
            if ($valor >= $valor2){
                $progressao = "Pa";
            }else{
                $progressao = "Pg";
            }
            return $progressao;  
        }
        function porcentagem($json){
            $valor = 0.0;
            if(progressao($json) == "Pa"){
                $checar = PA(a1($json), razao($json), quantidade($json));
                for($x = 0; $x < quantidade($checar); $x++){
                    if($checar[$x] == $json[$x]){
                        $valor = $valor + 1;
                    }
                } 
            }else{
                $checar = PG(a1($json), razao($json), quantidade($json));
                for($x = 0; $x < quantidade($checar); $x++){
                    if($checar[$x] == $json[$x]){
                        $valor = $valor + 1;
                    }
                } 
            }
            return ($valor / quantidade($checar)) * 100;
        }
        

    ?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checar</title>
</head>
<body>

    <form action="" method="post">
    <h1> Menu </h1>
    <select name="menu" id="menu">
        <option value=""></option>
        <option value="index">Inserir dados</option>
        <option value="ver">Ver dados</option>
        <option value="grafico">Gráfico dos dados</option>
        <fieldset>
            <input type="submit" name="ok" id="ok" value="ok" >
        </fieldset>
    </select>
    <?php
        if ($menu == "ver"){
            header('Location: verJson.php');
            exit;
        }else if ($menu == "grafico"){
            header('Location: grafico.php');
            exit;
        }else if ($menu == "index"){
            header('Location: index.php');
            exit;
        }else{

        }
    ?>
    <h1></h1>
    <legend>Informe o nome do arquivo</legend>
        <label for="nome">Nome</label>
        <input type="text" name="nome2" id="nome2" placeholder="Digite o nome" >
    </fieldset>
    <fieldset>
        <input type="submit" name="ok" id="ok" value="ok" >
    </fieldset>
    <?php
        $arquivo = file_get_contents($nome2);
        $json = json_decode($arquivo);
        
        for($i = 0; $i < count($json); $i++){
            echo $json[$i]."<br>";
        } 
        echo porcentagem($json)."% é uma ".progressao($json);

    ?>
</body>
</html>