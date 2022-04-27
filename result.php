<html>
<title>name</title>
<html>
<head> 
    <title>Select your pair</title> 
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.2/papaparse.min.js" integrity="sha512-SGWgwwRA8xZgEoKiex3UubkSkV1zSE1BS6O4pXcaxcNtUlQsOmOmhVnDwIvqGRfEmuz83tIGL13cXMZn6upPyg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
<?php
session_start();
clearstatcache();

?>
<? echo"$_SESSION" ?>
<div class="choose">
<form method="POST" action="index.php">
        <label for="coin"> Choose yourcoin to predic :</label>
        <select name="coin" onchange="OnSelectionChange()">
            <?php
            if (($handle = fopen("cyrpto_link.csv", "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if($data[0] != "pair of coins"){
                        // data[0] is pair of coins, data[1] is link to that pair
                        ?>
                        <option value= "<?php  echo $data[1] ?>" > <?php echo "$data[0]" ?> </option>
                        <?php
                    }
                }
                fclose($handle);
            }
            ?>
        </select>
        <input type="submit" name="submit" value="Submit this pair"/>
</form>
        </div>


<br><br>
<table class="center" width="80%" border="0" cellspacing="0">
    <td width="20%">
        <h2><?php
        
        
        $link = $_SESSION["link"];
        


        $coinname=shell_exec("python getcoinname.py "  .$link);
        echo"$coinname";
        ?></h2>
        <form method="POST" action="result.php">

        <label for="open">ราคาเปิดของวัน :</label><br>
        <input type="text" id="open" name="open"><br>
        <label for="high">ราคาสูงสุดของวัน :</label><br>
        <input type="text" id="high" name="high"><br>
        <label for="low">ราคาต่ำสุดของวัน :</label><br>
        <input type="text" id="low" name="low"><br>
        <br>
        <input type="submit" name="submit" value="Submit this pair"/>
        </form>
        <a href="<?php echo $_SESSION["link"]; ?>">download raw CSV</a>
    </td>
    <td width="20%">
        <?php
            if(isset($_POST['submit']) && $_POST["open"] != NULL && $_POST["high"] != NULL && $_POST["low"] != NULL){
                $open = $_POST["open"];
                echo "ราคาเปิดของวัน : ".$open."<br>";
                $high = $_POST["high"];
                echo "ราคาสูงสุดของวัน : ".$high."<br>";
                $low = $_POST["low"];
                echo "ราคาต่ำสุดของวัน : ".$low."<br>";
                
                $output=shell_exec("python model.py $open $high $low");

                echo "ราคาปิดของวันจากการทำนาย : ".$output."<br>";
            }
        ?>
    </td>
    <td width="40%">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <div id="container"></div>
    </td>
    <td width="20%">       
           <?php echo file_get_contents("priceTable.php"); ?>      
    </td>
</table>
</body>
</html>

<script>
    Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Predicting price'
    },

    subtitle: {
        text: 'Data input from CSV file'
    },

    data: {
        csvURL: './predic_pair.csv',
        enablePolling: true
    }
});
</script>
</html>


