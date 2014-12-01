<?php
	define('BLUE_THEME_DIR', base_url('assets/themes/blue/'));
	define('GENERAL_CSS_DIR', base_url('assets/css'));
	define('GENERAL_JS_DIR', base_url('assets/js'));
?>
<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Issued Page</title>
	
	<!-- Bootstrap -->
	<link href="<?php echo BLUE_THEME_DIR;?>/dist/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="<?php echo BLUE_THEME_DIR;?>/assets/css/custom.css" rel="stylesheet" media="screen">

    <!-- Updates -->
    <link href="<?php echo BLUE_THEME_DIR;?>/updates/update1/css/style01.css" rel="stylesheet" media="screen">	
	
	<!-- Animo css-->
	<link href="<?php echo BLUE_THEME_DIR;?>/plugins/animo/animate+animo.css" rel="stylesheet" media="screen">
	
	<link href="<?php echo BLUE_THEME_DIR;?>/examples/carousel/carousel.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="assets/js/html5shiv.js"></script>
	  <script src="assets/js/respond.min.js"></script>
	<![endif]-->
	
	<!-- Fonts -->	
	<link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>	
	<!-- Font-Awesome -->
	<link rel="stylesheet" type="text/css" href="<?php echo BLUE_THEME_DIR;?>/assets/css/font-awesome.css" media="screen" />
	<!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="assets/css/font-awesome-ie7.css" media="screen" /><![endif]-->
	
	<!-- Load jQuery -->
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.v2.0.3.js"></script>

	<!-- tambahan -->
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/<?php echo $favicon_frontend_logo;?>">
	<!-- end of tambahan -->
	

  </head>
  <body>
	<!-- 100% Width & Height container  -->
	<div class="login-fullwidith">
		
		<!-- Login Wrap  -->
		<div class="login-wrap2">
			<div class="center">
				<img src="<?php echo base_url();?>assets/uploads/option_images/<?php echo $company_logo;?>" class="search-logo" alt="logo"/><br/><br/>
				<span class="opensans size18 caps bold blue"><?php echo ($status=='200') ? 'Order Berhasil' : 'Order Gagal';?></span><br/>
				<span class="opensans size18 grey xsmall"><?php echo $error;?></span>
				<br/><br/>
				

			</div>
			<div class="searchingbg">
				<?php
					if($status=='200' and $category=='flight'){
						echo '<ul class="leftatr">
								<li>ID Pesanan</li>
								<li>Harga Tiket</li>
								<li>Pajak</li>
								<li>Bagasi</li>
								<li>Total</li>';
						if($discount<>''){
							echo '<li>Diskon</li>';
							echo '<li>Setelah Diskon</li>';
						}
						echo '</ul>';
									
						echo '<ul class="rightatr">
								<li>'.$order_id.'</li>
								<li>IDR '.number_format($price,0,',','.').'</li>
								<li>IDR '.number_format($tax,0,',','.').'</li>
								<li>IDR '.number_format($baggage,0,',','.').'</li>
								<li>IDR '.number_format($total_price,0,',','.').'</li>
								';
						if($discount<>''){
							echo '<li>IDR '.number_format($discount,0,',','.').'</li>';
							echo '<li>IDR '.number_format($after_discount,0,',','.').'</li>';
						}
						echo '</ul>';
									
						echo '<button id="btn" class="bluebtn margtop20">Lanjut ke Pembayaran</button>';
						echo '<div id="messages"></div>';
					}
					else if($status=='200' and $category=='train'){
						echo '<ul class="leftatr">
								<li>ID Pesanan</li>
								<li>Harga Tiket</li>
								<li>Pajak</li>
								<li>Total</li>
							</ul>';
									
						echo '<ul class="rightatr">
								<li>'.$order_id.'</li>
								<li>IDR '.number_format($price,0,',','.').'</li>
								<li>IDR '.number_format($tax,0,',','.').'</li>
								<li>IDR '.number_format($total_price,0,',','.').'</li>
							</ul>';
									
						echo '<button id="btn" class="bluebtn margtop20">Lanjut ke Pembayaran</button>';
						echo '<div id="messages"></div>';
					}
					else if($status=='200' and $category=='hotel'){
						echo '<ul class="leftatr">
								<li>ID Pesanan</li>
								<li>Harga Tiket</li>
								<li>Pajak</li>
								<li>Total</li>
							</ul>';
									
						echo '<ul class="rightatr">
								<li>'.$order_id.'</li>
								<li>IDR '.number_format($price,0,',','.').'</li>
								<li>IDR '.number_format($tax,0,',','.').'</li>
								<li>IDR '.number_format($total_price,0,',','.').'</li>
							</ul>';
									
						echo '<button id="btn-hotel" class="bluebtn margtop20">Lanjut ke Pembayaran</button>';
						echo '<div id="messages"></div>';
					}
				?>
			</div>
		</div>
		<!-- End of Login Wrap  -->
	
	</div>	
	<!-- End of Container  -->

	<!-- Javascript  -->
	<script src="<?php echo BLUE_THEME_DIR;?>/updates/update1/js/initialize-wearesearching.js"></script>
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.easing.js"></script>
	<!-- Load Animo -->
	<script src="<?php echo BLUE_THEME_DIR;?>/plugins/animo/animo.js"></script>
	<script>
	function errorMessage(){
		$('.login-wrap').animo( { animation: 'tada' } );
	}
	</script>
	
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo BLUE_THEME_DIR;?>/dist/js/bootstrap.min.js"></script>
	
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
					window.location.href = "<?php echo base_url();?>index.php/webfront/show_payment_methods/"+data.token+"/<?php echo $internal_order_id;?>";
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
					window.location.href = "<?php echo base_url();?>index.php/webfront/show_payment_methods/"+data.token+"/<?php echo $internal_order_id;?>";
				}
					
			}
		});
	});
	<?php
		}
	?>
</script>
	
  </body>
</html>