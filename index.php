<html>
<head> 
    <title>Select your pair</title> 
</head>
<body>
    <form method="POST" action="predic.php">
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

</body>
</html>



<?php //action="predic.php" ฝากไว้ก่อนเถอะ !!!! ?>




