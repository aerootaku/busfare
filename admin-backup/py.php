<?php
echo '<pre>';

$last_line = system('sudo python enroll.py');
// Printing additional info
echo '</pre>';

system('sudo touch enroll.py');
?>
