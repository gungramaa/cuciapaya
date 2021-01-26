 <div class="single-product-area">    			
				
	<?php 
	$sql	 ='	SELECT * from kategori';
	$query	 = mysqli_query($koneksi,$sql) or die (mysqli_error());
	$row	 = mysqli_num_rows($query);
	if($row !=0){
		while($arr=mysqli_fetch_array($query))
		{
			
			$id_k			= $arr['id_kategori'];
			$kategori		= $arr['nama_kat'];
			echo'			
			<div class="container">            
			<h2 class="section-title"><b>'.$kategori.'</b></h2>
			<div class="row">';
			
	$sql2	 ='	SELECT * from produk WHERE id_kategori="'.$id_k.'"';
	$query2	 = mysqli_query($koneksi,$sql2) or die (mysqli_error());
	$row2	 = mysqli_num_rows($query2);
	if($row !=0){
		while($arr=mysqli_fetch_array($query2))
		{
			$id_p			= $arr['id_produk'];
			$produk	    	= $arr['nama_produk'];
			$gambar	    	= $arr['gambar'];
			$harga			= format_rupiah($arr['harga']);
			echo'  
                <div class="col-md-4 col-sm-7">
                    <div class="single-shop-product">
                        <div class="product-upper">
                              <img width="300px" height="300px" src =../assets/image/'.$gambar.' >
						</div>
                        <h2><a href="">'.$produk.'</a></h2>
                        <div class="product-carousel-price">
                            <ins>'.$harga.'</ins>
                        </div>  
                        
                    <div class="product-option-shop">
					<a href="indexU.php?page=shop&form=cart&kode='.$id_p.'">
					<button type="button" class="btn btn-primary">
					<i class="fa fa-shopping-cart"></i>Add To Cart</button></a>
					
					<a href="indexU.php?page=shop&form=single&kode='.$id_p.'">
					<button type="button" class="btn btn-primary">
 					<i class="fa fa-link"></i> Buy This</button></a>
                    </div>                       
						</div>
					</div>				
		
			
';
		}
	}
			echo'</div>
</div>';
	}
	}
 echo'   
    </div>
'; 
?> 
</div>
<?php
if(isset($_GET['form']) && $_GET['form']=='cart'){
	include("cart.php");
}else if(isset($_GET['form']) && $_GET['form']=='single'){
	include("single.php");
}
?>