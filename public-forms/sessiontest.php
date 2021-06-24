<?php
session_start();
echo '<pre>';
echo 'session variables:<br>';
print_r($_SESSION);
echo '</pre>';