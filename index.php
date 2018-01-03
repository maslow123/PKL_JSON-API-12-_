<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "tesapi";
	
	mysql_connect($host,$user,$password);
	mysql_select_db($database) or die("Database tidak terdeteksi");
	
	$operasi = $_GET['operasi'];
	switch($operasi){
		case "view":
			// Menampilkan biodata
			$query_tampilkan = mysql_query("SELECT *FROM sekolah") or die("Tabel tidak terdefinisi");
			$data_array = array();
			while ($data=mysql_fetch_assoc($query_tampilkan)){
				$data_array[] = $data;
			}
			echo json_encode($data_array);//mencetak array
			break;
		case "insert":
			// Memasukkan data
			$nama = $_GET['Nama'];
			$kelas = $_GET['Kelas'];
			$alamat = $_GET['Alamat'];
			$hobi = $_GET['Hobi'];

			
			$query_masukkan = mysql_query("INSERT INTO sekolah(Nama,Kelas,Alamat,Hobi)VALUES('$nama','$kelas','$alamat','$hobi')");
			
			if($query_masukkan){
				echo "Data berhasil ditambahkan";
			}
			else{
				echo "Data gagal ditambahkan";
			}
			break;
		case "get_nis":
			// Menampilkan biodata berdasarkan NIS
			$nis = $_GET["NIS"];
			$query_tampil_biodata = mysql_query("SELECT *FROM sekolah WHERE NIS='$nis'");
			$data_array = array();
			$data_array = mysql_fetch_assoc($query_tampil_biodata);
				echo "Data yang ada pada NIS $nis<br>";
				echo "[".json_encode($data_array)."]";
			break;
		case "update":
			// Mengubah biodata berdasarkan id yang dimasukkan
			$nama = $_GET["Nama"];
			$kelas = $_GET["Kelas"];
			$alamat = $_GET["Alamat"];
			$hobi = $_GET["Hobi"];
			$nis = $_GET["NIS"];
			
			$query_ubah = mysql_query("UPDATE sekolah set Nama='$nama',
														  Kelas='$kelas',
														  Alamat='$alamat',
														  Hobi='$hobi' WHERE
														  NIS='$nis'");	
														  
			if($query_ubah){
				echo "Data berhasil diubah";
			}
			else{
				mysql_error();
			}
			break;
			
		case "delete":
			// Menghapus biodata berdasarkan nis yang dimasukkan
			$nis = $_GET['NIS'];
			$query_hapus = mysql_query("DELETE from sekolah WHERE NIS ='$nis'");
			
			if($query_hapus){
				echo "Data berhasil dihapus .";
			}
			else{
				mysql_error();
			}
			break;
		default:
			break;
		
	}
	?>