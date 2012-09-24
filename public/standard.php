<?php
/**
 * User: elron
 * Date: 15/09/12
 * Time: 16:52
 */

session_start();
require_once('../lib/Configuration.php');
require_once('../lib/Repo.php');

/*$o_Configuration = new Configuration();

echo $o_Configuration;

$o_Configuration->writeFile("./data/confs/out.config");
echo "Done!";*/
include_once("../apps/RepositoriesView.php");