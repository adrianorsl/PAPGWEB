<!DOCTYPE html>
<?php
    $nome2 = (isset($_POST['nome2']) ? $_POST['nome2'] : "") .".json";
    $quantidade2 = -1 ;
    $media = 0;
    $mediana = 0;
    $valor = 0;
    $valor2 = 0;
    $progressao = "";

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
    function somatorio($json){
        $quant = quantidade($json);
        if(progressao($json) == "Pa"){
        $a = $json[0];
        $b = $json[$quant - 1];
        $somatoria = (($a + $b) * quantidade($json)) / 2;
        return $somatoria;
        }else{
            $somatoria = (a1($json)*(pow(razao($json), quantidade($json)) - 1)) / (razao($json) - 1);
            return $somatoria;
        }
    }
    function media($json){
        return somatorio($json) / quantidade($json);
    }
    function mediana($json){
        if (quantidade($json) % 2 == 0){
            $aux = quantidade($json) / 2;
            $mediana = ($json[$aux - 1] + $json[$aux]) / 2; 
        }else {
            $aux = (quantidade($json) / 2);
            $mediana = $json[$aux]; 
        }
        return $mediana;
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

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VerJson</title>
</head>
<body>
    <form action="" method="post">
    <h2>Ver Json</h2>
    <fieldset>
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
        for ($x = 0; $x < count($json); $x++) {
            echo $json[$x]."<br>";
            $a1= $json[0];
            $quantidade2 += 1;
        }
        
        
        echo "a1: ".a1($json)."<br>";
        echo "Quantidade: ".quantidade($json)."<br>";
        echo "Razão: ".razao($json)."<br>";
        echo "Somatoria: ".somatorio($json)."<br>";
        echo "Media: ".media($json)."<br>";
        echo "Mediana: ".mediana($json)."<br>";
        echo "Progressão: ".progressao($json)."<br>";
    ?>
    
</body>
</html>