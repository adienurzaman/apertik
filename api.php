<?php 

# Read Data From GET Request

include "config/koneksi.php";
$act = $_GET['request'];


if($act == 'send_data'){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$jenis_pengunjung = $_POST['jenis_pengunjung'];
		$cek = " INSERT INTO tbl_antrean (jenis_pengunjung) VALUES ('$jenis_pengunjung') ";
		$query = mysqli_query($konek, $cek);

		if($query){
			$response['success'] = '1';
			$response['pesan'] = '200';
			echo json_encode($response);
		}else{
			$response['success'] = '0';
			$response['pesan'] = '400';
			echo json_encode($response);	
		}
	}else{
		$response['success'] = '0';
		$response['pesan'] = '502';
		echo json_encode($response);
	}
}

if($act == 'save_button'){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$nilai = $_POST['nilai'];
		$ket = $_POST['ket'];

		$cek_data = mysqli_query($konek,"SELECT * FROM ref_button ORDER BY id_button DESC");

	    if(mysqli_num_rows($cek_data) == 0){
	      $input="INSERT INTO ref_button (nilai,ket) VALUES ('$nilai','$ket');";
	    }else{
	      $input="UPDATE ref_button SET nilai = '$nilai', ket = '$ket' WHERE id_button = 1;";
	    }

		if(mysqli_query($konek,$input)){
			$response['success'] = '1';
			$response['pesan'] = '200';
			echo json_encode($response);
		}else{
			$response['success'] = '0';
			$response['pesan'] = '400';
			echo json_encode($response);
		}
	}else{
		$response['success'] = '0';
		$response['pesan'] = '502';
		echo json_encode($response);
	}
}

if($act == 'read_button'){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$cek = "SELECT * FROM ref_button";
		$query = mysqli_query($konek, $cek);

		if($query){
			$row = mysqli_fetch_assoc($query);

			$response['nilai'] = $row['nilai'];
			$response['success'] = '1';
			$response['pesan'] = '200';
			echo json_encode($response);
		}else{
			$response['success'] = '0';
			$response['pesan'] = '400';
			echo json_encode($response);
		}
	}
}

 ?>