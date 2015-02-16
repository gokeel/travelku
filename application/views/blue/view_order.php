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
	<title>Detil Pesanan</title>
	
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
					<li><a href="#">Detil Pesanan</a></li>
				</ul>				
			</div>
			<a class="backbtn right" href="javascript:history.back()"></a>
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
					<span class="size16px bold dark left">Tampilkan Detil ID Pesanan Anda</span>
					<!--<div class="roundstep active right">1</div>-->
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					<form id="form-check-order">
						<div class="col-md-4 textright">
							<div class="margtop7"><span class="dark">ID Pesanan:</span><span class="red">*</span></div>
						</div>
						<div class="col-md-4">	
							<input type="text" class="form-control" id="order_id" name="order_id" required>
						</div>
						<div class="col-md-4 textleft">
						</div>
						<div class="clearfix"></div>
						<br/>
						<div class="col-md-4 textright">
							<div class="margtop7"><span class="dark">Email:</span><span class="red">*</span></div>
						</div>
						<div class="col-md-4">	
							<input type="text" class="form-control" id="email" name="email" required>
						</div>
						<div class="col-md-4 textleft">
						</div>
					</form>
					<div class="clearfix"></div>
					<button id="btn-submit" type="submit" class="bluebtn margtop20">Tampilkan</button>
					<br/>
					<div id="content">
						<?php
							//echo $content;
						?>
					</div>
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
	$( window ).load(function() {
		var order_id = "<?php echo $this->input->get('order_id',NULL);?>";
		var email = "<?php echo $this->input->get('email',NULL);?>";
		
		if(order_id!="" && email !="")
			check_order(order_id, email);
	})
	$('#btn-submit').click(function(){
		var order_id = $("#order_id").val();
		var email = $("#email").val();
		check_order(order_id, email);
	})
	function check_order(order_id, email){
		var request = '<?php echo base_url();?>index.php/order/check_order';
		$.ajax({
			type : "GET",
			async: false,
			data: 'order_id='+order_id+'&email='+email,
			url: request,
			dataType: "json",
			success:function(datajson){
				var div = $('#content');
				div.empty();
				div.append('<br/><br/><span class="size16px bold dark left">Detil Pesanan Anda</span>\
					<div class="clearfix"></div>\
					<div class="line4"></div><br/>');
				var content = "";
				var payment_status = "";
				if(datajson.payment_status==null || datajson.payment_status=="")
					payment_status = "NOT PAID";
				else
					payment_status = datajson.payment_status;
				// row 1
				content += '<div class="col-md-3">\
								<div class="margtop7"><span class="dark">ID Pesanan:</span></div>\
							</div>\
							<div class="col-md-3">\
								<div class="margtop7"><strong><span class="grey">'+datajson.order_id+'</span></strong></div>\
							</div>\
							<div class="col-md-3">\
								<div class="margtop7"><span class="dark">Status Pembayaran:</span></div>\
							</div>\
							<div class="col-md-3">\
							<div class="margtop7"><strong><span class="'+((datajson.payment_status=="paid" || datajson.payment_status=="validated") ? "green" : "red")+'">'+toUpperCase(payment_status)+'</span></strong></div>\
							</div>\
							<div class="clearfix"></div>\
							<br/>';
				// row 2
				content += '<div class="col-md-3">\
								<div class="margtop7"><span class="dark">Waktu Pemesanan:</span></div>\
							</div>\
							<div class="col-md-3">\
								<div class="margtop7"><span class="grey">'+datajson.order_timestamp+'</span></div>\
							</div>\
							<div class="col-md-3">\
								<div class="margtop7"><span class="dark">Batas Pembayaran:</span></div>\
							</div>\
							<div class="col-md-3">\
							<div class="margtop7"><strong><span class="red">'+datajson.limit_order_timestamp+'</span></strong></div>\
							</div>\
							<div class="clearfix"></div>\
							<br/>';
				// row 3
				content += '<div class="col-md-3">\
								<div class="margtop7"><span class="dark">Total Harga:</span></div>\
							</div>\
							<div class="col-md-3">\
								<div class="margtop7"><span class="grey">'+datajson.customer_currency+' '+datajson.total_customer_price+'</span></div>\
							</div>\
							<div class="col-md-3">\
								<div class="margtop7"><span class="dark">Tanggal Pembayaran:</span></div>\
							</div>\
							<div class="col-md-3">\
							<div class="margtop7"><strong><span class="grey">'+datajson.payment_timestamp+'</span></strong></div>\
							</div>\
							<div class="clearfix"></div>\
							<br/>';
				// row 4
				content += '<div class="col-md-3">\
								<div class="margtop7"><span class="dark">Tipe Pesanan:</span></div>\
							</div>\
							<div class="col-md-3">\
								<div class="margtop7"><span class="grey">'+toUpperCase(datajson.order_type)+'</span></div>\
							</div>\
							<div class="col-md-3">\
								<div class="margtop7"><span class="dark">'+(datajson.cart_detail.hasOwnProperty("category") ? "Kategori:" : "")+'</span></div>\
							</div>\
							<div class="col-md-3">\
								<div class="margtop7"><span class="grey">'+(datajson.cart_detail.hasOwnProperty("category") ? toUpperCase(datajson.cart_detail.category) : "")+'</span></div>\
							</div>\
							<div class="clearfix"></div>\
							<br/>';
				if(datajson.order_type=="paket"){
					content += '<div class="col-md-3">\
									<div class="margtop7"><span class="dark">Nama Pesanan:</span></div>\
								</div>\
								<div class="col-md-3">\
									<div class="margtop7"><span class="grey">'+datajson.cart_detail.order_name+'</span></div>\
								</div>\
								<div class="col-md-3">\
									<div class="margtop7"><span class="dark">Info:</span></div>\
								</div>\
								<div class="col-md-3">\
									<div class="margtop7"><span class="grey">'+datajson.cart_detail.order_name_detail+'</span></div>\
								</div>\
								<div class="clearfix"></div>\
								<br/>';
					content += '<div class="col-md-3">\
									<div class="margtop7"><span class="dark">Data Pemesan:</span></div>\
								</div>\
								<div class="col-md-3">\
									<div class="margtop7"><span class="grey">'+datajson.contact.name+'</span></div>\
								</div>\
								<div class="col-md-3">\
									<div class="margtop7"><span class="grey">'+datajson.contact.email+'</span></div>\
								</div>\
								<div class="col-md-3">\
									<div class="margtop7"><span class="grey">'+datajson.contact.phone+'</span></div>\
								</div>\
								<div class="clearfix"></div>\
								<br/>';
				}
				
				if(datajson.order_type=="flight"){
					for(var i=0; i<datajson.cart_detail.length;i++){
						var departure_date_time = '';
						if(datajson.cart_detail[i].departure_date==datajson.cart_detail[i].arrival_date)
							departure_date = datajson.cart_detail[i].departure_date+'<br />'+datajson.cart_detail[i].departure_time+(datajson.cart_detail[i].arrival_time==''? '' : '-')+datajson.cart_detail[i].arrival_time;
						else
							departure_date = datajson.cart_detail[i].departure_date+'<br />'+datajson.cart_detail[i].departure_time+'-'+datajson.cart_detail[i].departure_date+' '+datajson.cart_detail[i].arrival_time;
						content += '<div class="col-md-3">\
										<div class="margtop7"><span class="grey">'+datajson.cart_detail[i].order_name+'</span></div>\
									</div>\
									<div class="col-md-3">\
										<div class="margtop7"><span class="grey">'+datajson.cart_detail[i].order_name_detail+'</span></div>\
									</div>\
									<div class="col-md-3">\
										<div class="margtop7"><span class="grey">'+departure_date+'</span></div>\
									</div>\
									<div class="col-md-3">\
										<div class="margtop7"><span class="grey">Kode Booking: <strong>'+(datajson.cart_detail[i].booking_code==null ? "Belum Tersedia" : datajson.cart_detail[i].booking_code)+'</strong></span></div>\
									</div>\
									<div class="clearfix"></div>\
									<br/>';
						/*butuh get_token untuk bisa print voucher
						if(datajson.cart_detail[i].ticket_status=="issued"){
							content += '<div class="col-md-6">\
											<a href="'+datajson.cart_detail[i].send_voucher+'" target="_blank"><button class="bluebtn margtop20">Kirim Voucher</button></a>\
										</div>\
										<div class="col-md-6">\
											<a href="'+datajson.cart_detail[i].print_voucher+'" target="_blank"><button class="bluebtn margtop20">Cetak Voucher</button></a>\
										</div>\
										<div class="clearfix"></div>\
										<br/>';
						}*/
					}
				
					var adult = '' ;
					var child = '' ;
					var infant = '' ;
					if(datajson.passenger[0].hasOwnProperty('adult')){
						for(var j=0; j<datajson.passenger[0].adult.length; j++){
							adult += datajson.passenger[0].adult[j].name+'<br/>'+datajson.passenger[0].adult[j].birth_date+'<br/>Bagasi '+datajson.passenger[0].adult[j].baggage+'kg'+(datajson.passenger[0].adult[j].baggage_return=='' ? '' : '<br/>Bagasi Kembali '+datajson.passenger[0].adult[j].baggage_return)+'kg<br/><br/>';
						}
					}
					if(datajson.passenger[0].hasOwnProperty('child')){
						for(var j=0; j<datajson.passenger[0].child.length; j++){
							child += datajson.passenger[0].child[j].name+'<br/>'+datajson.passenger[0].child[j].birth_date+'<br/>Bagasi '+datajson.passenger[0].child[j].baggage+'kg'+(datajson.passenger[0].child[j].baggage_return=='' ? '' : '<br/>Bagasi Kembali '+datajson.passenger[0].child[j].baggage_return)+'kg<br/><br/>';
						}
					}
					if(datajson.passenger[0].hasOwnProperty('infant')){
						for(var j=0; j<datajson.passenger[0].infant.length; j++){
							infant += datajson.passenger[0].infant[j].name+'<br/>'+datajson.passenger[0].infant[j].birth_date+'<br/>';
						}
					}
					content += '<div class="col-md-3">\
									<div class="margtop7"><span class="dark">Data Penumpang</span></div>\
								</div>\
								<div class="col-md-3">\
									<div class="margtop7"><span class="grey">Dewasa:<br/>'+adult+'</span></div>\
								</div>\
								<div class="col-md-3">\
									<div class="margtop7"><span class="grey">Anak:<br/>'+child+'</span></div>\
								</div>\
								<div class="col-md-3">\
									<div class="margtop7"><span class="grey">Bayi:<br/>'+infant+'</span></div>\
								</div>\
								<div class="clearfix"></div>\
								<br/>';
				}
				
				
				div.append(content);
			}
		});
	}
</script>

  </body>
</html>
