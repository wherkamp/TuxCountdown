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
	`name` VARCHAR(255) NOT NULL,
	`description` VARCHAR(255) NOT NULL,
	`date` VARCHAR(255) NOT NULL,
	`time` VARCHAR(255) NOT NULL,
	`done` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
);

");
echo "DETETE install.php";