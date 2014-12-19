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
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/<?php echo $favicon_frontend_logo;?>">
	
	<link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js" />
	<link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js" />
	<link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js" />
	<link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js" />
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
								if($running_system_order=='tiketcom'){
									if ($uri3=='flight') echo base_url('index.php/order/tiketcom_add_flight_order');
									else if ($uri3=='train') echo base_url('index.php/order/tiketcom_add_train_order');
									else if ($uri3=='hotel') echo base_url('index.php/hotel/tiketcom_add_order_hotel');
								}
								else if($running_system_order=='internal'){
									if ($uri3=='flight') echo base_url('index.php/order/add_flight_order');
									else if ($uri3=='train') echo base_url('index.php/order/add_train_order');
									else if ($uri3=='hotel') echo base_url('index.php/order/add_hotel_order');
								}
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
				if(data.items[0].diagnostic.status=="200"){
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
						var total_price_ret = total_price_adult_ret + total_price_child_ret + total_price_infant_ret;// + admin_fee; //sementara tidak pake
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
							<span class="left size14 dark">Trip Total:</span><br/><span style="font-size:9px"><i>*sebelum kena pajak dan biaya servis</i></span>\
							<span class="right lred2 bold size18">IDR '+currency_separator(total_price,'.')+'</span>\
							<div class="clearfix"></div>\
						</div>\
					');
					var input_dep_additional = '<input type="hidden" name="route" value="'+data.items[0].departures.flight_infos.flight_info[0].departure_city+' - '+data.items[0].departures.flight_infos.flight_info[0].arrival_city+'">\
						<input type="hidden" name="time_travel" value="'+data.items[0].departures.simple_departure_time+' - '+data.items[0].departures.simple_arrival_time+'">\
						<input type="hidden" name="total_price" value="'+data.items[0].departures.price_value+'">\
						<input type="hidden" name="admin_fee" value="10000">\
						<input type="hidden" name="price_adult" value="'+data.items[0].departures.price_adult+'">\
						<input type="hidden" name="price_child" value="'+data.items[0].departures.price_child+'">\
						<input type="hidden" name="price_infant" value="'+data.items[0].departures.price_infant+'">\
						';
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
						'+input_dep_additional+'\
						');
					//belum
					/* create mandatory input for passengers and contact person */
					var div_input = $('#form-passenger');
					var input_string = '<div class="padding30 grey">';
					var separator_index = 1;
					var datepicker_index = 1;
					var adult = 0;
					Object.getOwnPropertyNames(data.items[0].required).forEach(function(val, idx, array) {
						
						if(val.indexOf("separator") >= 0)
						{
							if(separator_index>1)
								input_string += '<br/><br/>';
							input_string += '<span class="size16px bold dark left">'+data.items[0].required[val]["FieldText"]+'</span>\
								<div class="roundstep right">'+separator_index+'</div>\
								<div class="clearfix"></div>\
								<div class="line4"></div>';
							if(val.indexOf("separator_adult") >= 0){
								adult+=1;
								
							}
							
							separator_index += 1;
						}
						else {
							if(data.items[0].required[val]["type"]=="textbox")
							{
								var teks = data.items[0].required[val]["FieldText"];
								var tambahan = '';
								if(teks.indexOf("Nama") >= 0)
									tambahan = 'onBlur="return isValidCharacter(this.value)"';
								if(teks.indexOf("Telepon") >= 0)
									tambahan = 'onBlur="return isValidNumber(this.value)"';
								input_string += '<span class="size13 dark">'+data.items[0].required[val]["FieldText"]+'</span>\
									<input type="text" class="form-control" name="'+val+'" placeholder="" style="width:75%" maxlength="50" '+tambahan+' required>';
								if(teks=="Nama Belakang" && separator_index > 2)
									input_string += '<span class="size13 dark">ID (KTP/SIM)</span>\
									<input type="text" class="form-control" name="ida'+adult+'" placeholder="" style="width:75%" maxlength="20" required>';
							}
							else if ( data.items[0].required[val]["type"]=="datetime"){
								input_string += '<span class="size13 dark">'+data.items[0].required[val]["FieldText"]+'*</span>\
									<input type="text" class="form-control mySelectCalendar" id="tanggal'+datepicker_index+'" name="'+val+'" placeholder="yyyy-mm-dd" style="width:75%" required>';
								datepicker_index += 1;
							}
							else if(data.items[0].required[val]["type"]=="combobox")
							{
								//add option
								if(val.indexOf("nationality") >= 0 || val.indexOf("passportissuing") >= 0){
									input_string += '<span class="size13 dark">'+data.items[0].required[val]["FieldText"]+'</span>\
										<select style="width:75%" required class="form-control mySelectBoxClass" name="'+val+'">';
									//input_string += '<option value="">--Pilih '+data.items[0].required[val]["FieldText"]+'--</option>';
									for(var i=0; i<data_country.length; i++){
										if(data_country[i].value=="id")
											input_string += '<option value="'+data_country[i].value+'" selected>'+data_country[i].teks+'</option>';
										else
											input_string += '<option value="'+data_country[i].value+'">'+data_country[i].teks+'</option>';
									}
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
										<select style="width:75%" required class="form-control mySelectBoxClass" name="'+val+'">';
									input_string += '<option value="">--Pilih '+data.items[0].required[val]["FieldText"]+'--</option>';
									for (var i=0;i<data.items[0].required[val]["resource"].length;i++){
										var id = Object.getOwnPropertyNames(data.items[0].required[val]["resource"][i].id); // id parent
										input_string += '<option value="'+id+'">'+data.items[0].required[val]["resource"][i].name+'</option>';
									}	
									input_string += '</select>';
								}
								else{
									input_string += '<span class="size13 dark">'+data.items[0].required[val]["FieldText"]+'</span>\
										<select style="width:75%" required class="form-control mySelectBoxClass" name="'+val+'">';
									input_string += '<option value="">--Pilih '+data.items[0].required[val]["FieldText"]+'--</option>';
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
						<button type="submit" class="bluebtn margtop20">Lanjut Booking</button>';
						
					div_input.append(input_string+'</div>');
					for(x=1;x<=datepicker_index;x++){
						$(function() {
							$( "#tanggal"+x ).datepicker({"dateFormat": "yy-mm-dd"});
						});	
					}
				}
				else{
					$('#form-passenger').append('<div class="alert alert-info">\
						Pesan Kesalahan<br/>\
						<p class="size12">'+data.items[0].diagnostic.error_msgs+'</p>\
						</div>');
				}
			}
		});
	}
	function get_detail_train(){
		<?php
			$train_id = $this->input->get('tid_dep', TRUE);
			echo 'var train_id = "'.$train_id.'";';
			$date_dep = $this->input->get('dep_date', TRUE);
			echo 'var date_dep = "'.$date_dep.'";';
			$from = $this->input->get('dari', TRUE);
			echo 'var from = "'.$from.'";';
			$to = $this->input->get('ke', TRUE);
			echo 'var to = "'.$to.'";';
			$adult = $this->input->get('dewasa', TRUE);
			echo 'var adult = "'.$adult.'";';
			$child = $this->input->get('anak', TRUE);
			echo 'var child = "'.$child.'";';
			$infant = $this->input->get('bayi', TRUE);
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
		$('#form-passenger').empty();
		var total_price = 0;
		$.ajax({
			type : "GET",
			url: "<?php echo base_url('index.php/train/search_trains');?>",
			data: "<?php echo $request;?>",
			cache: false,
			async: false,
			dataType: "json",
			success:function(data){
				for(var i=0; i<data.items[0].departures.result.length;i++){
					if (train_id == data.items[0].departures.result[i].train_id && subclass_dep==data.items[0].departures.result[i].subclass_name){
						var total_price_adult_dep = adult * data.items[0].departures.result[i].price_adult;
						var total_price_child_dep = child * data.items[0].departures.result[i].price_child;
						var total_price_infant_dep = infant * data.items[0].departures.result[i].price_infant;
						var total_price_dep = total_price_adult_dep + total_price_child_dep + total_price_infant_dep;// + admin_fee;
						total_price += total_price_dep;
						
						var departure_summary = '<div>\
								<p>'+data.items[0].departures.result[i].train_name+'</p><br/>\
								<div class="wh33percent left size12 bold dark">'+data.items[0].search_queries.dep_city+'</div>\
								<div class="wh33percent left center size12 bold dark">Durasi</div>\
								<div class="wh33percent right textright size12 bold dark">'+data.items[0].search_queries.arr_city+'</div>\
								<div class="clearfix"></div>\
								<div class="wh33percent left"><div class="fcircle"><span class="fdeparture"></span></div></div>\
								<div class="wh33percent right"><div class="fcircle right"><span class="farrival"></span></div></div>\
								<div class="clearfix"></div>\
								<div class="fline2px"></div>\
								<div class="wh33percent left size12">'+data.items[0].departures.result[i].departure_time+'</div>\
								<div class="wh33percent left center size12">'+data.items[0].departures.result[i].duration+'</div>\
								<div class="wh33percent right textright size12">'+data.items[0].departures.result[i].arrival_time+'</div>\
								<div class="clearfix"></div>\
							</div>';
						
						
						/*create input contains data*/
						$('#form-passenger').append('\
						<input type="hidden" name="train_id" value="'+data.items[0].departures.result[i].train_id+'">\
						<input type="hidden" name="subclass" value="'+data.items[0].departures.result[i].subclass_name+'">\
						<input type="hidden" name="d" value="'+data.items[0].search_queries.dep_station+'">\
						<input type="hidden" name="a" value="'+data.items[0].search_queries.arr_station+'">\
						<input type="hidden" name="date" value="'+data.items[0].search_queries.date+'">\
						<input type="hidden" name="token" value="'+data.items[0].token+'">\
						<input type="hidden" name="adult" value="'+adult+'">\
						<input type="hidden" name="child" value="'+child+'">\
						<input type="hidden" name="infant" value="'+infant+'">\
						<input type="hidden" name="train_id_ret" value="'+train_id_ret+'">\
						<input type="hidden" name="subclass_ret" value="'+subclass_ret+'">\
						<input type="hidden" name="ret_date" value="'+date_ret+'">\
						');
						/*input hidden additional*/
						$('#form-passenger').append('\
							<input type="hidden" name="class" value="'+data.items[0].departures.result[i].class_name_lang+'">\
							<input type="hidden" name="train_name" value="'+data.items[0].departures.result[i].train_name+'">\
							<input type="hidden" name="route" value="'+data.items[0].search_queries.dep_city+' - '+data.items[0].search_queries.arr_city+'">\
							<input type="hidden" name="time_travel" value="'+data.items[0].departures.result[i].departure_time+' - '+data.items[0].departures.result[i].arrival_time+'">\
							<input type="hidden" name="total_price_dep" value="'+total_price_dep+'">\
							<input type="hidden" name="price_adult" value="'+data.items[0].departures.result[i].price_adult+'">\
							<input type="hidden" name="price_child" value="'+data.items[0].departures.result[i].price_child+'">\
							<input type="hidden" name="price_infant" value="'+data.items[0].departures.result[i].price_infant+'">\
							');
					}
					
						
				} // end for
				var return_summary ='';var return_price_summary ='';
				if(train_id_ret!=''){
					for(var i=0; i<data.items[0].departures.result.length;i++){
						if (train_id_ret == data.items[0].returns.result[i].train_id  && subclass_ret==data.items[0].returns.result[i].subclass_name){
							var total_price_adult_ret = adult * data.items[0].returns.result[i].price_adult;
							var total_price_child_ret = child * data.items[0].returns.result[i].price_child;
							var total_price_infant_ret = infant * data.items[0].returns.result[i].price_infant;
							var total_price_ret = total_price_adult_ret + total_price_child_ret + total_price_infant_ret;// + admin_fee;
							total_price += total_price_ret;
								
							return_summary = '<div>\
								<p>'+data.items[0].returns.result[i].train_name+'</p><br/>\
								<div class="wh33percent left size12 bold dark">'+data.items[0].search_queries.arr_city+'</div>\
								<div class="wh33percent left center size12 bold dark">Durasi</div>\
								<div class="wh33percent right textright size12 bold dark">'+data.items[0].search_queries.dep_city+'</div>\
								<div class="clearfix"></div>\
								<div class="wh33percent left"><div class="fcircle"><span class="fdeparture"></span></div></div>\
								<div class="wh33percent right"><div class="fcircle right"><span class="farrival"></span></div></div>\
								<div class="clearfix"></div><div class="fline2px"></div>\
								<div class="wh33percent left size12">'+data.items[0].returns.result[i].departure_time+'</div>\
								<div class="wh33percent left center size12">'+data.items[0].returns.result[i].duration+'</div>\
								<div class="wh33percent right textright size12">'+data.items[0].returns.result[i].arrival_time+'</div>\
								<div class="clearfix"></div>\
							</div>';
							//check total passenger by age
							var penumpang = '';var harga = '';
							if(adult > 0){
								penumpang += adult + ' x Dewasa<br/>';
								harga += 'IDR '+currency_separator(total_price_adult_ret,'.')+'<br/>';
							}
							if(child > 0){
								penumpang += child + ' x Anak<br/>';
								harga += 'IDR '+currency_separator(total_price_child_ret,'.')+'<br/>';
							}
							if(infant > 0){
								penumpang += infant + ' x Anak';
								harga += 'IDR '+currency_separator(total_price_infant_ret,'.');
							}
							return_price_summary = 'Returning: Total <span class="right bold green">IDR '+currency_separator(total_price_ret,'.')+'</span>\
								<button type="button" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#collapse2"></button>\
								<div id="collapse2" class="collapse">\
									<div class="left size14">\
										'+penumpang+'\
									</div>\
									<div class="right size14">\
										'+harga+'\
									</div><div class="clearfix"></div>\
								</div>';
						}
					}						
				} // end if returning
				
				//create trip summary
				$('#trip-summary').empty();
				/* TRIP SUMMARY*/
				//check total passenger by age
				var penumpang = '';var harga = '';
				if(adult > 0){
					penumpang += adult + ' x Dewasa<br/>';
					harga += 'IDR '+currency_separator(total_price_adult_dep,'.')+'<br/>';
				}
				if(child > 0){
					penumpang += child + ' x Anak<br/>';
					harga += 'IDR '+currency_separator(total_price_child_dep,'.')+'<br/>';
				}
				if(infant > 0){
					penumpang += infant + ' x Anak';
					harga += 'IDR '+currency_separator(total_price_infant_dep,'.');
				}
				$('#trip-summary').append('<div class="padding20"><span class="opensans size18 dark bold">Trip Summary</span></div>\
					<div class="line3"></div>\
					<div class="hpadding30 margtop30">\
					'+departure_summary+'<br/><br/>\
					'+return_summary+'\
					<br/>\
					<div class="fdash mt10"></div><br/>\
					Departing: Total <span class="right bold green">IDR '+currency_separator(total_price_dep,'.')+'</span>\
					<button type="button" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#collapse1"></button>\
					<div id="collapse1" class="collapse">\
						<div class="left size14">\
							'+penumpang+'\
						</div>\
						<div class="right size14">\
							'+harga+'\
						</div><div class="clearfix"></div>\
					</div>\
					<div class="fdash mt10"></div><br/>\
					'+return_price_summary+'\
					<br/><br/>\
					</div>\
					<div class="line3"></div>\
					<div class="padding30">\
						<span class="left size14 dark">Trip Total:</span><br/><span style="font-size:9px"><i>*sebelum kena pajak dan biaya servis</i></span>\
						<span class="right lred2 bold size18">IDR '+currency_separator(total_price,'.')+'</span>\
						<div class="clearfix"></div>\
					</div>\
				');
					
				//create the forms
				var numbering = 1;
				var form = '<div class="padding30 grey">\
								<span class="size16px bold dark left">Informasi Kontak</span>\
								<div class="roundstep right">'+numbering+'</div>\
								<div class="clearfix"></div>\
								<div class="line4"></div>\
								<span class="size13 dark">Titel</span>\
								<select required class="form-control mySelectBoxClass" name=conSalutation>\
									<option value="">--Pilih Title--</option><option value="Mr">Tuan</option><option value="Mrs">Nyonya</option><option value="Ms">Nona</option>\
								</select>\
								<span class="size13 dark">ID (KTP/SIM)</span>\
									<input type="text" class="form-control" name="conId" placeholder="" maxlength="20" required>\
								<span class="size13 dark">Nama Depan</span>\
									<input type="text" class="form-control" name="conFirstName" placeholder="" maxlength="50" required>\
								<span class="size13 dark">Nama Belakang</span>\
									<input type="text" class="form-control" name="conLastName" placeholder="" maxlength="50" required>\
								<span class="size13 dark">Email</span>\
									<input type="text" class="form-control" name="conEmailAddress" placeholder="" required>\
								<span class="size13 dark">Telepon/HP</span>\
									<input type="text" class="form-control" name="conPhone" placeholder="" required>\
								<br/><br/>';
				if(parseInt(adult) > 0){
					var idx = 0;
					for(var i=0; i<parseInt(adult); i++){
						idx = i + 1;
						numbering += 1;
						form += '<span class="size16px bold dark left">Data Penumpang Dewasa</span>\
									<div class="roundstep right">'+numbering+'</div>\
									<div class="clearfix"></div>\
									<div class="line4"></div>';
						form += '<span class="size13 dark">Titel</span>\
									<select required class="form-control mySelectBoxClass" name=salutationAdult'+idx+'>\
										<option value="">--Pilih Title--</option><option value="Mr">Tuan</option><option value="Mrs">Nyonya</option><option value="Ms">Nona</option>\
									</select>\
								<span class="size13 dark">ID (KTP/ SIM/ Kartu Pelajar)</span>\
									<input type="text" class="form-control" name="IdCardAdult'+idx+'" placeholder="" required>\
								<span class="size13 dark">Nama Lengkap</span>\
									<input type="text" class="form-control" name="nameAdult'+idx+'" placeholder="" required>\
								<span class="size13 dark">Tanggal Lahir</span>\
									<input type="text" class="form-control mySelectCalendar" name="birthDateAdult'+idx+'" id="birthDateAdult'+idx+'" placeholder="" required>\
								<span class="size13 dark">Telepon/HP</span>\
									<input type="text" class="form-control" name="noHpAdult'+idx+'" placeholder="" required>\
								<br/><br/>';
					}
				}
				if(parseInt(child) > 0){
					var idx = 0;
					for(var i=0; i<parseInt(adult); i++){
						idx = i + 1;
						numbering += 1;
						form += '<span class="size16px bold dark left">Data Penumpang Anak</span>\
									<div class="roundstep right">'+numbering+'</div>\
									<div class="clearfix"></div>\
									<div class="line4"></div>';
						form += '<span class="size13 dark">Titel</span>\
									<select required class="form-control mySelectBoxClass" name=salutationChild'+idx+'>\
										<option value="">--Pilih Title--</option><option value="Mstr">Tuan</option><option value="Miss">Nona</option>\
									</select>\
								<span class="size13 dark">Nama Lengkap</span>\
									<input type="text" class="form-control" name="nameChild'+idx+'" placeholder="" required>\
								<span class="size13 dark">Tanggal Lahir</span>\
									<input type="text" class="form-control mySelectCalendar" name="birthDateChild'+idx+'" id="birthDateChild'+idx+'" placeholder="" required>\
								<br/><br/>';
					}
				}
				if(parseInt(infant) > 0){
					var idx = 0;
					for(var i=0; i<parseInt(infant); i++){
						idx = i + 1;
						numbering += 1;
						form += '<span class="size16px bold dark left">Data Penumpang Bayi</span>\
									<div class="roundstep right">'+numbering+'</div>\
									<div class="clearfix"></div>\
									<div class="line4"></div>';
						form += '<span class="size13 dark">Titel</span>\
									<select required class="form-control mySelectBoxClass" name=salutationInfant'+idx+'>\
										<option value="">--Pilih Title--</option><option value="Mstr">Tuan</option><option value="Miss">Nona</option>\
									</select>\
								<span class="size13 dark">Nama Lengkap</span>\
									<input type="text" class="form-control" name="nameInfant'+idx+'" placeholder="" required>\
								<span class="size13 dark">Tanggal Lahir</span>\
									<input type="text" class="form-control mySelectCalendar" name="birthDateInfant'+idx+'" id="birthDateInfant'+idx+'" placeholder="" required>';
						
					}
				}
				numbering += 1;
				form += '<br/><br/>\
						<span class="size16px bold dark left">Review and book your trip</span>\
						<div class="roundstep right">'+numbering+'</div>\
						<div class="clearfix"></div>\
						<div class="line4"></div>\
						<div class="alert alert-info">\
						Perhatian! Mohon untuk membaca informasi berikut.<br/>\
						<p class="size12">• Tiket yang anda beli akan langsung berhubungan dengan pihak maskapai/kereta api/hotel terkait. Segala hal yang berhubungan dengan pembatalan atau perubahan jadwal atau yang lainnya, mengikuti dengan peraturan perusahaan terkait.</p>\
						</div>\
						By selecting to complete this booking I acknowledge that I have read and accept the <a href="#" class="clblue">rules & \
						restrictions</a> <a href="#" class="clblue">terms & conditions</a> , and <a href="#" class="clblue">privacy policy</a>.	<br/>\
						<button type="submit" class="bluebtn margtop20">Lanjut Booking</button>\
						</div>';
				
				var first_number_adult = 2;
				var first_number_child = (child=="0" ? first_number_adult : 2 + parseInt(adult) );
				var first_number_infant = (infant=="0" ? first_number_child : first_number_child + parseInt(infant) );
				var number_book = first_number_infant + 1;
				
				$('#form-passenger').append(form);
				for (var i=0; i<parseInt(adult); i++){
					idx = i+1;
					$(function() {
						$( "#birthDateAdult"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				}
				for (var i=0; i<parseInt(child); i++){
					idx = i+1;
					$(function() {
						$( "#birthDateChild"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				}
				for (var i=0; i<parseInt(infant); i++){
					idx = i+1;
					$(function() {
						$( "#birthDateInfant"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				}
			}
		});
	};
	
	function get_detail_hotel(){
		var form = '';
		//fetch the get parameters
		<?php
			if($uri3=='hotel'){
				$gets = $this->input->get(NULL,TRUE);
				$inputs = '';
				$get = '';
				foreach($gets as $key => $value){
					$inputs .= '<input type="hidden" name="'.$key.'" value="'.$value.'">';
					$get .= $key.'='.$value.'&';
				}
					
				echo "var inputs = '".$inputs."';";
				echo "var gets = '".$get."';";
			}
			echo 'var room_id = "'.$this->input->get('room_id',TRUE).'";';
		?>
		
		$.ajax({
			type : "GET",
			url: '<?php echo base_url();?>index.php/hotel/tiketcom_detail_room',
			data: gets,
			cache: false,
			async: false,
			dataType: "json",
			success:function(data){
				if(data.items[0].diagnostic.status=="200"){
					if(data.items[0].results.result.length==0){
						$('#result-header').append('<p>Maaf, data tidak ada untuk rute ini.<p>');
					} 
					else{
						form += '<input type="hidden" name="hotel_name" value="'+data.items[0].breadcrumb.business_name+'">\
								<input type="hidden" name="hotel_id" value="'+data.items[0].breadcrumb.business_id+'">\
								<input type="hidden" name="hotel_address" value="'+data.items[0].general.address+'">\
								<input type="hidden" name="regional" value="'+data.items[0].breadcrumb.area_name+'">\
								';
						for(var i=0; i<data.items[0].results.result.length;i++){
							if(data.items[0].results.result[i].room_id == room_id){
								form += '<input type="hidden" name="room_name" value="'+data.items[0].results.result[i].room_name+'">\
										<input type="hidden" name="price" value="'+data.items[0].results.result[i].price+'">\
										';
							}
						}
					}
				}
			}
		});
		
		
		$('#form-passenger').empty();
		form += '<div class="padding30 grey">\
			<span class="size16px bold dark left">Informasi Kontak</span>\
			<div class="roundstep right">1</div>\
			<div class="clearfix"></div>\
			<div class="line4"></div>\
			<span class="size13 dark">Titel</span>\
			<select required class="form-control mySelectBoxClass" name=conSalutation>\
				<option value="">--Pilih Title--</option><option value="Mr">Tuan</option><option value="Mrs">Nyonya</option><option value="Ms">Nona</option>\
			</select>\
			<span class="size13 dark">ID (KTP/SIM)</span>\
				<input type="text" class="form-control" name="conId" placeholder="" required>\
			<span class="size13 dark">Nama Depan</span>\
				<input type="text" class="form-control" name="conFirstName" placeholder="" required>\
			<span class="size13 dark">Nama Belakang</span>\
				<input type="text" class="form-control" name="conLastName" placeholder="" required>\
			<span class="size13 dark">Email</span>\
				<input type="text" class="form-control" name="conEmailAddress" placeholder="" required>\
			<span class="size13 dark">Telepon/HP</span>\
				<input\ type="text" class="form-control" name="conPhone" placeholder="" required>\
			<br/><br/>\
			<span class="size16px bold dark left">Review and book your trip</span>\
			<div class="roundstep right">2</div>\
			<div class="clearfix"></div>\
			<div class="line4"></div>\
			<div class="alert alert-info">\
				Perhatian! Mohon untuk membaca informasi berikut.<br/>\
				<p class="size12">• Tiket yang anda beli akan langsung berhubungan dengan pihak maskapai/kereta api/hotel terkait. Segala hal yang berhubungan dengan pembatalan atau perubahan jadwal atau yang lainnya, mengikuti dengan peraturan perusahaan terkait.</p>\
			</div>\
			By selecting to complete this booking I acknowledge that I have read and accept the <a href="#" class="clblue">rules & \
			restrictions</a> <a href="#" class="clblue">terms & conditions</a> , and <a href="#" class="clblue">privacy policy</a>.	<br/>\
			<button type="submit" class="bluebtn margtop20">Lanjut Booking</button>\
		</div>';
		/*create input contains data*/
		$('#form-passenger').append(inputs);
		$('#form-passenger').append(form);
	};
	
	function create_form(el_div, n, who, tot_adult, category, numbering, last){
		var top = '';var konten = '';var bottom = '';
		if (n>0){
			for (var i=0; i<n; i++){
				idx = i + 1;
				if (who=='con'){
					top += '<div class="padding30 grey">\
									<span class="size16px bold dark left">Informasi Kontak</span>\
									<div class="roundstep right">'+numbering+'</div>\
									<div class="clearfix"></div>\
									<div class="line4"></div>';
					konten += '<span class="size13 dark">Titel</span>\
									<select required class="form-control mySelectBoxClass" name=conSalutation>\
										<option value="">--Pilih Title--</option><option value="Mr">Tuan</option><option value="Mrs">Nyonya</option><option value="Ms">Nona</option>\
									</select>\
								<span class="size13 dark">ID (KTP/SIM)</span>\
									<input type="text" class="form-control" name="conId" placeholder="" required>\
								<span class="size13 dark">Nama Depan</span>\
									<input type="text" class="form-control" name="conFirstName" placeholder="" required>\
								<span class="size13 dark">Nama Belakang</span>\
									<input type="text" class="form-control" name="conLastName" placeholder="" required>\
								<span class="size13 dark">Email</span>\
									<input type="text" class="form-control" name="conEmailAddress" placeholder="" required>\
								<span class="size13 dark">Telepon/HP</span>\
									<input type="text" class="form-control" name="conPhone" placeholder="" required>\
								';
				}
				$(el_div).append(top+konten);
				/*$(function() {
						$( "#birthDateAdult"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				$(function() {
						$( "#birthDateChild"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				$(function() {
						$( "#birthDateInfant"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});*/
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
	
	function isValidCharacter(str) {
		var iChars = "~`!#$%^&*+=-[]\\\';,/{}|\":<>?0123456789";

		for (var i = 0; i < str.length; i++) {
		   if (iChars.indexOf(str.charAt(i)) != -1) {
			   alert ("Nama harus berupa huruf, mohon benahi input anda");
		   }
		}
	}
	
	function isValidNumber(str) {
		var iChars = "~`!#$%^&*+=-[]\\\';,/{}|\":<>?abcdefghijklmnopqrstuvwxyz";

		for (var i = 0; i < str.length; i++) {
		   if (iChars.indexOf(str.charAt(i)) != -1) {
			   alert ("Telepon harus berupa angka, mohon benahi input anda");
		   }
		}
	}
</script>

  </body>
</html>
