<?php

include_once('conectar.php');

date_default_timezone_set('America/Bahia');

system('mysqldump -h localhost -u root --no-data --database pg > pg.sql -pcgeagt');

echo 'feito!';

?>