<?php
        if(isset($_POST['submit'])){
            $getlink = $_POST["coin"];
            echo "link : ".$getlink."<br>";
        }
?>

<?php

$data = $_POST["coin"]; 
$output=shell_exec("python test.py "  .$data);

echo $output;


?>