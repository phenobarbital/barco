<?php
require 'barco/barco.inc.php';
echo "barco version: " . barco::version();
$readme = nl2br(file_get_contents('barco/README'));
echo '<br />';
echo $readme;
echo '<br />';

echo "=== Usando Barco ===";
echo "";
?>