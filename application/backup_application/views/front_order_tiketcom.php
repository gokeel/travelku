			<div id="content">
			<!-- KONTEN MULAI -->
				<div id="kolom1-second-faq">
					<div id="kontenkolom1">
					<!-- KOLOM 1 mulai --> 
						<div id="faqkonten">
							<p align="justify"><span class="judul46"><?php echo ($status=='200') ? 'Order Berhasil' : 'Order Gagal';?></span><br /><br /><br /></p>
							<?php
								if($status=='200' and $category=='flight'){
									echo '<p align="justify"><span class="judul18">ID Pesanan anda: '.$order_id.'</span><br /><br /><br /></p>';
									echo '<p align="justify"><span class="judul18">Rincian Harga:</span><br /></p>';
									echo '<p>Harga Tiket:</p>
											<p style="padding-left:30px">IDR '.number_format($price,0,',','.').'</p>
										  <p>Pajak:</p>
											<p style="padding-left:30px">IDR '.number_format($tax,0,',','.').'</p>
										  <p>Biaya Bagasi:</p>
											<p style="padding-left:30px">IDR '.number_format($baggage,0,',','.').'</p>
										  <p>Total Biaya:</p>
											<p style="padding-left:30px">IDR '.number_format($total_price,0,',','.').'</p>
									';
									if($discount<>''){
										echo '<p></p>';
										echo '<p>'.$discount.'</p>';
										echo '<p>Harga Setelah Diskon:</p>
											<p style="padding-left:30px">IDR '.number_format($after_discount,0,',','.').'</p>';
									}
									echo '<button id="btn" style="margin-top:30px" class="button-1">Checkout</button>';
									echo '<img id="progress" src="'.IMAGES_DIR.'/spiffygif_34x34.gif" />';
									echo '<script>$("#progress").hide();</script>';
									echo '<div id="messages"></div>';
								}
								else if($status=='200' and $category=='train'){
									echo '<p align="justify"><span class="judul18">ID Pesanan anda: '.$order_id.'</span><br /><br /><br /></p>';
									echo '<p align="justify"><span class="judul18">Rincian Harga:</span><br /></p>';
									echo '<p>Harga Tiket:</p>
											<p style="padding-left:30px">IDR '.number_format($price,0,',','.').'</p>
										  <p>Pajak:</p>
											<p style="padding-left:30px">IDR '.number_format($tax,0,',','.').'</p>
										  <p>Total Biaya:</p>
											<p style="padding-left:30px">IDR '.number_format($total_price,0,',','.').'</p>
									';
									
									echo '<button id="btn" style="margin-top:30px" class="button-1">Checkout</button>';
									echo '<img id="progress" src="'.IMAGES_DIR.'/spiffygif_34x34.gif" />';
									echo '<script>$("#progress").hide();</script>';
									echo '<div id="messages"></div>';
								}
								else if($status=='200' and $category=='hotel'){
									echo '<p align="justify"><span class="judul18">ID Pesanan anda: '.$order_id.'</span><br /><br /><br /></p>';
									echo '<p align="justify"><span class="judul18">Rincian Harga:</span><br /></p>';
									echo '<p>Harga Tiket:</p>
											<p style="padding-left:30px">IDR '.number_format($price,0,',','.').'</p>
										  <p>Pajak:</p>
											<p style="padding-left:30px">IDR '.number_format($tax,0,',','.').'</p>
										  <p>Total Biaya:</p>
											<p style="padding-left:30px">IDR '.number_format($total_price,0,',','.').'</p>';
									echo '<button id="btn-hotel" style="margin-top:30px" class="button-1">Checkout</button>';
									echo '<img id="progress" src="'.IMAGES_DIR.'/spiffygif_34x34.gif" />';
									echo '<script>$("#progress").hide();</script>';
									echo '<div id="messages"></div>';
								}
								else
									echo '<p align="justify"><span class="judul18">Pesan Kesalahan: '.$error.'</span><br /><br /><br /></p>';
							?>
							
						</div>
					</div>
				<!-- KONTEN end -->
				</div>
			</div>
<script>
<?php
	if($status=='200' and ($category=='flight' or $category=='train')){
?>
	$('#btn').click(function(event) {
		$('#progress').show();
		$('#messages').empty();
		$.ajax({
			type : "GET",
			url: '<?php echo base_url();?>index.php/order/tiketcom_checkoutlogin',
			data: '<?php echo $checkout_uri;?>',
			cache: false,
			dataType: "json",
			success:function(data){
				if(data.status!="200"){
					$("#messages").append('<p style="color:red">'+data.message+'</p>');
					$("#progress").hide();
				}
				else{
					$("#progress").hide();
					window.location.href = "<?php echo base_url();?>index.php/webfront/tiketcom_choose_payment/"+data.token+"/<?php echo $internal_order_id;?>";
				}
					
			}
		});
	});
	<?php
}
		if($category=='hotel' and $status=='200'){
	?>
	$('#btn-hotel').click(function(event) {
		$('#progress').show();
		$('#messages').empty();
		$.ajax({
			type : "post",
			url: '<?php echo base_url();?>index.php/hotel/tiketcom_checkout_all',
			data: "<?php echo 'link='.$checkout_uri.'&token='.$token.'&conEmailAddress='.$conEmailAddress.'&conFirstName='.$conFirstName.'&conLastName='.$conLastName.'&conPhone='.$conPhone.'&conSalutation='.$conSalutation.'&detailId='.$detail_id;?>",
			cache: false,
			dataType: "json",
			success:function(data){
				if(data.status!="200"){
					$("#messages").append('<p style="color:red">'+data.message+'</p>');
					$("#progress").hide();
				}
				else{
					$("#progress").hide();
					window.location.href = "<?php echo base_url();?>index.php/webfront/tiketcom_choose_payment/"+data.token+"/<?php echo $internal_order_id;?>";
				}
					
			}
		});
	});
	<?php
		}
	?>
</script>