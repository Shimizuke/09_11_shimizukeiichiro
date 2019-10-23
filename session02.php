<?php
session_start();
$_SESSION["num"] += 1;

echo $_SESSION["num"]; //session01の300に1が足され続ける。

