<?php
/**
 * Created by PhpStorm.
 * User: wyatt
 * Date: 5/7/2018
 * Time: 9:59 AM
 */
include 'common/config/config.php';
$config = new config();
define('ROOT', $config->baseURl);
include 'common/conn.php';