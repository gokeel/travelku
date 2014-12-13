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
	<title>Metode Pembayaran Tiket</title>
	
    <!-- Bootstrap -->
    <link href="<?php echo BLUE_THEME_DIR;?>/dist/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo BLUE_THEME_DIR;?>/assets/css/custom.css" rel="stylesheet" media="screen">


	<link href="<?php echo BLUE_THEME_DIR;?>/examples/carousel/carousel.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/html5shiv.js"></script>
      <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/respond.min.js"></script>
    <![endif]-->
	
    <!-- Fonts -->	
	<link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>	
	<!-- Font-Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo BLUE_THEME_DIR;?>/assets/css/font-awesome.css" media="screen" />
    <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="assets/css/font-awesome-ie7.css" media="screen" /><![endif]-->
	
	<!-- Animo css-->
	<link href="<?php echo BLUE_THEME_DIR;?>/plugins/animo/animate+animo.css" rel="stylesheet" media="screen">

    <!-- Picker -->	
	<link rel="stylesheet" href="<?php echo BLUE_THEME_DIR;?>/assets/css/jquery-ui.css" />	
	
    <!-- jQuery -->		
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.v2.0.3.js"></script>	

	<!-- tambahan -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
	<script src="<?php echo GENERAL_JS_DIR;?>/functions.js"></script>
	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/<?php echo $favicon_frontend_logo;?>">
	<!-- end of tambahan -->
  </head>
  <body id="top" class="thebg" >
    
	<div class="navbar-wrapper2 navbar-fixed-top">
      <div class="container">
		<div class="navbar mtnav">

			<div class="container offset-3">
			  <!-- Navigation-->
			  <?php include_once('navigation.php');?>
			  <!-- /Navigation-->			  
			</div>
		
        </div>
      </div>
    </div>
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Tiket</a></li>
					<li>/</li>
					<li><a href="#">Metode Pembayaran</a></li>
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div><br/>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt25 offset-0">
			
			
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey" id="result">
					
			
				</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<?php include_once('box_call_support.php');?>
				<br/>
				
				<div class="pagecontainer2 loginbox">
					<div class="cpadding1">
						<span class="icon-lockk"></span>
						<h3 class="opensans">Log in</h3>
						<input type="text" class="form-control logpadding" placeholder="Username">
						<br/>
						<input type="text" class="form-control logpadding" placeholder="Password">
						<div class="margtop20">
							<div class="left">
								<div class="checkbox padding0">
									<label>
									  <input type="checkbox">Remember
									</label>
								</div>
								<a href="#" class="greylink">Lost password?</a><br/>
							</div>
							<div class="right">
								<button class="btn-search5" type="submit" onclick="errorMessage()">Login</button>	
							</div>
						</div>
						<div class="clearfix"></div><br/><br/>
					</div>
				</div><br/>
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
	

	
	
	<!-- FOOTER -->
	
	<?php include_once('footer.php')?>
	
	<!-- Javascript  -->
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/js-payment.js"></script>
	
    <!-- Nicescroll  -->	
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.nicescroll.min.js"></script>
	
    <!-- Custom functions -->
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/functions.js"></script>
	
    <!-- Custom Select -->
	<script type='text/javascript' src='<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.customSelect.js'></script>
	
	<!-- Load Animo -->
	<script src="<?php echo BLUE_THEME_DIR;?>/plugins/animo/animo.js"></script>

    <!-- Picker -->	
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery-ui.js"></script>	

    <!-- Picker -->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.easing.js"></script>	
	
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BLUE_THEME_DIR;?>/dist/js/bootstrap.min.js"></script>
	
