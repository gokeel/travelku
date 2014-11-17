<?php
	$uri3 = $this->uri->segment(3);
	$uri4 = $this->uri->segment(4);
	$uri5 = $this->uri->segment(5);
?>
			<div id="content">
			<!-- KONTEN MULAI -->
				<div id="kolom1-second-faq">
					<div id="kontenkolom1">
					<!-- KOLOM 1 mulai --> 
						<div id="faqkonten">
							<p align="justify"><span class="judul46">Form Detil dan Penumpang</span><br /><br /><br /></p>
							<p align="justify"><span class="judul18">Mohon untuk mengisi semua input berikut ini:</span><br /><br /><br /></p>
							<form id="form-order" name="form-order" method="post" action="<?php 
								if ($uri3=='flight') echo base_url('index.php/order/tiketcom_add_flight_order');
								else if ($uri3=='train') echo base_url('index.php/order/tiketcom_add_train_order');
								else if ($uri3=='hotel') echo base_url('index.php/hotel/tiketcom_add_order_hotel');
								?>">
								
								<p align="justify"><span class="judul18">Detil <?php if($uri3=='flight') echo 'Penerbangan'; elseif($uri3=='train') echo 'Kereta Api';elseif($uri3=='hotel') echo 'Hotel';?></span><br /><br /></p>
								<div id="detail"></div>
								<br /><br />
								<span style="color:red">Note: Semua kolom masukan wajib diisi</span>
								<div id="input_fields"></div>
								<br /><br />
								<input type="submit" class="button-1" id="submit-<?php if($uri3=='flight') echo 'flight'; elseif($uri3=='train') echo 'train';elseif($uri3=='hotel') echo 'hotel';?>" value="Submit" tabindex="8" style="float:right;" />
							</form>
						</div>
					</div>
				<!-- KONTEN end -->
				</div>
			</div>
