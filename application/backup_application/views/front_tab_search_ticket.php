			<div id="tiket">
				<article class="col1">
					<div id="tabs">
						<ul class="nav">
							<li class="selected"><a href="#Flight">Pesawat</a></li>
							<li><a href="#Train">Kereta</a></li>
							<li><a href="#Hotel">Hotel</a></li>
							
						</ul>
						<!--<div class="content">-->
							<div class="tab-content" id="Flight">
								<form id="form_flight" action="<?php echo base_url();?>index.php/webfront/search_ticket/flight" method="get">
									<div>
										<div>
											<input id="radio1" type="radio" name="flight-trip" value="single-trip" checked="checked"><label for="radio1">Sekali Jalan</label> 
											<input id="radio2" type="radio" name="flight-trip" value="round-trip"><label for="radio2">Pulang Pergi</label>
										 </div>
										<div class="row"> <span class="left">From</span>
											<select name="dari" id="flight-from"></select>
										</div>
										<div class="row"> <span class="left">To</span>
											<select name="ke" id="flight-to"></select>
										</div>
										<div class="row"> <span class="left">Berangkat</span>
											<input type="text" id="departing" name="flight-pergi" class="input1" value="<?php $d=strtotime("tomorrow"); echo date('Y-m-d',$d);?>"/>
										</div>
										<div class="row" id="flight-return"> <span class="left">Pulang</span>
											<input type="text" id="returning" name="flight-pulang" class="input1" value="<?php $d=strtotime("tomorrow"); echo date('Y-m-d',$d);?>"/>
										</div>
										<div class="row"> <span class="left">Dewasa</span>
											<input type="text" class="input2" name="dewasa" id="dewasa" value="1">
										</div>
										<div class="row"> <span class="left">Anak</span>
											<input type="text" class="input2" name="anak" id="anak" value="0">
											<span class="pad_left1">(3-11 thn)</span> 
										</div>
										<div class="row"> <span class="left">Bayi</span>
											<input type="text" class="input2" name="bayi" id="bayi" value="0" >
											<span class="right relative"><input class="button1" type="submit" value="Search" /></span>
										</div>
										<!--<div class="wrapper"> <span class="right relative"><input class="button1" type="submit" value="Search" /></span> </div>-->
									</div>
								</form>
							</div>
							<div class="tab-content" id="Hotel">
								<form id="form_hotel" action="<?php echo base_url();?>index.php/webfront/search_ticket/hotel" method="get">
									<div>
										<div class="row"> <span class="left">Kota/Hotel</span>
											<input type="text" class="input" id="query" name="query" >
										</div>
										<div class="row"> <span class="left">Checkin </span>
											<input type="text" class="input1" id="checkin" name="checkin" value="<?php $d=strtotime("tomorrow"); echo date('Y-m-d',$d);?>" >
											<a href="#" class="help"></a> 
										</div>
										<div class="row"> <span class="left">Checkout </span>
											<input type="text" class="input1" id="checkout" name="checkout" value="<?php $d=strtotime("tomorrow"); echo date('Y-m-d',$d);?>" >
											<a href="#" class="help"></a> 
										</div>
										<div class="row"> <span class="left">Kamar</span>
											<input type="text" class="input2" value="1" id="kamar" name="room">
											<a href="#" class="help"></a> 
										</div>
										<div class="row"> <span class="left">Malam</span>
											<input type="text" class="input2" value="1" id="malam" name="night">
											<a href="#" class="help"></a> 
										</div>
										<div class="row"> <span class="left">Dewasa</span>
											<input type="text" class="input2" value="1" id="hotel-dewasa" name="dewasa">
										</div>
										<div class="row"> <span class="left">Anak</span>
											<input type="text" class="input2" value="0" id="hotel-anak" name="anak">
											<span class="pad_left1">(0-11 years)</span> 
										</div>
										<div class="wrapper"> <span class="right relative"><input class="button1" type="submit" value="Search" /></span></div>
									</div>
								</form>
							</div>
							<div class="tab-content" id="Train">
								<form id="form_train" action="<?php echo base_url();?>index.php/webfront/search_ticket/train" method="get">
									<div>
										<div>
											<input id="radio1" type="radio" name="train-trip" value="single-trip" checked="checked"><label for="radio1">Sekali Jalan</label> 
											<input id="radio2" type="radio" name="train-trip" value="round-trip"><label for="radio2">Pulang Pergi</label>
										 </div>
										<div class="row"> <span class="left">From</span>
											<select name="dari" id="train-from"></select>
										</div>
										<div class="row"> <span class="left">To</span>
											<select name="ke" id="train-to"></select>
										</div>
										<div class="row"> <span class="left">Berangkat</span>
											<input type="text" id="train-pergi" name="train-pergi" class="input1" value="<?php $d=strtotime("tomorrow"); echo date('Y-m-d',$d);?>"/>
										</div>
										<div class="row" id="train-return"> <span class="left">Pulang</span>
											<input type="text" id="train-pulang" name="train-pulang" class="input1" value="<?php $d=strtotime("tomorrow"); echo date('Y-m-d',$d);?>"/>
										</div>
										<div class="row"> <span class="left">Dewasa</span>
											<input type="text" class="input2" name="dewasa" id="dewasa" value="1">
										</div>
										<div class="row"> <span class="left">Anak</span>
											<input type="text" class="input2" name="anak" id="anak" value="0">
											<span class="pad_left1">(3-11 thn)</span> 
										</div>
										<div class="row"> <span class="left">Bayi</span>
											<input type="text" class="input2" name="bayi" id="bayi" value="0">
										</div>
										<div class="wrapper"> <span class="right relative"><input class="button1" type="submit" value="Search" /></span> </div>
									</div>
								</form>
							</div>
						<!-- div -->
					</div>
				  </article>
			</div>
