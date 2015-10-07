<?php
	$link = mysql_connect('localhost','root','jogja')
	or die('Tidak dapat terhubung: ' .mysql_error());
	mysql_select_db('datamahasiswa') or die('Tidak dapat menghubungkan ke database');
?>
