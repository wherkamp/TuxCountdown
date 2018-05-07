<?php
/**
 * Created by PhpStorm.
 * User: wyatt
 * Date: 5/7/2018
 * Time: 11:14 AM
 */
include 'common.php';
$conn->query("CREATE TABLE `countdowns` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` TEXT NOT NULL,
	`description` TEXT NOT NULL,
	`date` TEXT NOT NULL,
	`time` TEXT NOT NULL,
	`done` TEXT NOT NULL,
	PRIMARY KEY (`id`)
);

");
echo "DETETE install.php";