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
	<title>Flight Return List</title>
	
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
					<li><a href="#">Pesawat</a></li>
					<li>/</li>
					<li><a href="#">
					<?php 
					echo ($this->input->get('flight-trip',TRUE)=='single-trip' ? 'Departing' : 'Returning');
					?></a></li>
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
				<div class="filtertip2">
					<div class="padding20">
						<p class="size13"><span class="size13 bold">19</span> offers with connection</p>
						<span class="size14">from</span> <span class="size30 bold green">$<span class="countpriceflights"></span></span>
						<p class="size13 mt10"><b>88</b> offers without connection</p>
					</div>
					<div class="tip-arrow2"></div>
				</div>
				
	

	
	
				<div class="bookfilters hpadding20">
					
					
						<div class="size30 dark">Flights</div>
						
						<table>
							<tr>
								<td>
									<div class="radio radiomargin0">
									  <label>
										<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
										Roundtrip&nbsp;&nbsp;&nbsp;
									  </label>
									</div>
								</td>
								<td>
									<div class="radio radiomargin0">
									  <label>
										<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
										One Way
									  </label>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="radio radiomargin0">
									  <label>
										<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
										Multiple destinations
									  </label>
									</div>
								</td>
							</tr>							
						</table>

						<div class="clearfix"></div><br/>
						
						<!-- ROUNDTRIP TAB -->
						<div class="hotelstab2 none">
							<div class="wh100percent">
								<div class="wh100percent textleft">
									<span class="opensans size13">Flying from</span>
									<input type="text" class="form-control" placeholder="City or airport">
								</div>
							</div>

							<div class="wh100percent">
								<div class="wh100percent textleft">
									<span class="opensans size13">To</span>
									<input type="text" class="form-control" placeholder="City or airport">
								</div>
							</div>
							
							
							<div class="clearfix pbottom15"></div>
							
							<div class="w50percent">
								<div class="wh90percent textleft">
									<span class="opensans size13">Departing</span>
									<input type="text" class="form-control mySelectCalendar" id="datepicker3" placeholder="mm/dd/yyyy"/>
								</div>
							</div>

							<div class="w50percentlast">
								<div class="wh90percent textleft right">
									<span class="opensans size13">Returning</span>
									<input type="text" class="form-control mySelectCalendar" id="datepicker4" placeholder="mm/dd/yyyy"/>
								</div>
							</div>
							
							<div class="clearfix pbottom15"></div>
							
							<div class="room1" >
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Adult</span>
										<select class="form-control mySelectBoxClass">
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
										<span class="opensans size13">Child</span>
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
							</div><div class="clearfix"></div><br/>
							<button type="submit" class="btn-search3">Search</button>
						</div>
						<!-- END OF ROUNDTRIP TAB -->
						
						<!-- ONEWAY TAB -->
						<div class="flightstab2 none">
							<div class="wh100percent">
								<div class="wh100percent textleft">
									<span class="opensans size13">Flying from</span>
									<input type="text" class="form-control" placeholder="City or airport">
								</div>
							</div>

							<div class="wh100percent">
								<div class="wh100percent textleft">
									<span class="opensans size13">To</span>
									<input type="text" class="form-control" placeholder="City or airport">
								</div>
							</div>
							
							
							<div class="clearfix pbottom15"></div>
							
							<div class="wh100percent">
								<div class="wh100percent textleft">
									<span class="opensans size13">Departing</span>
									<input type="text" class="form-control mySelectCalendar" id="datepicker3" placeholder="mm/dd/yyyy"/>
								</div>
							</div>


							
							<div class="clearfix pbottom15"></div>
							
							<div class="room1" >
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Adult</span>
										<select class="form-control mySelectBoxClass">
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
										<span class="opensans size13">Child</span>
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
							</div><div class="clearfix"></div>
							<button type="submit" class="btn-search3">Search</button>
						</div>
						<!-- END OF ONEWAY TAB -->
						
						<!-- MULTIPLE DESTINATIONS TAB -->
						<div class="vacationstab2 none">
						
							<span class="bold dark">Flight 1:</span><br/>
							<div class="w50percent">
								<div class="wh90percent textleft">
									<span class="opensans size13">Flying from</span>
									<input type="text" class="form-control" placeholder="City or airport">
								</div>
							</div>
							<div class="w50percentlast">
								<div class="wh90percent textleft right">
									<span class="opensans size13">To</span>
									<input type="text" class="form-control" placeholder="City or airport">
								</div>
							</div>
							<div class="clearfix pbottom15"></div>
							<div class="wh100percent">
								<div class="wh100percent textleft">
									<span class="opensans size13">Departing</span>
									<input type="text" class="form-control mySelectCalendar" id="datepicker3" placeholder="mm/dd/yyyy"/>
								</div>
							</div><br/>
							
							
							<span class="bold dark">Flight 2:</span><br/>
							<div class="w50percent">
								<div class="wh90percent textleft">
									<span class="opensans size13">Flying from</span>
									<input type="text" class="form-control" placeholder="City or airport">
								</div>
							</div>
							<div class="w50percentlast">
								<div class="wh90percent textleft right">
									<span class="opensans size13">To</span>
									<input type="text" class="form-control" placeholder="City or airport">
								</div>
							</div>
							<div class="clearfix pbottom15"></div>
							<div class="wh100percent">
								<div class="wh100percent textleft">
									<span class="opensans size13">Departing</span>
									<input type="text" class="form-control mySelectCalendar" id="datepicker3" placeholder="mm/dd/yyyy"/>
								</div>
							</div><br/>
							
							
							<span class="bold dark">Flight 3:</span><br/>
							<div class="w50percent">
								<div class="wh90percent textleft">
									<span class="opensans size13">Flying from</span>
									<input type="text" class="form-control" placeholder="City or airport">
								</div>
							</div>
							<div class="w50percentlast">
								<div class="wh90percent textleft right">
									<span class="opensans size13">To</span>
									<input type="text" class="form-control" placeholder="City or airport">
								</div>
							</div>
							<div class="clearfix pbottom15"></div>
							<div class="wh100percent">
								<div class="wh100percent textleft">
									<span class="opensans size13">Departing</span>
									<input type="text" class="form-control mySelectCalendar" id="datepicker3" placeholder="mm/dd/yyyy"/>
								</div>
							</div><br/>
							
							<div class="clearfix pbottom15"></div>
							
							<div class="room1" >
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Adult</span>
										<select class="form-control mySelectBoxClass">
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
										<span class="opensans size13">Child</span>
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
							</div><div class="clearfix"></div>
							<button type="submit" class="btn-search3">Search</button>
						</div>
						<!-- END OF MULTIPLE DESTINATIONS TAB -->
						

						
				</div>
				<!-- END OF BOOK FILTERS -->	
				
				
				
			</div>
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
	var flight_pergi ='';
	var flight_pulang = '';
	$( window ).load(function() {
		search_flight();
	});
	function check_total_passenger(trip, adult,child,infant){
		/* max each of adult,child,infant are 4, based on tiket.com's requirement*/
		/* for batavia and lion, max all passengers are 7 person*/
		/* for garuda and sriwijaya, max all passengers are 9 person*/
		/* it will be better if hellotraveler have policy that max passenger is 7.*/
		var response = 'ok';
		var max_flight = 7;
		var max_train = 4;
		var max;
		if(trip=='flight')
			max = max_flight;
		else if(trip=='train')
			max = max_train;
		if(adult==0 && child==0 && infant==0){
			if(trip=='flight')
				response = 'Harap pilih jumlah penumpang.';
			else if (trip=='train')
				response = 'Mohon lengkapi detil jadwal kereta api Anda.';
		}
		if(adult==0 && child>0)
			response = 'Penumpang dewasa minimal 1 orang.';
		if(infant>adult)
			response = 'Jumlah bayi tidak lebih dari jumlah dewasa / Satu anak minimal harus pergi dengan satu dewasa.';
		if(adult>4 || child>4 || infant>4)
			response = 'Jumlah penumpang tiap kategori dewasa/anak/bayi tidak boleh melebihi 4 orang.';
		if(adult+child+infant > max)
			response = 'Jumlah penumpang tidak boleh melebihi '+max+' orang';
		return response;
	}
	
	<?php
		function check_more_than_1_year_depart_date($compare_date){
			$datetime1 = date_create(date('Y-m-d'));
			$datetime2 = date_create($compare_date);
			$interval = date_diff($datetime1, $datetime2);
			return $interval->format('%a');
		}
	?>

	
	function search_flight(){
		var trip = '<?php echo $this->input->get('flight-trip',TRUE);?>';
		var dari = '<?php echo $this->input->get('dari',TRUE);?>';	
		var ke = '<?php echo $this->input->get('ke',TRUE);?>';
		var pergi = '<?php echo $this->input->get('flight-pergi',TRUE);?>';
		var pulang = '<?php echo $this->input->get('flight-pulang',TRUE);?>';
		var dewasa = '<?php echo $this->input->get('dewasa',TRUE);?>';
		var anak = '<?php echo $this->input->get('anak',TRUE);?>';
		var bayi = '<?php echo $this->input->get('bayi',TRUE);?>';
		
		$('#list').empty();
		$('#result-header').empty();
		$('#result-header').append('Hasil Pencarian Data Pesawat "Pulang Pergi" (Urutan dari harga termurah), '+ke+' - '+dari+' Tanggal Pulang: '+pulang);
		$('#result-header').append('<img id="progress" src="<?php echo IMAGES_DIR; ?>/spiffygif_34x34.gif" />');
		$("#progress").show();
		check_passenger = check_total_passenger('flight', parseInt(dewasa), parseInt(anak), parseInt(bayi));
		<?php
			$datetime1 = date_create(date('Y-m-d'));
			$datetime2 = date_create($this->input->get('flight-pulang', TRUE));
			$interval = date_diff($datetime1, $datetime2);
			$diff = intval($interval->format('%a'));
			echo 'var diff_date = '.$diff.';';
		?>
		if(check_passenger!='ok'){
			$('#result-header').append('<p style="color:red">'+check_passenger+'</p>');
		}
		else{
			if(diff_date>360)
				$('#result-header').append('<p style="color:red">Tanggal pulang tidak lebih dari 360 hari</p>');
			else{
				$.ajax({
					type : "GET",
					url: '<?php echo base_url();?>index.php/flight/search_flights',
					data: 'dari='+dari+'&ke='+ke+'&flight-pergi='+pergi+'&flight-pulang='+pulang+'&dewasa='+dewasa+'&anak='+anak+'&bayi='+bayi,
					cache: false,
					dataType: "json",
					success:function(data){
						if(data.items[0].diagnostic.status=="200"){
							if(data.items[0].returns.result.length==0){
								$('#result-header').append('<p>Maaf, data tidak ada untuk rute ini.<p>');
							} 
							else{
								var div = $("#list");
								var collapse_index = 0;
								for(var i=0; i<data.items[0].returns.result.length;i++){
									<?php
										$url = base_url('index.php/webfront/form_passenger_tiket/flight/'.$this->input->get('flight_id').'/'.$this->input->get('dep_date'));
									?>
									var next_url = '<?php echo $url;?>/'+data.items[0].returns.result[i].flight_id+'/'+data.items[0].search_queries.ret_date;
									collapse_index += 1;
									var airline_name = data.items[0].returns.result[i].airlines_name;
									div.append('<div id="ticketid0123" class="offset-2" >\
										<div class="fgreenline"><b>'+data.items[0].ret_det.dep_airport.short_name+'</b> '+data.items[0].ret_det.dep_airport.business_name+' <span class="farrow"></span> <b>'+data.items[0].ret_det.arr_airport.short_name+'</b> '+data.items[0].ret_det.arr_airport.business_name+'</div>\
											<div class="frow1">\
												<ul class="flightstable mt20">\
													<li class="ft1">\
														<img src="<?php echo base_url();?>assets/images/logomaskapai/'+airline_name.toLowerCase()+'.jpg" width="120" height="50" "  alt=""><br/>\
														<span class="grey">'+data.items[0].returns.result[i].airlines_name+'</span><br/>\
													</li>\
													<li class="ft2">\
														Departure<br/>\
														<span class="grey">'+data.items[0].ret_det.formatted_date+'</span><br/>\
														<span class="size16 dark bold">'+data.items[0].returns.result[i].simple_departure_time+'</span><br/>\
													</li>\
													<li class="ft3">\
														Arrival<br/>\
														<span class="grey"></span><br/>\
														<span class="size16 dark bold">'+data.items[0].returns.result[i].simple_arrival_time+'</span><br/>\
													</li>\
													<li class="ft4">\
														Flight<br/>\
														<span class="grey">'+data.items[0].returns.result[i].flight_number+'</span><br/>\
													</li>\
													<li class="ft5">\
														<button class="lightbtn mt1" type="button" data-toggle="collapse" data-target="#collapse'+collapse_index+'">More</button>\
													</li>\
												</ul>\
												<div class="clearfix"></div><br/><br/>\
												</div>\
												<div  class="collapse frowexpand" id="collapse'+collapse_index+'">\
													<ul class="flightstable mt20">\
														<li class="ft1">\
														</li>\
														<li class="ft2">\
															Durasi<br/>\
															<b>'+data.items[0].returns.result[i].duration+'</b><br/>\
														</li>\
														<li class="ft3">Transit<br/><span class="grey">'+data.items[0].returns.result[i].stop+'</span><br/><br/>\
														</li>\
														<li class="ft4">Dewasa IDR '+currency_separator(parseInt(data.items[0].returns.result[i].price_adult),'.')+'<br/><br/>Anak IDR '+currency_separator(parseInt(data.items[0].returns.result[i].price_child),'.')+'<br/><br/>Bayi IDR '+currency_separator(parseInt(data.items[0].returns.result[i].price_infant),'.')+'<br/><br/>\
														</li>\
														<li class="ft5"><button class="hidebtn mt1" type="button" data-toggle="collapse" data-target="#collapse'+collapse_index+'">Hide</button>\
														</li>\
													</ul>\
													<div class="clearfix"></div><br/><br/>\
												</div>\
												<div class="fselect">\
													<span class="size12 lightgrey">Total Harga</span> <span class="size18 green bold">IDR '+currency_separator(parseInt(data.items[0].returns.result[i].price_value),'.')+'</span>&nbsp; <a href="'+next_url+'"><button class="selectbtn mt1" type="button">Select</button></a>	\
												</div>');
									div.append('<div class="clearfix"></div><div class="offset-2"><hr class="featurette-divider3"></div>');
								}
							}	
						}
						else {
							$('#result-header').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>');
						}
						$("#progress").hide();
					}
				})
			}		
		}
	}
</script>	

</body>
</html>
