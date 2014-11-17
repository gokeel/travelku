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
	<title>Paket Murah dari Travelku.co</title>
	
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
	<!-- end of tambahan -->
  </head>
  <body id="top" class="thebg" >
    
	
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
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php echo base_url();?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Paket</a></li>
					<li>/</li>
					<li><a href="#"><?php echo ucwords($this->uri->segment(3));?></a></li>
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

			<!-- FILTERS -->
			<div class="col-md-3 filters offset-0">
			
				<!-- TOP TIP -->
				<div class="filtertip">
					<div class="padding20">
						<!--<p class="size13"><span class="size18 bold counthotel">53</span> Hotels starting at</p>
						<p class="size30 bold">$<span class="countprice"></span></p>
						<p class="size13">Narrow results or <a href="#">view all</a></p>-->
						<p class="size13">Kami menyediakan</p>
						<p class="size30 bold">Tiket & Paket</p>
					</div>
					<div class="tip-arrow"></div>
				</div>
				<div class="line2"></div>
				<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#tiketing">
				  Tiket <span class="collapsearrow"></span>
				</button>
				<div id="tiketing" class="collapse in">
					<div class="bookfilters hpadding20">
						
							<div class="w100percent">
								<div class="radio">
								  <label>
									<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
									<!--<span class="hotel-ico"></span>--> Hotel
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
									Pesawat
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
									Kereta
								  </label>
								</div>
							</div>
							
							<div class="clearfix"></div><br/>
							
							<!-- HOTELS TAB -->
							<div class="hotelstab2 none">
								<span class="opensans size13">Kota/Nama Hotel</span>
								<input type="text" class="form-control" placeholder="denpasar">
								
								<div class="clearfix pbottom15"></div>
								
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Check in</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker" placeholder="yyyy-mm-dd"/>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13">Check out</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker2" placeholder="yyyy-mm-dd"/>
									</div>
								</div>
								
								<div class="clearfix pbottom15"></div>
								
								<div class="room1" >
									<div class="w50percent">
										<div class="wh90percent textleft right">
												<div class="w50percent">
													<div class="wh90percent textleft left">
														<span class="opensans size13"><b>Kamar</b></span>
														<select class="form-control mySelectBoxClass">
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
														<select class="form-control mySelectBoxClass">
														  <option>0</option>
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
										<div class="wh90percent textleft right ohidden">
											<div class="w50percent">
												<div class="wh90percent textleft left">
													<span class="opensans size13">Dewasa</span>
													<select class="form-control mySelectBoxClass">
													  <option selected>1</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
													</select>
												</div>
											</div>							
											<div class="w50percentlast">
												<div class="wh90percent textleft right ohidden">
												<span class="opensans size13">Anak</span>
													<select class="form-control mySelectBoxClass">
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
								<button type="submit" class="btn-search3">Search</button>
							</div>
							<!-- END OF HOTELS TAB -->
							
							<!-- FLIGHTS TAB -->
							<div class="flightstab2 none">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Dari</span>
										<select name="dari" id="flight-from" class="form-control"></select>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13">Ke</span>
										<select name="ke" id="flight-to" class="form-control"></select>
									</div>
								</div>
								
								
								<div class="clearfix pbottom15"></div>
								
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Berangkat</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker3" placeholder="yyyy-mm-dd"/>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13">Kembali</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker4" placeholder="yyyy-mm-dd"/>
									</div>
								</div>
								
								<div class="clearfix pbottom15"></div>
								
								<div class="room1" >
									<div class="w40percent">
										<div class="wh90percent textleft">
											<span class="opensans size13">Dewasa</span>
											<select class="form-control mySelectBoxClass">
											  <option>1</option>
											  <option selected>2</option>
											  <option>3</option>
											  <option>4</option>
											  <option>5</option>
											</select>
										</div>
									</div>

									<div class="w60percentlast">	
										<div class="wh90percent textleft right">
												<div class="w50percent">
													<div class="wh90percent textleft left">
														<span class="opensans size13"><b>Anak</b></span>
														<select class="form-control mySelectBoxClass">
														  <option selected>1</option>
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
														<select class="form-control mySelectBoxClass">
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
											</div>
									</div>
								</div><div class="clearfix"></div>
								<button type="submit" class="btn-search3">Search</button>
							</div>
							<!-- END OF FLIGHTS TAB -->
							
							<!-- TRAINS TAB -->
							<div class="vacationstab2 none">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Dari</span>
										<select name="dari" id="train-from" class="form-control"></select>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13">Ke</span>
										<select name="ke" id="train-to" class="form-control"></select>
									</div>
								</div>
								
								
								<div class="clearfix pbottom15"></div>
								
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Berangkat</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker5" placeholder="yyyy-mm-dd"/>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13">Kembali</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker6" placeholder="yyyy-mm-dd"/>
									</div>
								</div>
								
								<div class="clearfix pbottom15"></div>
								
								<div class="room1" >
									<div class="w40percent">
										<div class="wh90percent textleft">
											<span class="opensans size13">Dewasa</span>
											<select class="form-control mySelectBoxClass">
											  <option>1</option>
											  <option selected>2</option>
											  <option>3</option>
											  <option>4</option>
											  <option>5</option>
											</select>
										</div>
									</div>

									<div class="w60percentlast">	
										<div class="wh90percent textleft right">
												<div class="w50percent">
													<div class="wh90percent textleft left">
														<span class="opensans size13"><b>Anak</b></span>
														<select class="form-control mySelectBoxClass">
														  <option selected>1</option>
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
														<select class="form-control mySelectBoxClass">
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
											</div>
									</div>
								</div><div class="clearfix"></div>
								<button type="submit" class="btn-search3">Search</button>
							</div>
							<!-- END OF TRAINS TAB -->
							
					</div>
				</div>
				
				<div class="line2"></div>
				<!-- END OF BOOK FILTERS -->	
				<?php if($pesawat_status=='200'){?>
				<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#promo-pesawat">
				  Promo Penerbangan <span class="collapsearrow"></span>
				</button>
				<div id="promo-pesawat" class="collapse in">
					<div class="padding20">
						<div style="width:100%; font-size:12px">
                            <ul>
							<?php for($i=0;$i<sizeof($pesawat);$i++){?>
								<li> <span class="right-irfan color1">IDR <?php echo $pesawat[$i]['price'];?></span> <a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $pesawat[$i]['id'];?>"><?php echo $pesawat[$i]['title'];?></a> </li>
								
							<?php } ?>
							</ul>
                        </div>
					</div>
				</div>
				<div class="line2"></div>
				<?php } ?>
				
				<div class="clearfix"></div>
				<br/>
				<br/>
				<br/>
				
				
			</div>
			<!-- END OF FILTERS -->
			
			<!-- LIST CONTENT-->
			<div class="rightcontent col-md-9 offset-0">
			
				<div class="hpadding20">
					<!-- Top filters -->
					<span class="opensans normal dark size24 textcenter">Daftar Paket <?php echo ucwords($this->uri->segment(3));?></span>
					<!-- End of topfilters-->
				</div>
				<!-- End of padding -->
				
				<br/><br/>
				<div class="clearfix"></div>
				

				<div class="itemscontainer offset-1" id="list">
				</div>	
				<!-- End of offset1-->		

				<div class="hpadding20" id="pagination">
				</div>

			</div>
			<!-- END OF LIST CONTENT-->
			
		

		</div>
		<!-- END OF container-->
		
	</div>
	<!-- END OF CONTENT -->
	


	
	
	<!-- FOOTER -->

	<?php include_once('footer.php')?>
	
	
	
	

	
	

    
