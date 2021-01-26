<div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Mau Beli ??</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<form method="post" enctype="multipart/form-data">
            <div class="modal-body">
      		<label>Jumlah Barang</label>
			<input type="number" placeholder="Jumlah..." name="jumlah">
            </div>
            <div class="modal-footer">
             <a href="cancel.php"><button type="button" class="btn btn-secondary" data-dismiss="modal">TIDAK</button></a>
             <input type="submit" class="btn btn-primary" name="submit" value="Iya,Beli">
            </div>
            </div>
        </div>
	</form>
<?php
if(isset($_POST['submit'])){
		$jumlah	    = $_POST['jumlah'];
		
	$sql1	='SELECT * FROM produk WHERE id_produk="'.$_GET['kode'].'" LIMIT 1';
	$qry	= mysqli_query($koneksi,$sql1) or die (mysqli_error($koneksi)); 
	$arr	= mysqli_fetch_array($qry);
			
		$idp	    = $arr['id_produk'];
		$harga		= $arr['harga'];
		$LastIDdet	= $_SESSION['order'];//IDOtomatis("order_detail");
		$mydate		= getdate(date("U"));
		$invoice	= $_SESSION['user'].'-'.$mydate['mday'].'-'.$mydate['mon'].'-'.$mydate['year'];	
	
	$sql_de	= 'insert into order_detail 
			(id_detail,id_order,id_produk,jumlah,total_harga,invoice,status) value 	
			('.$LastIDdet.','.$_SESSION['order'].',"'.$idp.'","'.$jumlah.'","'.(int)$jumlah * (int)$harga.'","'.$invoice.'","waiting")';	
	$edit2   = mysqli_query($koneksi,$sql_de) or die (mysqli_error($koneksi));
		if($edit2){
			unset($_SESSION['order']);
				echo'
				<script>
					alert("Proses Pembayaran ");
					window.location="bayar.php";
				</script>';
			}else{
				unset($_SESSION['order']);
				echo'
					<script>
						alert("Transaksi Gagal");
						window.location="indexU.php?page=shop";
					</script>';
		}		
	}
?>