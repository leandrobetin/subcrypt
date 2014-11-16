<?php
include 'class_subcrypt.php';

if($_POST)
{
		
	$subcrypt = new Subcrypt();	
	
	echo $subcrypt->process( $_COOKIE[ $_POST['1'] ], $_POST['2'] );
}

