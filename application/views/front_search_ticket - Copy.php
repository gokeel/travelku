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
			$('#faqkonten').empty();
			$('#faqkonten').append('<span class="judul20">Hasil Pencarian Data Pesawat (Urutan dari harga termurah), <?php echo $this->input->get('dari',TRUE);?> - <?php echo $this->input->get('ke',TRUE);?> Tanggal Berangkat: <?php echo $this->input->get('flight-pergi',TRUE);?></span><br /><br>');
			check_passenger = check_total_passenger('flight',<?php echo intval($this->input->get('dewasa',TRUE)).','.intval($this->input->get('anak',TRUE)).','.intval($this->input->get('bayi',TRUE));?>);
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
						data: params,
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
										tr_head.appendChild(set_td_data('th', 'Kode Penerbangan'));
										tr_head.appendChild(set_td_data('th', 'Rute & Jam'));
										tr_head.appendChild(set_td_data('th', 'Harga'));
										tr_head.appendChild(set_td_data('th', 'Pesan'));
										table.appendChild(tr_head);
										
										var tbody = document.createElement('tbody');
										
										
										for(var i=0; i<data.items[0].departures.result.length;i++){
											var tr_body = document.createElement('tr');
											tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].airlines_name));
											tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].flight_number));
											tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].full_via));
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
							}
					})
				}
				
			}
			
	}
	function search_train(params){
			var dari = '<?php echo $this->input->get('dari',TRUE);?>';
			var ke = '<?php echo $this->input->get('ke',TRUE);?>';
			var berangkat = '<?php echo $this->input->get('train-pergi',TRUE);?>';
			var adult = '<?php echo $this->input->get('dewasa',TRUE);?>';
			var child = '<?php echo $this->input->get('anak',TRUE);?>';
			var infant = '<?php echo $this->input->get('bayi',TRUE);?>';
			$('#faqkonten').empty();
			$('#faqkonten').append('<span class="judul20">Hasil Pencarian Data Pesawat (Urutan dari harga termurah), '+dari+' - '+ke+' Tanggal Berangkat: '+berangkat+'</span><br /><br>');
			
			//checking input
			if(dari==ke)
				$('#faqkonten').append('<p style="color:red">Stasiun asal tidak boleh sama dengan stasiun tujuan</p>');
			else{
				var check_passenger = check_total_passenger('train', parseInt(adult), parseInt(child), parseInt(infant));
				if(check_passenger != 'ok')
					$('#faqkonten').append('<p style="color:red">'+check_passenger+'</p>');
				else {
					<?php
						$datetime1 = date_create(date('Y-m-d'));
						$datetime2 = date_create($this->input->get('train-pergi', TRUE));
						$interval = date_diff($datetime1, $datetime2);
						$diff = intval($interval->format('%a'));
						echo 'var diff_date = '.$diff.';';
					?>
					if(diff_date>90)
						$('#faqkonten').append('<p style="color:red">Pencarian Kereta Hanya Tersedia Sampai 90 Hari Kedepan.</p>');
					else{
						$.ajax({
							type : "GET",
							url: '<?php echo base_url();?>index.php/train/search_trains',
							data: params,
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
												link_order.setAttribute('href', '<?php echo base_url();?>index.php/webfront/form_passengers/train/'+data.items[0].departures.result[i].schedule_id+'/'+data.items[0].search_queries.date+'/<?php echo $this->input->get('dari',TRUE);?>/<?php echo $this->input->get('ke',TRUE);?>/<?php echo $this->input->get('dewasa',TRUE);?>/<?php echo $this->input->get('anak',TRUE);?>/<?php echo $this->input->get('bayi',TRUE);?>');
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
	
	function search_hotel(params){
			$('#faqkonten').empty();
				
				$('#faqkonten').append('<span class="judul20">Hasil Pencarian Data Pesawat (Urutan dari harga termurah), <?php echo $this->input->get('checkin',TRUE);?> - <?php echo $this->input->get('checkout',TRUE);?> Kamar:<?php echo $this->input->get('room',TRUE);?> Malam:<?php echo $this->input->get('night',TRUE);?> Dewasa:<?php echo $this->input->get('dewasa',TRUE);?> Anak:<?php echo $this->input->get('anak',TRUE);?></span><br /><br>');
				$.ajax({
					type : "GET",
					url: '<?php echo base_url();?>index.php/hotel/search_hotels',
					data: params,
					cache: false,
					dataType: "json",
					success:function(data){
							if(data==''){
								$('#faqkonten').append('<p>Maaf, data tidak ada untuk rute ini.<p>');
							}
							else{
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
										img.src = path.replace(/\\/g, '');
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
										p3.appendChild(document.createTextNode('Harga: '+data.items[0].results.result[i].price));
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
										link_order.setAttribute('href', '<?php echo base_url();?>index.php/webfront/form_passengers/hotel/'+data.items[0].results.result[i].id+'/<?php echo $this->input->get('query',TRUE);?>/<?php echo $this->input->get('checkin',TRUE);?>/<?php echo $this->input->get('checkout',TRUE);?>/<?php echo $this->input->get('room',TRUE);?>/<?php echo $this->input->get('dewasa',TRUE);?>/<?php echo $this->input->get('anak',TRUE);?>/<?php echo $this->input->get('night',TRUE);?>');
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
	
	$(document).ready(function() {

		/* This is basic - uses default settings */
		$('.fancybox').fancybox();
	});
</script>	