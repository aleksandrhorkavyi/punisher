<?php

$openapi = \OpenApi\scan('/var/www/punisher/');
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
?>

<h1>Docs</h1>
