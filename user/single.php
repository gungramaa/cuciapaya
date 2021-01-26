<?php 
if(isset($_GET['kode'])){
	
	$LastIDorder 	= IDOtomatis("order");
	$mydate			= getdate(date("U"));
	$curent 		= $mydate['mday'].'-'.$mydate['mon'].'-'.$mydate['year'];
	$sql_or	= 'insert into `order`(id_order,no_ktp,tgl_pesan) value ("'.$LastIDorder.'","'.$_SESSION['user'].'","'.$curent.'")';
	$ins   	= mysqli_query($koneksi,$sql_or) or die (mysqli_error($koneksi));
		
	if($ins){
		session_start();
		$_SESSION['order'] = $LastIDorder;
			echo'
				<script>
					alert("Mohon Tunggu Sebentar");
					window.location="single2.php";
				</script>';
	}
}
?>