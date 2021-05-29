<!DOCTYPE html>
<?php
    $nome2 = (isset($_POST['nome2']) ? $_POST['nome2'] : "") .".json";
    $quantidade = 0;
    $somatoria = 0;
    $media = 0;
    $mediana = 0;
    $progressao = "";

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
            $quantidade = $quantidade + 1;
            $somatoria = $somatoria + $json[$x];
        }
        if ($quantidade % 2 == 0){
            $aux = $quantidade / 2;
            $mediana = $json[$aux - 1] + $json[$aux]; 
        }else {
            $aux = ($quantidade / 2) + 1;
            $mediana = $json[$aux]; 
        }
        for ($x = 0; $x < $quantidade - 2; $x++){
            $a = $json[$x + 1];
            $b = $json[$x];
            $c = $a - $b;
            $d = $json[$x+2] - $a;
            if($d == $c){
                $progressao = "PA";
            }else{
                $progressao = "PG";
            }
        }
        $media = $somatoria / $quantidade;
        echo $a1."<br>";
        echo $quantidade."<br>";
        echo $somatoria."<br>";
        echo $media."<br>";
        echo $mediana."<br>";
        echo $progressao."<br>";
    ?>
    
</body>
</html>