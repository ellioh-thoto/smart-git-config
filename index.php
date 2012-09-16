<?php
/**
 * User: elron
 * Date: 15/09/12
 * Time: 16:52
 */

require_once('./lib/Configuration.php');
require_once('./lib/Repo.php');

$o_Configuration = new Configuration();

echo $o_Configuration;

$o_Configuration->writeFile("./data/out.config");
echo "Done!";