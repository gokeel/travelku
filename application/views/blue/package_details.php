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
	<title>Detil Paket</title>
	
    <!-- Bootstrap -->
    <link href="<?php echo BLUE_THEME_DIR;?>/dist/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo BLUE_THEME_DIR;?>/assets/css/custom.css" rel="stylesheet" media="screen">


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
	
	<!-- bin/jquery.slider.min.css -->
	<link rel="stylesheet" href="<?php echo BLUE_THEME_DIR;?>/plugins/jslider/css/jslider.css" type="text/css">
	<link rel="stylesheet" href="<?php echo BLUE_THEME_DIR;?>/plugins/jslider/css/jslider.round-blue.css" type="text/css">
	
    <!-- jQuery-->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.v2.0.3.js"></script>
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery-ui.js"></script>	
	
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
	<script src="<?php echo GENERAL_JS_DIR;?>/jquery.htmlClean.js"></script>
	<script src="<?php echo GENERAL_JS_DIR;?>/jquery.htmlClean.min.js"></script>
	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
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
					<li><a href="#">Paket</a></li>
					<li>/</li>
					<li><a href="#">Detil Konten</a></li>
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0">	

			<!-- SLIDER -->
			<div class="col-md-8 details-slider">
			
				<div id="c-carousel">
				<div id="wrapper">
				<div id="inner">
					<div id="caroufredsel_wrapper2">
						<div id="carousel">
							<!--<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide1.jpg" alt=""/>
							<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide2.jpg" alt=""/>
							<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide3.jpg" alt=""/>
							<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide4.jpg" alt=""/>
							<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide5.jpg" alt=""/>
							<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide6.jpg" alt=""/>-->
							<?php
							for($i=0; $i<sizeof($images); $i++){
							?>
								<img src="<?php echo base_url();?>/assets/uploads/posts/<?php echo $images[$i];?>" alt=""/>
							<?php } ?>
						</div>
					</div>
					<div id="pager-wrapper">
						<div id="pager">
							<?php
							for($i=0; $i<sizeof($images); $i++){
							?>
								<img src="<?php echo base_url();?>/assets/uploads/posts/<?php echo $images[$i];?>" width="120" height="68" alt=""/>
							<?php } ?>
							<!--<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide1.jpg" width="120" height="68" alt=""/>
							<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide2.jpg" width="120" height="68" alt=""/>
							<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide3.jpg" width="120" height="68" alt=""/>
							<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide4.jpg" width="120" height="68" alt=""/>
							<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide5.jpg" width="120" height="68" alt=""/>
							<img src="<?php echo BLUE_THEME_DIR;?>/images/details-slider/slide6.jpg" width="120" height="68" alt=""/>	-->
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<button id="prev_btn2" class="prev2"><img src="<?php echo BLUE_THEME_DIR;?>/images/spacer.png" alt=""/></button>
				<button id="next_btn2" class="next2"><img src="<?php echo BLUE_THEME_DIR;?>/images/spacer.png" alt=""/></button>		
					
		</div>
		</div> <!-- /c-carousel -->
			
			
			
			
			
			</div>
			<!-- END OF SLIDER -->			
			
			<!-- RIGHT INFO -->
			<div class="col-md-4 detailsright offset-0">
				<div class="padding20">
					<h4 class="lh1"><?php echo $post_title;?></h4>
					<?php if($post_star_rating<>''){?><img src="<?php echo BLUE_THEME_DIR;?>/images/smallrating-<?php echo $post_star_rating;?>.png" alt=""/><?php } ?>
				</div>
				
				<div class="line3"></div>
				
				<div class="hpadding20">
					<h2 class="opensans slim green2"><?php echo $currency;?> <?php echo $post_price;?></h2>
				</div>
				
				<div class="line3 margtop20"></div>
				
				<div class="col-md-6 bordertype1 padding20">
					<img src="<?php echo BLUE_THEME_DIR;?>/images/user-rating-<?php if($review_status=='200') echo $user_rating_rounded; else echo '0';?>.png" alt=""/><br/>
					<?php if($review_status=='200') echo $total_review; else echo '0';?> review
				</div>
				<div class="col-md-6 bordertype2 padding20">
					<span class="opensans size30 bold grey2"><?php if($review_status=='200') echo $user_rating; else echo '0';?></span>/5<br/>
					Rating pelanggan
				</div>
				<div class="clearfix"></div>
				<div class="hpadding50">
					<h2 class="opensans slim green2"><?php echo $post_mini_slogan;?></h2>
				</div>
				
				<div class="line3 margtop20"></div>
				<!--<div class="col-md-12 bordertype3">
					<span class="opensans size30 bold grey2"><?php echo $post_mini_slogan;?></span><br/>
					segera pesan!
				</div>
				<div class="col-md-6 bordertype3">
					<a href="#" class="grey">+Add review</a>
				</div>-->
				<div class="clearfix"></div><br/>
				
				<div class="hpadding20">
					<br/><br/><a href="<?php echo base_url();?>index.php/webfront/package_buy_form/<?php echo $post_id;?>" class="booknow margtop20 btnmarg">Book now</a>
				</div>
			</div>
			<!-- END OF RIGHT INFO -->

		</div>
		<!-- END OF container-->
		
		<div class="container mt25 offset-0">

			<div class="col-md-8 pagecontainer2 offset-0">
				<div class="cstyle10"></div>
		
				<ul class="nav nav-tabs" id="myTab">
					<li onclick="mySelectUpdate()" class="active"><a data-toggle="tab" href="#summary"><span class="summary"></span><span class="hidetext">Summary</span>&nbsp;</a></li>
					<li onclick="mySelectUpdate();" class=""><a data-toggle="tab" href="#reviews"><span class="reviews"></span><span class="hidetext">Reviews</span>&nbsp;</a></li>
				</ul>			
				<div class="tab-content4" >
					<!-- TAB 1 -->				
					<div id="summary" class="tab-pane fade active in">
						<script>
							$('#summary').append($.htmlClean('<?php echo $post_content;?>', {format:true}));
						</script>
					</div>
					
					<!-- TAB 5 -->					
					<div id="reviews" class="tab-pane fade ">
						<?php if($review_status=='200'){?>
						<div class="hpadding20">
							<div class="col-md-4 offset-0">
								<span class="opensans dark size60 slim lh3 "><?php echo $user_rating;?>/5</span><br/>
								<img src="<?php echo BLUE_THEME_DIR;?>/images/user-rating-<?php echo $user_rating_rounded;?>.png" alt=""/>
							</div>
							<div class="col-md-8 offset-0">
								<div class="progress progress-striped">
								  <div class="progress-bar progress-bar-success" style="width:<?php echo $user_rating_percentage;?>%" role="progressbar" aria-valuenow="<?php echo $user_rating_percentage;?>" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only"><?php echo $user_rating;?> dari 5</span>
								  </div>
								</div>		
								<!--<div class="progress progress-striped">
								  <div class="progress-bar progress-bar-success wh100percent" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">100% of guests recommend</span>
								  </div>
								</div>-->
								<div class="clearfix"></div>
								Rating berdasarkan semua feedback dari pelanggan
							</div>			
							<div class="clearfix"></div>
							<br/>
							<span class="opensans dark size16 bold">Average ratings</span>
						</div>
						
						<div class="line4"></div>
					<?php
						for($i=0;$i<sizeof($review);$i++){
					?>
						<div class="hpadding20">							
							<div class="col-md-4 offset-0 center">
								<div class="padding20">
									<div class="bordertype5">
										<div class="circlewrap">
											<img src="<?php echo BLUE_THEME_DIR;?>/images/user-avatar.jpg" class="circleimg" alt=""/>
											<span><?php echo $review[$i]['score'];?></span>
										</div>
										<span class="dark">oleh <?php echo $review[$i]['name'];?></span><br/>
										
									</div>
									
								</div>
							</div>
							<div class="col-md-8 offset-0">
								<div class="padding20">
									<span class="opensans size16 dark"><?php echo $review[$i]['title'];?></span><br/>
									<span class="opensans size13 lgrey">Diposting tanggal <?php echo $review[$i]['date'];?></span><br/>
									<p><?php echo $review[$i]['content'];?></p>	
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
							
						<div class="line2"></div>
					<?php } //end fetching reviews
					} // end checking status 200
					
					?>
						<!-- END OF REVIEW -->
						<br/>
						<br/>
						<div class="hpadding20">
							<span class="opensans dark size16 bold">Reviews</span>
						</div>
						
						<div class="line2"></div>
						<?php
							if($this->uri->segment(4)=='success')
								echo '<p class="grey">Review anda telah kami terima dan akan segera tampil.</p>';
							else if($this->uri->segment(4)=='failed')
								echo '<p class="grey">Gagal memberi review.</p>';
						?>

						<div class="wh33percent left center">
							<br/>
							<ul class="jslidetext2">
								<li>Nama</li>
								<li>Skor Evaluasi</li>
								<li>Judul</li>
								<li>Komentar</li>
							</ul>
						</div>
						<div class="wh66percent right offset-0">
							<div class="padding20 relative wh70percent" id="add-review">
								
								<form method="post" action="<?php echo base_url();?>index.php/webfront/post_review">
									<input type="hidden" name="post_id" value="<?php echo $post_id;?>">
									<input type="text" class="form-control margtop10" placeholder="" name="reviewer_name">
									<select class="form-control mySelectBoxClass margtop10" name="evaluation_score">
									  <option value="5" selected>Wonderful!</option>
									  <option value="4">Good</option>
									  <option value="3">Neutral</option>
									  <option value="2">Not recommended!</option>
									</select>
									<input type="text" class="form-control margtop10" placeholder="" name="evaluation_title">
									
									<textarea class="form-control margtop10" rows="3" name="evaluation_content"></textarea>
									
									<div class="clearfix"></div>
									<button type="submit" class="btn-search4 margtop20">Submit</button>	
								</form>
								<br/>
								<br/>
								<br/>
								<br/>
								
							</div>							
						</div>
						<div class="clearfix"></div>

					</div>								
				</div>
			</div>
			
			<div class="col-md-4" >
				<?php if($review_status=='200'){?>
				<div class="pagecontainer2 testimonialbox">
					<div class="cpadding0 mt-10">
						<span class="icon-quote"></span>
						<p class="opensans size16 grey2"><?php echo $review[0]['content'];?><br/>
						<span class="lato lblue bold size13"><i>oleh <?php echo $review[0]['name'];?></i></span></p> 
					</div>
				</div>
				<br/>
				<?php } ?>
				
				<?php include_once('box_call_support.php');?>				
			
			</div>
		</div>
		
		
		
	</div>
	<!-- END OF CONTENT -->
	
	
	


	
	
	<!-- FOOTER -->

	<?php include_once('footer.php')?>
	
	
	<!-- Javascript -->	
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/js-details.js"></script>
	
	<!-- Googlemap -->	
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/initialize-google-map.js"></script>
	
    <!-- Custom Select -->
	<script type='text/javascript' src='<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.customSelect.js'></script>
	
    <!-- Custom functions -->
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/functions.js"></script>

    <!-- Nicescroll  -->	
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.nicescroll.min.js"></script>
	
    <!-- jQuery KenBurn Slider  -->
    <script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	
    <!-- CarouFredSel -->
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.touchSwipe.min.js"></script>
	
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.transit.min.js"></script>
	<script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>

    <!-- Counter -->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/counter.js"></script>	
	
    <!-- Carousel-->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/initialize-carousel-detailspage.js"></script>		
	
    <!-- Js Easing-->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.easing.js"></script>

	
    <!-- Bootstrap-->	
    <script src="<?php echo BLUE_THEME_DIR;?>/dist/js/bootstrap.min.js"></script>
	
		
	
  </body>
</html>
