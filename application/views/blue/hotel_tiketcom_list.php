<?php
	define('BLUE_THEME_DIR', base_url('assets/themes/blue/'));
	define('GENERAL_CSS_DIR', base_url('assets/css'));
	define('GENERAL_JS_DIR', base_url('assets/js'));
	define('IMAGES_DIR', base_url('assets/images'));
?>
<!DOCTYPE html>
<html>
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hotel List</title>
	
    <!-- Bootstrap -->
    <link href="<?php echo BLUE_THEME_DIR;?>/dist/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo BLUE_THEME_DIR;?>/assets/css/custom.css" rel="stylesheet" media="screen">

    <!-- Updates -->
    <link href="<?php echo BLUE_THEME_DIR;?>/updates/update1/css/style01.css" rel="stylesheet" media="screen">
	
    <!-- Carousel -->
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
	
    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="<?php echo BLUE_THEME_DIR;?>/css/fullscreen.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo BLUE_THEME_DIR;?>/rs-plugin/css/settings.css" media="screen" />

    <!-- Picker -->	
	<link rel="stylesheet" href="<?php echo BLUE_THEME_DIR;?>/assets/css/jquery-ui.css" />	
	
	
	<!-- bin/jquery.slider.min.css -->
	<link rel="stylesheet" href="<?php echo BLUE_THEME_DIR;?>/plugins/jslider/css/jslider.css" type="text/css">
	<link rel="stylesheet" href="<?php echo BLUE_THEME_DIR;?>/plugins/jslider/css/jslider.round.css" type="text/css">	
	

	
    <!-- jQuery -->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.v2.0.3.js"></script>
	
	<!-- bin/jquery.slider.min.js -->
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/plugins/jslider/js/jshashtable-2.1_src.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/plugins/jslider/js/jquery.numberformatter-1.2.3.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/plugins/jslider/js/tmpl.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/plugins/jslider/js/jquery.dependClass-0.1.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/plugins/jslider/js/draggable-0.1.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/plugins/jslider/js/jquery.slider.js"></script>
	<!-- end -->
	
	<!-- tambahan -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
	<script src="<?php echo GENERAL_JS_DIR;?>/functions.js"></script>
	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/<?php echo $favicon_frontend_logo;?>">
	
	<script type="text/javascript" src="<?php echo GENERAL_JS_DIR;?>/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" href="<?php echo GENERAL_CSS_DIR;?>/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />

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
					<li><a href="#">Hotel</a></li>
				</ul>				
			</div>
			<a class="backbtn right" href="javascript:history.back()"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0">	
			<!-- FILTERS -->
			<?php include_once('sidebar_left.php')?>
			<!-- END OF FILTERS -->
			
			<!-- LIST CONTENT-->
			<div class="rightcontent col-md-9 offset-0">
			
				<div class="hpadding20">
					<!-- Top filters -->
					<div class="topsortby">
						<div class="col-md-12 offset-0">
								
								<div class="left mt7"><b><div id="result-header"></div></b></div>
						</div>
					</div>
					<!-- End of topfilters-->
				</div>
				<!-- End of padding -->
				
				<br/><br/>
				<div class="clearfix"></div>
				<div class="itemscontainer offset-1" id="list">
				</div>	
				<!-- End of offset1-->
			</div>
			<!-- END OF LIST CONTENT-->
			
		

		</div>
		<!-- END OF container-->
		
	</div>
	<!-- END OF CONTENT -->
	
	
	<!-- FOOTER -->
	<?php include_once('footer.php')?>
	

    <!-- Javascript -->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/js-list4.js"></script>	
	
	
    <!-- Custom Select -->
	<script type='text/javascript' src='<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.customSelect.js'></script>
	
    <!-- Custom Select -->
	<script type='text/javascript' src='<?php echo BLUE_THEME_DIR;?>/js/lightbox.js'></script>	
	
    <!-- JS Ease -->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.easing.js"></script>
	
    <!-- Custom functions -->
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/functions.js"></script>
	
    <!-- jQuery KenBurn Slider  -->
    <script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	
    <!-- CarouFredSel -->
	<script src="<?php echo BLUE_THEME_DIR;?>/updates/update1/js/js-flights.js"></script>		
    <script src="<?php echo BLUE_THEME_DIR;?>/updates/update1/js/jquery.carouFredSel-wrapper2.js"></script>
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.touchSwipe.min.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.transit.min.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>

    <!-- Counter -->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/counter.js"></script>	
	
    <!-- Nicescroll  -->	
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.nicescroll.min.js"></script>
	
    <!-- Picker -->	
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery-ui.js"></script>
	
    <!-- Bootstrap -->	
    <script src="<?php echo BLUE_THEME_DIR;?>/dist/js/bootstrap.min.js"></script>

