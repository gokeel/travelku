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

<!-- YUI Library -->
	<script src="http://yui.yahooapis.com/3.17.2/build/yui/yui-min.js"></script>
	<link rel="stylesheet" href="http://yui.yahooapis.com/3.17.2/build/cssgrids/cssgrids-min.css">
	

  </head>
  <body class="yui3-skin-sam">
	<!-- 100% Width & Height container  -->
	<div class="login-fullwidith">
		
		<!-- Login Wrap  -->
		<div class="login-wrap2">
			<div class="center">
				<img src="<?php echo base_url();?>assets/uploads/option_images/<?php echo $company_logo;?>" class="search-logo" alt="logo"/><br/><br/>
				<span class="opensans size18 caps bold blue">Pemesanan <?php echo ($status=='200') ? 'Selesai' : 'Gagal';?></span><br/>
				<span class="opensans size18 grey xsmall"><?php echo $message;?></span>
				<br/><br/>
				

			</div>
			<div class="searchingbg">
				<?php
					if($status=='200'){
						echo '<ul class="leftatr">
								<li>ID Pesanan</li>
								<li>Total</li>
								<li>Langkah Pembayaran</li>
							</ul>';
									
						echo '<ul class="rightatr">
								<li>'.$order_id.'</li>
								<li>IDR '.number_format($total,0,',','.').'</li>
								<li><button id="show-steps" class="bluebtn">Tampilkan</button></li>
							</ul>';
					}
				?>
				
			</div>
			<button id="btn" class="bluebtn margtop20">Kembali ke Home</button>
			
			
		</div>
		<?php
			if($status=='200'){
				echo '<div id="payment-steps">
					<div class="yui3-widget-bd">';
				if($method=='KlikBCA'){
					echo '<ol style="list-style-type: decimal;">';
					foreach($steps as $key => $value)
						echo '<li>'.$value.'</li>';
					echo '</ol>';
				}
				else if($method=='ATM Transfer'){
					foreach($steps as $index){
						echo '<p style="font-size:14px;">'.$index['name'].'</p>';
						echo '<ol style="list-style-type: decimal;">';
						foreach($index['step'] as $key => $value){
							echo '<li>'.$value.'</li>';
						}
						echo '</ol><br /><br />';
					}
				}
				echo '</div></div>';
			}
		?>
	
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
	$('#btn').click(function(event) {
		window.location.href = "<?php echo base_url();?>";
	});
<?php
if($status=='200'){	
?>	YUI().use('panel', 'dd-plugin', function (Y) {
		var addRowBtn  = Y.one('#show-steps');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#payment-steps',
			headerContent: 'Langkah Pembayaran',
			width        : 250,
			zIndex       : 5,
			centered     : true,
			modal        : true,
			visible      : false,
			render       : true,
			plugins      : [Y.Plugin.Drag]
		});
		// When the addRowBtn is pressed, show the modal form.
		addRowBtn.on('click', function (e) {
			panel.show();
		});
	});
<?php } ?>
</script>
	
  </body>
</html>