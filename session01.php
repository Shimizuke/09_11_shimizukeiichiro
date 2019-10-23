<?php
session_start();
$_SESSION["num"] = 300; 

echo $_SESSION["num"]; //300が出る
