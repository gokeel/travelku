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
	<title><?php echo $homepage_title;?></title>
	
    <!-- Bootstrap -->
    <link href="<?php echo BLUE_THEME_DIR;?>/dist/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo BLUE_THEME_DIR;?>/assets/css/custom.css" rel="stylesheet" media="screen">

    <!-- Carousel -->
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
	
    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="<?php echo BLUE_THEME_DIR;?>/css/fullwidth.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo BLUE_THEME_DIR;?>/rs-plugin/css/settings2.css" media="screen" />

    <!-- Picker UI-->	
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
  <body id="top">
    
	<!-- Top wrapper -->	
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
	<!-- / Top wrapper -->

	<!-- Blue background -->
	<div class="mtslide2 sliderbg2"></div>
	<!-- / Blue background -->

    <!-- WRAP -->
	<div class="wrap ctup" >
		
		<div class="slideup">
			<div class="container z-index100">		
				<div class="slidercontainer">
				
					<div class="row">
						<div class="col-md-4 scolleft">
							<div class="w50percent">
								<div class="radio">
								  <label>
									<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" checked>
									<!--<span class="flight-ico"></span> Pesawat-->
									Pesawat
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" >
									Hotel
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="optionsRadios" id="optionsRadios3" value="option2">
									Kereta
								  </label>
								</div>
							</div>
							
							<div class="w50percentlast">
								<p class="cstyle08">Perjalanan:</p>
								<div class="radio">
								  <label>
									<input type="radio" name="optionsRadios2" id="optionsRadios6" value="option2" checked>
									Sekali Jalan
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="optionsRadios2" id="optionsRadios7" value="option2">
									Pulang Pergi
								  </label>
								</div>
							</div>	
							
							<div class="clearfix"></div><br/>
							
							<!-- HOTELS TAB -->
							<div class="hotelstab none">
								<form method="get" action="<?php echo base_url();?>index.php/webfront/show_hotel_tiketcom_list">
									<span class="opensans size18" >Kota/Nama Hotel</span>
									<input type="text" class="form-control" placeholder="contoh:denpasar" id="query" name="query" required>
									
									<br/>
									
									<div class="w50percent">
										<div class="wh90percent textleft">
											<span class="opensans size13"><b>Check in</b></span>
											<input type="text" class="form-control mySelectCalendar" name="checkin" id="datepicker" value="<?php $d=strtotime("tomorrow"); echo date('Y-m-d',$d);?>"/>
										</div>
									</div>

									<div class="w50percentlast">
										<div class="wh90percent textleft right">
											<span class="opensans size13"><b>Check out</b></span>
											<input type="text" class="form-control mySelectCalendar" name="checkout" id="datepicker2" value="<?php $d=strtotime("tomorrow"); echo date('Y-m-d',$d);?>"/>
										</div>
									</div>
									
									<div class="clearfix"></div>
									
									<div class="room1 margtop15">
										<div class="w50percent">
											<div class="wh90percent textleft right">
												<div class="w50percent">
													<div class="wh90percent textleft left">
														<span class="opensans size13"><b>Kamar</b></span>
														<select class="form-control" id="kamar" name="room">
														  <option selected value="1">1</option>
														  <?php for($i=2; $i<9; $i++){ 
														  echo '<option value="'.$i.'">'.$i.'</option>';
														  } ?>
														</select>
													</div>
												</div>							
												<div class="w50percentlast">
													<div class="wh90percent textleft right">
													<span class="opensans size13"><b>Malam</b></span>
														<select class="form-control" id="malam" name="night">
														  <option selected>1</option>
														  <?php for($i=2; $i<16; $i++){ 
														  echo '<option value="'.$i.'">'.$i.'</option>';
														  } ?>
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="w50percentlast">	
											<div class="wh90percent textleft right">
												<div class="w50percent">
													<div class="wh90percent textleft left">
														<span class="opensans size13"><b>Dewasa</b></span>
														<select class="form-control" id="hotel-dewasa" name="dewasa">
														  <option>0</option>
														  <option>1</option>
														  <option selected>2</option>
														  <option>3</option>
														  <option>4</option>
														  <option>5</option>
														</select>
													</div>
												</div>							
												<div class="w50percentlast">
													<div class="wh90percent textleft right">
													<span class="opensans size13"><b>Anak</b></span>
														<select class="form-control" id="hotel-anak" name="anak">
														  <option selected>0</option>
														  <option>1</option>
														  <option>2</option>
														  <option>3</option>
														  <option>4</option>
														  <option>5</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									
										
									<div class="clearfix"></div>
									<br />
									<button type="submit" class="btn-search-biru-tua">Search</button>
								</form>
							</div>
							<!-- END OF HOTELS TAB -->
							
							<!-- FLIGHTS TAB -->
							<div class="flightstab none">
								<form method="get" action="<?php echo base_url();?>index.php/webfront/show_flight_list/flight">
									<input type="hidden" name="flight-trip" id="flight-trip" value="single-trip">
									<div class="w50percent">
										<div class="wh90percent textleft">
											<span class="opensans size13"><b>Dari</b></span>
											<select name="dari" id="flight-from" class="form-control"></select>
										</div>
									</div>

									<div class="w50percentlast">
										<div class="wh90percent textleft right">
											<span class="opensans size13"><b>Ke</b></span>
											<select name="ke" id="flight-to" class="form-control"></select>
										</div>
									</div>
									
									
									<div class="clearfix"></div><br/>
									
									<div class="w50percent">
										<div class="wh90percent textleft">
											<span class="opensans size13"><b>Berangkat</b></span>
											<input type="text" class="form-control mySelectCalendar" name="flight-pergi" id="datepicker3" placeholder="yyyy-mm-dd"/>
										</div>
									</div>

									<div class="w50percentlast">
										<div class="wh90percent textleft right" id="flight-returning">
											<span class="opensans size13"><b>Kembali</b></span>
											<input type="text" class="form-control mySelectCalendar" name="flight-pulang" id="datepicker4" placeholder="yyyy-mm-dd"/>
										</div>
									</div>
									
									<div class="clearfix"></div>
									
									<div class="room1 margtop15">
										<div class="w40percent">
											<div class="wh90percent textleft">
												<span class="opensans size13"><b>Dewasa</b></span>
												<select class="form-control mySelectBoxClass" name="dewasa" id="flight-dewasa">
												  <!--<option>0</option>-->
												  <option selected>1</option>
												  <option>2</option>
												  <option>3</option>
												  <option>4</option>
												  <option>5</option>
												  <option>6</option>
												</select>
											</div>
										</div>

										<div class="w60percentlast">	
											<div class="wh90percent textleft right">
												<div class="w50percent">
												<div class="wh90percent textleft left">
													<span class="opensans size13"><b>Anak <span style="font-size:8px">(2-12 th)</span></b></span>
													<select name="anak" id="flight-anak" class="form-control mySelectBoxClass">
													  <option selected>0</option>
													  <option>1</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
													  <option>6</option>
													</select>
													
												</div>
											</div>							
											<div class="w50percentlast">
												<div class="wh90percent textleft right">
												<span class="opensans size13"><b>Bayi <span style="font-size:8px">(0-2 th)</span></b></span>
													<select name="bayi" id="flight-bayi" class="form-control mySelectBoxClass">
													  <option selected>0</option>
													  <option>1</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
													  <option>6</option>
													</select>
												</div>
											</div>
											</div>
										</div>
									</div><div class="clearfix"></div>
								
									<button type="submit" class="btn-search-biru-tua">Search</button>
								</form>
							</div>
							<!-- END OF FLIGHTS TAB -->
							
							<!-- TRAINS TAB -->
							<div class="vacationstab none">
								<form method="get" action="<?php echo base_url();?>index.php/webfront/show_flight_list/train">
									<input type="hidden" name="train-trip" id="train-trip" value="single-trip">
									<div class="w50percent">
										<div class="wh90percent textleft">
											<span class="opensans size13"><b>Dari</b></span>
											<select name="dari" id="train-from" class="form-control"></select>
										</div>
									</div>

									<div class="w50percentlast">
										<div class="wh90percent textleft right">
											<span class="opensans size13"><b>Ke</b></span>
											<select name="ke" id="train-to" class="form-control"></select>
										</div>
									</div>
									
									
									<div class="clearfix"></div><br/>
									
									<div class="w50percent">
										<div class="wh90percent textleft">
											<span class="opensans size13"><b>Berangkat</b></span>
											<input type="text" class="form-control mySelectCalendar" name="train-pergi" id="datepicker5" placeholder="yyyy-mm-dd"/>
										</div>
									</div>

									<div class="w50percentlast">
										<div class="wh90percent textleft right" id="train-returning">
											<span class="opensans size13"><b>Kembali</b></span>
											<input type="text" class="form-control mySelectCalendar" name="train-pulang" id="datepicker6" placeholder="yyyy-mm-dd"/>
										</div>
									</div>
									
									<div class="clearfix"></div>
									
									<div class="room1 margtop15">
										<div class="w40percent">
											<div class="wh90percent textleft">
												<span class="opensans size13"><b>Dewasa</b></span>
												<select class="form-control mySelectBoxClass" name="dewasa" id="train-dewasa" >
												  <option selected>1</option>
												  <option>2</option>
												  <option>3</option>
												  <option>4</option>
												  <option>5</option>
												  <option>6</option>
												</select>
											</div>
										</div>

										<div class="w60percentlast">	
											<div class="wh90percent textleft right">
												<div class="w50percent">
													<div class="wh90percent textleft left">
														<span class="opensans size13"><b>Anak</b></span>
														<select class="form-control mySelectBoxClass" name="anak" id="train-anak" >
														  <option selected>0</option>
														  <option>1</option>
														  <option>2</option>
														  <option>3</option>
														  <option>4</option>
														  <option>5</option>
														  <option>6</option>
														</select>
													</div>
												</div>							
												<div class="w50percentlast">
													<div class="wh90percent textleft right">
													<span class="opensans size13"><b>Bayi</b></span>
														<select class="form-control mySelectBoxClass" name="bayi" id="train-bayi" >
														  <option selected>0</option>
														  <option>1</option>
														  <option>2</option>
														  <option>3</option>
														  <option>4</option>
														  <option>5</option>
														  <option>6</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div><div class="clearfix"></div>
									
									<button type="submit" class="btn-search-biru-tua">Search</button>
								</form>
							</div>
							<!-- END OF TRAINS TAB -->
						</div>
						<div class="col-md-8 scolright">
						
							<!--
							#################################
								- THEMEPUNCH BANNER -
							#################################
							-->

							<div class="fullwidthbanner">
								<ul >

									<!-- papercut fade turnoff flyin slideright slideleft slideup slidedown-->
								<?php
								for($i=0;$i<sizeof($slider);$i++){
								?>	
									<!-- FADE -->
									<li data-transition="fade" data-slotamount="1" data-masterspeed="300"> 										
										<img src="<?php echo base_url();?>assets/uploads/posts/<?php echo $slider[$i]['image'];?>" alt=""/>
										<div class="tp-caption scrolleffect sft"
											 data-x="center"
											 data-y="100"
											 data-speed="1000"
											 data-start="800"
											 data-easing="easeOutExpo"  >
											 <!--<div class="sboxpurple textcenter">
												<span class="lato size28 slim caps white"><?php echo $slider[$i]['category'];?></span><br/><br/><br/>
												<span class="lato size48 slim caps white"><?php echo $slider[$i]['title'];?></span><br/><br/><br/>
												<!--<span class="lato size20 normal caps white">from</span><br/><br/>-->
												<!--<span class="lato size40 slim uppercase yellow"><?php echo $slider[$i]['currency'];?> <?php echo $slider[$i]['price'];?></span>
												<br/>
											 </div>-->
										</div>	
										<div class="tp-caption sfb"
											 data-x="left"
											 data-y="371"
											 data-speed="1000"
											 data-start="800"
											 data-easing="easeOutExpo"  >
											<div class="blacklable">
												<?php
												if($slider[$i]['price']<>"0"){
												?>
												<a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $slider[$i]['id'];?>">
													<h4 class="lato bold white"><?php echo $slider[$i]['title'];?> 
														
														<span class="green"><?php echo $slider[$i]['currency'];?> <?php echo $slider[$i]['price'];?></span>
													</h4>
												</a>
												<?php } 
												else{
												?>
												<h4 class="lato bold white"><?php echo $slider[$i]['title'];?></h4>
												<?php } ?>
												
											<h5 class="lato grey mt-10"><?php echo $slider[$i]['mini_slogan'];?></h5>
											</div>
										</div>	
									</li>
								<?php 
								}	
								?>
								
								</ul>
								<div class="tp-bannertimer none"></div>
							</div>
						
						<!--
						##############################
						 - ACTIVATE THE BANNER HERE -
						##############################
						-->
						<script type="text/javascript">

							var tpj=jQuery;
							tpj.noConflict();

							tpj(document).ready(function() {

							if (tpj.fn.cssOriginal!=undefined)
								tpj.fn.css = tpj.fn.cssOriginal;

								var api = tpj('.fullwidthbanner').revolution(
									{
										delay:9000,
										startwidth:960,
										startheight:446,

										onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off

										thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
										thumbHeight:50,
										thumbAmount:3,

										hideThumbs:0,
										navigationType:"bullet",				// bullet, thumb, none
										navigationArrows:"solo",				// nexttobullets, solo (old name verticalcentered), none

										navigationStyle:"round",				// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom


										navigationHAlign:"right",				// Vertical Align top,center,bottom
										navigationVAlign:"bottom",					// Horizontal Align left,center,right
										navigationHOffset:30,
										navigationVOffset:30,

										soloArrowLeftHalign:"left",
										soloArrowLeftValign:"center",
										soloArrowLeftHOffset:20,
										soloArrowLeftVOffset:0,

										soloArrowRightHalign:"right",
										soloArrowRightValign:"center",
										soloArrowRightHOffset:20,
										soloArrowRightVOffset:0,

										touchenabled:"on",						// Enable Swipe Function : on/off


										stopAtSlide:-1,							// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
										stopAfterLoops:-1,						// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

										hideCaptionAtLimit:0,					// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
										hideAllCaptionAtLilmit:0,				// Hide all The Captions if Width of Browser is less then this value
										hideSliderAtLimit:0,					// Hide the whole slider, and stop also functions if Width of Browser is less than this value


										fullWidth:"on",

										shadow:1								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)

									});

									
									
									
									

									// TO HIDE THE ARROWS SEPERATLY FROM THE BULLETS, SOME TRICK HERE:
									// YOU CAN REMOVE IT FROM HERE TILL THE END OF THIS SECTION IF YOU DONT NEED THIS !
										api.bind("revolution.slide.onloaded",function (e) {


											jQuery('.tparrows').each(function() {
												var arrows=jQuery(this);

												var timer = setInterval(function() {

													if (arrows.css('opacity') == 1 && !jQuery('.tp-simpleresponsive').hasClass("mouseisover"))
													  arrows.fadeOut(300);
												},3000);
											})

											jQuery('.tp-simpleresponsive, .tparrows').hover(function() {
												jQuery('.tp-simpleresponsive').addClass("mouseisover");
												jQuery('body').find('.tparrows').each(function() {
													jQuery(this).fadeIn(300);
												});
											}, function() {
												if (!jQuery(this).hasClass("tparrows"))
													jQuery('.tp-simpleresponsive').removeClass("mouseisover");
											})
										});
									// END OF THE SECTION, HIDE MY ARROWS SEPERATLY FROM THE BULLETS

						});
						
						
						
						
						jQuery(document).ready(function($){
							// gets the width of black bar at the bottom of the slider
							var $gwsr = $('.scolright').outerWidth();
							$('.blacklable').css({'width' : $gwsr +'px'});
						});
						jQuery(window).resize(function() {
							jQuery(document).ready(function($){

								// gets the width of black bar at the bottom of the slider
								var $gwsr = $('.scolright').outerWidth();
								$('.blacklable').css({'width' : $gwsr +'px'});

							});
						});
						
						




						</script>
					
					
						</div>			
					
					</div><!-- end of row -->
				</div>
			</div>
		</div>
		
		<div class="deals4">
			<div class="container">	
				<div class="row">
					<div class="col-md-4">
						<div class="lbl">
							<a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $latest[0]['id'];?>"><img src="<?php echo base_url();?>assets/uploads/posts/<?php echo $latest[0]['image'];?>" width="360" height="184" alt="" class="fwimg"/></a>
							<div class="smallblacklabel">Paket Terbaru</div>
						</div>
					<?php
						$index_latest = 0;
						$i = 0;
						for($i=0; $i<3; $i++){
					?>
							<div class="deal">
								<a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $latest[$i]['id'];?>"><img src="<?php echo base_url();?>assets/uploads/posts/<?php echo $latest[$i]['image'];?>" alt="" class="dealthumb" width="50" height="50" /></a>
								<div class="dealtitle">
									<p><a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $latest[$i]['id'];?>" class="dark"><?php echo ucwords($latest[$i]['title']);?></a></p>
									<?php if($latest[$i]['star_rating']<>'') {?>
										<img src="<?php echo BLUE_THEME_DIR;?>/images/smallrating-<?php echo $latest[$i]['star_rating'];?>.png" alt="" class="mt-10"/><span class="size13 grey mt-9">
									<?php } //end of checking star rating
									echo $latest[$i]['category'];?></span>
								</div>
								<div class="dealprice">
									<p class="size12 grey lh2"><span class="price"><?php echo $latest[$i]['currency'];?> <?php echo $latest[$i]['price'];?></span></p>
								</div>					
							</div>
					<?php
						}
					?>				
					</div>
					<!-- End of first row-->
					
					<div class="col-md-4">
						<div class="lbl">
							<a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $umrah[0]['id'];?>"><img src="<?php echo base_url();?>assets/uploads/posts/<?php echo $umrah[0]['image'];?>" width="360" height="184" alt="" class="fwimg"/></a>
							<div class="smallblacklabel">Paket Umrah</div>
						</div>
					<?php
						for($i=0;$i<sizeof($umrah);$i++){
					?>
						<div class="deal">
							<a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $umrah[$i]['id'];?>"><img src="<?php echo base_url();?>assets/uploads/posts/<?php echo $umrah[$i]['image'];?>" width="50" height="50" alt="" class="dealthumb"/></a>
							<div class="dealtitle">
								<p><a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $umrah[$i]['id'];?>" class="dark"><?php echo ucwords($umrah[$i]['title']);?></a></p>
								<?php if($umrah[$i]['star_rating']<>'') {?>
									<img src="<?php echo BLUE_THEME_DIR;?>/images/smallrating-<?php echo $umrah[$i]['star_rating'];?>.png" alt="" class="mt-10"/><span class="size13 grey mt-9">
								<?php } //end of checking star rating
								echo $umrah[$i]['category'];?></span>
							</div>
							<div class="dealprice">
								<p class="size12 grey lh2"><span class="price"><?php echo $umrah[$i]['currency'];?> <?php echo $umrah[$i]['price'];?></span><br/></p>
							</div>					
						</div>
					<?php } ?>					
					</div>
					<!-- End of first row-->
					
					<div class="col-md-4">
						<div class="lbl">
							<a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $promo[0]['id'];?>"><img src="<?php echo base_url();?>assets/uploads/posts/<?php echo $promo[0]['image'];?>" width="360" height="184" alt="" class="fwimg"/></a>
							<div class="smallblacklabel">Promo Terbaru</div>
						</div>
					<?php
						for($i=0;$i<3;$i++){
					?>
						<div class="deal">
							<a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $promo[$i]['id'];?>"><img src="<?php echo base_url();?>assets/uploads/posts/<?php echo $promo[$i]['image'];?>" width="50" height="50" alt="" class="dealthumb"/></a>
							<div class="dealtitle">
								<p><a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $promo[$i]['id'];?>" class="dark"><?php echo ucwords($promo[$i]['title']);?></a></p>
								<?php if($promo[$i]['star_rating']<>'') {?>
									<img src="<?php echo BLUE_THEME_DIR;?>/images/smallrating-<?php echo $promo[$i]['star_rating'];?>.png" alt="" class="mt-10"/><span class="size13 grey mt-9">
								<?php } //end of checking star rating
								echo $promo[$i]['category'];?></span>
							</div>
							<div class="dealprice">
								<p class="size12 grey lh2"><span class="price"><?php echo $promo[$i]['currency'];?> <?php echo $promo[$i]['price'];?></span><br/></p>
							</div>					
						</div>
					<?php } ?>
					</div>
					<!-- End of first row-->			
				</div>
			</div>
		</div>
		
		<div class="deals4">
			<div class="container">	
				<div class="row">
					<div class="col-md-6">
						<img style="margin-left:0px" src="<?php echo base_url();?>assets/uploads/option_images/<?php echo $tag_service_1_logo;?>" width="45%" height="100%"/>
						<img style="margin-left:7%" src="<?php echo base_url();?>assets/uploads/option_images/<?php echo $tag_service_2_logo;?>" width="45%" height="100%"/>
					</div>
					<div class="col-md-6">
						<img style="margin-left:0px" src="<?php echo base_url();?>assets/uploads/option_images/<?php echo $tag_service_3_logo;?>" width="45%" height="100%"/>
						<img style="margin-left:7%" src="<?php echo base_url();?>assets/uploads/option_images/<?php echo $tag_service_4_logo;?>" width="45%" height="100%"/>
					</div>
				</div>
			</div>
		</div>
		<div class="container cstyle06">	

			<div class="row anim2">
			  <h2>&nbsp;&nbsp;Paket Promo</h2>
			  
			  <div class="col-md-12">
			  
			  
			  
				<!-- Carousel -->
				<div class="wrapper">
					<div class="list_carousel">
						<ul id="foo">
							<?php
							for($i=0;$i<sizeof($promo);$i++){
						?>
							<li>
								<a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $promo[$i]['id'];?>"><img src="<?php echo base_url();?>assets/uploads/posts/<?php echo $promo[$i]['image'];?>" alt="" width="255px" height="179px"/></a>
								<div class="m1">
									<h6 class="lh1 dark"><b><?php echo ucwords($promo[$i]['title']);?></b></h6>
									<h6 class="lh1 green"><?php echo $promo[$i]['currency'];?> <?php echo $promo[$i]['price'];?></h6>							
								</div>
							</li>
						<?php } ?>
						</ul>
						<div class="clearfix"></div>
						<a id="prev_btn" class="prev" href="#"><img src="<?php echo BLUE_THEME_DIR;?>/images/spacer.png" alt=""/></a>
						<a id="next_btn" class="next" href="#"><img src="<?php echo BLUE_THEME_DIR;?>/images/spacer.png" alt=""/></a>
					</div>
				</div>

			  
			  </div>
			</div>	

			<!--<hr class="featurette-divider2">
			
			<div class="row anim3">
			  <div class="col-md-12">
				<img src="<?php echo base_url();?>assets/images/banner-partner.png" alt="" width="100%" height="155px"/>
			  </div>
			</div>-->
		</div>
		


		<!-- FOOTER 
		<div class="container none">		
			<footer>
			<p class="pull-right"><a href="#">Back to top</a></p>
			<p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
			</footer>
		</div>		-->
		<div style="overflow:hidden;padding:30px 0;width:100%;">
		<!--<div class="footerbg">-->
			<div class="container">	
				<!--<div class="col-md-6" style="background-color:#F2F2F2">-->
				<div class="col-md-6">
					<!--<img src="<?php echo base_url();?>assets/images/banner-partner.png" alt="" width="100%" height="155px"/>-->
					<img src="<?php echo base_url();?>assets/images/logomaskapai/sriwijaya.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/Lion Air.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/Air asia.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/Garuda Indonesia.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/CITILINK.png" height="40px" width="65px"/><br /><br />
					<img src="<?php echo base_url();?>assets/images/logomaskapai/Wings Air.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/Batik air.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/Tiger air.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/Kalstar.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/xpress air.png" height="40px" width="65px"/><br /><br />
					<img src="<?php echo base_url();?>assets/images/logomaskapai/Trigana Air.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/Malindo Air.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/Susi Air.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/NAM.png" height="40px" width="65px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/logomaskapai/Thai Air.png" height="40px" width="65px"/>
				</div>
				<div class="col-md-3">
					<img src="<?php echo base_url();?>assets/images/payment/BCA.png" height="50px" width="90px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/payment/mandiri.png" height="50px" width="90px"/><br /><br />
					<img src="<?php echo base_url();?>assets/images/payment/BRI.png" height="50px" width="90px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/payment/BNI.png" height="50px" width="90px"/>
				</div>
				<div class="col-md-3">
					<img src="<?php echo base_url();?>assets/images/Asita.png" height="50px" width="90px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/Al Qadri.png" height="50px" width="90px"/><br /><br />
					<img src="<?php echo base_url();?>assets/images/Abacus.png" height="50px" width="90px"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="<?php echo base_url();?>assets/images/Wonderfull Indonesia.png" height="50px" width="90px"/>
				</div>
			</div>
		</div>
	<br/>
	
		<?php include_once('footer.php')?>
		

		
	</div>
	<!-- WRAP -->
	
	
    <!-- Javascript -->
	
    <!-- This page JS -->
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/js-index7.js"></script>	
	
    <!-- Custom functions -->
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/functions.js"></script>
	
    <!-- Picker UI-->	
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery-ui.js"></script>		
	
	<!-- Easing -->
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.easing.js"></script>
	
    <!-- jQuery KenBurn Slider  -->
    <script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	
   <!-- Nicescroll  -->	
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.nicescroll.min.js"></script>
	
    <!-- CarouFredSel -->
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.touchSwipe.min.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.transit.min.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>
	
    <!-- Custom Select -->
	<script type='text/javascript' src='<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.customSelect.js'></script>	

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BLUE_THEME_DIR;?>/dist/js/bootstrap.min.js"></script>
<script>	
	$( window ).load(function() {
		load_all_airport('<?php echo base_url();?>index.php/flight/get_all_airport', "#flight-from");
		load_all_airport('<?php echo base_url();?>index.php/flight/get_all_airport', "#flight-to");
		
		load_all_station('<?php echo base_url();?>index.php/train/get_all_station', "#train-from");
		load_all_station('<?php echo base_url();?>index.php/train/get_all_station', "#train-to");
		
		changeDateCheckout("datepicker", "datepicker2", "malam");
	});

	//event on hotel checkout change the night
	jQuery("#datepicker2").change(function(){
		var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
		var checkin = document.getElementById("datepicker").value;
		var checkout = document.getElementById("datepicker2").value;
		var firstDate = new Date(checkin);
		var secondDate = new Date(checkout);

		var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
		if(diffDays<=15)
			document.getElementById("malam").value = diffDays.toString();
		else{
			alert("Lama menginap tidak lebih dari 15 hari");
			document.getElementById("datepicker2").value = checkin;
			document.getElementById("malam").value = "1";
		}
	});
	
	jQuery("#datepicker").change(function(){
		changeDateCheckout("datepicker", "datepicker2", "malam");
	});
	
	//event on night changed, change the checkout
	jQuery("#malam").change(function(){
		changeDateCheckout("datepicker", "datepicker2", "malam");
	});
	
	function changeDateCheckout(from, to, malam){
		var checkin = document.getElementById(from).value;
		var firstDate = new Date(checkin);
		var night = document.getElementById(malam).value;
		var numberOfDaysToAdd = parseInt(night);
		
		var someDate = new Date(firstDate.getFullYear(), firstDate.getMonth(), firstDate.getDate() + numberOfDaysToAdd);
		
		var dd = someDate.getDate();
		var mm = someDate.getMonth() + 1;
		var yy = someDate.getFullYear();
		
		var someFormattedDate = yy+'-'+(mm < 10 ? "0"+mm : mm)+'-'+(dd < 10 ? "0"+dd : dd);
		jQuery("#"+to).val(someFormattedDate);
	}
</script>	

  </body>
</html>
