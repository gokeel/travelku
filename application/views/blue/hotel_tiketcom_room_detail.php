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
	$( window ).load(function() {
		detail_hotel();
	});
	
	function detail_hotel(params){
		//cindy nordiansyah
		var checkin = "<?php echo $this->input->get('startdate',TRUE);?>";
		var checkout = "<?php echo $this->input->get('enddate',TRUE);?>";
		var room = "<?php echo $this->input->get('room',TRUE);?>";
		var night = "<?php echo $this->input->get('night',TRUE);?>";
		var adult = "<?php echo $this->input->get('adult',TRUE);?>";
		var child = "<?php echo $this->input->get('child',TRUE);?>";
		var uid = "<?php echo $this->input->get('uid',TRUE);?>";
		
		$('#result-header').empty();
		$('#list').empty();				
		$('#result-header').append('<img id="progress" src="<?php echo IMAGES_DIR; ?>/spiffygif_34x34.gif" />');
		$("#progress").show();		
				
		$.ajax({
			type : "GET",
			url: '<?php echo base_url();?>index.php/hotel/tiketcom_show_hotel_rooms/<?php echo $this->uri->segment(3);?>',
			data: "startdate="+checkin+"&enddate="+checkout+"&room="+room+"&night="+night+"&adult="+adult+"&child="+child+"&uid="+uid,
			cache: false,
			dataType: "json",
			success:function(data){
				if(data.items[0].diagnostic.status=="200"){
					if(data.items[0].results.result.length==0){
						$('#result-header').append('<p>Maaf, data tidak ada untuk rute ini.<p>');
					} 
					else{
						$('#result-header').append(data.items[0].breadcrumb.business_name+' '+data.items[0].breadcrumb.area_name+' '+data.items[0].breadcrumb.province_name+', '+checkin+' - '+checkout+' Kamar:'+room+' Malam:'+night+' Dewasa:'+adult+' Anak:'+child+'<br/><h3>Silahkan Pilih Tipe Kamar</h3>');
									
						var div = $("#list");
						for(var i=0; i<data.items[0].results.result.length;i++){
							var room_name = data.items[0].results.result[i].room_name;
							var rating = data.items[0].breadcrumb.star_rating;
							var star_image = 'bigrating-'+rating+'.png';
							var breakfast = data.items[0].results.result[i].with_breakfasts;
							var breakfast_string = (breakfast=="1" ? 'Termasuk sarapan' : 'Tidak termasuk sarapan');
							var hotel_preferences = '';
							var other_facilities = '';
							var hp_name = '';//hotel preference name
							for(var j=0; j<data.items[0].results.result[i].room_facility.length; j++){
								hp_name = data.items[0].results.result[i].room_facility[j];
								switch(hp_name){
									case "AC":
										hotel_preferences += '<li class="icohp-air" title="'+hp_name+'"></li>';
										break;
									case "Air mineral botol gratis":
										hotel_preferences += '<li class="icohp-living" title="'+hp_name+'"></li>';
										break;
									case "Pengering Rambut":
										hotel_preferences += '<li class="icohp-hairdryer" title="'+hp_name+'"></li>';
										break;
									case "Akses Internet - Wifi":
										hotel_preferences += '<li class="icohp-internet" title="'+hp_name+'"></li>';
										break;
									case "Televisi":
										hotel_preferences += '<li class="icohp-tv" title="'+hp_name+'"></li>';
										break;
									case "Bar kecil":
										hotel_preferences += '<li class="icohp-bar" title="'+hp_name+'"></li>';
										break;
									case "Telepon":
										hotel_preferences += '<li class="icohp-roomservice" title="'+hp_name+'"></li>';
										break;
									default :
										other_facilities += hp_name+' | ';
								}
							}
							
							var room_policy = '<ol style="list-style:decimal">';
							for(var k=0; k<data.items[0].policy.length; k++){
								if (data.items[0].policy[k].name==room_name){
									//parsing object required
									Object.getOwnPropertyNames(data.items[0].policy[k]).forEach(function(val, idx, array) {
										if(val.indexOf("tier") >= 0)
											room_policy += "<li>"+data.items[0].policy[k][val]+"</li>";
									});
								}
							}
							room_policy += "</ol>";
							var book_uri = data.items[0].results.result[i].bookUri;
							var book_uri_split = book_uri.split("?");
							
							div.append('<div class="offset-2">\
								<div class="col-md-4 offset-0">\
									<div class="listitem2">\
										<a href="'+data.items[0].results.result[i].photo_url+'" data-footer="" data-title="'+data.items[0].results.result[i].room_name+'" data-gallery="multiimages" data-toggle="lightbox"><img src="'+data.items[0].results.result[i].photo_url+'" alt=""/></a>\
										<div class="liover"></div>\
									</div>\
								</div>\
								<div class="col-md-8 offset-0">\
									<div class="itemlabel3">\
										<div class="labelright">\
											<img src="<?php echo BLUE_THEME_DIR;?>/images/'+star_image+'" width="60" alt=""/><br/><br/>\
											<span class="size11 grey">'+data.items[0].results.result[i].room_available+' Kamar Tersedia<br/><br/>Harga Final!<br/></span>\
											<span class="green size18"><b>IDR '+currency_separator(parseInt(data.items[0].results.result[i].price), '.')+'</b></span><br/>\
											<span class="size11 grey">per night</span><br/><br/><br/>\
											<a href="<?php echo base_url();?>index.php/webfront/form_passenger_tiket/hotel?'+book_uri_split[1]+'&token='+data.items[0].token+'&uid=<?php echo $this->input->get('uid',TRUE);?>">\
											<button class="bookbtn mt1" type="submit">Select</button></a>\
										</div>\
										<div class="labelleft2">\
											<b>'+data.items[0].results.result[i].room_name+'</b><br/>\
											<p class="grey">\
											'+breakfast_string+'</p><br/>\
											<ul class="hotelpreferences">'+hotel_preferences+'</ul><br/><br/>\
											<p class="grey">\
												Fasilitas lainnya:<br/>'+other_facilities+'</p><br/>\
										</div>\
									</div>\
								</div>\
							</div>\
							<div class="clearfix"></div>\
							<div class="alert alert-info" style="margin-left:15px;margin-top:5px;margin-right:15px">\
						<b>Kebijakan Kamar:</b><br/>\
						'+room_policy+'\
						</div>\
							<div class="offset-2"><hr class="featurette-divider3"></div>');
						}
						// generate images gallery
						var head = '<div class="row anim3">\
								  <div class="col-md-3">\
									<h2>Galeri Foto</h2>\
								  </div>\
								  <div class="col-md-9">\
									<div class="wrapper">\
										<div class="list_carousel">\
											<ul id="foo2">';
						var li = '';
						var foot = '</ul>\
									<div class="clearfix"></div>\
									</div>\
									</div>\
								  </div>\
								</div>';
						for(var k=0; k<data.items[0].all_photo.photo.length; k++){
							li += '<li>\
										<a href="'+data.items[0].all_photo.photo[k].file_name+'"><img src="'+data.items[0].all_photo.photo[k].file_name+'" alt="'+data.items[0].all_photo.photo[k].photo_type+'" width="255px" height="179px"/></a>\
										<div class="m1">\
											<h6 class="lh1 dark"><b>'+data.items[0].all_photo.photo[k].photo_type+'</b></h6>\
										</div>\
									</li>';
						}
						$('#list').append(head+li+foot);
						
					}
				}
				$("#progress").hide();
			}
		})	
	}
	
	$(document).ready(function() {

		/* This is basic - uses default settings */
		$('.fancybox').fancybox();
	});
</script>		

</body>
</html>
