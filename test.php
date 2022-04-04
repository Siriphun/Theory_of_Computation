
    <?php
    if (($handle = fopen("cyrpto_link.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            echo "$data[0]<br>";
        }
        fclose($handle);
    }
    ?>