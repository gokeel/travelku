			<div id="content">
			<!-- KONTEN MULAI -->
				<div id="kolom1-second-faq">
					<div id="kontenkolom1">
					<!-- KOLOM 1 mulai --> 
						<div id="faqkonten">
						</div>
					</div>
				<!-- KONTEN end -->
				</div>
			</div>
<script>
	var flight_pergi ='';
	var flight_pulang = '';
	$( window ).load(function() {
		<?php
			$category = $this->uri->segment(3);
			//get the parameters
			$get = $this->input->get(NULL,TRUE);
			$input = '';
			foreach($get as $key => $value)
				$input .= $key.'='.$value.'&';
			echo 'var input="'.rtrim($input,'&').'";';
			//load to the page
			if($category=='flight')
				echo 'search_flight(input);';
			else if($category=='train')
				echo 'search_train(input);';
			else if($category=='hotel')
				echo 'search_hotel(input);';
		?>
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

	
	function search_flight(params){
		var trip = '<?php echo $this->input->get('flight-trip',TRUE);?>';
		var dari = '<?php echo $this->input->get('dari',TRUE);?>';	
		var ke = '<?php echo $this->input->get('ke',TRUE);?>';
		var pergi = '<?php echo $this->input->get('flight-pergi',TRUE);?>';
		var pulang = '<?php echo $this->input->get('flight-pulang',TRUE);?>';
		var dewasa = '<?php echo $this->input->get('dewasa',TRUE);?>';
		var anak = '<?php echo $this->input->get('anak',TRUE);?>';
		var bayi = '<?php echo $this->input->get('bayi',TRUE);?>';
		if (trip=='single-trip')
		{
			$('#faqkonten').empty();
			$('#faqkonten').append('<span class="judul20">Hasil Pencarian Data Pesawat "Sekali Jalan" <br />(Urutan dari harga termurah), '+dari+' - '+ke+' Tanggal Berangkat: '+pergi+'</span><br /><br>');
			$('#faqkonten').append('<img id="progress" src="<?php echo IMAGES_DIR; ?>/spiffygif_34x34.gif" />');
			$("#progress").show();
			check_passenger = check_total_passenger('flight', parseInt(dewasa), parseInt(anak), parseInt(bayi));
			<?php
				$datetime1 = date_create(date('Y-m-d'));
				$datetime2 = date_create($this->input->get('flight-pergi', TRUE));
				$interval = date_diff($datetime1, $datetime2);
				$diff = intval($interval->format('%a'));
				echo 'var diff_date = '.$diff.';';
			?>
			if(check_passenger!='ok'){
				$('#faqkonten').append('<p style="color:red">'+check_passenger+'</p>');
			}
			else{
				if(diff_date>360)
					$('#faqkonten').append('<p style="color:red">Tanggal keberangkatan tidak lebih dari 360 hari</p>');
				else{
					$.ajax({
						type : "GET",
						url: '<?php echo base_url();?>index.php/flight/search_flights',
						data: 'dari='+dari+'&ke='+ke+'&flight-pergi='+pergi+'&dewasa='+dewasa+'&anak='+anak+'&bayi='+bayi,
						cache: false,
						dataType: "json",
						success:function(data){
								if(data==''){
									$('#faqkonten').append('<p>Maaf, data tidak ada untuk rute ini.<p>');
								}
								else{
									if(data.items[0].diagnostic.status=="200"){
										var div = $("#faqkonten");
										var table = document.createElement('table');
										table.setAttribute('id', 'search-result');
										var thead = document.createElement('thead');
										var tr_head = document.createElement('tr');
										tr_head.appendChild(set_td_data('th', 'Maskapai'));
										tr_head.appendChild(set_td_data('th', 'Rute & Jam'));
										tr_head.appendChild(set_td_data('th', 'Transit'));
										tr_head.appendChild(set_td_data('th', 'Harga'));
										tr_head.appendChild(set_td_data('th', 'Pesan'));
										table.appendChild(tr_head);
										
										var tbody = document.createElement('tbody');
										
										
										for(var i=0; i<data.items[0].departures.result.length;i++){
											var tr_body = document.createElement('tr');
											tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].airlines_name+" "+data.items[0].departures.result[i].flight_number));
											tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].full_via));
											tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].stop));
											//tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].price_value));
											// detail untuk price tiap usia
												var td1 = document.createElement('td');
												var p1 = document.createElement('p');
												p1.appendChild(document.createTextNode('Dewasa: '+data.items[0].departures.result[i].price_adult));
												td1.appendChild(p1);
												
												var p2 = document.createElement('p');
												p2.appendChild(document.createTextNode('Anak(3-9thn): '+data.items[0].departures.result[i].price_child));
												td1.appendChild(p2);
												
												var p3 = document.createElement('p');
												p3.appendChild(document.createTextNode('Bayi: '+data.items[0].departures.result[i].price_infant));
												td1.appendChild(p3);
												
												tr_body.appendChild(td1);
												
											var el_td = document.createElement('td');
											var link_order = document.createElement('a');
											var str = document.createTextNode('Pesan');
											link_order.appendChild(str);
											link_order.setAttribute('href', '<?php echo base_url();?>index.php/webfront/form_passengers/flight/'+data.items[0].departures.result[i].flight_id+'/'+data.items[0].search_queries.date);
											link_order.setAttribute('class', 'tombol-pesan');
											el_td.appendChild(link_order);
											tr_body.appendChild(el_td);
											
											table.appendChild(tr_body);
											
										}
										
										div.append(table);
									}
									else {
										$('#faqkonten').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>');
									}
								}
								$("#progress").hide();
							}
					})
				}
				
			}
		}
		else if (trip=='round-trip')
		{
			$('#faqkonten').empty();
			$('#faqkonten').append('<span class="judul20">Hasil Pencarian Data Pesawat "Pulang Pergi" <br />(Urutan dari harga termurah), '+dari+' - '+ke+' - '+dari+' <br />Tanggal Berangkat: '+pergi+' Pulang: '+pulang+'</span><br /><br>');
			
			check_passenger = check_total_passenger('flight', parseInt(dewasa), parseInt(anak), parseInt(bayi));
			if(check_passenger!='ok'){
				$('#faqkonten').append('<p style="color:red">'+check_passenger+'</p>');
			}
			else {
				var compare_date;
				<?php
					$pergi = date_create($this->input->get('flight-pergi', TRUE));
					$pulang = date_create($this->input->get('flight-pulang', TRUE));
					if($pulang >= $pergi)
						echo 'compare_date = "ok";';
					else
						echo 'compare_date = "Tanggal pulang minimal harus sama atau lebih besar dari tanggal pergi. Silahkan pilih tanggal lain.";';
				?>
				if(compare_date!='ok')
					$('#faqkonten').append('<p style="color:red">'+compare_date+'</p>');
				else{
					<?php
						$now = date_create(date('Y-m-d'));
						
						$interval_pergi = date_diff($now, $pergi);
						$interval_pulang = date_diff($now, $pulang);
						$diff_pergi = intval($interval_pergi->format('%a'));
						$diff_pulang = intval($interval_pulang->format('%a'));
						echo 'var diff_date_pergi = '.$diff_pergi.';';
						echo 'var diff_date_pulang = '.$diff_pulang.';';
					?>
					if(diff_date_pergi>360 || diff_date_pulang>360)
						$('#faqkonten').append('<p style="color:red">Tanggal keberangkatan/kepulangan tidak lebih dari 360 hari</p>');
					else
					{
						$('#faqkonten').append('<div id="tabs">\
							<ul class="nav">\
								<li class="selected"><a href="#tab-1">'+dari+' - '+ke+' '+pergi+'</a></li>\
								<li><a href="#tab-2">'+ke+' - '+dari+' '+pulang+'</a></li>\
								<li><a href="#tab-3">Jadwal Terpilih</a></li>\
							</ul></div>');
				
						/* konten untuk pergi */
						$('#tabs').append('<div class="tab-content" id="tab-1"></div>');
						$('#tabs').append('<div class="tab-content" id="tab-2"></div>');
						$('#tabs').append('<div class="tab-content" id="tab-3"></div>');
						
						$.ajax({
							type : "GET",
							url: '<?php echo base_url();?>index.php/flight/search_flights',
							data: 'dari='+dari+'&ke='+ke+'&flight-pergi='+pergi+'&flight-pulang='+pulang+'&dewasa='+dewasa+'&anak='+anak+'&bayi='+bayi,
							cache: false,
							async: false,
							dataType: "json",
							success:function(data){
								if(data.items[0].diagnostic.status=="200")
								{
									/* content for tab pergi */
									var div = $("#tab-1");
									var table = document.createElement('table');
									table.setAttribute('id', 'search-result');
									var thead = document.createElement('thead');
									var tr_head = document.createElement('tr');
									tr_head.appendChild(set_td_data('th', 'Maskapai'));
									tr_head.appendChild(set_td_data('th', 'Rute & Jam'));
									tr_head.appendChild(set_td_data('th', 'Transit'));
									tr_head.appendChild(set_td_data('th', 'Harga'));
									tr_head.appendChild(set_td_data('th', 'Pilih Jadwal'));
									table.appendChild(tr_head);
										
									var tbody = document.createElement('tbody');
											
									for(var i=0; i<data.items[0].departures.result.length;i++){
										var tr_body = document.createElement('tr');
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].airlines_name+" "+data.items[0].departures.result[i].flight_number));
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].full_via));
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].stop));
										//tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].price_value));
										// detail untuk price tiap usia
										var td1 = document.createElement('td');
										var p1 = document.createElement('p');
										p1.appendChild(document.createTextNode('Dewasa: '+data.items[0].departures.result[i].price_adult));
										td1.appendChild(p1);
													
										var p2 = document.createElement('p');
										p2.appendChild(document.createTextNode('Anak(3-9thn): '+data.items[0].departures.result[i].price_child));
										td1.appendChild(p2);
											
										var p3 = document.createElement('p');
										p3.appendChild(document.createTextNode('Bayi: '+data.items[0].departures.result[i].price_infant));
										td1.appendChild(p3);
													
										tr_body.appendChild(td1);
													
										var el_td = document.createElement('td');
										var input = document.createElement('input');
										input.setAttribute('type', 'radio');
										input.setAttribute('name', 'jadwal-pergi');
										input.setAttribute('id', data.items[0].departures.result[i].flight_id);
										input.setAttribute('value', data.items[0].departures.result[i].flight_id+'/'+data.items[0].search_queries.date+'/'+data.items[0].departures.result[i].simple_departure_time);
										var label = document.createElement('label');
										label.setAttribute('for', data.items[0].departures.result[i].flight_id);
										label.setAttribute('style', 'font-size: 10px;');
										label.innerHTML = 'Pilih';
										el_td.appendChild(input);
										el_td.appendChild(label);
												
										tr_body.appendChild(el_td);
												
										table.appendChild(tr_body);
												
									}
											
									div.append(table);
										
									/* content for tab pulang */
									var div_tab2 = $("#tab-2");
									var table = document.createElement('table');
									table.setAttribute('id', 'search-result');
									var thead = document.createElement('thead');
									var tr_head = document.createElement('tr');
									tr_head.appendChild(set_td_data('th', 'Maskapai'));
									tr_head.appendChild(set_td_data('th', 'Rute & Jam'));
									tr_head.appendChild(set_td_data('th', 'Transit'));
									tr_head.appendChild(set_td_data('th', 'Harga'));
									tr_head.appendChild(set_td_data('th', 'Pilih Jadwal'));
									table.appendChild(tr_head);
									
									var tbody = document.createElement('tbody');
											
									for(var i=0; i<data.items[0].returns.result.length;i++){
										var tr_body = document.createElement('tr');
										tr_body.appendChild(set_td_data('td', data.items[0].returns.result[i].airlines_name+" "+data.items[0].returns.result[i].flight_number));
										tr_body.appendChild(set_td_data('td', data.items[0].returns.result[i].full_via));
										tr_body.appendChild(set_td_data('td', data.items[0].returns.result[i].stop));
										//tr_body.appendChild(set_td_data('td', data.items[0].returns.result[i].price_value));
										// detail untuk price tiap usia
										var td1 = document.createElement('td');
										var p1 = document.createElement('p');
										p1.appendChild(document.createTextNode('Dewasa: '+data.items[0].returns.result[i].price_adult));
										td1.appendChild(p1);
													
										var p2 = document.createElement('p');
										p2.appendChild(document.createTextNode('Anak(3-9thn): '+data.items[0].returns.result[i].price_child));
										td1.appendChild(p2);
										
										var p3 = document.createElement('p');
										p3.appendChild(document.createTextNode('Bayi: '+data.items[0].returns.result[i].price_infant));
										td1.appendChild(p3);
													
										tr_body.appendChild(td1);
													
										var el_td = document.createElement('td');
										var input = document.createElement('input');
										input.setAttribute('type', 'radio');
										input.setAttribute('name', 'jadwal-pulang');
										input.setAttribute('id', data.items[0].returns.result[i].flight_id);
										input.setAttribute('value', data.items[0].returns.result[i].flight_id+'/'+data.items[0].search_queries.ret_date+'/'+data.items[0].returns.result[i].simple_departure_time);
										var label = document.createElement('label');
										label.setAttribute('for', data.items[0].returns.result[i].flight_id);
										label.setAttribute('style', 'font-size: 10px;');
										label.innerHTML = 'Pilih';
										el_td.appendChild(input);
										el_td.appendChild(label);
												
										tr_body.appendChild(el_td);
											
										table.appendChild(tr_body);
												
									}
											
									div_tab2.append(table);
								}
								else {
									$('#faqkonten').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>');
								}
							}
						});
					}
					
					$('#tab-3').append('<div id="chosen-depart"></div><div id="chosen-return" style="padding-top:30px"></div><button id="btn" style="margin-top:30px" class="button-1">Lanjutkan ke Pemesanan</button>');
					$("input[name='jadwal-pergi']").change(function(){
						var str = $(this).val();
						flight_pergi = $(this).val();
						var field = str.split('/',3);
							
						$('#chosen-depart').empty();
						$('#chosen-depart').append('<div>\
							<p><strong>Jadwal Pergi yang Dipilih:</strong></p>\
							<p>Flight ID = #'+field[0]+'</p>\
							<p>Tanggal = '+field[1]+'</p>\
							<p>Jam = '+field[2]+'</p>\
							</div>');
					});
					$("input[name='jadwal-pulang']").change(function(){
						var str = $(this).val();
						flight_pulang = $(this).val();
						var field = str.split('/',3);
							
						$('#chosen-return').empty();
						$('#chosen-return').append('<div>\
							<p><strong>Jadwal Pulang yang Dipilih:</strong></p>\
							<p>Flight ID = #'+field[0]+'</p>\
							<p>Tanggal = '+field[1]+'</p>\
							<p>Jam = '+field[2]+'</p>\
							</div>');
					});
					$('#btn').click(function(event) {
						var flight_1 = $("input[name='jadwal-pergi']").val();
						var flight_2 = $("input[name='jadwal-pulang']").val();
							
						if(flight_pergi=="" || flight_pulang=="")
							alert('Terdapat jadwal pesawat yang belum dipilih, mohon cek kembali.');
						else{
							var split_1 = flight_pergi.split('/',3);
							var split_2 = flight_pulang.split('/',3);
							if(split_1[1]==split_2[1]) //jika tanggal sama, waktu pulang tidak boleh lebih kecil dari waktu berangkat
							{
								if(split_1[2]>split_2[2])
									alert('Di tanggal yang sama, waktu pulang harus lebih besar dari waktu pergi.');
								else
									window.location.href = '<?php echo base_url();?>index.php/webfront/form_passengers/flight/'+split_1[0]+'/'+split_1[1]+'/'+split_2[0]+'/'+split_2[1];
							}
							else
								window.location.href = '<?php echo base_url();?>index.php/webfront/form_passengers/flight/'+split_1[0]+'/'+split_1[1]+'/'+split_2[0]+'/'+split_2[1];
						}
					});
					$(function() {
						$( "#tabs" ).tabs();
					});
				}
			}
		}
	}
	
	function search_train(params){
		var trip = '<?php echo $this->input->get('train-trip',TRUE);?>';
		var dari = '<?php echo $this->input->get('dari',TRUE);?>';	
		var ke = '<?php echo $this->input->get('ke',TRUE);?>';
		var pergi = '<?php echo $this->input->get('train-pergi',TRUE);?>';
		var pulang = '<?php echo $this->input->get('train-pulang',TRUE);?>';
		var dewasa = '<?php echo $this->input->get('dewasa',TRUE);?>';
		var anak = '<?php echo $this->input->get('anak',TRUE);?>';
		var bayi = '<?php echo $this->input->get('bayi',TRUE);?>';
		
		if (trip=='single-trip')
		{
			$('#faqkonten').empty();
			$('#faqkonten').append('<span class="judul20">Hasil Pencarian Data Kereta "Sekali Jalan" <br />(Urutan dari harga termurah), '+dari+' - '+ke+' Tanggal Berangkat: '+pergi+'</span><br /><br>');
			$('#faqkonten').append('<img id="progress" src="<?php echo IMAGES_DIR; ?>/spiffygif_34x34.gif" />');
			$("#progress").show();
			check_passenger = check_total_passenger('train', parseInt(dewasa), parseInt(anak), parseInt(bayi));
			<?php
				$datetime1 = date_create(date('Y-m-d'));
				$datetime2 = date_create($this->input->get('train-pergi', TRUE));
				$interval = date_diff($datetime1, $datetime2);
				$diff = intval($interval->format('%a'));
				echo 'var diff_date = '.$diff.';';
			?>
			if(check_passenger!='ok'){
				$('#faqkonten').append('<p style="color:red">'+check_passenger+'</p>');
			}
			else{
				if(diff_date>90)
					$('#faqkonten').append('<p style="color:red">Tanggal keberangkatan tidak lebih dari 90 hari</p>');
				else{
					$.ajax({
						type : "GET",
						url: '<?php echo base_url();?>index.php/train/search_trains',
						data: 'dari='+dari+'&ke='+ke+'&train-pergi='+pergi+'&dewasa='+dewasa+'&anak='+anak+'&bayi='+bayi,
						cache: false,
						dataType: "json",
						success:function(data){
								if(data==''){
									$('#faqkonten').append('<p>Maaf, data tidak ada untuk rute ini.<p>');
								}
								else{
									if(data.items[0].diagnostic.status=="200"){
										var div = $("#faqkonten");
										var table = document.createElement('table');
										table.setAttribute('id', 'search-result');
										var thead = document.createElement('thead');
										var tr_head = document.createElement('tr');
										tr_head.appendChild(set_td_data('th', 'Kereta Api (Kelas)'));
										tr_head.appendChild(set_td_data('th', 'Kursi Tersedia'));
										tr_head.appendChild(set_td_data('th', 'Waktu'));
										//tr_head.appendChild(set_td_data('th', 'Tiba'));
										//tr_head.appendChild(set_td_data('th', 'Durasi'));
										tr_head.appendChild(set_td_data('th', 'Harga'));
										tr_head.appendChild(set_td_data('th', 'Pesan'));
										table.appendChild(tr_head);
										
										var tbody = document.createElement('tbody');
											
										for(var i=0; i<data.items[0].departures.result.length;i++){
											var kelas = data.items[0].departures.result[i].class_name;
												
											var tr_body = document.createElement('tr');
											tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].train_name+' ('+kelas.toUpperCase()+', subclass: '+data.items[0].departures.result[i].subclass_name+')'));
											tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].detail_availability));
											tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].departure_time+'-'+data.items[0].departures.result[i].arrival_time));
											//tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].arrival_time));
											//tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].duration));
												
											var td1 = document.createElement('td');
											var p1 = document.createElement('p');
											p1.appendChild(document.createTextNode('Dewasa: '+data.items[0].departures.result[i].price_adult));
											td1.appendChild(p1);
												
											var p2 = document.createElement('p');
											p2.appendChild(document.createTextNode('Anak(3-9thn): '+data.items[0].departures.result[i].price_child));
											td1.appendChild(p2);
												
											var p3 = document.createElement('p');
											p3.appendChild(document.createTextNode('Bayi: '+data.items[0].departures.result[i].price_infant));
											td1.appendChild(p3);
												
											tr_body.appendChild(td1);
												
											var el_td = document.createElement('td');
											var link_order = document.createElement('a');
											var str = document.createTextNode('Pesan');
											link_order.appendChild(str);
											link_order.setAttribute('href', '<?php echo base_url();?>index.php/webfront/form_passengers/train?tid_dep='+data.items[0].departures.result[i].train_id+'&dep_date='+data.items[0].search_queries.date+'&sc_dep='+data.items[0].departures.result[i].subclass_name+'&dari=<?php echo $this->input->get('dari',TRUE);?>&ke=<?php echo $this->input->get('ke',TRUE);?>&adult=<?php echo $this->input->get('dewasa',TRUE);?>&child=<?php echo $this->input->get('anak',TRUE);?>&infant=<?php echo $this->input->get('bayi',TRUE);?>');
											link_order.setAttribute('class', 'tombol-pesan');
											el_td.appendChild(link_order);
											tr_body.appendChild(el_td);
												
											table.appendChild(tr_body);
										}
											
										div.append(table);
									}
									else {
										$('#faqkonten').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>');
									}
								}
								$("#progress").hide();
							}
					})
				}
				
			}
		}
		else if (trip=='round-trip')
		{
			$('#faqkonten').empty();
			$('#faqkonten').append('<span class="judul20">Hasil Pencarian Data Kereta "Pulang Pergi" <br />(Urutan dari harga termurah), '+dari+' - '+ke+' - '+dari+' <br />Tanggal Berangkat: '+pergi+' Pulang: '+pulang+'</span><br /><br>');
			
			check_passenger = check_total_passenger('train', parseInt(dewasa), parseInt(anak), parseInt(bayi));
			if(check_passenger!='ok'){
				$('#faqkonten').append('<p style="color:red">'+check_passenger+'</p>');
			}
			else {
				var compare_date;
				<?php
					$pergi = date_create($this->input->get('train-pergi', TRUE));
					$pulang = date_create($this->input->get('train-pulang', TRUE));
					if($pulang >= $pergi)
						echo 'compare_date = "ok";';
					else
						echo 'compare_date = "Tanggal pulang minimal harus sama atau lebih besar dari tanggal pergi. Silahkan pilih tanggal lain.";';
				?>
				if(compare_date!='ok')
					$('#faqkonten').append('<p style="color:red">'+compare_date+'</p>');
				else{
					<?php
						$now = date_create(date('Y-m-d'));
						
						$interval_pergi = date_diff($now, $pergi);
						$interval_pulang = date_diff($now, $pulang);
						$diff_pergi = intval($interval_pergi->format('%a'));
						$diff_pulang = intval($interval_pulang->format('%a'));
						echo 'var diff_date_pergi = '.$diff_pergi.';';
						echo 'var diff_date_pulang = '.$diff_pulang.';';
					?>
					if(diff_date_pergi>90 || diff_date_pulang>90)
						$('#faqkonten').append('<p style="color:red">Tanggal keberangkatan/kepulangan tidak lebih dari 90 hari</p>');
					else
					{
						$('#faqkonten').append('<div id="tabs">\
							<ul class="nav">\
								<li class="selected"><a href="#tab-1">'+dari+' - '+ke+' '+pergi+'</a></li>\
								<li><a href="#tab-2">'+ke+' - '+dari+' '+pulang+'</a></li>\
								<li><a href="#tab-3">Jadwal Terpilih</a></li>\
							</ul></div>');
				
						/* konten untuk pergi */
						$('#tabs').append('<div class="tab-content" id="tab-1"></div>');
						$('#tabs').append('<div class="tab-content" id="tab-2"></div>');
						$('#tabs').append('<div class="tab-content" id="tab-3"></div>');
						
						$.ajax({
							type : "GET",
							url: '<?php echo base_url();?>index.php/train/search_trains',
							data: 'dari='+dari+'&ke='+ke+'&train-pergi='+pergi+'&train-pulang='+pulang+'&dewasa='+dewasa+'&anak='+anak+'&bayi='+bayi,
							cache: false,
							async: false,
							dataType: "json",
							success:function(data){
								if(data.items[0].diagnostic.status=="200")
								{
									/* content for tab pergi */
									var div = $("#tab-1");
									var table = document.createElement('table');
									table.setAttribute('id', 'search-result');
									var thead = document.createElement('thead');
									var tr_head = document.createElement('tr');
									tr_head.appendChild(set_td_data('th', 'Kereta Api (Kelas)'));
									tr_head.appendChild(set_td_data('th', 'Kursi Tersedia'));
									tr_head.appendChild(set_td_data('th', 'Waktu'));
									//tr_head.appendChild(set_td_data('th', 'Tiba'));
									//tr_head.appendChild(set_td_data('th', 'Durasi'));
									tr_head.appendChild(set_td_data('th', 'Harga'));
									tr_head.appendChild(set_td_data('th', 'Pesan'));
									table.appendChild(tr_head);
										
									var tbody = document.createElement('tbody');
											
									for(var i=0; i<data.items[0].departures.result.length;i++){
										var kelas = data.items[0].departures.result[i].class_name;
											
										var tr_body = document.createElement('tr');
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].train_name+' ('+kelas.toUpperCase()+', subclass: '+data.items[0].departures.result[i].subclass_name+')'));
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].detail_availability));
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].departure_time+'-'+data.items[0].departures.result[i].arrival_time));
										//tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].arrival_time));
										//tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].duration));
												
										var td1 = document.createElement('td');
										var p1 = document.createElement('p');
										p1.appendChild(document.createTextNode('Dewasa: '+data.items[0].departures.result[i].price_adult));
										td1.appendChild(p1);
												
										var p2 = document.createElement('p');
										p2.appendChild(document.createTextNode('Anak(3-9thn): '+data.items[0].departures.result[i].price_child));
										td1.appendChild(p2);
												
										var p3 = document.createElement('p');
										p3.appendChild(document.createTextNode('Bayi: '+data.items[0].departures.result[i].price_infant));
										td1.appendChild(p3);
												
										tr_body.appendChild(td1);
												
										var el_td = document.createElement('td');
										var input = document.createElement('input');
										input.setAttribute('type', 'radio');
										input.setAttribute('name', 'jadwal-pergi');
										input.setAttribute('id', data.items[0].departures.result[i].train_id);
										input.setAttribute('value', data.items[0].departures.result[i].train_id+'/'+data.items[0].search_queries.date+'/'+data.items[0].departures.result[i].departure_time+'/'+data.items[0].departures.result[i].subclass_name+'/'+data.items[0].departures.result[i].train_name);
										var label = document.createElement('label');
										label.setAttribute('for', data.items[0].departures.result[i].train_id);
										label.setAttribute('style', 'font-size: 10px;');
										label.innerHTML = 'Pilih';
										el_td.appendChild(input);
										el_td.appendChild(label);
												
										tr_body.appendChild(el_td);	
										table.appendChild(tr_body);
									}
											
									div.append(table);
										
									/* content for tab pulang */
									var div_tab2 = $("#tab-2");
									var table = document.createElement('table');
									table.setAttribute('id', 'search-result');
									var thead = document.createElement('thead');
									var tr_head = document.createElement('tr');
									tr_head.appendChild(set_td_data('th', 'Kereta Api (Kelas)'));
									tr_head.appendChild(set_td_data('th', 'Kursi Tersedia'));
									tr_head.appendChild(set_td_data('th', 'Waktu'));
									//tr_head.appendChild(set_td_data('th', 'Tiba'));
									//tr_head.appendChild(set_td_data('th', 'Durasi'));
									tr_head.appendChild(set_td_data('th', 'Harga'));
									tr_head.appendChild(set_td_data('th', 'Pesan'));
									table.appendChild(tr_head);
										
									var tbody = document.createElement('tbody');
											
									for(var i=0; i<data.items[0].returns.result.length;i++){
										var kelas = data.items[0].returns.result[i].class_name;
												
										var tr_body = document.createElement('tr');
										tr_body.appendChild(set_td_data('td', data.items[0].returns.result[i].train_name+' ('+kelas.toUpperCase()+', subclass: '+data.items[0].returns.result[i].subclass_name+')'));
										tr_body.appendChild(set_td_data('td', data.items[0].returns.result[i].detail_availability));
										tr_body.appendChild(set_td_data('td', data.items[0].returns.result[i].departure_time+'-'+data.items[0].returns.result[i].arrival_time));
										//tr_body.appendChild(set_td_data('td', data.items[0].returns.result[i].arrival_time));
										//tr_body.appendChild(set_td_data('td', data.items[0].returns.result[i].duration));
												
										var td1 = document.createElement('td');
										var p1 = document.createElement('p');
										p1.appendChild(document.createTextNode('Dewasa: '+data.items[0].returns.result[i].price_adult));
										td1.appendChild(p1);
												
										var p2 = document.createElement('p');
										p2.appendChild(document.createTextNode('Anak(3-9thn): '+data.items[0].returns.result[i].price_child));
										td1.appendChild(p2);
												
										var p3 = document.createElement('p');
										p3.appendChild(document.createTextNode('Bayi: '+data.items[0].returns.result[i].price_infant));
										td1.appendChild(p3);
												
										tr_body.appendChild(td1);
											
										var el_td = document.createElement('td');
										var input = document.createElement('input');
										input.setAttribute('type', 'radio');
										input.setAttribute('name', 'jadwal-pulang');
										input.setAttribute('id', data.items[0].returns.result[i].train_id);
										input.setAttribute('value', data.items[0].returns.result[i].train_id+'/'+data.items[0].search_queries.return_date+'/'+data.items[0].returns.result[i].departure_time+'/'+data.items[0].returns.result[i].subclass_name+'/'+data.items[0].returns.result[i].train_name);
										var label = document.createElement('label');
										label.setAttribute('for', data.items[0].returns.result[i].train_id);
										label.setAttribute('style', 'font-size: 10px;');
										label.innerHTML = 'Pilih';
										el_td.appendChild(input);
										el_td.appendChild(label);
												
										tr_body.appendChild(el_td);			
										table.appendChild(tr_body);
									}
											
									div_tab2.append(table);
								}
								else {
									$('#faqkonten').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>');
								}
							}
						});
					}
					
					$('#tab-3').append('<div id="chosen-depart"></div><div id="chosen-return" style="padding-top:30px"></div><button id="btn" style="margin-top:30px" class="button-1">Lanjutkan ke Pemesanan</button>');
					$("input[name='jadwal-pergi']").change(function(){
						var str = $(this).val();
						train_pergi = $(this).val();
						var field = str.split('/',5);
							
						$('#chosen-depart').empty();
						$('#chosen-depart').append('<div>\
							<p><strong>Jadwal Pergi yang Dipilih:</strong></p>\
							<p>Kereta = '+field[4]+'</p>\
							<p>Train ID = #'+field[0]+'</p>\
							<p>Subclass = #'+field[3]+'</p>\
							<p>Tanggal = '+field[1]+'</p>\
							<p>Jam = '+field[2]+'</p>\
							</div>');
					});
					$("input[name='jadwal-pulang']").change(function(){
						var str = $(this).val();
						train_pulang = $(this).val();
						var field = str.split('/',5);
							
						$('#chosen-return').empty();
						$('#chosen-return').append('<div>\
							<p><strong>Jadwal Pulang yang Dipilih:</strong></p>\
							<p>Kereta = '+field[4]+'</p>\
							<p>Train ID = #'+field[0]+'</p>\
							<p>Subclass = #'+field[3]+'</p>\
							<p>Tanggal = '+field[1]+'</p>\
							<p>Jam = '+field[2]+'</p>\
							</div>');
					});
					$('#btn').click(function(event) {
						var train_1 = $("input[name='jadwal-pergi']").val();
						var train_2 = $("input[name='jadwal-pulang']").val();
							
						if(train_pergi=="" || train_pulang=="")
							alert('Terdapat jadwal kereta yang belum dipilih, mohon cek kembali.');
						else{
							var split_1 = train_pergi.split('/',4);
							var split_2 = train_pulang.split('/',4);
							/* 
								split_1[0-3] = train_id/dep_date/dep_time/subclass
								split_2[0-3] = train_id_ret/ret_date/ret_time/subclass_ret
							*/
							if(split_1[1]==split_2[1]) //jika tanggal sama, waktu pulang tidak boleh lebih kecil dari waktu berangkat
							{
								if(split_1[2]>split_2[2])
									alert('Di tanggal yang sama, waktu pulang harus lebih besar dari waktu pergi.');
								else
									window.location.href = '<?php echo base_url();?>index.php/webfront/form_passengers/train?tid_dep='+split_1[0]+'&dep_date='+split_1[1]+'&sc_dep='+split_1[3]+'&tid_ret='+split_2[0]+'&ret_date='+split_2[1]+'&sc_ret='+split_2[3]+'&dari=<?php echo $this->input->get('dari',TRUE);?>&ke=<?php echo $this->input->get('ke',TRUE);?>&adult=<?php echo $this->input->get('dewasa',TRUE);?>&child=<?php echo $this->input->get('anak',TRUE);?>&infant=<?php echo $this->input->get('bayi',TRUE);?>';
							}
							else
								window.location.href = '<?php echo base_url();?>index.php/webfront/form_passengers/train?tid_dep='+split_1[0]+'&dep_date='+split_1[1]+'&sc_dep='+split_1[3]+'&tid_ret='+split_2[0]+'&ret_date='+split_2[1]+'&sc_ret='+split_2[3]+'&dari=<?php echo $this->input->get('dari',TRUE);?>&ke=<?php echo $this->input->get('ke',TRUE);?>&adult=<?php echo $this->input->get('dewasa',TRUE);?>&child=<?php echo $this->input->get('anak',TRUE);?>&infant=<?php echo $this->input->get('bayi',TRUE);?>';
						}
					});
					$(function() {
						$( "#tabs" ).tabs();
					});
				}
			}
		}
	}
	
	function search_hotel(params){
			//cindy nordiansyah
			//Tanggal check-in lebih kecil dari tanggal hari ini
			<?php
				$datetime1 = date_create(date('Y-m-d'));
				$datetime2 = date_create($this->input->get('checkin', TRUE));
				$interval = date_diff($datetime1, $datetime2);
				$diff = $interval->format('%R%a');
				echo 'var diff_date_in_now = '.$diff.';';
			?>
			//Tanggal check-in lebih besar dari tanggal check out
			//Lama menginap lebih dari 100 hari (max 99 hari)
			<?php
				$datetime1 = date_create($this->input->get('checkin', TRUE));
				$datetime2 = date_create($this->input->get('checkout', TRUE));
				$interval = date_diff($datetime1, $datetime2);
				$diff = $interval->format('%R%a');
				echo 'var diff_date_in_out = '.$diff.';';
			?>
			<?php
				$rooms = $this->input->get('room', TRUE);		
				echo 'var rooms_quantity = "'.$rooms.'";';
			?>
			//Memesan 10 kamar(max 8 kamar)
			
			//console.log('diff date now = '+diff_date_in_now);
			//console.log('diff date in out = '+diff_date_in_out);
			//console.log('room = '+rooms_quantity);
			
			$('#faqkonten').empty();
			if(diff_date_in_now<0){	
				$('#faqkonten').append('<p style="color:red">Tanggal Check-In Tidak Boleh Kurang Dari Hari Ini.</p>');
				
			}
			else {
				if(diff_date_in_out>=100){
					
					$('#faqkonten').append('<p style="color:red">Tanggal Check-Out Tidak Boleh Lebih Dari 99 Hari Sejak Check-In.</p>');
				}
				else if(diff_date_in_out<0){
					$('#faqkonten').append('<p style="color:red">Tanggal Check-Out Tidak Boleh Kurang Dari Tanggal Check-In.</p>');
				}						
				else {
					if(rooms_quantity>8){
						$('#faqkonten').append('<p style="color:red">Dalam Satu Kali Pemesanan Dibatasi Maksimum 8 Kamar.</p>');
					}
					else {
						
						$('#faqkonten').append('<span class="judul20">Hasil Pencarian Data Hotel (Urutan dari harga termurah), <?php echo $this->input->get('checkin',TRUE);?> - <?php echo $this->input->get('checkout',TRUE);?> Kamar:<?php echo $this->input->get('room',TRUE);?> Malam:<?php echo $this->input->get('night',TRUE);?> Dewasa:<?php echo $this->input->get('dewasa',TRUE);?> Anak:<?php echo $this->input->get('anak',TRUE);?></span><br /><br>');
						$.ajax({
							type : "GET",
							url: '<?php echo base_url();?>index.php/hotel/tiketcom_search_hotels',
							data: params,
							cache: false,
							dataType: "json",
							success:function(data){
									if(data==''){
										$('#faqkonten').append('<p>Maaf, data tidak ada untuk pencarian ini.<p>');
									}
									else{
										//console.log('data= '+data);
										$('#faqkonten').append('<p>Harga mulai dari IDR '+currency_separator(data.items[0].search_queries.minprice, '.')+' - IDR '+currency_separator(data.items[0].search_queries.maxprice, '.')+'</p>');
										if(data.items[0].diagnostic.status=="200"){
											var div = $("#faqkonten");
											var table = document.createElement('table');
											table.setAttribute('id', 'search-result');
											var tbody = document.createElement('tbody');
											for(var i=0; i<data.items[0].results.result.length;i++){
												var tr_body = document.createElement('tr');
												
												var td1 = document.createElement('td');
												var img = document.createElement('img');
												var path = data.items[0].results.result[i].photo_primary;
												img.src = path.replace(/\\/g, '')
												img.setAttribute('width', '120px');
												img.setAttribute('height', '100px');
												td1.appendChild(img);
												var p1 = document.createElement('p');
												p1.appendChild(document.createTextNode(data.items[0].results.result[i].name));
												td1.appendChild(p1);
												var p2 = document.createElement('p');
												p2.appendChild(document.createTextNode(data.items[0].results.result[i].address));
												td1.appendChild(p2);
												var a_peta = document.createElement('a');
												var a_peta_str = document.createTextNode('Lihat Peta');
												a_peta.appendChild(a_peta_str);
												a_peta.setAttribute('class','fancybox fancybox.iframe');
												a_peta.setAttribute('href', 'https://www.google.com/maps/embed/v1/view?key=<?php echo $this->config->item('google_api_key');?>&center='+data.items[0].results.result[i].latitude+','+data.items[0].results.result[i].longitude+'&zoom=18&maptype=roadmap');
												td1.appendChild(a_peta);
												
												var td2 = document.createElement('td');
												td2.setAttribute('width', '250px');
												var p3 = document.createElement('p');
												p3.appendChild(document.createTextNode('Harga: IDR '+currency_separator(data.items[0].results.result[i].price, '.')));
												td2.appendChild(p3);
												var p4 = document.createElement('p');
												p4.appendChild(document.createTextNode('Kamar Tersedia: '+data.items[0].results.result[i].room_available));
												td2.appendChild(p4);
												var p6 = document.createElement('p');
												p6.appendChild(document.createTextNode('Bintang : '+data.items[0].results.result[i].star_rating));
												td2.appendChild(p6);
												var p7 = document.createElement('p');
												p7.appendChild(document.createTextNode('Rating Pelanggan: '+data.items[0].results.result[i].rating+'/10'));
												td2.appendChild(p7);
												var p5 = document.createElement('p');
												p5.appendChild(document.createTextNode('Fasilitas: '+data.items[0].results.result[i].room_facility_name));
												td2.appendChild(p5);
												
												tr_body.appendChild(td1);
												tr_body.appendChild(td2);
												
												var el_td = document.createElement('td');
												var link_order = document.createElement('a');
												var str = document.createTextNode('Pesan');
												link_order.appendChild(str);
												//link_order.setAttribute('href', '<?php echo base_url();?>index.php/webfront/form_detil_hotel/'+data.items[0].results.result[i].id+'/<?php echo $this->input->get('query',TRUE);?>/<?php echo $this->input->get('checkin',TRUE);?>/<?php echo $this->input->get('checkout',TRUE);?>/<?php echo $this->input->get('room',TRUE);?>/<?php echo $this->input->get('dewasa',TRUE);?>/<?php echo $this->input->get('anak',TRUE);?>/<?php echo $this->input->get('night',TRUE);?>');
												//https://api.master18.tiket.com/the-101-legian?startdate=2012-06-11&enddate=2012-06-12&night=1&room=1&adult=2&child=0&uid=business%3A4108&token=1c78d7bc29690cd96dfce9e0350cfc51&output=json
												//link_order.setAttribute('href', '<?php echo base_url();?>index.php/hotel/show_hotel_rooms/'+data.items[0].results.result[i].name+'/<?php echo $this->input->get('query',TRUE);?>/<?php echo $this->input->get('checkin',TRUE);?>/<?php echo $this->input->get('checkout',TRUE);?>/<?php echo $this->input->get('room',TRUE);?>/<?php echo $this->input->get('dewasa',TRUE);?>/<?php echo $this->input->get('anak',TRUE);?>/<?php echo $this->input->get('night',TRUE);?>');
												var business_uri = data.items[0].results.result[i].business_uri;
												var business_uri_split = business_uri.split("/");
												//var nama_hotel = business_uri_split[0].split("/");
	
												//business_uri = uri_split[1].replace('&latitude=0&longitude=0&distance=0','');
												//console.log('uri split = '+uri_split);
												link_order.setAttribute('href', '<?php echo base_url();?>index.php/webfront/form_detil_hotel/'+business_uri_split[7]);
												link_order.setAttribute('class', 'tombol-pesan');
												el_td.appendChild(link_order);
												tr_body.appendChild(el_td);
												
												table.appendChild(tr_body);
											}
											
											div.append(table);
										}
										else {
										$('#faqkonten').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>');
									}
									}
								}
						})
					}
				}
				
			}
			
			
			
	}
	
	$(document).ready(function() {

		/* This is basic - uses default settings */
		$('.fancybox').fancybox();
	});
</script>	