<script>
	$(function() {
		$( "#departing" ).datepicker({"dateFormat": "yy-mm-dd"});
		$( "#returning" ).datepicker({"dateFormat": "yy-mm-dd"});
		$( "#train-pergi" ).datepicker({"dateFormat": "yy-mm-dd"});
		$( "#train-pulang" ).datepicker({"dateFormat": "yy-mm-dd"});
		$( "#checkin" ).datepicker({"dateFormat": "yy-mm-dd"});
		$( "#checkout" ).datepicker({"dateFormat": "yy-mm-dd"});
		//$( "#returning" ).datepicker({"dateFormat": "yy-mm-dd"});
	});
	 $(function() {
		$( "#tabs" ).tabs();
	});
	$( window ).load(function() {
		$('#flight-return').hide();
		$('#train-return').hide();
		load_all_airport('<?php echo base_url();?>index.php/flight/get_all_airport', "#flight-from");
		load_all_airport('<?php echo base_url();?>index.php/flight/get_all_airport', "#flight-to");
		
		load_all_station('<?php echo base_url();?>index.php/train/get_all_station', "#train-from");
		load_all_station('<?php echo base_url();?>index.php/train/get_all_station', "#train-to");
		// init date on hotel
		$( "#checkin" ).datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			yearRange: ":2016",
			minDate: "dateToday",
			onClose: function (selectedDate) {
				var myDate = $(this).datepicker('getDate'); 
                myDate.setDate(myDate.getDate()+1); 
				$('#checkout').datepicker('setDate', myDate);
				$('#checkout').datepicker( "option", "minDate", myDate);
			}
		});
		$( "#checkout" ).datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 2,
			yearRange: ":2016",
		});
	});
	$("input[name='flight-trip']").change(function(){
		if ($(this).val() === 'single-trip') {
		  $('#flight-return').hide();
		} else if ($(this).val() === 'round-trip') {
		  $('#flight-return').show();
		} 
	});
	$("input[name='train-trip']").change(function(){
		if ($(this).val() === 'single-trip') {
		  $('#train-return').hide();
		} else if ($(this).val() === 'round-trip') {
		  $('#train-return').show();
		} 
	});
</script>