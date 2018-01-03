<?php
	header('Content-type: application/json');
	
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "tesapi";
	
	mysql_connect($host,$user,$password);
	mysql_select_db($database);
	
	$query = mysql_query("SELECT*FROM sekolah");
	
	$show = array();	
		while($k = mysql_fetch_array($query)){
			$show[] = array(
							"NIS"=> $k["NIS"],
							"Nama" => $k["Nama"],
							"Kelas" => $k["Kelas"],
							"Alamat" => $k["Alamat"],
							"Hobi" => $k["Hobi"]);
		}
	$data = array("data" => $show);
	$json = json_encode($data);
	
	echo $json;
	?>