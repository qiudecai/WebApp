<?php 
/***********************************************************************************************************************
"Nodo Web App" Copyright � 2015 Martin de Graaf

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*************************************************************************************************************************/
require_once('../settings.php');


session_start();
if(!isset($_SESSION['userId'])) {
    
	if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {

	$username = mysql_real_escape_string($_COOKIE['username']);
	$password = mysql_real_escape_string($_COOKIE['password']);
	
	mysql_select_db($database, $db);
	$result = mysql_query("SELECT * FROM nodo_tbl_users WHERE user_login_name='$username' AND user_password='$password'") or die(mysql_error());  
	$row = mysql_fetch_array($result);
	$id = $row['id'];
	$active = $row['active'];
	$default_page = $row['default_page'];

	if($id > 0 && $active == 1) {
		
		//De gebruiker inloggen
		$_SESSION['userId'] = $id;
		$userId=$_SESSION['userId'];
		//session_write_close();
		
		
	}
}
	else {	
	//die('You need to be logged in!!!');
	header("Location: /webapp/index.html");
	}
} else {

 $userId=$_SESSION['userId'];
 
}
?>