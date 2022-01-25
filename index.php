<?php
require_once 'vendor/autoload.php';
require_once "Connect.php";

echo "Hello! You can fill your CRM here!\n";
echo "Please, press enter to continue...\n\n";

$restContect = new Connect();

$restContect->SwitchManager();