<script>
	var new_token = '';
	var order_id = '';
	var price = '';
	var msg = '';
	$( window ).load(function() {
		load_available_payments();
	});
	function load_available_payments(){
		$("#progress").show();
		$("#result").empty();
		
		$.ajax({
			type : "GET",
			url: '<?php echo base_url();?>index.php/order/tiketcom_get_available_payment?token=<?php echo $this->uri->segment(3);?>&id=<?php echo $this->uri->segment(4);?>',
			cache: false,
			dataType: "json",
			success:function(data){
				if(data.status!="200"){
					$("#messages").append('<p style="color:red">Pesan Kesalahan: '+data.message+'</p>');
					$("#progress").hide();
				}
				else{
					var header = '<span class="size16px bold dark left">Pilih metode pembayaran anda</span>\
						<div class="roundstep right">1</div>\
						<div class="clearfix"></div><br/>\
						<div class="line4"></div>';
					var nav = '<ul class="nav navigation-tabs">';
					var nav_index = 0;
					var nav_konten_index = 0;
					var nav_konten = '<div class="tab-content4">';
					for(var i=0;i<data.list.length;i++){
						if(data.list[i].text=="KlikBCA"){
							nav_index += 1;
							nav_konten_index += 1;
							if(nav_index==1){
								nav += '<li class="active"><a href="#method'+i+'" data-toggle="tab">'+data.list[i].text+'</a></li>';
								nav_konten += '<div class="tab-pane active" id="method'+i+'">';
							}
							else{
								nav += '<li><a href="#method'+i+'" data-toggle="tab">'+data.list[i].text+'</a></li>';
								nav_konten += '<div class="tab-pane" id="method'+i+'">';
							}
							
							discount = parseInt(data.price_no_discount) - parseInt(data.price_with_discount);
							
							nav_konten += '<div class="col-md-4 textright">\
												<div class="margtop15"><span class="dark">ID Pesanan:</span></div>\
											</div>\
											<div class="col-md-4">\
												<div class="margtop15"><span class="dark">'+data.order_id+'</span></div>\
											</div>\
											<div class="col-md-4 textleft"></div>\
											<div class="clearfix"></div><br/>';
								
							nav_konten += '<div class="col-md-4 textright">\
												<div class="margtop15"><span class="dark">Harga + Pajak:</span></div>\
											</div>\
											<div class="col-md-4">\
												<div class="margtop15"><span class="dark">IDR '+currency_separator(data.price_no_discount, '.')+'</span></div>\
											</div>\
											<div class="col-md-4 textleft"></div>\
											<div class="clearfix"></div><br/>';
							
							nav_konten += '<div class="col-md-4 textright">\
												<div class="margtop15"><span class="dark">Diskon Pembayaran:</span></div>\
											</div>\
											<div class="col-md-4">\
												<div class="margtop15"><span class="dark">IDR '+currency_separator(discount, '.')+'</span></div>\
											</div>\
											<div class="col-md-4 textleft"></div>\
											<div class="clearfix"></div><br/>';
							
							nav_konten += '<div class="col-md-4 textright">\
												<div class="margtop15"><span class="dark">Total:</span></div>\
											</div>\
											<div class="col-md-4">\
												<div class="margtop15"><span class="dark">IDR '+currency_separator(data.price_with_discount, '.')+'</span></div>\
											</div>\
											<div class="col-md-4 textleft"></div>\
											<div class="clearfix"></div><br/>';
														
							nav_konten += '<div class="col-md-4 textright">\
												<div class="margtop15"><span class="dark">Catatan:</span></div>\
											</div>\
											<div class="col-md-8">\
												<div class="margtop15"><span class="dark">'+(data.list[i].message=="" ? "-" : data.list[i].message)+'</span></div>\
											</div>\
											<div class="clearfix"></div><br/>';
							
							/*if(data.list[i].text=="CIMB Clicks" || data.list[i].text=="ePay BRI" || data.list[i].text=="BCA KlikPay" || data.list[i].text=="Kartu Kredit" || data.list[i].text=="Credit Card"){
								nav_konten += '<form method="post" action="'+data.list[i].link+'&checkouttoken='+data.token+'">\
												<div class="alert alert-info">\
													Petunjuk cara pembayaran:<br/>\
													<p class="size12">• Anda akan diarahkan ke halaman lain untuk meminta detil akun.</p>\
												</div>\
												<button type="submit" class="bluebtn margtop20">Complete booking</button>\
												</form>\
												</div>';
							}
							
							else */if(data.list[i].text=="KlikBCA"){
								nav_konten += '<form method="post" action="<?php echo base_url();?>index.php/order/tiketcom_checkout_payment">\
												<input type="hidden" name="method" value="'+data.list[i].text+'">\
												<input type="hidden" name="token" value="'+data.token+'">\
												<input type="hidden" name="link" value="'+data.list[i].link+'">\
												<div class="col-md-4 textright">\
													<div class="margtop15"><span class="dark">User ID KlikBCA<span class="red">*</span>:</span></div>\
												</div>\
												<div class="col-md-4">\
													<input type="text" name="user_bca" class="form-control margtop10" placeholder="">\
												</div>\
												<div class="col-md-4 textleft"></div>\
												<div class="clearfix"></div><br/>\
												<div class="alert alert-info">\
													Petunjuk cara pembayaran:<br/>\
													<p class="size12">• Jika setelah transaksi anda mendapatkan pesan kesalahan seperti "Transaction Failed" atau "Transaksi Gagal", mohon untuk menghubungi Call Center kami melalui email atau telepon yang tertera di website ini. Pesan ini memungkinkan dana anda telah tertarik dan transaksi berhasil namun pesan tidak sesuai. Mohon cek email anda untuk melihat booking voucher, jika setelah 15 menit anda belum menerima, mohon untuk menghubungi Call Center kami.</p>\
													<p class="size12">• User ID KlikBCA yang dimasukkan adalah User ID KlikBCA yang telah aktif.</p>\
													<p class="size12">• Mohon untuk melakukan pembayaran hanya melalui KlikBCA dengan User ID yang sama saat memasukkan User ID.</p>\
													<p class="size12">• Pembayaran harus dilakukan dalam waktu 60 menit setelah booking. Transaksi akan dibatalkan jika pembayaran tidak dilakukan dalam periode waktu yang telah ditentukan.</p>\
													<p class="size12">• Setelah melakukan pembayaran, anda akan menerima e-mail dalam waktu 5 menit berisi informasi kode booking dan detil.</p>\
												</div>\
												<button type="submit" class="bluebtn margtop20">Complete booking</button>\
												</form>\
												</div>';
							}
							
							/*else if(data.list[i].text=="ATM Transfer"){
								nav_konten += '<form method="post" action="<?php echo base_url();?>index.php/order/tiketcom_checkout_payment">\
												<input type="hidden" name="method" value="'+data.list[i].text+'">\
												<input type="hidden" name="token" value="'+data.token+'">\
												<input type="hidden" name="link" value="'+data.list[i].link+'">\
												<div class="alert alert-info">\
													Petunjuk cara pembayaran:<br/>\
													<p class="size12">• Hanya melalui jaringan ATM Bersama atau ATM Prima yang dapat diproses dalam metode pembayaran ini. Untuk Internet Banking/Mobile Banking/melalui Teller/non ATM, mohon menggunakan metode pembayaran yang lain dan tersedia.</p>\
													<p class="size12">• Setiap transaksi akan dikenakan charge sesuai regulasi oleh ATM Bersama/ATM Prima/Alto.</p>\
													<p class="size12">• Untuk pengguna ATM Mandiri, minimum transaksi adalah IDR 50.000.</p>\
													<p class="size12">• Pembayaran harus dilakukan dalam waktu 60 menit setelah booking. Transaksi akan dibatalkan jika pembayaran tidak dilakukan dalam periode waktu yang telah ditentukan.</p>\
													<p class="size12">• Setelah melakukan pembayaran, anda akan menerima e-mail dalam waktu 5 menit berisi informasi kode booking dan detil.</p>\
												</div>\
												<button type="submit" class="bluebtn margtop20">Complete booking</button>\
												</form>\
												</div>';
							}
							else if(data.list[i].text=="Mandiri Clickpay"){
								nav_konten += '<form method="post" action="<?php echo base_url();?>index.php/order/tiketcom_checkout_payment">\
												<input type="hidden" name="method" value="'+data.list[i].text+'">\
												<input type="hidden" name="token" value="'+data.token+'">\
												<input type="hidden" name="link" value="'+data.list[i].link+'">\
												<div class="col-md-4 textright">\
													<div class="margtop15"><span class="dark">No Kartu Debit<span class="red">*</span>:</span></div>\
												</div>\
												<div class="col-md-4">\
													<input type="text" name="card_no" class="form-control margtop10" placeholder="">\
												</div>\
												<div class="col-md-4 textleft"></div>\
												<div class="clearfix"></div><br/>\
												<div class="col-md-4 textright">\
													<div class="margtop15"><span class="dark">APPLI:<span class="red">*</span>:</span></div>\
												</div>\
												<div class="col-md-4">\
													<div class="margtop15"><span class="dark">3</span></div>\
												</div>\
												<div class="col-md-4 textleft"></div>\
												<div class="clearfix"></div><br/>\
												<div class="col-md-4 textright">\
													<div class="margtop15"><span class="dark">Input 1:<span class="red">*</span>:</span></div>\
												</div>\
												<div class="col-md-4">\
													<div class="margtop15"><span class="dark">10 digit terakhir nomor kartu</span></div>\
												</div>\
												<div class="col-md-4 textleft"></div>\
												<div class="clearfix"></div><br/>\
												<div class="col-md-4 textright">\
													<div class="margtop15"><span class="dark">Input 2:<span class="red">*</span>:</span></div>\
												</div>\
												<div class="col-md-4">\
													<div class="margtop15"><span class="dark">'+data.price_with_discount+'</span></div>\
												</div>\
												<div class="col-md-4 textleft"></div>\
												<div class="clearfix"></div><br/>\
												<div class="col-md-4 textright">\
													<div class="margtop15"><span class="dark">Input 3:<span class="red">*</span>:</span></div>\
												</div>\
												<div class="col-md-4">\
													<div class="margtop15"><span class="dark">'+data.order_id+'</span></div>\
												</div>\
												<div class="col-md-4 textleft"></div>\
												<div class="clearfix"></div><br/>\
												<div class="col-md-4 textright">\
													<div class="margtop15"><span class="dark">Respon Token Mandiri:<span class="red">*</span>:</span></div>\
												</div>\
												<div class="col-md-4">\
													<input type="text" name="token_response" class="form-control margtop10" placeholder="">\
												</div>\
												<div class="col-md-4 textleft"></div>\
												<div class="clearfix"></div><br/>\
												<div class="alert alert-info">\
													Petunjuk cara pembayaran:<br/>\
													<p class="size12">• Aktifkan Token Mandiri anda dan masukkan password.</p>\
													<p class="size12">• Tekan 3 saat muncul "APPLI".</p>\
													<p class="size12">• Masukkan 10 digit terakhir kartu debit anda.</p>\
													<p class="size12">• Masukkan nilai total transaksi anda yaitu '+data.price_with_discount+' .</p>\
													<p class="size12">• Masukkan ID transaksi anda yaitu '+data.order_id+' .</p>\
													<p class="size12">• Setelah mendapat respon dari token mandiri, masukkan ke dalam input di atas ini.</p>\
												</div>\
												<button type="submit" class="bluebtn margtop20">Complete booking</button>\
												</form>\
											</div>';
							}*/
						}
						
					}
					// add input for deposit
					nav += '<li><a href="#method-deposit" data-toggle="tab">Deposit</a></li>';
					nav_konten += '<div class="tab-pane" id="method-deposit">';
					nav_konten += '<div class="col-md-4 textright">\
												<div class="margtop15"><span class="dark">ID Pesanan:</span></div>\
											</div>\
											<div class="col-md-4">\
												<div class="margtop15"><span class="dark">'+data.order_id+'</span></div>\
											</div>\
											<div class="col-md-4 textleft"></div>\
											<div class="clearfix"></div><br/>\
											<div class="col-md-4 textright">\
												<div class="margtop15"><span class="dark">Harga + Pajak:</span></div>\
											</div>\
											<div class="col-md-4">\
												<div class="margtop15"><span class="dark">IDR '+currency_separator(data.price_no_discount, '.')+'</span></div>\
											</div>\
											<div class="col-md-4 textleft"></div>\
											<div class="clearfix"></div><br/>';
					nav_konten += '<form method="post" action="<?php echo base_url();?>index.php/order/tiketcom_checkout_payment">\
										<input type="hidden" name="method" value="Deposit">\
										<input type="hidden" name="token" value="<?php echo $this->uri->segment(3);?>">\
										<input type="hidden" name="link" value="http://api.sandbox.tiket.com/checkout/checkout_payment/8">\
										<div class="alert alert-info">\
											Petunjuk cara pembayaran:<br/>\
											<p class="size12">• Segera lakukan pembayaran dalam 180 menit.</p>\
											<p class="size12">• Segera lakukan konfirmasi ulang melalui halaman konfirmasi pembayaran yang akan ditampilkan setelah menekan tombol di bawah ini.</p>\
										</div>\
										<button type="submit" class="bluebtn margtop20">Complete booking</button>\
										</form>\
									</div>';
					
					$('#result').append(header+nav+'</ul><br/>'+nav_konten+'</div>');
				}
					
			}
		});
		
	}
</script>

  </body>
</html>
