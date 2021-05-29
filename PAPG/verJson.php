<!DOCTYPE html>
<?php
    $nome2 = (isset($_POST['nome2']) ? $_POST['nome2'] : "") .".json";

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
        foreach ($json as $value) {
            echo $value."<br>";
        }
    ?>


</body>
</html>