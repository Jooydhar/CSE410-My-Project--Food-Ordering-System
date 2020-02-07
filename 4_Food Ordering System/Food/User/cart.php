<?php
	
	$fid = $_GET['fid'];
	$userid = $_GET['userid'];
	#echo "<script type='text/javascript'>alert('$fid');</script>";
	#echo "<script type='text/javascript'>alert('$userid');</script>";
	$query = mysqli_query( mysqli_connect('localhost' , 'root' , '' , 'fooddata' ) , "insert into cart(id,fid ) values('$userid' , '$fid')" );
	# echo "<script type='text/javascript'>alert('Added To Cart');</script>";
	header("Location: menu.php?userid=".$_GET['userid']."&catid=".$_GET['catid']."");

?>