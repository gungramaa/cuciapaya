<form enctype="multipart/form-data" method="post">
	<table align="center"> 
    		<tr>
            	<td align="center">
                	EDIT PRODUK
                 <?php
				 	if(isset($_GET['kode'])){
						$a	='SELECT * 
							FROM (((order_detail d 
							INNER JOIN `order` o ON o.id_order=d.id_order) 
							INNER JOIN produk p ON p.id_produk=d.id_produk)
							INNER JOIN `user` u ON u.no_ktp = o.no_ktp) 
							WHERE d.id_detail="'.$_GET['kode'].'" LIMIT 1';
						$b	= mysqli_query($koneksi,$a) or die (mysqli_error($koneksi)); 
						$d	= mysqli_fetch_array($b);
						
						$id_d			= $d['id_detail'];
						$id_o			= $d['id_order'];
						$id_P			= $d['id_produk'];

						$ktp			= $d['no_ktp'];
						$nama_u			= $d['nama'];

						$nama_p		    = $d['nama_produk'];
						$harga_p		= $d['harga'];
						$jumlah			= $d['jumlah'];
						$harga			= $d['total_harga'];
						$invoice		= $d['invoice'];
						$status			= $d['status'];
					}
				 ?>
                </td>
            </tr>
     </table>
	 <table align="center" class="customers">   
   			<tr>
            	<th>Id Detail</th>
                <td><input type="text" disabled="" value="<?php echo $id_d;?>"/>
                	<input type="hidden" name="idd" value="<?php echo $id_d;?>" />
                </td>
            </tr>
			<tr>
            	<th>Id Order</th>
                <td><input type="text" disabled="" value="<?php echo $id_o;?>"/>
                	<input type="hidden" name="ido" value="<?php echo $id_o;?>" />
                </td>
            </tr>
		 	<tr>
            	<th>No KTP</th>
                <td><input type="text" disabled="" value="<?php echo $ktp;?>"/>
                	<input type="hidden" name="ktp" value="<?php echo $ktp;?>" />
                </td>
            </tr>
		 	<tr>
            	<th>Nama Customer</th>
                <td><input type="text" disabled="" value="<?php echo $nama_u;?>"/>
                	<input type="hidden" name="ktp" value="<?php echo $nama_u;?>" />
                </td>
            </tr>
            <tr>
            	<th>Id Produk</th>
                <td>
				<?php
	$qsk = 'select * from produk';
	$psk = mysqli_query($koneksi,$qsk) or die (mysqli_error());
	$nsk = mysqli_num_rows($psk);
	echo '<select name="idp" class="form-control">
		 	<option>'.$id_P.'&nbsp;| &nbsp;'.$nama_p.'&nbsp;| &nbsp;'.$harga_p.'</option>
			';
			if ($nsk!=0)
			{
				while($rsk = mysqli_fetch_array($psk)){
				$pcode = $rsk['id_produk'];
				$pname = $rsk['nama_produk'];
				$phar = $rsk['harga'];
				echo'	<option value="'.$pcode.'">'.$pcode.'&nbsp;| &nbsp;'.$pname.'&nbsp;| &nbsp;'.$phar.'</option>';
				}
					echo '</select>';
			}
			?>
                	
                </td>
            </tr>
                </td>
            </tr>
            <tr>
            	<th>Jumlah</th>
                <td><input type="text" name="jumlah" value="<?php echo $jumlah;?>">
                </td>
            </tr>
			<tr>
            	<th>Invoice</th>
                <td><input type="text" disabled="" value="<?php echo $invoice;?>"/>
                	<input type="hidden" name="invoice" value="<?php echo $invoice;?>" />
                </td>
            </tr>
            <tr>
            	<th>Status</th>
                <td><select name="status">
					<option><?php echo $status ;?></option>
					<option>Waiting</option>
					<option>Processed</option>
					<option>Delivered</option>
					</select>
                </td>
            </tr> 	 	
     <table align="center" class="customers">
     		<tr>
            	<td>
                	<input type="submit" name="submit" value="Save"></td
				<td>
                    <a href="index.php?page=order"><input type="button" value="Cancel"></a>
                </td>
            </tr>
     </table>
     <?php
	 	if(isset($_POST['submit'])){
		$idd			= $_POST['idd'];
		$ido			= $_POST['ido'];
		$idP			= $_POST['idp'];
		$nktp			= $_POST['ktp'];
		$jum			= $_POST['jumlah'];
		$invoices		= $_POST['invoice'];
		$stt			= $_POST['status'];
			
		$sql = 'select harga from produk WHERE id_produk = "'.$idP.'"';
		$qry = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
		$row = mysqli_num_rows($psk); 

			if ($row!=0)
			{
				$rsk = mysqli_fetch_array($qry);
				$har = $rsk['harga'];
				
		$Tharga			= (int)$har * (int)$jum;
			}
			
			$sql	= 'UPDATE order_detail SET id_produk="'.$idP.'",jumlah="'.$jum.'",
			total_harga="'.$Tharga.'",invoice="'.$invoice.'",status="'.$stt.'" WHERE id_detail="'.$idd.'"';
			
			$query   = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
			if($query){
				echo'
				<script>
					alert("You Edited Successfuly");
					window.location="index.php?page=order";
				</script>';
			}
		
		}
	 ?>
     </table>
</form>