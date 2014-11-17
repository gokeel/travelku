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
							<p align="justify"><span class="judul46">Form Tamu Hotel</span><br /><br /><br /></p>
							<p align="justify"><span class="judul18">Mohon untuk mengisi semua input berikut ini:</span><br /><br /><br /></p>
							<form id="form-order" name="form-order" method="post" action="<?php 
								if ($uri3=='flight') echo base_url('index.php/order/add_flight_order');
								else if ($uri3=='train') echo base_url('index.php/order/add_train_order');
								else if ($uri3=='hotel') echo base_url('index.php/hotel/tiketcom_checkout_customer');
								?>">
								<!--<input type="hidden" name="id" value="<?php //echo $uri4;?>">--> 
								<!--<input type="hidden" name="departing_date" value="<?php echo $uri5;?>">--> 
								<p align="justify"><span class="judul18">Detil <?php if($uri3=='flight') echo 'Penerbangan'; elseif($uri3=='train') echo 'Kereta Api';elseif($uri3=='hotel') echo 'Hotel';?></span><br /><br /></p>
								<div id="detail"></div>
								<br /><br />
								<p align="justify"><span class="judul18">Informasi Kontak yang Dapat Dihubungi</span><br /><br /></p>
								<div id="contact-person"></div>
								<br /><br />
								<p align="justify"><span class="judul18">Informasi Tamu yang Akan Check In</span><br /><br /></p>
								<div id="hotel-guest"></div>
								<br /><br />
								<!--<p align="justify"><span class="judul18">Data Penumpang Anak</span><br /><br /></p>
								<div id="passenger-child"></div>
								<br /><br />
								<p align="justify"><span class="judul18">Data Penumpang Bayi</span><br /><br /></p>
								<div id="passenger-infant"></div>
								<br /><br />-->
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
	$( window ).load(function() {
		load_admin_fee();
		<?php
			if ($uri3=='flight')
				echo 'get_detail_flight()';
			else if ($uri3 == 'train')
				echo 'get_detail_train()';
			else if ($uri3 == 'hotel')
				echo 'get_detail_hotel()';
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
				if(data.nominal!='')
					admin_fee = parseInt(datajson.nominal);
			}
		});
	}
	
	
	function get_detail_hotel(){
		<?php
			// $hotel_id = $this->uri->segment(4);
			// echo 'var hotel_id = "'.$hotel_id.'";';
			// $query = $this->uri->segment(5);
			// echo 'var query = "'.$query.'";';
			// $checkin = $this->uri->segment(6);
			// echo 'var checkin = "'.$checkin.'";';
			// $checkout = $this->uri->segment(7);
			// echo 'var checkout = "'.$checkout.'";';
			// $room = $this->uri->segment(8);
			// echo 'var room = "'.$room.'";';
			// $adult = $this->uri->segment(9);
			// echo 'var adult = "'.$adult.'";';
			// $child = $this->uri->segment(10);
			// echo 'var child = "'.$child.'";';
			// $night = $this->uri->segment(11);
			// echo 'var night = "'.$night.'";';
			// $request = 'id='.$hotel_id.'&query='.$query.'&checkin='.$checkin.'&checkout='.$checkout.'&room='.$room.'&dewasa='.$adult.'&anak='.$child.'&night='.$night;
		 ?>
		// $.ajax({
			// type : "GET",
			// url: "<?php echo base_url('index.php/hotel/tiketcom_checkout_customer');?>",
			// data: "<?php echo $request;?>",
			// cache: false,
			// dataType: "json",
			// success:function(data){
				// for(var i=0; i<data.items[0].results.result.length;i++){
					// if (hotel_id == data.items[0].results.result[i].id){
						// var total_price = admin_fee + parseInt(data.items[0].results.result[i].price);
						// $('#detail').empty();
						// /*create input contains data*/
						// $('#detail').append('\
						// <input type="hidden" name="hotel_id" value="'+data.items[0].results.result[i].id+'">\
						// <input type="hidden" name="hotel_name" value="'+data.items[0].results.result[i].name+'">\
						// <input type="hidden" name="hotel_address" value="'+data.items[0].results.result[i].address+'">\
						// <input type="hidden" name="regional" value="'+data.items[0].results.result[i].regional+'">\
						// <input type="hidden" name="checkin" value="'+checkin+'">\
						// <input type="hidden" name="checkout" value="'+checkout+'">\
						// <input type="hidden" name="room" value="'+room+'">\
						// <input type="hidden" name="price" value="'+data.items[0].results.result[i].price+'">\
						// <input type="hidden" name="admin_fee" value="'+admin_fee+'">\
						// <input type="hidden" name="tot_adult" value="'+adult+'">\
						// <input type="hidden" name="night" value="'+night+'">\
						// ');
						// /*fetch data*/
						// $('#detail').append('\
							// <table id="passenger">\
								// <tr>\
									// <td><p><strong>'+data.items[0].results.result[i].name+'</strong></p>\
										// <p>Checkin - Checkout: '+checkin+' - '+checkout+'</p>\
									// </td>\
								// </tr>\
								// <tr>\
									// <td style="padding-top:15px;">\
									// <p>Kamar: '+room+'</p>\
									// <p>Dewasa: '+adult+'</p>\
									// <p>Anak: '+child+'</p>\
									// <p>Harga: '+currency_separator(data.items[0].results.result[i].price, '.')+'</p>\
									// <p>Biaya Administrasi: '+currency_separator(admin_fee, '.')+'</p>\
									// <p>Total harus dibayar: IDR <strong>'+currency_separator(total_price, '.')+'</strong></p>\
									// </td>\
								// </tr>\
							// </table>');
						create_form_hotel('#pemesan', 1, 'con', 0);
						create_form_hotel('#passenger-adult', 1, 'a', 0);
					//}
				//}
			//}
		//});
	};
	
	function create_form(el_div, n, who, tot_adult){
		var div = $(el_div);
		if (n>0){
			for (var i=0; i<n; i++){
				idx = i + 1;
				if (who=='con'){
					$(el_div).append('<fieldset style="margin-top: 10px;">\
						<table id="passenger">\
							<tr>\
								<td>Titel</td>\
								<td><select id="conSalutation" type="text" name="conSalutation"><option value="Mr">Tuan</option><option value="Mrs">Nyonya</option><option value="Ms">Nona</option></select></td>\
								<td>ID Card(KTP/SIM/Kartu Pelajar)</td>\
								<td><input type="text" name="conid"></td>\
							</tr>\
							<tr>\
								<td>Nama Depan</td>\
								<td><input type="text" name="conFirstName"></td>\
								<td>Nama Belakang</td>\
								<td><input type="text" name="conLastName"></td>\
							</tr>\
							<tr>\
								<td>Email</td>\
								<td><input type="text" name="conEmailAddress"></td>\
								<td>Telepon/HP 1</td>\
								<td><input type="text" name="conPhone"></td>\
							</tr>\
						</table>\
						\
						</fieldset>');
				}
				else if(who=='a'){
					$(el_div).append('<fieldset style="margin-top: 10px;">\
						<legend>Penumpang Dewasa '+idx+'</legend>\
						<table id="passenger">\
							<tr>\
								<td>Titel</td>\
								<td><select id="titlea'+idx+'" type="text" name="titlea'+idx+'"><option value="Mr">Tuan</option><option value="Mrs">Nyonya</option><option value="Ms">Nona</option></select></td>\
								<td>ID Card(KTP/SIM/Kartu Pelajar)</td>\
								<td><input type="text" name="ida'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Nama Depan</td>\
								<td><input type="text" name="firstnamea'+idx+'"></td>\
								<td>Nama Belakang</td>\
								<td><input type="text" name="lastnamea'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Tanggal Lahir (Format: YYYY-MM-DD)</td>\
								<td><input type="text" name="birthdatea'+idx+'" id="birthdatea'+idx+'"></td>\
								<td>Telepon/HP 1</td>\
								<td><input type="text" name="phonea'+idx+'"></td>\
							</tr>\
						</table>\
						\
						</fieldset>');
					$(function() {
						$( "#birthdatea"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				}
				else if(who=='c'){
					$(el_div).append('<fieldset style="margin-top: 10px;">\
						<legend>Penumpang Anak '+idx+'</legend>\
						<table id="passenger">\
							<tr>\
								<td>Titel</td>\
								<td><select id="titlec'+idx+'" type="text" name="titlec'+idx+'"><option value="Mstr">Tuan</option><option value="Miss">Nona</option></select></td>\
								<td>ID Card(KTP/SIM/Kartu Pelajar)</td>\
								<td><input type="text" name="idc'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Nama Depan</td>\
								<td><input type="text" name="firstnamec'+idx+'"></td>\
								<td>Nama Belakang</td>\
								<td><input type="text" name="lastnamec'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Tanggal Lahir (Format: YYYY-MM-DD)</td>\
								<td><input type="text" name="birthdatec'+idx+'" id="birthdatec'+idx+'"></td>\
								<td></td>\
								<td></td>\
							</tr>\
						</table>\
						\
						</fieldset>');
					$(function() {
						$( "#birthdatec"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				}
				else if(who=='i'){
					$(el_div).append('<fieldset style="margin-top: 10px;">\
						<legend>Penumpang Bayi '+idx+'</legend>\
						<table id="passenger">\
							<tr>\
								<td>Titel</td>\
								<td><select id="titlei'+idx+'" type="text" name="titlei'+idx+'"><option value="Mstr">Tuan</option><option value="Miss">Nona</option></select></td>\
								<td>Orang Tua</td>\
								<td><select id="parenti'+idx+'" name="parenti'+idx+'">'+create_opt_parents(tot_adult)+'</select></td>\
							</tr>\
							<tr>\
								<td>Nama Depan</td>\
								<td><input type="text" name="firstnamei'+idx+'"></td>\
								<td>Nama Belakang</td>\
								<td><input type="text" name="lastnamei'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Tanggal Lahir (Format: YYYY-MM-DD)</td>\
								<td><input type="text" name="birthdatei'+idx+'" id="birthdatei'+idx+'"></td>\
								<td></td>\
								<td></td>\
							</tr>\
						</table>\
						\
						</fieldset>');
					$(function() {
						$( "#birthdatei"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				}
				
			}
		}
	}
	
	function create_form_hotel(el_div, n, who, tot_adult){
		var div = $(el_div);
		if (n>0){
			for (var i=0; i<n; i++){
				idx = i + 1;
				if (who=='con'){
					$(el_div).append('<fieldset style="margin-top: 10px;">\
						<table id="passenger">\
							<tr>\
								<td>Titel</td>\
								<td><select id="conSalutation" type="text" name="conSalutation"><option value="Mr">Tuan</option><option value="Mrs">Nyonya</option><option value="Ms">Nona</option></select></td>\
								<td>ID Card(KTP/SIM/Kartu Pelajar)</td>\
								<td><input type="text" name="conid"></td>\
							</tr>\
							<tr>\
								<td>Nama Depan</td>\
								<td><input type="text" name="conFirstName"></td>\
								<td>Nama Belakang</td>\
								<td><input type="text" name="conLastName"></td>\
							</tr>\
							<tr>\
								<td>Email</td>\
								<td><input type="text" name="conEmailAddress"></td>\
								<td>Telepon/HP 1</td>\
								<td><input type="text" name="conPhone"></td>\
							</tr>\
						</table>\
						\
						</fieldset>');
				}
				else if(who=='a'){
					$(el_div).append('<fieldset style="margin-top: 10px;">\
						<legend>Penumpang Dewasa '+idx+'</legend>\
						<table id="passenger">\
							<tr>\
								<td>Titel</td>\
								<td><select id="titlea'+idx+'" type="text" name="titlea'+idx+'"><option value="Mr">Tuan</option><option value="Mrs">Nyonya</option><option value="Ms">Nona</option></select></td>\
								<td>ID Card(KTP/SIM/Kartu Pelajar)</td>\
								<td><input type="text" name="ida'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Nama Depan</td>\
								<td><input type="text" name="firstnamea'+idx+'"></td>\
								<td>Nama Belakang</td>\
								<td><input type="text" name="lastnamea'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Tanggal Lahir (Format: YYYY-MM-DD)</td>\
								<td><input type="text" name="birthdatea'+idx+'" id="birthdatea'+idx+'"></td>\
								<td>Telepon/HP 1</td>\
								<td><input type="text" name="phonea'+idx+'"></td>\
							</tr>\
						</table>\
						\
						</fieldset>');
					$(function() {
						$( "#birthdatea"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				}
				else if(who=='c'){
					$(el_div).append('<fieldset style="margin-top: 10px;">\
						<legend>Penumpang Anak '+idx+'</legend>\
						<table id="passenger">\
							<tr>\
								<td>Titel</td>\
								<td><select id="titlec'+idx+'" type="text" name="titlec'+idx+'"><option value="Mstr">Tuan</option><option value="Miss">Nona</option></select></td>\
								<td>ID Card(KTP/SIM/Kartu Pelajar)</td>\
								<td><input type="text" name="idc'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Nama Depan</td>\
								<td><input type="text" name="firstnamec'+idx+'"></td>\
								<td>Nama Belakang</td>\
								<td><input type="text" name="lastnamec'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Tanggal Lahir (Format: YYYY-MM-DD)</td>\
								<td><input type="text" name="birthdatec'+idx+'" id="birthdatec'+idx+'"></td>\
								<td></td>\
								<td></td>\
							</tr>\
						</table>\
						\
						</fieldset>');
					$(function() {
						$( "#birthdatec"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
					});
				}
				else if(who=='i'){
					$(el_div).append('<fieldset style="margin-top: 10px;">\
						<legend>Penumpang Bayi '+idx+'</legend>\
						<table id="passenger">\
							<tr>\
								<td>Titel</td>\
								<td><select id="titlei'+idx+'" type="text" name="titlei'+idx+'"><option value="Mstr">Tuan</option><option value="Miss">Nona</option></select></td>\
								<td>Orang Tua</td>\
								<td><select id="parenti'+idx+'" name="parenti'+idx+'">'+create_opt_parents(tot_adult)+'</select></td>\
							</tr>\
							<tr>\
								<td>Nama Depan</td>\
								<td><input type="text" name="firstnamei'+idx+'"></td>\
								<td>Nama Belakang</td>\
								<td><input type="text" name="lastnamei'+idx+'"></td>\
							</tr>\
							<tr>\
								<td>Tanggal Lahir (Format: YYYY-MM-DD)</td>\
								<td><input type="text" name="birthdatei'+idx+'" id="birthdatei'+idx+'"></td>\
								<td></td>\
								<td></td>\
							</tr>\
						</table>\
						\
						</fieldset>');
					$(function() {
						$( "#birthdatei"+idx ).datepicker({"dateFormat": "yy-mm-dd"});
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
	
</script>