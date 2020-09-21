<?php 

# Read Data From GET Request

session_start();
include "config/koneksi.php";
include "auth/timeout.php";

if($_SESSION['login']==1){
  if(!cek_login()){
    $_SESSION['login'] = 0;
  }
}
if($_SESSION['login']==0){
  header('location:auth/logout.php');
}
else{
  	if (empty($_SESSION['username']) AND $_SESSION['login']==0){
    	echo "<link href='style.css' rel='stylesheet' type='text/css'>
  		<center>Untuk mengakses modul, Anda harus login <br>";
    	echo "<a href=index.php><b>LOGIN</b></a></center>";
  	}
	else{

		$act = $_GET['request'];

		if($act == 'cek_username'){
			$username = $_POST['username'];
			$cek = "SELECT * FROM tbl_user WHERE username = '$username' ";
			$query = mysqli_query($konek, $cek);
			$hasil_cek = mysqli_num_rows($query);

			if($query){
				if($hasil_cek>0){
					echo "1";
				}else{
					echo "0";	
				}
			}else{
				echo "0";		
			}
		}

		if($act == 'cek_nilai_button'){
			$cek = "SELECT * FROM ref_button WHERE nilai = '0' ";
			$query = mysqli_query($konek, $cek);
			$hasil_cek = mysqli_num_rows($query);
			$row = mysqli_fetch_assoc($query);

			if($query){
				if($hasil_cek>0){
					$response['nilai'] = $row['nilai'];
					$response['success'] = '1';
					$response['pesan'] = '200';
					echo json_encode($response);
				}else{
					$response['success'] = '0';
					$response['pesan'] = '404';
					echo json_encode($response);
				}
			}else{
				$response['success'] = '0';
				$response['pesan'] = '502';
				echo json_encode($response);		
			}
		}

		if($act == 'get_data_terakhir'){
		    $cek2 = "SELECT tanggal FROM tbl_pendapatan ORDER BY tanggal DESC LIMIT 1 ";
			$query2 = mysqli_query($konek, $cek2);
			$hasil_cek2 = mysqli_num_rows($query2);
			$row2 = mysqli_fetch_assoc($query2);
			
			$tanggal_terakhir = $row2['tanggal'];
			
			$cek = "SELECT SUM(jumlah_D) as jumlah_D, SUM(jumlah_A) as jumlah_A FROM tbl_pendapatan WHERE tanggal = '$tanggal_terakhir' ";
			$query = mysqli_query($konek, $cek);
			$hasil_cek = mysqli_num_rows($query);
			$row = mysqli_fetch_assoc($query);

			if($query){
				if($hasil_cek>0 && $hasil_cek2>0){
					$respon = "1/".$row['jumlah_D']."/".$row['jumlah_A']."/".$row2['tanggal'];
					echo $respon;
				}else{
					echo "0/0/0/0";	
				}
			}else{
				echo "0";		
			}
		}

		if($act == 'save_button'){
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
		}

		if($act == 'get_data_antrean'){
			$cek_data = mysqli_query($konek,"SELECT * FROM tbl_antrean");

		    if(mysqli_num_rows($cek_data) == 0){
		      	$response['success'] = '0';
				$response['pesan'] = '400';
				echo json_encode($response);
		    }else{
		      	$jmlD="SELECT * FROM tbl_antrean WHERE jenis_pengunjung = 'Dewasa' ;";
		      	$jmlA="SELECT * FROM tbl_antrean WHERE jenis_pengunjung = 'Anak' ;";
		      	$sql_harga="SELECT * FROM tbl_setting_aplikasi LEFT JOIN tbl_harga ON tbl_harga.id_harga = tbl_setting_aplikasi.set_harga ORDER BY tbl_setting_aplikasi.id_setting DESC ;";
		    }
		    $query1 = mysqli_query($konek,$jmlD);
		    $query2 = mysqli_query($konek,$jmlA);
		    $query3 = mysqli_query($konek,$sql_harga);
			if($query1 && $query2 && $query3){

				$jml_Dewasa = mysqli_num_rows($query1);
				$jml_Anak = mysqli_num_rows($query2);
				$row = mysqli_fetch_assoc($query3);

				$response['jml_dewasa'] = $jml_Dewasa;
				$response['jml_anak'] = $jml_Anak;

				$response['harga_D'] = $row['harga_D'];
				$response['harga_A'] = $row['harga_A'];

				$response['success'] = '1';
				$response['pesan'] = '200';
				echo json_encode($response);
			}else{
				$response['success'] = '0';
				$response['pesan'] = '400';
				echo json_encode($response);
			}
		}

		if($act == 'save_pendapatan'){
			$harga_D = $_POST['jml_D'];
			$harga_A = $_POST['jml_A'];

			$jml_D = $_POST['jumlah_D'];
			$jml_A = $_POST['jumlah_A'];
			$total_bayar = $_POST['total_bayar'];
			$tgl = $_POST['tanggal'];

			$input="INSERT INTO tbl_pendapatan (tanggal,jumlah_D,jumlah_A,sub_total_d,sub_total_a,total_bayar) VALUES ('$tgl','$jml_D','$jml_A','$harga_D','$harga_A','$total_bayar');";
			if(mysqli_query($konek,$input)){
				$sql_hapus_antrean = "TRUNCATE tbl_antrean";
				if(mysqli_query($konek,$sql_hapus_antrean)){
					$response['success'] = '1';
					$response['pesan'] = 'Data resi berhasil disimpan';
					echo json_encode($response);
				}
			}

		}

	}
}

?>