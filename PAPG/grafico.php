<!DOCTYPE html>
<?php
    $nome2 = (isset($_POST['nome2']) ? $_POST['nome2'] : "") .".json";
    $menu = (isset($_POST['menu']) ? $_POST['menu'] : "");
   
?>

<html>
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VerJson</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart($json) {

      var data = new google.visualization.DataTable(<?=$json?>);
      data.addColumn('number', 'Quantidade');
      data.addColumn('number', 'Progressão');
      
      
     

      var options = {
        chart: {
          title: 'Progressão Aritmetica',
        },
        width: 900,
        height: 500,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
<body>

<form action="" method="post">
    <h1> Menu </h1>
    <select name="menu" id="menu">
        <option value=""></option>
        <option value="index">Inserir dados</option>
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
    ?>  

    

     
    <div id="line_top_x"></div>

</body>
</html>