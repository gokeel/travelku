<?php
	define('BLUE_THEME_DIR', base_url('assets/themes/blue/'));
	define('GENERAL_CSS_DIR', base_url('assets/css'));
	define('GENERAL_JS_DIR', base_url('assets/js'));
?>
<?php
	$uri3 = $this->uri->segment(3);
	$uri4 = $this->uri->segment(4);
	$uri5 = $this->uri->segment(5);
?>
<!DOCTYPE html>
<html>
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Form Informasi Pemesan / Penumpang</title>
	
    <!-- Bootstrap -->
    <link href="<?php echo BLUE_THEME_DIR;?>/dist/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo BLUE_THEME_DIR;?>/assets/css/custom.css" rel="stylesheet" media="screen">
	
    <!-- Updates -->
    <link href="<?php echo BLUE_THEME_DIR;?>/updates/update1/css/style01.css" rel="stylesheet" media="screen">


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
    <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="<?php echo BLUE_THEME_DIR;?>/assets/css/font-awesome-ie7.css" media="screen" /><![endif]-->
	
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
					<li><a href="#">Tiket</a></li>
					<li>/</li>
					<li><a href="#">Form Pemesan / Penumpang</a></li>
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
			
		<form id="form-order" name="form-order" method="post" action="<?php 
								if ($uri3=='flight') echo base_url('index.php/order/tiketcom_add_flight_order');
								else if ($uri3=='train') echo base_url('index.php/order/tiketcom_add_train_order');
								else if ($uri3=='hotel') echo base_url('index.php/hotel/tiketcom_add_order_hotel');
								?>">	
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0" id="form-passenger">

			</div>
			<!-- END OF LEFT CONTENT -->			
		</form>	
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey" id="trip-summary">
					
					
					


				</div><br/>
				
				<!--<div class="pagecontainer2 needassistancebox">
					<div class="cpadding1">
						<span class="icon-help"></span>
						<h3 class="opensans">Need Assistance?</h3>
						<p class="size14 grey">Our team is 24/7 at your service to help you with your booking issues or answer any related questions</p>
						<p class="opensans size30 lblue xslim">1-866-599-6674</p>
					</div>
				</div>-->
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
	var admin_fee = 0;
	var data_country = [];
	$(window).load(function() {
		load_admin_fee();
		load_country();
		<?php
			if ($uri3=='flight')
				echo 'get_detail_flight();';
			else if ($uri3 == 'train')
				echo 'get_detail_train();';
			else if ($uri3 == 'hotel')
				echo 'get_detail_hotel();';
		?>
	});
	
	function load_admin_fee(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_administration_fee/<?php echo $uri3;?>',
			dataType: "json",
			success:function(datajson){
				if(datajson.nominal!='')
					admin_fee = parseInt(datajson.nominal);
			}
		});
	}
	
	function load_country(){
		
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/flight/list_country',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.items[0].listCountry.length;i++)
					data_country[i] = {value: datajson.items[0].listCountry[i].country_id, teks:datajson.items[0].listCountry[i].country_name};
			}
		});
	}
	
	function get_detail_flight(){
		<?php
			echo 'var flight_id_pergi = "'.$this->uri->segment(4).'";';
			echo 'var tanggal_pergi = "'.$this->uri->segment(5).'";';
			echo 'var flight_id_pulang = "'.$this->uri->segment(6).'";';
			echo 'var tanggal_pulang = "'.$this->uri->segment(7).'";';
		?>
		//get detail first flight
		var url_request = '';
		if(flight_id_pulang=='') //if single trip
			url_request = '<?php echo base_url();?>index.php/flight/get_flight_data/'+flight_id_pergi+'/'+tanggal_pergi;
		else
			url_request = '<?php echo base_url();?>index.php/flight/get_flight_data/'+flight_id_pergi+'/'+tanggal_pergi+'/'+flight_id_pulang+'/'+tanggal_pulang;
		
		$.ajax({
			type : "GET",
			url: url_request,
			async: false,
			dataType: "json",
			success:function(data){
				var total_price_adult_dep = data.items[0].departures.count_adult * data.items[0].departures.price_adult;
				var total_price_child_dep = data.items[0].departures.count_child * data.items[0].departures.price_child;
				var total_price_infant_dep = data.items[0].departures.count_infant * data.items[0].departures.price_infant;
				var total_price_dep = total_price_adult_dep + total_price_child_dep + total_price_infant_dep;// + admin_fee; //sementara tidak pake
				var total_price = total_price_dep;
				var dep_stop = data.items[0].departures.stop;
				var logo_stop = (dep_stop=='Langsung' ? '' : '<div class="wh33percent left"><div class="fcircle center"><span class="fstop"></span></div></div>');
				var dep_stop_city = data.items[0].departures.long_via;
				var return_summary = '';
				var return_price_summary = '';
				var input_return = '';
				//if returning create summary as well
				if(flight_id_pulang!=''){
					var ret_stop = data.items[0].returns.stop;
					var logo_ret_stop = (ret_stop=='Langsung' ? '' : '<div class="wh33percent left"><div class="fcircle center"><span class="fstop"></span></div></div>');
					var ret_stop_city = data.items[0].returns.long_via;
					
					return_summary = '<div>\
						<p>'+data.items[0].returns.airlines_name+' '+data.items[0].returns.flight_number+'</p><br/>\
						<div class="wh33percent left size12 bold dark">'+data.items[0].returns.flight_infos.flight_info[0].departure_city+'</div>\
						<div class="wh33percent left center size12 bold dark">'+ret_stop_city+'</div>\
						<div class="wh33percent right textright size12 bold dark">'+data.items[0].returns.flight_infos.flight_info[0].arrival_city+'</div>\
						<div class="clearfix"></div>\
						<div class="wh33percent left"><div class="fcircle"><span class="fdeparture"></span></div></div>\
						'+logo_ret_stop+'\
						<div class="wh33percent right"><div class="fcircle right"><span class="farrival"></span></div></div>\
						<div class="clearfix"></div><div class="fline2px"></div>\
						<div class="wh33percent left size12">'+data.items[0].returns.simple_departure_time+'</div>\
						<div class="wh33percent left center size12">'+data.items[0].returns.duration+'</div>\
						<div class="wh33percent right textright size12">'+data.items[0].returns.simple_arrival_time+'</div>\
						<div class="clearfix"></div>\
					</div>';
					var total_price_adult_ret = data.items[0].returns.count_adult * data.items[0].returns.price_adult;
					var total_price_child_ret = data.items[0].returns.count_child * data.items[0].returns.price_child;
					var total_price_infant_ret = data.items[0].returns.count_infant * data.items[0].returns.price_infant;
					var total_price_ret = total_price_adult_dep + total_price_child_dep + total_price_infant_dep;// + admin_fee; //sementara tidak pake
					total_price += total_price_ret;
					
					return_price_summary = 'Returning: Total <span class="right bold green">IDR '+currency_separator(total_price_ret,'.')+'</span>\
					<button type="button" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#collapse2"></button>\
					<div id="collapse2" class="collapse">\
						<div class="left size14">\
							Dewasa<br/>\
							Anak<br/>\
							Bayi\
						</div>\
						<div class="right size14">\
							IDR '+currency_separator(total_price_adult_ret,'.')+'<br/>\
							IDR '+currency_separator(total_price_child_ret,'.')+'<br/>\
							IDR '+currency_separator(total_price_infant_ret,'.')+'\
						</div><div class="clearfix"></div>\
					</div>';
					
					input_return = '<input type="hidden" name="ret_flight_id" value="'+flight_id_pulang+'">\
					<input type="hidden" name="airline_name_ret" value="'+data.items[0].returns.airlines_name+'">';
				}
				$('#trip-summary').empty();
				/* TRIP SUMMARY*/
				$('#trip-summary').append('<div class="padding20"><span class="opensans size18 dark bold">Trip Summary</span></div>\
								<div class="line3"></div>\
								<div class="hpadding30 margtop30">\
								<div>\
									<p>'+data.items[0].departures.airlines_name+' '+data.items[0].departures.flight_number+'</p><br/>\
									<div class="wh33percent left size12 bold dark">'+data.items[0].departures.flight_infos.flight_info[0].departure_city+'</div>\
									<div class="wh33percent left center size12 bold dark">'+dep_stop_city+'</div>\
									<div class="wh33percent right textright size12 bold dark">'+data.items[0].departures.flight_infos.flight_info[0].arrival_city+'</div>\
									<div class="clearfix"></div>\
									<div class="wh33percent left"><div class="fcircle"><span class="fdeparture"></span></div></div>\
									'+logo_stop+'\
									<div class="wh33percent right"><div class="fcircle right"><span class="farrival"></span></div></div>\
									<div class="clearfix"></div>\
									<div class="fline2px"></div>\
									<div class="wh33percent left size12">'+data.items[0].departures.simple_departure_time+'</div>\
									<div class="wh33percent left center size12">'+data.items[0].departures.duration+'</div>\
									<div class="wh33percent right textright size12">'+data.items[0].departures.simple_arrival_time+'</div>\
									<div class="clearfix"></div>\
								</div><br/><br/>\
								'+return_summary+'\
								<br/>\
								<div class="fdash mt10"></div><br/>\
								Departing: Total <span class="right bold green">IDR '+currency_separator(total_price_dep,'.')+'</span>\
								<button type="button" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#collapse1"></button>\
								<div id="collapse1" class="collapse">\
									<div class="left size14">\
										Dewasa<br/>\
										Anak<br/>\
										Bayi\
									</div>\
									<div class="right size14">\
										IDR '+currency_separator(total_price_adult_dep,'.')+'<br/>\
										IDR '+currency_separator(total_price_child_dep,'.')+'<br/>\
										IDR '+currency_separator(total_price_infant_dep,'.')+'\
									</div><div class="clearfix"></div>\
								</div>\
								<div class="fdash mt10"></div><br/>\
								'+return_price_summary+'\
								<br/><br/>\
							</div>\
							<div class="line3"></div>\
							<div class="padding30">\
								<span class="left size14 dark">Trip Total:</span>\
								<span class="right lred2 bold size18">IDR '+currency_separator(total_price,'.')+'</span>\
								<div class="clearfix"></div>\
							</div>\
					');
					
				/*create input contains data*/
				var token = "<?php echo $this->session->userdata('token');?>";
				$('#form-passenger').append('\
					<input type="hidden" name="token" value="'+token+'">\
					<input type="hidden" name="flight_id" value="'+flight_id_pergi+'">\
					<input type="hidden" name="adult" value="'+data.items[0].departures.count_adult+'">\
					<input type="hidden" name="child" value="'+data.items[0].departures.count_child+'">\
					<input type="hidden" name="infant" value="'+data.items[0].departures.count_infant+'">\
					<input type="hidden" name="airline_name" value="'+data.items[0].departures.airlines_name+'">\
					<input type="hidden" name="date_go" value="'+data.items[0].departures.flight_date+'">\
					'+input_return+'\
					');
				//belum
				/* create mandatory input for passengers and contact person */
				var div_input = $('#form-passenger');
				var input_string = '<div class="padding30 grey">';
				var separator_index = 1;
				var datepicker_index = 1;
				Object.getOwnPropertyNames(data.items[0].required).forEach(function(val, idx, array) {
					
					if(val.indexOf("separator") >= 0)
					{
						if(separator_index>1)
							input_string += '<br/><br/>';
						input_string += '<span class="size16px bold dark left">'+data.items[0].required[val]["FieldText"]+'</span>\
							<div class="roundstep right">'+separator_index+'</div>\
							<div class="clearfix"></div>\
							<div class="line4"></div>';
						separator_index += 1;
					}
					else {
						if(data.items[0].required[val]["type"]=="textbox")
						{
							input_string += '<span class="size13 dark">'+data.items[0].required[val]["FieldText"]+'</span>\
								<input type="text" class="form-control" name="'+val+'" placeholder="">';
						}
						else if ( data.items[0].required[val]["type"]=="datetime"){
							input_string += '<span class="size13 dark">'+data.items[0].required[val]["FieldText"]+'*</span>\
								<input type="text" class="form-control mySelectCalendar" id="datepicker'+datepicker_index+'" name="'+val+'" placeholder="yyyy-mm-dd"/>';
							datepicker_index += 1;
						}
						else if(data.items[0].required[val]["type"]=="combobox")
						{
							//add option
							if(val.indexOf("nationality") >= 0 || val.indexOf("passportissuing") >= 0){
								input_string += '<span class="size13 dark">'+data.items[0].required[val]["FieldText"]+'</span>\
									<select class="form-control mySelectBoxClass" name="'+val+'">';
								
								for(var i=0; i<data_country.length; i++)
									input_string += '<option value="'+data_country[i].value+'">'+data_country[i].teks+'<option/>';
									
								input_string += '</select>';
							}
							/*else if(val.indexOf("passportissuing") >= 0){
								input_string += '<span class="size13 dark">'+data.items[0].required[val]["FieldText"]+'</span>\
								<select class="form-control mySelectBoxClass" name="'+val+'">';
								
								for(var i=0; i<data_country.length; i++)
									input_string += '<option value="'+data_country[i].value+'">'+data_country[i].teks+'<option/>';
									
								input_string += '</select>';
							}*/
							else if(val.indexOf("parent") >= 0){
								input_string += '<span class="size13 dark">'+data.items[0].required[val]["FieldText"]+'</span>\
									<select class="form-control mySelectBoxClass" name="'+val+'">';
								
								for (var i=0;i<data.items[0].required[val]["resource"].length;i++){
									var id = Object.getOwnPropertyNames(data.items[0].required[val]["resource"][i]); // id parent
									input_string += '<option value="'+id+'">'+data.items[0].required[val]["resource"][i][id]+'</option>';
								}	
								input_string += '</select>';
							}
							else{
								input_string += '<span class="size13 dark">'+data.items[0].required[val]["FieldText"]+'</span>\
									<select class="form-control mySelectBoxClass" name="'+val+'">';
								
								for (var i=0;i<data.items[0].required[val]["resource"].length;i++){
									input_string += '<option value="'+data.items[0].required[val]["resource"][i].id+'">'+data.items[0].required[val]["resource"][i].name+'</option>';
								}	
								input_string += '</select>';
							}
						}
					}
				});
				input_string += '<br/><br/>\
					<span class="size16px bold dark left">Review and book your trip</span>\
					<div class="roundstep right">'+separator_index+'</div>\
					<div class="clearfix"></div>\
					<div class="line4"></div>\
					<div class="alert alert-info">\
					Perhatian! Mohon untuk membaca informasi berikut.<br/>\
					<p class="size12">• Tiket yang anda beli akan langsung berhubungan dengan pihak maskapai/kereta api/hotel terkait. Segala hal yang berhubungan dengan pembatalan atau perubahan jadwal atau yang lainnya, mengikuti dengan peraturan perusahaan terkait.</p>\
					</div>\
					By selecting to complete this booking I acknowledge that I have read and accept the <a href="#" class="clblue">rules & \
					restrictions</a> <a href="#" class="clblue">terms & conditions</a> , and <a href="#" class="clblue">privacy policy</a>.	<br/>\
					<button type="submit" class="bluebtn margtop20">Lanjut -> Issued & Pembayaran</button>';
					
				div_input.append(input_string+'</div>');
			}
		});
	}
	/*function get_detail_train(){
		<?php
			$train_id = $this->input->get('tid_dep', TRUE);
			echo 'var train_id = "'.$train_id.'";';
			$date_dep = $this->input->get('dep_date', TRUE);
			echo 'var date_dep = "'.$date_dep.'";';
			$from = $this->input->get('dari', TRUE);
			echo 'var from = "'.$from.'";';
			$to = $this->input->get('ke', TRUE);
			echo 'var to = "'.$to.'";';
			$adult = $this->input->get('adult', TRUE);
			echo 'var adult = "'.$adult.'";';
			$child = $this->input->get('child', TRUE);
			echo 'var child = "'.$child.'";';
			$infant = $this->input->get('infant', TRUE);
			echo 'var infant = "'.$infant.'";';
			$train_id_ret = $this->input->get('tid_ret', TRUE);
			echo 'var train_id_ret = "'.$train_id_ret.'";';
			$date_ret = $this->input->get('ret_date', TRUE);
			echo 'var date_ret = "'.$date_ret.'";';
			$subclass_dep = $this->input->get('sc_dep', TRUE);
			$subclass_ret = $this->input->get('sc_ret', TRUE);
			echo 'var subclass_dep = "'.$subclass_dep.'";';
			echo 'var subclass_ret = "'.$subclass_ret.'";';
			$request = 'dari='.$from.'&ke='.$to.'&train-pergi='.$date_dep.'&dewasa='.$adult.'&anak='.$child.'&bayi='.$infant.'&train-pulang='.$date_ret;
			echo 'var train_id = "'.$train_id.'";';
		?>
		$.ajax({
			type : "GET",
			url: "<?php echo base_url('index.php/train/search_trains');?>",
			data: "<?php echo $request;?>",
			cache: false,
			dataType: "json",
			success:function(data){
				for(var i=0; i<data.items[0].departures.result.length;i++){
					if (train_id == data.items[0].departures.result[i].train_id && subclass_dep==data.items[0].departures.result[i].subclass_name){
						var total_price_adult = adult * data.items[0].departures.result[i].price_adult;
						var total_price_child = child * data.items[0].departures.result[i].price_child;
						var total_price_infant = infant * data.items[0].departures.result[i].price_infant;
						var total_price = total_price_adult + total_price_child + total_price_infant;// + admin_fee;
						$('#detail').empty();
						/*create input contains data*/
	/*					$('#detail').append('\
						<input type="hidden" name="train_id" value="'+data.items[0].departures.result[i].train_id+'">\
						<input type="hidden" name="subclass" value="'+data.items[0].departures.result[i].subclass_name+'">\
						<input type="hidden" name="d" value="'+data.items[0].search_queries.dep_station+'">\
						<input type="hidden" name="a" value="'+data.items[0].search_queries.arr_station+'">\
						<input type="hidden" name="date" value="'+data.items[0].search_queries.date+'">\
						<input type="hidden" name="token" value="'+data.items[0].token+'">\
						<input type="hidden" name="adult" value="'+adult+'">\
						<input type="hidden" name="child" value="'+child+'">\
						<input type="hidden" name="infant" value="'+infant+'">\
						');
						/*fetch data*/
	/*					var table_start = '<table id="passenger">';
						var content = '<tr>\
									<td><p><strong>'+data.items[0].departures.result[i].train_name+' (subclass: '+data.items[0].departures.result[i].subclass_name+')</strong></p>\
										<p>Tanggal: '+date_dep+'</p>\
										<p>Departure-Arrival: '+data.items[0].departures.result[i].departure_time+'-'+data.items[0].departures.result[i].arrival_time+'</p>\
									</td>\
									<td style="padding-left:15px;">\
									<p><strong>Rincian Harga:</strong></p>\
										<ul style="list-style-type:square; margin-left: 20px;">\
										<li>Dewasa: '+adult+' x '+currency_separator(data.items[0].departures.result[i].price_adult, '.')+' = '+currency_separator(total_price_adult, '.')+'</li>\
										<li>Anak: '+child+' x '+currency_separator(data.items[0].departures.result[i].price_child, '.')+' = '+currency_separator(total_price_child, '.')+'</li>\
										<li>Bayi: '+infant+' x '+currency_separator(data.items[0].departures.result[i].price_infant, '.')+' = '+currency_separator(total_price_infant, '.')+'</li>\
										</ul>\
									<p>Total harus dibayar: IDR <strong>'+currency_separator(total_price, '.')+'</strong></p>\
									</td>\
								</tr>';
						var table_end = '</table>';
					}
					if(train_id_ret!=''){
						if (train_id_ret == data.items[0].returns.result[i].train_id  && subclass_ret==data.items[0].returns.result[i].subclass_name){
							var total_price_adult_ret = adult * data.items[0].returns.result[i].price_adult;
							var total_price_child_ret = child * data.items[0].returns.result[i].price_child;
							var total_price_infant_ret = infant * data.items[0].returns.result[i].price_infant;
							var total_price_ret = total_price_adult_ret + total_price_child_ret + total_price_infant_ret;// + admin_fee;
							
							/*create input contains data*/
	/*						$('#detail').append('\
							<input type="hidden" name="train_id_ret" value="'+data.items[0].returns.result[i].train_id+'">\
							<input type="hidden" name="subclass_ret" value="'+data.items[0].returns.result[i].subclass_name+'">\
							<input type="hidden" name="ret_date" value="'+data.items[0].search_queries.return_date+'">\
							');
							/*fetch data*/
	/*						content = content + '<tr>\
										<td style="padding-top:15px"><p><strong>'+data.items[0].returns.result[i].train_name+' (subclass: '+data.items[0].returns.result[i].subclass_name+')</strong></p>\
											<p>Tanggal: '+date_ret+'</p>\
											<p>Departure-Arrival: '+data.items[0].returns.result[i].departure_time+'-'+data.items[0].returns.result[i].arrival_time+'</p>\
										</td>\
										<td style="padding-top:15px";padding-left:15px;">\
										<p><strong>Rincian Harga:</strong></p>\
											<ul style="list-style-type:square; margin-left: 20px;">\
											<li>Dewasa: '+adult+' x '+currency_separator(data.items[0].returns.result[i].price_adult, '.')+' = '+currency_separator(total_price_adult, '.')+'</li>\
											<li>Anak: '+child+' x '+currency_separator(data.items[0].returns.result[i].price_child, '.')+' = '+currency_separator(total_price_child, '.')+'</li>\
											<li>Bayi: '+infant+' x '+currency_separator(data.items[0].returns.result[i].price_infant, '.')+' = '+currency_separator(total_price_infant, '.')+'</li>\
											</ul>\
										<p>Total harus dibayar: IDR <strong>'+currency_separator(total_price, '.')+'</strong></p>\
										</td>\
									</tr>';
						}
						
					}
				} // end for
				//create the details
				$('#detail').append(table_start+content+table_end);
				
				create_form('#pemesan', 1, 'con', 0, 'train');
				create_form('#passenger-adult', adult, 'a', 0, 'train');
				create_form('#passenger-child', child, 'c', 0, 'train');
				create_form('#passenger-infant', infant, 'i', adult, 'train');
			}
		});
	};
	*/
	function get_detail_hotel(){
		
		//fetch the get parameters
		<?php
			if($uri3=='hotel'){
				$gets = $this->input->get(NULL,TRUE);
				$inputs = '';
				foreach($gets as $key => $value)
					$inputs .= '<input type="hidden" name="'.$key.'" value="'.$value.'">';
				echo "var inputs = '".$inputs."';";
			}
			
		?>
		$('#detail').empty();
		/*create input contains data*/
		$('#detail').append(inputs);
		create_form('#pemesan', 1, 'con', 0, 'hotel');
	};
	
	function create_form(el_div, n, who, tot_adult, category){
		if (n>0){
			for (var i=0; i<n; i++){
				idx = i + 1;
				if (who=='con'){
					var div = '<p align="justify"><span class="judul18">Data Pemesan</span><br /><br /></p>\
								<div id="pemesan"></div>\
								<br /><br />';
					var top = '<fieldset style="margin-top: 10px;">\
						<table id="passenger">';
					var konten = '<tr>\
							<td>Titel<span style="color:red">*</span></td>\
							<td><select id="conSalutation" type="text" name="conSalutation"><option value="Mr">Tuan</option><option value="Mrs">Nyonya</option><option value="Ms">Nona</option></select></td>\
							<td>ID Card(KTP/SIM/Kartu Pelajar)<span style="color:red">*</span></td>\
							<td><input type="text" name="conid"></td>\
						</tr>\
						<tr>\
							<td>Nama Depan<span style="color:red">*</span></td>\
							<td><input type="text" name="conFirstName"></td>\
							<td>Nama Belakang</td>\
							<td><input type="text" name="conLastName"></td>\
						</tr>\
						<tr>\
							<td>Email<span style="color:red">*</span></td>\
							<td><input type="text" name="conEmailAddress"></td>\
							<td>Telepon/HP<span style="color:red">*</span></td>\
							<td><input type="text" name="conPhone"></td>\
						</tr>';
					var bottom = '</table></fieldset>';
					$('#input_fields').append(div+top+konten+bottom);
				}
				else if(who=='a'){
					var div = '<p align="justify"><span class="judul18">Data Penumpang Dewasa</span><br /><br /></p>\
								<div id="passenger-adult"></div>\
								<br /><br />';
					var top = '<fieldset style="margin-top: 10px;">\
						<table id="passenger">';
					if(category=="train"){
						var konten = '<tr>\
								<td>Titel<span style="color:red">*</span></td>\
								<td><select id="salutationAdult'+idx+'" name="salutationAdult'+idx+'"><option value="Mr">Tuan</option><option value="Mrs">Nyonya</option><option value="Ms">Nona</option></select></td>\
								<td>ID Card(KTP/ SIM/ Kartu Pelajar)<span style="color:red">*</span></td>\
								<td><input type="text" name="IdCardAdult'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Nama Lengkap<span style="color:red">*</span></td>\
								<td><input type="text" name="nameAdult'+idx+'"></td>\
								<td></td>\
								<td></td>\
							</tr>\
							<tr>\
								<td>Tanggal Lahir<span style="color:red">*</span></td>\
								<td><input type="text" name="birthDateAdult'+idx+'" id="birthDateAdult'+idx+'"></td>\
								<td>Telepon/HP<span style="color:red">*</span></td>\
								<td><input type="text" name="noHpAdult'+idx+'"></td>\
							</tr>';
					}
					var bottom = '</table></fieldset>';
					$('#input_fields').append(div+top+konten+bottom);
					//create_select_nationality('passportnationalitya'+idx);
					$(function() {
						$( "#birthDateAdult"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				}
				else if(who=='c'){
					var div = '<p align="justify"><span class="judul18">Data Penumpang Anak</span><br /><br /></p>\
								<div id="passenger-child"></div>\
								<br /><br />';
					var top = '<fieldset style="margin-top: 10px;">\
						<table id="passenger">';
					if(category=="train"){
						var konten = '<tr>\
								<td>Titel<span style="color:red">*</span></td>\
								<td><select id="salutationChild'+idx+'" name="salutationChild'+idx+'"><option value="Mstr">Tuan</option><option value="Miss">Nona</option></select></td>\
								<td>Nama Lengkap<span style="color:red">*</span></td>\
								<td><input type="text" name="nameChild'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Tanggal Lahir<span style="color:red">*</span></td>\
								<td><input type="text" name="birthDateChild'+idx+'" id="birthDateChild'+idx+'"></td>\
							</tr>';
					}
					var bottom = '</table></fieldset>';
					$('#input_fields').append(div+top+konten+bottom);
					//create_select_nationality('passportnationalityc'+idx);
					$(function() {
						$( "#birthDateChild"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				}
				else if(who=='i'){
					var div = '<p align="justify"><span class="judul18">Data Penumpang Bayi</span><br /><br /></p>\
								<div id="passenger-infant"></div>\
								<br /><br />';
					var top = '<fieldset style="margin-top: 10px;">\
						<table id="passenger">';
					if(category=="train"){
						var konten = '<tr>\
								<td>Titel<span style="color:red">*</span></td>\
								<td><select id="salutationInfant'+idx+'" name="salutationInfant'+idx+'"><option value="Mstr">Tuan</option><option value="Miss">Nona</option></select></td>\
								<td>Nama Lengkap<span style="color:red">*</span></td>\
								<td><input type="text" name="nameInfant'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Tanggal Lahir<span style="color:red">*</span></td>\
								<td><input type="text" name="birthDateInfant'+idx+'" id="birthDateInfant'+idx+'"></td>\
							</tr>';
					}
					var bottom = '</table></fieldset>';
					$('#input_fields').append(div+top+konten+bottom);
					//create_select_nationality('passportnationalityi'+idx);
					$(function() {
						$( "#birthDateInfant"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				}
				
			}
		}
	}
	
	function create_opt_parents(tot_adult){
		var str = '';
		for (var i=0; i<tot_adult; i++){
			idx = i+1;
			str = str + '<option value="'+idx+'">Dewasa '+idx+'</option>';
		}
		return str;
	}
	
	function create_select_nationality(name_input){
		var str = '<select name="'+name_input+'">';
		for(var i=0; i<data.length; i++){
			str = str + '<option value="'+data[i].value+'">'+data[i].teks+'</option>';
		}
		str = str + '</select>';
		$('#'+name_input).append(str);
	}
</script>

  </body>
</html>