<script>
	$(document).ready(function() {
		/* This is basic - uses default settings */
		$('.fancybox').fancybox();
	});
	var flight_pergi ='';
	var flight_pulang = '';
	$( window ).load(function() {
		search_hotel();
	});
	
	
	function search_hotel(){
		<?php
			//get the parameters
			$get = $this->input->get(NULL,TRUE);
			$input = '';
			foreach($get as $key => $value)
				$input .= $key.'='.$value.'&';
			echo 'var params = "'.$input.'";';
		?>
		
		//cindy nordiansyah
		//Tanggal check-in lebih kecil dari tanggal hari ini
		<?php
			$datetime1 = date_create(date('Y-m-d'));
			$datetime2 = date_create($this->input->get('checkin', TRUE));
			$datetime3 = date_create($this->input->get('checkout', TRUE));
			$interval_in = date_diff($datetime1, $datetime2);
			$interval_out = date_diff($datetime1, $datetime3);
			$diff_in = $interval_in->format('%R%a');
			$diff_out = $interval_out->format('%R%a');
			echo 'var diff_date_in_now = '.$diff_in.';';
			echo 'var diff_date_out_now = '.$diff_out.';';
		?>
		//Tanggal check-in lebih besar dari tanggal check out
		//Lama menginap lebih dari 15 hari (max 15 hari)
		<?php
			$datetime1 = date_create($this->input->get('checkin', TRUE));
			$datetime2 = date_create($this->input->get('checkout', TRUE));
			$interval = date_diff($datetime1, $datetime2);
			$diff = $interval->format('%R%a');
			echo 'var diff_date_in_out = '.$diff.';';
		?>
		<?php
			$rooms = $this->input->get('room', TRUE);		
			echo 'var rooms_quantity = "'.$rooms.'";';
		?>
		//Memesan 10 kamar(max 8 kamar)
			
		//console.log('diff date now = '+diff_date_in_now);
		//console.log('diff date in out = '+diff_date_in_out);
		//console.log('room = '+rooms_quantity);
		
		var check_error = false;
		var error_message = '';
		$('#result-header').empty();
		$('#list').empty();
		if(diff_date_in_now<0){	
			//$('#result-header').append('<p style="color:red"></p>');
			check_error = true;
			error_message += 'Tanggal check-in tidak boleh kurang dari hari ini. ';
		}
		if(diff_date_in_now > 547){	
			//$('#result-header').append('<p style="color:red"></p>');
			check_error = true;
			error_message += 'Tanggal check-in tidak lebih dari 547 hari. ';
		}
		if(diff_date_out_now > 550){	
			//$('#result-header').append('<p style="color:red"></p>');
			check_error = true;
			error_message += 'Tanggal check-out tidak lebih dari 550 hari. ';
		}
		if(diff_date_in_out > 15){
			check_error = true;
			error_message += 'Tanggal check-out tidak lebih dari 15 hari sejak tanggal check-in. ';
		}
		if(diff_date_in_out < 0){
			check_error = true;
			error_message += 'Tanggal check-out tidak kurang dari tanggal check-in. ';
		}
		if(rooms_quantity > 8){
			check_error = true;
			error_message += 'Dalam satu pemesanan dibatasi maksimum 8 kamar. ';
		}
		if(check_error){
			// if there is any error
			$('#result-header').append('<p style="color:red">'+error_message+'</p>');
		}
		else {
			//everything is OK
			$('#result-header').append('<img id="progress" src="<?php echo IMAGES_DIR; ?>/spiffygif_34x34.gif" />');
			$("#progress").show();
					
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/hotel/tiketcom_search_hotels',
				data: params,
				cache: false,
				dataType: "json",
				success:function(data){
					if(data.items[0].diagnostic.status=="200"){
						if(data.items[0].results.result.length==0){
							$('#result-header').append('<p>Maaf, data tidak ada untuk rute ini.<p>');
						} 
						else{
							$('#result-header').append('Pencarian Hotel - Harga dari '+currency_separator(parseInt(data.items[0].search_queries.minprice), '.')+' - '+currency_separator(parseInt(data.items[0].search_queries.maxprice), '.')+', Tanggal '+data.items[0].search_queries.startdate+' - '+data.items[0].search_queries.enddate+' Kamar:'+data.items[0].search_queries.room+' Malam:'+data.items[0].search_queries.night+' Dewasa:'+data.items[0].search_queries.adult+' Anak:'+data.items[0].search_queries.child);
									
							var div = $("#list");
							for(var i=0; i<data.items[0].results.result.length;i++){
								var rating = data.items[0].results.result[i].star_rating;
								var star_image = 'bigrating-'+rating+'.png';
								var user_rating_api = data.items[0].results.result[i].rating;
								var user_rating_internal = Math.round(parseInt(user_rating_api / 2));
								var user_rating_image = 'user-rating-'+user_rating_internal+'.png';
								var business_uri = data.items[0].results.result[i].business_uri;
								var business_uri_split = business_uri.split("/");
										
								/*this will replace https to http on images*/
								var image_temp = data.items[0].results.result[i].photo_primary;
								var image_primary = image_temp.replace("https", "http");
								/*end replace*/
										
								div.append('<div class="offset-2">\
									<div class="col-md-4 offset-0">\
										<div class="listitem2">\
											<a href="'+image_primary+'" data-footer="A custom footer text" data-title="A random title" data-gallery="multiimages" data-toggle="lightbox"><img src="'+image_primary+'" alt=""/></a>\
											<div class="liover"></div>\
										</div>\
									</div>\
									<div class="col-md-8 offset-0">\
										<div class="itemlabel3">\
											<div class="labelright">\
												<img src="<?php echo BLUE_THEME_DIR;?>/images/'+star_image+'" width="60" alt=""/><br/><br/>\
												<img src="<?php echo BLUE_THEME_DIR;?>/images/'+user_rating_image+'" width="60" alt=""/><br/><br/>\
												<span class="size11 grey">'+data.items[0].results.result[i].room_available+' Kamar Tersedia<br/><br/>Harga Final:<br/></span>\
												<span class="green size18"><b>IDR '+currency_separator(parseInt(data.items[0].results.result[i].price), '.')+'</b></span><br/>\
												<span class="size11 grey">/night</span><br/><br/>\
												<a href="<?php echo base_url();?>index.php/webfront/hotel_tiketcom_detail/'+business_uri_split[7]+'">\
												<button class="bookbtn mt1" type="submit">Select</button></a>\
											</div>\
											<div class="labelleft2">\
												<b>'+data.items[0].results.result[i].name+'</b><br/>\
												<p class="grey">\
												Alamat: <a class="fancybox fancybox.iframe" href="https://www.google.com/maps/embed/v1/view?key=<?php echo $this->config->item('google_api_key');?>&center='+data.items[0].results.result[i].latitude+','+data.items[0].results.result[i].longitude+'&zoom=18&maptype=roadmap">Lihat Peta</a><br/>'+data.items[0].results.result[i].address+'</p><br/>\
												<p class="grey">\
												Fasilitas: '+data.items[0].results.result[i].room_facility_name+'</p><br/>\
											</div>\
										</div>\
									</div>\
								</div>\
								<div class="clearfix"></div>\
								<div class="offset-2"><hr class="featurette-divider3"></div>');
							}
						}
					}
					$("#progress").hide();
				}
			})
			$("#progress").hide();
		}
	}
</script>	

</body>
</html>
