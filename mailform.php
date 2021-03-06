<?php
/*
 * mailform.php
 * 
 * Copyright 2018 Krzysztof Hrybacz <krzysztof@zygtech.pl>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>
<?php
	require_once('config.php');
	session_start();
	if ($_SESSION['login']!='') {
		$link = mysqli_connect($sql, $sqluser, $sqlpass, $sqldb);
		mysqli_set_charset($link,'utf8');
		if ($_GET['id']!='') {
			$result = mysqli_query($link,'SELECT * FROM `clients` WHERE id=' . $_GET['id'] . ';');
			$client = mysqli_fetch_array($result);
		}
		?>
<html>

<head>
	<title>Mail Edit</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web%3A400%2C300%2C900%7CPT+Sans%3A700&#038;subset=latin" rel="stylesheet">
	<script src="limit.js"></script>
	<script src="tinymce/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea', menubar: false, height: 300 });</script>
	<style>
		input[type=text] { border-radius: 0px; border: 1px solid #c5c5c5; background: #ffffff; }
		textarea { height: 300px; }
	</style>
</head>

<body>
	<div class="container">
	<img class="right" src="logo.png" />
	<h1> Welcome: <?php echo $_SESSION['login']; ?> <span class="logout">(<a href="index.php?logout=true">log out</a>)</span></h1>
	</div>
	<div class="ribbon"><div class="container">
	<h2> MAIL EDIT </h2>
	</div></div>
	<div class="main"><div class="container">
	<form action="mailsend.php" method="POST">
	Title:<br />
	<input type="text" name="title" /><br /><br />
	Content:<br />
	<textarea name="content"></textarea>
	<br /><br />
	<?php
	foreach ($_POST['emails'] as $email)
		echo $email . '<br /><input type="hidden" name="emails[]" value="' . $email . '" />';
	?>
	<br />
	<input type="submit" value="Send" />
	</form>
	</div></div>
	<div class="ribbon"><div class="container">
	<?php require_once('menu.php'); ?>
	</div></div>
</body>

</html>
<?php
	}
?>
