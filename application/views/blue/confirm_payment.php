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
	<title>Konfirmasi Pembayaran ATM Transfer</title>
	
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
					<li><a href="#">Tiket/Paket</a></li>
					<li>/</li>
					<li><a href="#">Konfirmasi Pembayaran</a></li>
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt25 offset-0">
			
			
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					<span class="size16px bold dark left">Formulir Data Pengirim</span>
					<div class="roundstep active right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					<?php
						if ($this->uri->segment(3)=="success")
							echo '<p>** Terima kasih, masukan anda telah kami terima. Kami akan segera segera memproses pesanan anda.</p><br/><br/>';
						else if ($this->uri->segment(3)=="failed")
							echo '<p style="color:red">** Anda sudah pernah melakukan konfirmasi atas Order ID = '. $this->uri->segment(4).'. Status pembayaran anda saat ini adalah "'.$this->uri->segment(5).'"</p><br/><br/>';
					?>
					Mohon untuk mengisi semua input berikut ini: <br/><br/>
					<form action="<?php echo base_url();?>index.php/order/confirm_payment_order" method="post" id="ContactForm">
						<div class="col-md-4 textright">
							<div class="margtop15"><span class="dark">Order ID:</span><span class="red">*</span></div>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control " placeholder="" name="order_id" id="order_id">
						</div>
						<div class="col-md-4 textleft margtop15">
						</div>
						<div class="clearfix"></div>
						<br/>
						
						<div class="col-md-4 textright">
							<div class="margtop15"><span class="dark">Tanggal Transfer:</span><span class="red">*</span></div>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control " placeholder="yyyy-mm-dd" name="tgl-transfer" id="tgl-transfer">
						</div>
						<div class="col-md-4 textleft margtop15">
						</div>
						<div class="clearfix"></div>
						<br/>
						
						<div class="col-md-4 textright">
							<div class="margtop7"><span class="dark">Bank Tujuan:</span><span class="red">*</span></div>
						</div>
						<div class="col-md-4">	
							<select class="form-control mySelectBoxClass" name="bank_tujuan" id="bank-tujuan">
							</select>
						</div>
						<div class="col-md-4 textleft margtop15">
						</div>
						<div class="clearfix"></div>
						<br/>
						
						<div class="col-md-4 textright">
							<div class="margtop15"><span class="dark">Jumlah Dana:</span><span class="red">*</span></div>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control " placeholder="" name="total" id="total">
						</div>
						<div class="col-md-4 textleft margtop15">
						</div>
						<div class="clearfix"></div>
						<br/>
						
						<div class="col-md-4 textright">
							<div class="margtop7"><span class="dark">Nama Pemilik Rekening:</span><span class="red">*</span></div>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="" name="sender" id="sender">
						</div>
						<div class="col-md-4 textleft">
						</div>
						<div class="clearfix"></div>
						<br/>
						
						<div class="col-md-4 textright">
							<div class="margtop7"><span class="dark">Catatan Tambahan:</span><span class="red">*</span></div>
						</div>
						<div class="col-md-4">
							<textarea name="note"></textarea>
						</div>
						<div class="col-md-4 textleft">
						</div>
						<div class="clearfix"></div>
						<br/>
						
						<button type="submit" class="bluebtn margtop20">Submit</button>	
					</form>
			
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
						<div class="clearfix"></div><br/>
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
	$(function() {
		$( "#tgl-transfer" ).datepicker({"dateFormat": "yy-mm-dd"});
	});

	$( window ).load(function() {
		$.ajax({
			type : "GET",
			url: "<?php echo base_url('index.php/order/get_banks');?>",
			//async: false,
			dataType: "json",
			success:function(data){
				//$('#bank-tujuan').append('<table border=0 id="table-bank" style="margin-left: 300px">');
				for (var i=0; i<data.length; i++){
					$('#bank-tujuan').append('<option value="'+data[i].bank_id+'">'+data[i].bank_name+'</option>');
				}
				
			}
		})
	})
</script>

  </body>
</html>