<style>
table, table td {
    border: 0px;
    border-collapse: collapse;
    margin: 1px;
    padding: 1px;
}
</style>
<script>
	var admin_fee = 0;
	var data_country = [];
	$( window ).load(function() {
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
				var total_price_adult = data.items[0].departures.count_adult * data.items[0].departures.price_adult;
				var total_price_child = data.items[0].departures.count_child * data.items[0].departures.price_child;
				var total_price_infant = data.items[0].departures.count_infant * data.items[0].departures.price_infant;
				var total_price = total_price_adult + total_price_child + total_price_infant;// + admin_fee; //sementara tidak pake
				$('#detail').empty();
				/*create input contains data*/
				$('#detail').append('\
				<input type="hidden" name="token" value="<?php echo $this->session->userdata('token');?>">\
				<input type="hidden" name="flight_id" value="'+flight_id_pergi+'">\
				<input type="hidden" name="adult" value="'+data.items[0].departures.count_adult+'">\
				<input type="hidden" name="child" value="'+data.items[0].departures.count_child+'">\
				<input type="hidden" name="infant" value="'+data.items[0].departures.count_infant+'">\
				<input type="hidden" name="airline_name" value="'+data.items[0].departures.airlines_name+'">\
				<input type="hidden" name="date_go" value="'+data.items[0].departures.flight_date+'">\
				');
				/*fetch data*/
				var img_path = data.items[0].departures.image;
				$('#detail').append('\
					<table id="passenger">\
						<tr>\
							<td>\
								<img src="'+img_path.replace(/\\/g, '')+'" width="100px" height="80px" alt="logo-airline" />\
							</td>\
							<td style="padding-left:15px">\
								<p><strong>Flight ID: #</strong>'+data.items[0].departures.flight_id+'</p>\
								<p><strong>'+data.items[0].departures.airlines_name+' '+data.items[0].departures.flight_number+'</strong></p>\
								<p><strong>Tanggal:</strong> '+data.items[0].departures.flight_date+'</p>\
								<p><strong>Departure-Arrival:</strong> <br />'+data.items[0].departures.full_via+'</p>\
								<p><strong>Transit:</strong> <br />'+data.items[0].departures.stop+'</p>\
							</td>\
							<td style="padding-left:15px">\
							<p><strong>Rincian Harga:</strong></p>\
								<ul style="list-style-type:square; margin-left: 20px;">\
								<li>Dewasa: '+data.items[0].departures.count_adult+' x '+currency_separator(data.items[0].departures.price_adult, '.')+' = '+currency_separator(total_price_adult, '.')+'</li>\
								<li>Anak: '+data.items[0].departures.count_child+' x '+currency_separator(data.items[0].departures.price_child, '.')+' = '+currency_separator(total_price_child, '.')+'</li>\
								<li>Bayi: '+data.items[0].departures.count_infant+' x '+currency_separator(data.items[0].departures.price_infant, '.')+' = '+currency_separator(total_price_infant, '.')+'</li>\
								</ul>\
							</td>\
						</tr>\
					</table>');
					
				/*for round trip*/
				if(flight_id_pulang!=''){
					var total_price_adult = data.items[0].returns.count_adult * data.items[0].returns.price_adult;
					var total_price_child = data.items[0].returns.count_child * data.items[0].returns.price_child;
					var total_price_infant = data.items[0].returns.count_infant * data.items[0].returns.price_infant;
					var total_price = total_price_adult + total_price_child + total_price_infant + admin_fee;
					/*create input contains data*/
					$('#detail').append('\
					<input type="hidden" name="ret_flight_id" value="'+flight_id_pulang+'">\
					<input type="hidden" name="airline_name_ret" value="'+data.items[0].returns.airlines_name+'">\
					');
					/*fetch data*/
					var img_path = data.items[0].returns.image;
					$('#detail').append('\
						<table id="passenger" style="margin-top:30px">\
							<tr>\
								<td>\
									<img src="'+img_path.replace(/\\/g, '')+'" width="100px" height="80px" alt="logo-airline" />\
								</td>\
								<td style="padding-left:15px">\
									<p><strong>Flight ID: #</strong>'+data.items[0].returns.flight_id+'</p>\
									<p><strong>'+data.items[0].returns.airlines_name+' '+data.items[0].returns.flight_number+'</strong></p>\
									<p><strong>Tanggal: </strong>'+data.items[0].returns.flight_date+'</p>\
									<p><strong>Departure-Arrival: </strong><br />'+data.items[0].returns.full_via+'</p>\
									<p><strong>Transit: </strong><br />'+data.items[0].returns.stop+'</p>\
								</td>\
								<td style="padding-left:15px">\
								<p><strong>Rincian Harga:</strong></p>\
									<ul style="list-style-type:square; margin-left: 20px;">\
									<li>Dewasa: '+data.items[0].returns.count_adult+' x '+currency_separator(data.items[0].returns.price_adult, '.')+' = '+currency_separator(total_price_adult, '.')+'</li>\
									<li>Anak: '+data.items[0].returns.count_child+' x '+currency_separator(data.items[0].returns.price_child, '.')+' = '+currency_separator(total_price_child, '.')+'</li>\
									<li>Bayi: '+data.items[0].returns.count_infant+' x '+currency_separator(data.items[0].returns.price_infant, '.')+' = '+currency_separator(total_price_infant, '.')+'</li>\
									</ul>\
								</td>\
							</tr>\
						</table>');
				}
					
				/*end round trip*/
				/* create mandatory input for passengers and contact person */
				var div_input = document.getElementById('input_fields');
				Object.getOwnPropertyNames(data.items[0].required).forEach(function(val, idx, array) {
					//alert(val + ' -> ' + data.items[0].required[val]);
					if(val.indexOf("separator") >= 0)
					{
						//<p align="justify"><span class="judul18">Data Pemesan</span><br /><br /></p>
						var p = document.createElement('p');
						p.setAttribute("align", "justify");
						var span = document.createElement('span');
						span.setAttribute("class", "judul18");
						span.appendChild(document.createTextNode(data.items[0].required[val]["FieldText"]));
						var br = document.createElement("br");
						p.appendChild(span);
						p.appendChild(br);
						p.appendChild(br);
						//append to parent
						div_input.appendChild(p);
					}
					else {
						if(data.items[0].required[val]["type"]=="textbox" || data.items[0].required[val]["type"]=="datetime")
						{
							var input = document.createElement('input');
							input.setAttribute('type', "text");
							input.setAttribute('name', val);
							input.setAttribute('id', val);
							
							var label = document.createElement('label');
							label.setAttribute('for', val);
							label.setAttribute('style', 'font-size: 10px;');
							label.innerHTML = data.items[0].required[val]["FieldText"];
							
							div_input.appendChild(label);
							div_input.appendChild(input);
							if(data.items[0].required[val]["type"]=="datetime")
							{
								$(function() {
									$( "#"+val ).datepicker({"dateFormat": "yy-mm-dd"});
								});
							}
						}
						if(data.items[0].required[val]["type"]=="combobox")
						{
							var sel = document.createElement("select");
							sel.setAttribute("id", val);
							sel.setAttribute("name", val);
							
							var label = document.createElement('label');
							label.setAttribute('for', val);
							label.setAttribute('style', 'font-size: 10px;');
							label.innerHTML = data.items[0].required[val]["FieldText"];
							
							div_input.appendChild(label);
							
							//add option
							if(val.indexOf("nationality") >= 0){
								for(var i=0; i<data_country.length; i++){
									var option = document.createElement('option');
									option.value = data_country[i].value;
									option.text = data_country[i].teks;
									sel.appendChild(option);
								}
							}
							else if(val.indexOf("passportissuing") >= 0){
								for(var i=0; i<data_country.length; i++){
									var option = document.createElement('option');
									option.value = data_country[i].value;
									option.text = data_country[i].teks;
									sel.appendChild(option);
								}
							}
							else if(val.indexOf("parent") >= 0){
								for (var i=0;i<data.items[0].required[val]["resource"].length;i++){
									var option = document.createElement('option');
									var id = Object.getOwnPropertyNames(data.items[0].required[val]["resource"][i]);
									option.value = id;
									option.text = data.items[0].required[val]["resource"][i][id];
									sel.appendChild(option);
																		
								}
							}
							else{
								for (var i=0;i<data.items[0].required[val]["resource"].length;i++){
									var option = document.createElement('option');
									option.value = data.items[0].required[val]["resource"][i].id;
									option.text = data.items[0].required[val]["resource"][i].name;
									sel.appendChild(option);
								}
							}
							
							
							div_input.appendChild(sel);
						}
					}
				});
			}
		});
	};
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
						$('#detail').append('\
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
						var table_start = '<table id="passenger">';
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
							$('#detail').append('\
							<input type="hidden" name="train_id_ret" value="'+data.items[0].returns.result[i].train_id+'">\
							<input type="hidden" name="subclass_ret" value="'+data.items[0].returns.result[i].subclass_name+'">\
							<input type="hidden" name="ret_date" value="'+data.items[0].search_queries.return_date+'">\
							');
							/*fetch data*/
							content = content + '<tr>\
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
	
	function create_select_nationality(name_input){
		var str = '<select name="'+name_input+'">';
		for(var i=0; i<data.length; i++){
			str = str + '<option value="'+data[i].value+'">'+data[i].teks+'</option>';
		}
		str = str + '</select>';
		$('#'+name_input).append(str);
	}
	
/*
	Field cadangan untuk order pesawat, sementara tidak diperlukan
				<input type="hidden" name="depart_date" value="'+tanggal_pergi+'">
				<input type="hidden" name="airlines_name" value="'+data.items[0].departures.airlines_name+'">\
				<input type="hidden" name="time_travel" value="'+data.items[0].departures.simple_departure_time+'-'+data.items[0].departures.simple_arrival_time+'">\
				<input type="hidden" name="route" value="'+data.items[0].departures.flight_infos.flight_info[0].departure_city+'-'+data.items[0].departures.flight_infos.flight_info[0].arrival_city+'">\
				<input type="hidden" name="total_price" value="'+total_price+'">\
				<input type="hidden" name="price_adult" value="'+data.items[0].departures.price_adult+'">\
				<input type="hidden" name="price_child" value="'+data.items[0].departures.price_child+'">\
				<input type="hidden" name="price_infant" value="'+data.items[0].departures.price_infant+'">\
				<input type="hidden" name="admin_fee" value="'+admin_fee+'">\
					returns
					<input type="hidden" name="airlines_name_ret" value="'+data.items[0].returns.airlines_name+'">\
					<input type="hidden" name="depart_date_ret" value="'+tanggal_pulang+'">\
					<input type="hidden" name="time_travel_ret" value="'+data.items[0].returns.simple_departure_time+'-'+data.items[0].returns.simple_arrival_time+'">\
					<input type="hidden" name="route_ret" value="'+data.items[0].returns.flight_infos.flight_info[0].departure_city+'-'+data.items[0].returns.flight_infos.flight_info[0].arrival_city+'">\
					<input type="hidden" name="total_price_ret" value="'+total_price+'">\
					<input type="hidden" name="price_adult_ret" value="'+data.items[0].returns.price_adult+'">\
					<input type="hidden" name="price_child_ret" value="'+data.items[0].returns.price_child+'">\
					<input type="hidden" name="price_infant_ret" value="'+data.items[0].returns.price_infant+'">\
		biaya admin
		<p><strong>Biaya Administrasi:</strong> '+currency_separator(admin_fee, '.')+'</p>\
		<p><strong>Total harus dibayar: IDR'+currency_separator(total_price, '.')+'</strong></p>\
		
		
	Field cadangan untuk kereta, sementara tidak diperlukan
	
						<input type="hidden" name="train_name" value="'+data.items[0].departures.result[i].train_name+'">\
						<input type="hidden" name="class" value="'+data.items[0].departures.result[i].class_name+'">\
						<input type="hidden" name="time_travel" value="'+data.items[0].departures.result[i].departure_time+'-'+data.items[0].departures.result[i].arrival_time+'">\
						<input type="hidden" name="route" value="'+data.items[0].search_queries.dep_city+'-'+data.items[0].search_queries.arr_city+'">\
						<input type="hidden" name="total_price" value="'+total_price+'">\
						<input type="hidden" name="price_adult" value="'+data.items[0].departures.result[i].price_adult+'">\
						<input type="hidden" name="price_child" value="'+data.items[0].departures.result[i].price_child+'">\
						<input type="hidden" name="price_infant" value="'+data.items[0].departures.result[i].price_infant+'">\
						<input type="hidden" name="admin_fee" value="'+admin_fee+'">\
						
						
							<input type="hidden" name="train_name" value="'+data.items[0].returns.result[i].train_name+'">\
							<input type="hidden" name="class" value="'+data.items[0].returns.result[i].class_name+'">\
							<input type="hidden" name="time_travel" value="'+data.items[0].returns.result[i].departure_time+'-'+data.items[0].returns.result[i].arrival_time+'">\
							<input type="hidden" name="route" value="'+data.items[0].search_queries.arr_city+'-'+data.items[0].search_queries.dep_city+'">\
							<input type="hidden" name="total_price" value="'+total_price_ret+'">\
							<input type="hidden" name="price_adult" value="'+data.items[0].returns.result[i].price_adult+'">\
							<input type="hidden" name="price_child" value="'+data.items[0].returns.result[i].price_child+'">\
							<input type="hidden" name="price_infant" value="'+data.items[0].returns.result[i].price_infant+'">\
							<input type="hidden" name="admin_fee" value="'+admin_fee+'">\
						
						<tr>\
								<td>Kewarganegaraan<span style="color:red">*</span></td>\
								<td><div id="passportnationalitya'+idx+'"></div></td>\
								<td></td>\
								<td></td>\
							</tr>\
*/
</script>