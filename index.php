<html>
<title></title>

<body>
    <?php
    if (isset($_POST['submit'])) {
        $getlink = $_POST["coin"];
        echo "link : " . $getlink . "<br>";
    }

    session_start();
    $_SESSION["link"] = $getlink;
    if ($getlink != NULL) {
        $_SESSION["link"] = $getlink;
    }

    ?>

    <?php

    $data = $_POST["coin"];
    echo $data;
    $output = shell_exec("python toMl.py "  . $data);
    $getCoinPrice = shell_exec("python getCoinPrice.py");
    $genTableCoinPrice = shell_exec("python getPriceTable.py");
    #echo $output;
    header("Location: result.php");
    exit();

    ?>

</body>

</html>