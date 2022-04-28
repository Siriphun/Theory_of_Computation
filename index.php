<html>
<title></title>

<body>
    <?php
    if (isset($_POST['submit'])) {
        $getlink = $_POST["coin"];
        echo "link : " . $getlink . "<br>";
    }

    session_start();
    $_SESSION["link"] = "https://www.cryptodatadownload.com/cdd/Binance_BTCUSDT_d.csv";
    if ($getlink != NULL) {
        $_SESSION["link"] = $getlink;
    }

    ?>

    <?php

    $data = $_POST["coin"];
    $output = shell_exec("python toMl.py "  . $data);
    $getCoinPrice = shell_exec("python getCoinPrice.py");
    $genTableCoinPrice = shell_exec("python getPriceTable.py");
    #echo $output;
    header("Location: result.php");
    exit();

    ?>

</body>

</html>