<script>
	$( window ).load(function() {
		load_all_airport('<?php echo base_url();?>index.php/flight/get_all_airport', "#flight-from");
		load_all_airport('<?php echo base_url();?>index.php/flight/get_all_airport', "#flight-to");
		
		load_all_station('<?php echo base_url();?>index.php/train/get_all_station', "#train-from");
		load_all_station('<?php echo base_url();?>index.php/train/get_all_station', "#train-to");
		
		load_posts();
		count_all_content();
	})
	function load_posts(){
		<?php 
			$par = $this->uri->segment(3);
			$limit_start = $this->uri->segment(4);
			$limit_end = $this->uri->segment(5);
		?>
		<?php 
			if($par == 'promo')
				echo 'var request = "'.base_url('index.php/webfront/get_post_promo/'.$limit_start.'/'.$limit_end).'";';
			else
				echo 'var request = "'.base_url('index.php/webfront/get_post_by_category/'.$par.'/'.$limit_start.'/'.$limit_end).'";';
		?>
		var d = new Date(); 
		var image_path = '<?php echo base_url();?>assets/uploads/posts/';
		$.ajax({
			type : "GET",
			async: false,
			url: request,
			dataType: "json",
			success:function(datajson){
				var div = $('#list');
				var line = 1; // for dividing lines, per line 3 contents
				for(var i=0; i<datajson.length; i++){
					var content_str = datajson[i].content;
					var content_cut = content_str.substring(0,200);
					//alert(content cut);
					div.append('<div class="col-md-4">\
							<div class="listitem">\
								<img src="<?php echo base_url();?>assets/uploads/posts/'+datajson[i].image_file+'?ver='+d.getTime()+'" alt=""/>\
								<div class="liover"></div>\
								<a class="fav-icon" href="#"></a>\
								<a class="book-icon" href="#"></a>\
							</div>\
							<div class="itemlabel2">\
								<div class="labelright">\
									<span class="green size18"><b>IDR <br/>'+currency_separator(datajson[i].price,'.')+'</b></span><br/><br/><br/>\
									<a class="bookbtn mt1" href="<?php echo base_url();?>index.php/webfront/show_package_content/'+datajson[i].id+'">Book</a>\
								</div>\
								<div class="labelleft">\
									<a href="<?php echo base_url();?>index.php/webfront/show_package_content/'+datajson[i].id+'"><b>'+datajson[i].title+'</b></a><br/><br/><br/>\
									<p class="grey">'+datajson[i].content+'</p>\
								</div>\
							</div>\
						</div>');
					if((i==(line*3)-1)){
						div.append('<div class="clearfix"></div>\
							<div class="offset-2"><hr class="featurette-divider3"></div>');
						line += 1;
					}
					if((i==(datajson.length-1) && i!=(line*3)-1))
						div.append('<div class="clearfix"></div>\
							<div class="offset-2"><hr class="featurette-divider3"></div>');
				}
			}
		});
	}
	
	function count_all_content(){
		<?php 
			$par = $this->uri->segment(3);
			$limit_start = $this->uri->segment(4);
			echo 'var limit_start = "'.$limit_start.'";';
			$count = $this->uri->segment(5);
		?>
		<?php 
			if($par == 'promo')
				echo 'var request = "'.base_url('index.php/webfront/count_post_promo/').'";';
			else
				echo 'var request = "'.base_url('index.php/webfront/count_post_by_category/'.$par).'";';
		?>
		$.ajax({
			type : "GET",
			async: false,
			url: request,
			dataType: "json",
			success:function(datajson){
				var content_per_page = 9;
				var page_number = Math.ceil(datajson.count / content_per_page);
				var div = $('#pagination');
				var top = '<ul class="pagination right paddingbtm20">';
				var bottom = '';
				if(page_number==1){
					top += '<li class="disabled"><a href="#">&laquo;</a></li>';
					bottom = '<li class="disabled"><a href="#">&raquo;</a></li></ul>';
				}
				if(limit_start==0 && page_number>1){
					top += '<li class="disabled"><a href="#">&laquo;</a></li>';
					bottom = '<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/<?php echo $par;?>/'+(page_number-1)*9+'/9">&raquo;</a></li></ul>';
				}
				if(limit_start==(page_number-1)*9 && page_number>1){
					top += '<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/<?php echo $par;?>/0/9">&laquo;</a></li>';
					bottom = '<li class="disabled"><a href="#">&raquo;</a></li></ul>';
				}
				if(limit_start>0 && limit_start<(page_number-1)*9 && page_number>1){
					top += '<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/<?php echo $par;?>/0/9">&laquo;</a></li>';
					bottom = '<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/<?php echo $par;?>/'+(page_number-1)*9+'/9">&raquo;</a></li></ul>';
				}
				var li = '';
				for(var i=1; i<=page_number; i++){
					if(limit_start==(i-1)*9)
						li = li + '<li class="disabled"><a href="<?php echo base_url();?>index.php/webfront/show_packages/<?php echo $par;?>/'+((i-1)*9)+'/9">'+i+'</a></li>';
					else
						li = li + '<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/<?php echo $par;?>/'+((i-1)*9)+'/9">'+i+'</a></li>';
				}
					
				
				div.append(top+li+bottom);
			}
		});
	}
</script>

<!-- Counter -->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/js-list3.js"></script>	

    <!-- Custom Select -->
	<script type='text/javascript' src='<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.customSelect.js'></script>
	
    <!-- JS Ease -->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.easing.js"></script>
	
    <!-- Custom functions -->
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/functions.js"></script>
	
    <!-- jQuery KenBurn Slider  -->
    <script type="text/javascript" src="<?php echo BLUE_THEME_DIR;?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    <!-- Counter -->	
    <script src="<?php echo BLUE_THEME_DIR;?>/assets/js/counter.js"></script>	
	
    <!-- Nicescroll  -->	
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery.nicescroll.min.js"></script>
	
    <!-- Picker -->	
	<script src="<?php echo BLUE_THEME_DIR;?>/assets/js/jquery-ui.js"></script>
	
    <!-- Bootstrap -->	
    <script src="<?php echo BLUE_THEME_DIR;?>/dist/js/bootstrap.min.js"></script>
	
  </body>
</html>