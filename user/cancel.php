<?php
session_start();
if (!isset($_SESSION['user']) && $_SESSION['role']!='user'){
	header("location:login.php");}
	else {
		include("../koneksi.php");
		include("../function.php");
	}
		$LastID		= Lastid("order");
		$q			='DELETE FROM order WHERE id_order="'.$LastID.'"';
		$n			= mysqli_query($koneksi,$q) or die (mysqli_error($koneksi));
				if($n){
					echo'
					<script>
						alert("Kembali Ke halaman Shop");
						window.location="indexU.php?page=shop";
					</script>';
				}
		 ?>