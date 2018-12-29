<?php
require('../../auth/authenticate.php');
require('../../database/db.php');
$db = new Database;
$con = $db->con;
$user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
var_dump(array_keys($_POST));