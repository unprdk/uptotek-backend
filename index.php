<?php
// Getting dem includes.
require_once("Includes/MysqlConstants.php");
require_once("Includes/HeaderConstants.php");
require_once("Includes/Controllers.php");
require_once("Includes/Route.php");

// Setting dat json-header.
header('Content-Type: application/json');

// Registering dem routes.
echo Route($_SERVER['REQUEST_URI']);