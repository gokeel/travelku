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
			<a class="homebtn left" href="<?php echo base_url();?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Tiket</a></li>
					<li>/</li>
					<li><a href="#">Metode Pembayaran</a></li>
				</ul>				
			</div>
			<a class="backbtn right" href="javascript:history.back()"></a>
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
					$("#result").append('<p style="color:red">Pesan Kesalahan: '+data.message+'</p>');
					$("#progress").hide();
				}
				else{
					var header = '<span class="size16px bold dark left">Detil Harga Untuk Pembayaran</span>\
						<div class="roundstep right">1</div>\
						<div class="clearfix"></div><br/>\
						<div class="line4"></div>';
					var nav = '<ul class="nav navigation-tabs">';
					var nav_index = 0;
					var nav_konten_index = 0;
					var nav_konten = '<div class="tab-content4">';
					
					// add input for deposit
					nav += '<li class="active"><a href="#method-deposit" data-toggle="tab">Detil</a></li>';
					nav_konten += '<div class="tab-pane active" id="method-deposit">';
					nav_konten += '<div class="col-md-5 textleft">\
										<div class="margtop15"><span class="dark">ID Pesanan</span></div>\
									</div>\
									<div class="col-md-4">\
										<div class="margtop15"><span class="dark">: '+data.order_id+'</span></div>\
									</div>\
									<div class="col-md-3 textleft"></div>\
									<div class="clearfix"></div><br/>\
									<div class="col-md-5 textleft">\
										<div class="margtop15"><span class="dark">Harga Tiket + Biaya Pelayanan</span></div>\
									</div>\
									<div class="col-md-4">\
										<div class="margtop15"><span class="dark">: IDR '+currency_separator(data.grand_total, '.')+'</span></div>\
									</div>\
									<div class="col-md-3 textleft"></div>\
									<div class="clearfix"></div><br/>';
					nav_konten += '<form method="post" action="<?php echo base_url();?>index.php/order/tiketcom_checkout_payment">\
										<input type="hidden" name="method" value="Deposit">\
										<input type="hidden" name="token" value="<?php echo $this->uri->segment(3);?>">\
										<input type="hidden" name="link" value="<?php echo $this->config->item('api_server');?>/checkout/checkout_payment/8">\
										<div class="alert alert-info">\
											Petunjuk cara pembayaran:<br/>\
											<p class="size12">• Segera lakukan pembayaran dalam 180 menit setelah menekan tombol di bawah ini.</p>\
											<p class="size12">• Segera lakukan konfirmasi ulang melalui halaman konfirmasi pembayaran tiket.</p>\
											<p class="size12">• Info pemesanan dan cara pembayaran akan dikirimkan ke email anda.</p>\
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
