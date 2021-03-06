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
	<title>Travelku</title>
	
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
    <link rel="stylesheet" type="text/css" href="<?php echo BLUE_THEME_DIR;?>/css/fullscreen.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo BLUE_THEME_DIR;?>/rs-plugin/css/settings.css" media="screen" />

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
	<!-- /Top wrapper -->


	<!--
	#################################
		- THEMEPUNCH BANNER -
	#################################
	-->
	<div id="dajy" class="fullscreen-container mtslide sliderbg fixed">
			<div class="fullscreenbanner">
				<ul>

					<!-- papercut fade turnoff flyin slideright slideleft slideup slidedown-->
				
				
					<!-- FADE -->
					<?php
						for($i=0;$i<sizeof($slider);$i++){
					?>
					<li data-transition="fade" data-slotamount="1" data-masterspeed="300"> 										
						
						<img src="<?php echo base_url();?>assets/uploads/posts/<?php echo $slider[$i]['image'];?>" alt=""/>
						<div class="tp-caption scrolleffect sft"
							 data-x="center"
							 data-y="120"
							 data-speed="1000"
							 data-start="800"
							 data-easing="easeOutExpo"  >
							 <div class="sboxpurple textcenter">
								<!--<span class="lato size28 slim caps white">France</span><br/><br/><br/>-->
								<a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $slider[$i]['id'];?>"><span class="lato size100 slim caps white"><?php echo $slider[$i]['title']?></span></a><br/><br/>
								<!--<span class="lato size20 normal caps white">from</span><br/><br/>-->
								<span class="lato size48 slim uppercase yellow">IDR <?php echo $slider[$i]['price']?></span><br/>
							 </div>
						</div>	
					</li>	
					<?php } ?>
					<!-- FADE -->
					<!--<li data-transition="fade" data-slotamount="1" data-masterspeed="300"> 										
						<img src="<?php echo BLUE_THEME_DIR;?>/images/slider/rome.jpg" alt=""/>
						<div class="tp-caption scrolleffect sft"
							 data-x="center"
							 data-y="120"
							 data-speed="1000"
							 data-start="800"
							 data-easing="easeOutExpo">
							 <div class="sboxpurple textcenter">
								<span class="lato size28 slim caps white">Italy</span><br/><br/><br/>
								<span class="lato size100 slim caps white">Rome</span><br/>
								<span class="lato size20 normal caps white">from</span><br/><br/>
								<span class="lato size48 slim uppercase yellow">$1500</span><br/>
							 </div>
						</div>	
					</li>	-->
				
					<!-- FADE -->
					<!--<li data-transition="fade" data-slotamount="1" data-masterspeed="300"> 										
						<img src="<?php echo BLUE_THEME_DIR;?>/images/slider/santorini.jpg" alt=""/>
						<div class="tp-caption scrolleffect sft"
							 data-x="center"
							 data-y="120"
							 data-speed="1000"
							 data-start="800"
							 data-easing="easeOutExpo">
							 <div class="sboxpurple textcenter">
								<span class="lato size28 slim caps white">Greece</span><br/><br/><br/>
								<span class="lato size100 slim caps white">Santorini</span><br/>
								<span class="lato size20 normal caps white">from</span><br/><br/>
								<span class="lato size48 slim uppercase yellow">$1500</span><br/>
							 </div>
						</div>	
					</li>
					-->

				</ul>
				<div class="tp-bannertimer none"></div>
			</div>
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

				tpj('.fullscreenbanner').revolution(
					{
						delay:5000,
						startwidth:1170,
						startheight:600,

						onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off

						thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
						thumbHeight:50,
						thumbAmount:3,

						hideThumbs:0,
						navigationType:"bullet",				// bullet, thumb, none
						navigationArrows:"solo",				// nexttobullets, solo (old name verticalcentered), none

						navigationStyle:false,				// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom


						navigationHAlign:"left",				// Vertical Align top,center,bottom
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


						fullWidth:"on",							// Same time only Enable FullScreen of FullWidth !!
						fullScreen:"off",						// Same time only Enable FullScreen of FullWidth !!


						shadow:0								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)

					});


		});
		</script>
		

		



	<!-- WRAP -->
	<div class="wrap cstyle03">
		
		<div class="container mt-130 z-index100">		
		  <div class="row">
			<div class="col-md-12">
				<div class="bs-example bs-example-tabs cstyle04">
				
					<ul class="nav nav-tabs" id="myTab">
						<li onclick="mySelectUpdate()" class="active"><a data-toggle="tab" href="#air2"><span class="flight"></span><span class="hidetext">Pesawat</span>&nbsp;</a></li>
						<li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#train2"><span class="hotel"></span><span class="hidetext">Kereta</span>&nbsp;</a></li>
						<li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#hotel2"><span class="suitcase"></span><span class="hidetext">Hotel</span>&nbsp;</a></li>
					</ul>
					
					<div class="tab-content2" id="myTabContent">
						<div id="air2" class="tab-pane fade active in">
							<p hidden="true">flight</p>
							<div class="col-md-4">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>Dari</b></span>
										<select name="dari" id="flight-from" class="form-control"></select>
										<!--<input type="text" class="form-control" placeholder="City or airport">-->
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13"><b>Ke</b></span>
										<select name="ke" id="flight-to" class="form-control"></select>
										<!--<input type="text" class="form-control" placeholder="City or airport">-->
									</div>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>Berangkat</b></span>
										<input type="text" class="form-control mySelectCalendar" name="flight-pergi" id="datepicker3" placeholder="yyyy-mm-dd"/>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13"><b>Kembali</b></span>
										<input type="text" class="form-control mySelectCalendar" name="flight-pulang" id="datepicker4" placeholder="yyyy-mm-dd"/>
									</div>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="room1" >
									<div class="w40percent">
										<div class="wh90percent textleft">
											<span class="opensans size13"><b>Dewasa</b></span>
											<select class="form-control mySelectBoxClass" name="dewasa" id="flight-dewasa">
											  <option>0</option>
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
												<span class="opensans size13"><b>Bayi</b></span>
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
								</div>
							</div>
						</div>
						<!--End of 1st tab -->
						
						<div id="train2" class="tab-pane fade">
							<p hidden="true">train</p>
							<div class="col-md-4">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>Dari</b></span>
										<select name="dari" id="train-from" class="form-control"></select>
										<!--<input type="text" class="form-control" placeholder="Stasiun">-->
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13"><b>Ke</b></span>
										<select name="ke" id="train-to" class="form-control"></select>
										<!--<input type="text" class="form-control" placeholder="Stasiun">-->
									</div>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>Berangkat</b></span>
										<input type="text" class="form-control mySelectCalendar" name="train-pergi" id="datepicker5" placeholder="yyyy-mm-dd"/>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13"><b>Kembali</b></span>
										<input type="text" class="form-control mySelectCalendar" name="train-pulang" id="datepicker6" placeholder="yyyy-mm-dd"/>
									</div>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="room1" >
									<div class="w40percent">
										<div class="wh90percent textleft">
											<span class="opensans size13"><b>Dewasa</b></span>
											<select class="form-control mySelectBoxClass" name="dewasa" id="train-dewasa" >
											  <option>0</option>
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
								</div>
							</div>
						</div>
						<!--End of train tab -->
						
						<div id="hotel2" class="tab-pane fade">
							<p hidden="true">hotel</p>
							<div class="col-md-4 pt-6">
								<span class="opensans size18" >Kota/Nama Hotel</span>
								<input type="text" class="form-control" placeholder="denpasar" id="query" name="query">
							</div>

							<div class="col-md-4">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>Check in</b></span>
										<input type="text" class="form-control mySelectCalendar" name="checkin" id="datepicker" placeholder="yyyy-mm-dd"/>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13"><b>Check out</b></span>
										<input type="text" class="form-control mySelectCalendar" name="checkout" id="datepicker2" placeholder="yyyy-mm-dd"/>
									</div>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="room1" >
									<div class="w50percent">
										<div class="wh90percent textleft right">
											<div class="w50percent">
												<div class="wh90percent textleft left">
													<span class="opensans size13"><b>Kamar</b></span>
													<select class="form-control mySelectBoxClass" id="kamar" name="room">
													  <option selected>1</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
													</select>
												</div>
											</div>							
											<div class="w50percentlast">
												<div class="wh90percent textleft right">
												<span class="opensans size13"><b>Malam</b></span>
													<select class="form-control mySelectBoxClass" id="malam" name="night">
													  <option selected>1</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
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
													<select class="form-control mySelectBoxClass" id="hotel-dewasa" name="dewasa">
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
													<select class="form-control mySelectBoxClass" id="hotel-anak" name="anak">
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
							</div>

						
						</div>
						<!--End of 2nd tab -->
						
					</div>
					
					<div class="searchbg2">
						
						<!--<form action="list4.html">-->
							<button type="submit" class="btn-search right mr30" id="search-button">Search</button>
						<!--</form>-->
					</div>
						
				</div>
			</div>
			
		  </div>
		</div>
		

		<!--<div class="lastminute2 lcfix">
			<div class="container lmc">	
				<img src="<?php echo BLUE_THEME_DIR;?>/images/rating-4.png" alt=""/><br/>
				LAST MINUTE: <b>Barcelona</b> - 2 nights - Flight+4* Hotel, Dep 27h Aug from $209/person<br/>
				<form action="list4.html">
					<button class="btn iosbtn" type="submit">Read more</button>
				</form>
			</div>
		</div>-->
		
		<div class="container cstyle06">	

			<div class="row anim2">
			  <div class="col-md-3">
				<h2>Paket Promo</h2> 
			  </div>
			  <div class="col-md-9">
			  
			  
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
									<h6 class="lh1 dark"><b><?php echo $promo[$i]['title'];?></b></h6>
									<h6 class="lh1 green">IDR <?php echo $promo[$i]['price'];?></h6>							
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
		
			<hr class="featurette-divider2">

			<div class="row anim3">
			  <div class="col-md-3">
				<h2>Paket<br/>Tur & Umrah</h2> 
			  </div>
			  <div class="col-md-9">
			  
				<!-- Carousel -->
				<div class="wrapper">
					<div class="list_carousel">		
						<ul id="foo2">
						<?php
							for($i=0;$i<sizeof($package);$i++){
						?>
							<li>
								<a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $package[$i]['id'];?>"><img src="<?php echo base_url();?>assets/uploads/posts/<?php echo $package[$i]['image'];?>" alt="" width="255px" height="179px"/></a>
								<div class="m1">
									<h6 class="lh1 dark"><b><?php echo $package[$i]['title'];?></b></h6>
									<h6 class="lh1 green">IDR <?php echo $package[$i]['price'];?></h6>							
								</div>
							</li>
						<?php } ?>					
						</ul>
						<div class="clearfix"></div>
						<a id="prev_btn2" class="prev" href="#"><img src="<?php echo BLUE_THEME_DIR;?>/images/spacer.png" alt=""/></a>
						<a id="next_btn2" class="next" href="#"><img src="<?php echo BLUE_THEME_DIR;?>/images/spacer.png" alt=""/></a>
					</div>
				</div>
			  
			  </div>
			</div>			

		</div>
	
		<!-- FOOTER -->
		<div class="footerbg">
			<div class="container">		
				<footer>
					<div class="footer">
						Alamat : <?php echo $company_address;?> <br/>
						Call Center : <?php echo $support_by_call;?>  <?php echo $support_by_email;?>   
                        <br/><br/>
						<a href="<?php echo prep_url($facebook_link);?>" class="social1"><img src="<?php echo BLUE_THEME_DIR;?>/images/icon-facebook.png" alt=""/></a>
						<a href="<?php echo prep_url($twitter_link);?>" class="social2"><img src="<?php echo BLUE_THEME_DIR;?>/images/icon-twitter.png" alt=""/></a>
						<a href="<?php echo prep_url($gplus_link);?>" class="social3"><img src="<?php echo BLUE_THEME_DIR;?>/images/icon-gplus.png" alt=""/></a>
						<a href="<?php echo prep_url($youtube_link);?>" class="social4"><img src="<?php echo BLUE_THEME_DIR;?>/images/icon-youtube.png" alt=""/></a>
						<br/><br/>
						Copyright &copy; 2014 <a href="<?php echo base_url();?>">Travelku.co</a> All rights reserved.
						<br/><br/>
						<a href="#top" id="gotop2" class="gotop"><img src="<?php echo BLUE_THEME_DIR;?>/images/spacer.png" alt=""/></a>
					</div>
				</footer>
			</div>	
		</div>
		
		

		
		
	</div>
    <!-- /WRAP -->
		
	
    <!-- Javascript -->
	
    <!-- This page JS -->
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/js-index3.js"></script>	
	
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
	});
	
	$( "#search-button" ).click(function() {
		//get selected tabs and find the hidden text
		var $tab = $('#myTabContent'), $active = $tab.find('.tab-pane.active'), text = $active.find('p:hidden').text();
		
		if(text=='flight'){
			var from = $('#flight-from').val();
			var to = $('#flight-to').val();
			var departing = $('#datepicker3').val();
			var returning = $('#datepicker4').val();
			var dewasa = $('#flight-dewasa').val();
			var anak = $('#flight-anak').val();
			var bayi = $('#flight-bayi').val();
			var trip = "";
			if(returning=="")
				trip = "single-trip";
			else	trip = "round-trip";
			
			var url = '<?php echo base_url();?>index.php/webfront/show_flight_list/flight?';
			var params = 'flight-trip='+trip+'&dari='+from+'&ke='+to+'&flight-pergi='+departing+'&flight-pulang='+returning+'&dewasa='+dewasa+'&anak='+anak+'&bayi='+bayi;
			
			window.location.href = url+params;
		}
		else if(text=='hotel'){
			var query = $('#query').val();
			var kamar = $('#kamar').val();
			var malam = $('#malam').val();
			var checkin = $('#datepicker').val();
			var checkout = $('#datepicker2').val();
			var dewasa = $('#hotel-dewasa').val();
			var anak = $('#hotel-anak').val();
			
			var url = '<?php echo base_url();?>index.php/webfront/show_hotel_tiketcom_list?';
			var params = 'query='+query+'&checkin='+checkin+'&checkout='+checkout+'&room='+kamar+'&night='+malam+'&dewasa='+dewasa+'&anak='+anak;
			
			window.location.href = url+params;
		}
	});

</script>	

	
  </body>
</html>
