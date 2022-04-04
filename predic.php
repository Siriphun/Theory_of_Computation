<?php
        if(isset($_POST['submit'])){
            $getlink = $_POST["coin"];
            echo "link : ".$getlink."<br>";
        }

        session_start();
        $_SESSION["link"] = $getlink;
?>

<?php

$data = $_POST["coin"]; 
$output=shell_exec("python toMl.py "  .$data);

#echo $output;
header("Location: result.php");
exit();

?>