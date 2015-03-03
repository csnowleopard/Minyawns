<?php
/**
 * Setup file for project. Run this file to executer all project initialization tasks
 * Do not write any project code here.
 * Do not include this file in functions.php
 */

require_once( '../../../wp-load.php');


global $wpdb;
$query_widget=("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}userjobs 
				(id 			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			     user_id 		INT,
			     job_id 		INT,
                 status 		VARCHAR(100),
                 status_date 	DATE,
			     rating 		INT )");

$wpdb->query($query_widget);

echo "New {$wpdb->prefix}userjobs table  created successfully";



$query_pagerestrict=("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}userpermissions
					(id 			INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					role 			varchar(25) NOT NULL,
					noperm_slug 	varchar(60) NOT NULL
					)");

$wpdb->query($query_pagerestrict);

echo "New {$wpdb->prefix}userpermissions table  created successfully";


 