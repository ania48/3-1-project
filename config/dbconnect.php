<?php
$databaseConnection = new mysqli("localhost", "root", "", "austro_asian_times");
if ($databaseConnection->connect_error) {
    die("Connection failed: " . $databaseConnection->connect_error);
}
