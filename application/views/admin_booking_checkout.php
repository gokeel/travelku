<?php
	$type = $this->uri->segment(3);
	$id = $this->uri->segment(4);
?>
<!--<style type="text/css">
.yui3-panel {
    outline: none;
}
.yui3-panel-content .yui3-widget-hd {
    font-weight: bold;
}
.yui3-panel-content .yui3-widget-bd {
    padding: 15px;
}
.yui3-panel-content label {
    margin-right: 30px;
}
.yui3-panel-content fieldset {
    border: none;
    padding: 0;
}
.yui3-panel-content input[type="text"] {
    border: none;
    border: 1px solid #ccc;
    padding: 3px 7px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: 100%;
    width: 200px;
}

#addRow {
    margin-top: 10px;
}

</style>
-->
<div id="content"  style="min-height:400px;"> 
  <!--content--> 
	
	<div class="frametab">
		<h3 style="margin:5px 0 5px 5px;">Proses Booking & Issued</h3>
		<div id="data-order">
				<div id="data-booking-code"></div>
				<div id="data-general"></div>
				<div id="data-pemesan"></div>
				<div id="data-adult"></div>
				<div id="data-child"></div>
				<div id="data-infant"></div>
		</div>
	</div> 
	
	<div id="panel-add-bc">
		<div class="yui3-widget-bd">
			<form id="form-add-bc" name="form-add-bc">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<fieldset>
					<p>
						<label for="bank-name">Kode Booking</label>
						<input type="text" name="bc" id="bc" placeholder="">
					</p>
				</fieldset>
			</form>
		</div>
	</div>
	<div id="panel-send-bc">
		<div class="yui3-widget-bd">
			<form id="form-send-bc" name="form-send-bc">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<fieldset>
					<p>
						<label for="bank-name">Konten Email</label>
						<!--<input class="editor" name="email_content" id="email_content">-->
						<textarea name="email_content" id="email_content" style="width: 450px; height: 250px;"></textarea>
					</p>
				</fieldset>
			</form>
		</div>
	</div>
</div>

<script>
	$(".editor").jqte();
</script>
<script>
	<?php
		echo 'var type = "'.$type.'";';
		echo 'var id = "'.$id.'";';
	?>
	$.ajax({
		type : "GET",
		url: '<?php echo base_url();?>index.php/order/get_order_by_id/<?php echo $type;?>/<?php echo $id;?>',
		async: false,
		dataType: "json",
		success:function(data){
			//generate booking code
			$('#data-booking-code').empty();
			$('#data-booking-code').append('<h2>Kode Booking<h2>');
			var bc_is_null = false;
			if(data.responses.general[0].booking_code==null || data.responses.general[0].booking_code=="")
				bc_is_null = true;
			
			var in_red = disabled = '';
			if(bc_is_null==true){
				in_red = ';color:red;';
				disabled = 'disabled';
			}
			
			var str_bc = '<table style="margin-left:0px">\
						<tr>\
							<td><strong>Kode Booking</strong></td>\
							<td style="width:200px'+in_red+'">'+(bc_is_null==true ? "BELUM ADA" : data.responses.general[0].booking_code)+'</td>\
							<td><button id="add-bc">Tambah/Ubah Kode Booking</button></td>\
							<td><button id="send-bc" '+disabled+'>Kirim kode booking ke customer</button></td>\
							<td><button id="issued" '+disabled+'>Issued</button></td>\
						</tr>\
					</table>';
			$('#data-booking-code').append(str_bc);
			$('#issued').click(function(event) {
				event.preventDefault();
				$.ajax({
					type : "GET",
					url: '<?php echo base_url();?>index.php/order/issued_order_by_system/<?php echo $id;?>',
					cache: false,
					dataType: "json",
					success:function(data){
						if (data.response=="nok")
							alert(data.message);
						else if (data.response=="ok")
							window.location.assign('<?php echo base_url();?>index.php/admin/booking_page');
					}
				})
			});
			//generate general info
			$('#data-general').empty();
			$('#data-general').append('<h2>Data Detil Pemesanan</h2>');
			// FLIGHT
			if (type=="flight"){
				var str = '<table style="margin-left:0px">\
						<tr>\
							<td><strong>Total Harga</strong></td>\
							<td style="width:200px">IDR '+currency_separator(data.responses.general[0].total_price, '.')+'</td>\
						</tr>\
						<tr>\
							<td><strong>Nama Agen</strong></td>\
							<td style="width:200px">'+data.responses.general[0].agent_name+'</td>\
							<td><strong>Rute & Jenis Perjalanan</strong></td>\
							<td style="width:200px">'+data.responses.general[0].route+'<br />'+(data.responses.general[0].is_round_trip=="true" ? 'Round Trip' : 'Single Trip')+'</td>\
						</tr>';
				var second_row_left = '<td><strong>Perjalanan Berangkat</strong></td>\
							<td style="width:200px">'+data.responses.general[0].airline_name_depart+' - '+data.responses.general[0].flight_id_depart+'<br />'+data.responses.general[0].departing_date+'<br />'+data.responses.general[0].time_travel+'</td>';
				var second_row_right = '';
				var third_row_left = '';
				var third_row_right = '';
					
				if(data.responses.general[0].is_round_trip=="true"){
					second_row_right += '<td><strong>Perjalanan Kembali</strong></td>\
							<td style="width:200px">'+data.responses.general[0].airline_name_return+'<br />'+data.responses.general[0].flight_id_return+'<br />'+data.responses.general[0].returning_date+'<br />'+data.responses.general[0].time_travel_ret+'</td>';
						
					/*penghitungan harga per penumpang*/
					var dewasa = dewasa_ret = anak = anak_ret = bayi = bayi_ret = '';
					var harga_dewasa = harga_dewasa_ret = harga_anak = harga_anak_ret = harga_bayi = harga_bayi_ret = 0;
						
					if(parseInt(data.responses.general[0].adult) > 0){
						harga_dewasa = parseInt(data.responses.general[0].adult) * parseInt(data.responses.general[0].price_adult);
						harga_dewasa_ret = parseInt(data.responses.general[0].adult) * parseInt(data.responses.general[0].price_adult_ret);
						dewasa += 'Dewasa: '+data.responses.general[0].adult+' x IDR '+currency_separator(data.responses.general[0].price_adult, '.')+' = IDR '+currency_separator(harga_dewasa, '.')+'<br />';
						dewasa_ret += 'Dewasa: '+data.responses.general[0].adult+' x IDR '+currency_separator(data.responses.general[0].price_adult_ret, '.')+' = IDR '+currency_separator(harga_dewasa_ret, '.')+'<br />';
					}
					if(parseInt(data.responses.general[0].child) > 0){
						harga_anak = parseInt(data.responses.general[0].child) * parseInt(data.responses.general[0].price_child);
						harga_anak_ret = parseInt(data.responses.general[0].child) * parseInt(data.responses.general[0].price_child_ret);
						anak += 'Anak: '+data.responses.general[0].child+' x IDR '+currency_separator(data.responses.general[0].price_child, '.')+' = IDR '+currency_separator(harga_anak, '.')+'<br />';
						anak_ret += 'Anak: '+data.responses.general[0].child+' x IDR '+currency_separator(data.responses.general[0].price_child_ret, '.')+' = IDR '+currency_separator(harga_anak_ret, '.')+'<br />';
					}
					if(parseInt(data.responses.general[0].infant) > 0){
						harga_bayi = parseInt(data.responses.general[0].infant) * parseInt(data.responses.general[0].price_infant);
						harga_bayi_ret = parseInt(data.responses.general[0].infant) * parseInt(data.responses.general[0].price_infant_ret);
						bayi += 'Bayi: '+data.responses.general[0].infant+' x IDR '+currency_separator(data.responses.general[0].price_infant, '.')+' = IDR '+currency_separator(harga_bayi, '.')+'<br />';
						bayi_ret += 'Bayi: '+data.responses.general[0].infant+' x IDR '+currency_separator(data.responses.general[0].price_infant_ret, '.')+' = IDR '+currency_separator(harga_bayi_ret, '.')+'<br />';
					}
					/*end of penghitungan*/
						
					third_row_left = '<td><strong>Penumpang dan Harga</strong></td>\
							<td style="width:300px">'+dewasa+anak+bayi+'<br />\
								<strong>Total Harga Berangkat:</strong> IDR '+currency_separator(data.responses.general[0].total_price_dep, '.')+'\
							</td>';
					third_row_right = '<td><strong>Penumpang dan Harga</strong></td>\
							<td style="width:300px">'+dewasa_ret+anak_ret+bayi_ret+'<br />\
								<strong>Total Harga Kembali:</strong> IDR '+currency_separator(data.responses.general[0].total_price_ret, '.')+'\
							</td>';
				}
				else{
					/*penghitungan harga per penumpang*/
					var dewasa = anak = bayi = '';
					var harga_dewasa = harga_anak = harga_bayi = 0;
						
					if(parseInt(data.responses.general[0].adult) > 0){
						harga_dewasa = parseInt(data.responses.general[0].adult) * parseInt(data.responses.general[0].price_adult);
						dewasa += 'Dewasa: '+data.responses.general[0].adult+' x IDR '+currency_separator(data.responses.general[0].price_adult, '.')+' = IDR '+currency_separator(harga_dewasa, '.')+'<br />';
					}
					if(parseInt(data.responses.general[0].child) > 0){
						harga_anak = parseInt(data.responses.general[0].child) * parseInt(data.responses.general[0].price_child);
						anak += 'Anak: '+data.responses.general[0].child+' x IDR '+currency_separator(data.responses.general[0].price_child, '.')+' = IDR '+currency_separator(harga_anak, '.')+'<br />';
					}
					if(parseInt(data.responses.general[0].infant) > 0){
						harga_bayi = parseInt(data.responses.general[0].infant) * parseInt(data.responses.general[0].price_infant);
						bayi += 'Bayi: '+data.responses.general[0].infant+' x IDR '+currency_separator(data.responses.general[0].price_infant, '.')+' = IDR '+currency_separator(harga_bayi, '.')+'<br />';
					}
					/*end of penghitungan*/
					second_row_right += '<td><strong>Penumpang dan Harga</strong></td>\
							<td style="width:300px">'+dewasa+anak+bayi+'<br />\
								<strong>Total Harga Berangkat:</strong> IDR '+currency_separator(data.responses.general[0].total_price_dep, '.')+'\
							</td>';
				}
						
				//add second row
				str += '<tr>\
					'+second_row_left+'\
					'+second_row_right+'\
					</tr>';
				//add third row
				str += '<tr>\
					'+third_row_left+'\
					'+third_row_right+'\
					</tr>';
						
				str += '</table>';
			
				$('#data-general').append(str);
				$('#data-pemesan').append('<h2>Data Pemesan</h2>');
				$('#data-pemesan').append('<table style="margin-left:0px">\
						<tr>\
							<th>Titel</th>\
							<th>Nama Lengkap</th>\
							<th>Alamat Email</th>\
							<th>Telepon/HP</th>\
						</tr>\
						<tr>\
							<td>'+data.responses.contact.title+'</td>\
							<td>'+data.responses.contact.fullname+'</td>\
							<td>'+data.responses.contact.email+'</td>\
							<td>'+data.responses.contact.phone+'</td>\
						</tr>\
					</table>');
					
				$('#data-adult').append('<h2>Data Penumpang Dewasa</h2>');
				var str_adult = '<table style="margin-left:0px">\
						<tr>\
							<th>No.</th>\
							<th>Titel</th>\
							<th>Nama Depan</th>\
							<th>Nama Belakang</th>\
							<th>Tgl Lahir</th>\
							<th>No. ID</th>\
							<th>Kewarganegaraan</th>\
							<th>Bagasi</th>\
							<th>Bagasi Kembali</th>\
						</tr>';
				// fetching passengers
				for (var a=0; a<data.responses.adult.length; a++){
					str_adult += '<tr>\
									<td>'+data.responses.adult[a].order_list+'</td>\
									<td>'+data.responses.adult[a].title+'</td>\
									<td>'+data.responses.adult[a].first_name+'</td>\
									<td>'+data.responses.adult[a].last_name+'</td>\
									<td>'+data.responses.adult[a].birth_date+'</td>\
									<td>'+data.responses.adult[a].id+'</td>\
									<td>'+data.responses.adult[a].nationality+'</td>\
									<td>'+data.responses.adult[a].baggage+'</td>\
									<td>'+data.responses.adult[a].baggage_return+'</td>\
								</tr>';
				}
					
				str_adult += '</table>';
				$('#data-adult').append(str_adult);
					
				$('#data-child').append('<h2>Data Penumpang Anak</h2>');
				var str_child = '<table style="margin-left:0px">\
						<tr>\
							<th>No.</th>\
							<th>Titel</th>\
							<th>Nama Depan</th>\
							<th>Nama Belakang</th>\
							<th>Tgl Lahir</th>\
							<th>No. ID</th>\
							<th>Kewarganegaraan</th>\
							<th>Bagasi</th>\
							<th>Bagasi Kembali</th>\
						</tr>';
				// fetching passengers
				for (var a=0; a<data.responses.child.length; a++){
					str_child += '<tr>\
									<td>'+data.responses.child[a].order_list+'</td>\
									<td>'+data.responses.child[a].title+'</td>\
									<td>'+data.responses.child[a].first_name+'</td>\
									<td>'+data.responses.child[a].last_name+'</td>\
									<td>'+data.responses.child[a].birth_date+'</td>\
									<td>'+data.responses.child[a].id+'</td>\
									<td>'+data.responses.child[a].nationality+'</td>\
									<td>'+data.responses.child[a].baggage+'</td>\
									<td>'+data.responses.child[a].baggage_return+'</td>\
								</tr>';
				}
					
				str_child += '</table>';
				$('#data-child').append(str_child);
					
				$('#data-infant').append('<h2>Data Penumpang Bayi</h2>');
				var str_infant = '<table style="margin-left:0px">\
						<tr>\
							<th>No.</th>\
							<th>Titel</th>\
							<th>Nama Depan</th>\
							<th>Nama Belakang</th>\
							<th>Tgl Lahir</th>\
							<th>No. ID</th>\
							<th>Kewarganegaraan</th>\
							<th>Bagasi</th>\
							<th>Bagasi Kembali</th>\
						</tr>';
				// fetching passengers
				for (var a=0; a<data.responses.infant.length; a++){
					str_infant += '<tr>\
									<td>'+data.responses.infant[a].order_list+'</td>\
									<td>'+data.responses.infant[a].title+'</td>\
									<td>'+data.responses.infant[a].first_name+'</td>\
									<td>'+data.responses.infant[a].last_name+'</td>\
									<td>'+data.responses.infant[a].birth_date+'</td>\
									<td>'+data.responses.infant[a].id+'</td>\
									<td>'+data.responses.infant[a].nationality+'</td>\
									<td>'+data.responses.infant[a].baggage+'</td>\
									<td>'+data.responses.infant[a].baggage_return+'</td>\
								</tr>';
				}
					
				str_infant += '</table>';
				$('#data-infant').append(str_infant);
			} // end-flight
				
				// train
				else if (type=="train"){
					$('#data-general').append('<table>\
							<tr>\
								<td><strong>Nama Agen</strong></td><td>'+data.responses.general[0].agent_name+'</td>\
								<td><strong>Kereta Api / Kelas / Sub-Kelas</strong></td><td>'+data.responses.general[0].train_name+' / '+data.responses.general[0].kelas+' / '+data.responses.general[0].subclass.value+'</td>\
							</tr>\
							<tr>\
								<td><strong>Rute</strong></td><td>'+data.responses.general[0].route+'</td>\
								<td><strong>Keberangkatan-Kedatangan</strong></td><td>'+data.responses.general[0].departing_date.value+' '+data.responses.general[0].time_travel+'</td>\
							</tr>\
							<tr>\
								<td><strong>Rincian Harga</strong></td>\
								<td>\
									<ul style="list-style-type:square; margin-left: 20px;">\
										<li>\
										Dewasa: '+data.responses.general[0].adult.value+' x '+data.responses.general[0].price_adult+' = '+data.responses.general[0].adult.value * data.responses.general[0].price_adult+'\
										</li>\
										<li>\
										Anak: '+data.responses.general[0].child.value+' x '+data.responses.general[0].price_child+' = '+data.responses.general[0].child.value * data.responses.general[0].price_child+'\
										</li>\
										<li>\
										Bayi: '+data.responses.general[0].infant.value+' x '+data.responses.general[0].price_infant+' = '+data.responses.general[0].infant.value * data.responses.general[0].price_infant+'\
										</li>\
									</ul>\
								</td>\
								<td><strong>Total Harga</strong></td>\
								<td>IDR <strong>'+data.responses.general[0].total_price+'</strong></td>\
							</tr>\
						</table>');
					
					$('#data-general').append('<input type="hidden" name="'+data.responses.general[0].train_id.name+'" value="'+data.responses.general[0].train_id.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.general[0].token.name+'" value="'+data.responses.general[0].token.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.general[0].depart_station.name+'" value="'+data.responses.general[0].depart_station.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.general[0].arrival_station.name+'" value="'+data.responses.general[0].arrival_station.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.general[0].departing_date.name+'" value="'+data.responses.general[0].departing_date.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.general[0].subclass.name+'" value="'+data.responses.general[0].subclass.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.general[0].adult.name+'" value="'+data.responses.general[0].adult.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.general[0].child.name+'" value="'+data.responses.general[0].child.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.general[0].infant.name+'" value="'+data.responses.general[0].infant.value+'">');
					$('#data-pemesan').append('<h2>Data Pemesan</h2>');
					$('#data-pemesan').append('<table>\
							<tr>\
								<td><strong>Titel</strong></td>\
								<td>'+data.responses.contact[0].title.value+'</td>\
								<td></td>\
								<td></td>\
							</tr>\
							<tr>\
								<td><strong>Nama Depan</strong></td>\
								<td>'+data.responses.contact[0].firstname.value+'</td>\
								<td><strong>Nama Belakang</strong></td>\
								<td>'+data.responses.contact[0].lastname.value+'</td>\
							</tr>\
							<tr>\
								<td><strong>Email</strong></td>\
								<td>'+data.responses.contact[0].email.value+'</td>\
								<td><strong>Telepon/HP</strong></td>\
								<td>'+data.responses.contact[0].phone.value+'</td>\
							</tr>\
						</table>');
					$('#data-general').append('<input type="hidden" name="'+data.responses.contact[0].title.name+'" value="'+data.responses.contact[0].title.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.contact[0].firstname.name+'" value="'+data.responses.contact[0].firstname.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.contact[0].lastname.name+'" value="'+data.responses.contact[0].lastname.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.contact[0].email.name+'" value="'+data.responses.contact[0].email.value+'">');
					$('#data-general').append('<input type="hidden" name="'+data.responses.contact[0].phone.name+'" value="'+data.responses.contact[0].phone.value+'">');
					
					$('#data-adult').append('<h2>Data Penumpang Dewasa</h2>');
					var div = document.getElementById('data-adult');
					var table = document.createElement('table');
					var thead = document.createElement('tr');
					thead.appendChild(set_td_data('th', 'Title'));
					thead.appendChild(set_td_data('th', 'Nama Lengkap'));
					thead.appendChild(set_td_data('th', 'Tanggal Lahir'));
					thead.appendChild(set_td_data('th', 'No. Identitas'));
					thead.appendChild(set_td_data('th', 'No. Telepon/HP'));
					table.appendChild(thead);
					for (var a=0; a<data.responses.general[0].adult.value; a++){
						var tr = document.createElement('tr');
						tr.appendChild(set_td_data('td', data.responses.adult[a].title.value));
						tr.appendChild(set_td_data('td', data.responses.adult[a].name.value));
						tr.appendChild(set_td_data('td', data.responses.adult[a].birthdate.value));
						tr.appendChild(set_td_data('td', data.responses.adult[a].id.value));
						tr.appendChild(set_td_data('td', data.responses.adult[a].phone.value));
						table.appendChild(tr);
						$('#data-general').append('<input type="hidden" name="'+data.responses.adult[0].title.name+'" value="'+data.responses.adult[0].title.value+'">');
						$('#data-general').append('<input type="hidden" name="'+data.responses.adult[0].name.name+'" value="'+data.responses.adult[0].name.value+'">');
						$('#data-general').append('<input type="hidden" name="'+data.responses.adult[0].birthdate.name+'" value="'+data.responses.adult[0].birthdate.value+'">');
						$('#data-general').append('<input type="hidden" name="'+data.responses.adult[0].id.name+'" value="'+data.responses.adult[0].id.value+'">');
						$('#data-general').append('<input type="hidden" name="'+data.responses.adult[0].phone.name+'" value="'+data.responses.adult[0].phone.value+'">');
					}
					div.appendChild(table);
					
					$('#data-child').append('<h2>Data Penumpang Anak</h2>');
					var div = document.getElementById('data-child');
					var table = document.createElement('table');
					var thead = document.createElement('tr');
					thead.appendChild(set_td_data('th', 'Title'));
					thead.appendChild(set_td_data('th', 'Nama Lengkap'));
					thead.appendChild(set_td_data('th', 'Tanggal Lahir'));
					table.appendChild(thead);
					for (var a=0; a<data.responses.general[0].child.value; a++){
						var tr = document.createElement('tr');
						tr.appendChild(set_td_data('td', data.responses.child[a].title.value));
						tr.appendChild(set_td_data('td', data.responses.child[a].name.value));
						tr.appendChild(set_td_data('td', data.responses.child[a].birthdate.value));
						table.appendChild(tr);
						$('#data-general').append('<input type="hidden" name="'+data.responses.child[0].title.name+'" value="'+data.responses.child[0].title.value+'">');
						$('#data-general').append('<input type="hidden" name="'+data.responses.child[0].name.name+'" value="'+data.responses.child[0].name.value+'">');
						$('#data-general').append('<input type="hidden" name="'+data.responses.child[0].birthdate.name+'" value="'+data.responses.child[0].birthdate.value+'">');
					}
					div.appendChild(table);
					
					$('#data-infant').append('<h2>Data Penumpang Bayi</h2>');
					var div = document.getElementById('data-infant');
					var table = document.createElement('table');
					var thead = document.createElement('tr');
					thead.appendChild(set_td_data('th', 'Title'));
					thead.appendChild(set_td_data('th', 'Nama Lengkap'));
					thead.appendChild(set_td_data('th', 'Tanggal Lahir'));
					table.appendChild(thead);
					for (var a=0; a<data.responses.general[0].infant.value; a++){
						var tr = document.createElement('tr');
						tr.appendChild(set_td_data('td', data.responses.infant[a].title.value));
						tr.appendChild(set_td_data('td', data.responses.infant[a].name.value));
						tr.appendChild(set_td_data('td', data.responses.infant[a].birthdate.value));
						table.appendChild(tr);
						$('#data-general').append('<input type="hidden" name="'+data.responses.infant[0].title.name+'" value="'+data.responses.infant[0].title.value+'">');
						$('#data-general').append('<input type="hidden" name="'+data.responses.infant[0].name.name+'" value="'+data.responses.infant[0].name.value+'">');
						$('#data-general').append('<input type="hidden" name="'+data.responses.infant[0].birthdate.name+'" value="'+data.responses.infant[0].birthdate.value+'">');
					}
					div.appendChild(table);
				} // end-train
				
				//hotel
				else if (type=="hotel"){
					$('#data-general').append('<table>\
							<tr>\
								<td><strong>Nama Agen</strong></td><td>'+data.responses.general[0].agent_name+'</td>\
								<td><strong>Hotel</strong></td><td>'+data.responses.general[0].hotel_name+'</td>\
							</tr>\
							<tr>\
								<td><strong>Alamat</strong></td><td>'+data.responses.general[0].hotel_address+'</td>\
								<td><strong>Regional</strong></td><td>'+data.responses.general[0].hotel_regional+'</td>\
							</tr>\
							<tr>\
								<td><strong>Kamar</strong></td><td>'+data.responses.general[0].room+'</td>\
								<td><strong>Checkin-Checkout (Malam)</strong></td><td>'+data.responses.general[0].checkin+' - '+data.responses.general[0].checkout+' ('+data.responses.general[0].night+' malam)</td>\
							</tr>\
							<tr>\
								<td><strong>Jumlah Orang</strong></td>\
								<td>\
									<ul style="list-style-type:square; margin-left: 20px;">\
										<li>\
										Dewasa: '+data.responses.general[0].adult+'\
										</li>\
										<li>\
										Anak: '+data.responses.general[0].child+'\
										</li>\
									</ul>\
								</td>\
								<td><strong>Total Harga</strong></td>\
								<td>IDR <strong>'+data.responses.general[0].total_price+'</strong></td>\
							</tr>\
						</table>');
					$('#data-pemesan').append('<h2>Data Pemesan</h2>');
					$('#data-pemesan').append('<table>\
							<tr>\
								<td><strong>Titel</strong></td>\
								<td>'+data.responses.contact[0].title.value+'</td>\
								<td></td>\
								<td></td>\
							</tr>\
							<tr>\
								<td><strong>Nama Depan</strong></td>\
								<td>'+data.responses.contact[0].firstname.value+'</td>\
								<td><strong>Nama Belakang</strong></td>\
								<td>'+data.responses.contact[0].lastname.value+'</td>\
							</tr>\
							<tr>\
								<td><strong>Email</strong></td>\
								<td>'+data.responses.contact[0].email.value+'</td>\
								<td><strong>Telepon/HP</strong></td>\
								<td>'+data.responses.contact[0].phone.value+'</td>\
							</tr>\
						</table>');
				} // end hotel
				
				//paket
			else if (type=="paket"){
				$('#data-general').append('<table>\
						<tr>\
							<td><strong>Nama Agen</strong></td><td>'+data.responses.general[0].agent_name+'</td>\
							<td><strong>Deskripsi Paket</strong></td><td>'+data.responses.general[0].description+'</td>\
						</tr>\
						<tr>\
							<td><strong>Titel Paket</strong></td><td>'+data.responses.general[0].title+'</td>\
							<td><strong>Total Harga</strong></td><td>'+data.responses.general[0].total_price+'</td>\
						</tr>\
						<tr>\
							<td><strong>Kategori Paket</strong></td><td>'+data.responses.general[0].category+'</td>\
							<td></td>\
							<td></td>\
						</tr>\
					</table>');
				$('#data-pemesan').append('<h2>Data Pemesan</h2>');
				$('#data-pemesan').append('<table>\
						<tr>\
							<td><strong>Titel</strong></td>\
							<td>'+data.responses.contact.title+'</td>\
							<td><strong>Nama Lengkap</strong></td>\
							<td>'+data.responses.contact.fullname+'</td>\
						</tr>\
						<tr>\
							<td><strong>Email</strong></td>\
							<td>'+data.responses.contact.email+'</td>\
							<td><strong>Telepon/HP</strong></td>\
							<td>'+data.responses.contact.phone+'</td>\
						</tr>\
					</table>');
			} // end paket
				
		}
	});
	
	YUI().use('panel', 'dd-plugin', function (Y) {
		function add_bc(){
			var form = $('#form-add-bc').serialize();
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/admin/add_booking_code',
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
					if(data.response==true)
						window.location.assign("<?php echo base_url('index.php/admin/proceed_order/'.$type.'/'.$id);?>");
					else
						alert("Terdapat kesalahan saat mengubah kode booking.");
				}
			})
		}
		
		var addRowBtn  = Y.one('#add-bc');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#panel-add-bc',
			headerContent: 'Masukkan Kode Booking',
			width        : 250,
			zIndex       : 5,
			centered     : true,
			modal        : true,
			visible      : false,
			render       : true,
			plugins      : [Y.Plugin.Drag]
		});
		panel.addButton({
			value  : 'Submit',
			section: Y.WidgetStdMod.FOOTER,
			action : function (e) {
				e.preventDefault();
				add_bc();
			}
		});
		panel.addButton({
			value  : 'Batal',
			section: Y.WidgetStdMod.FOOTER,
			action : function (e) {
				panel.hide();
			}
		});
		// When the addRowBtn is pressed, show the modal form.
		addRowBtn.on('click', function (e) {
			panel.show();
		});
	});
	
	YUI().use('panel', 'dd-plugin', function (Y) {
		function send_bc(){
			var form = $('#form-send-bc').serialize();
			$.ajax({
				type : "POST",
				url: '<?php echo base_url();?>index.php/admin/add_booking_code',
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
					if(data.response==true)
						window.location.assign("<?php echo base_url('index.php/admin/proceed_order/'.$type.'/'.$id);?>");
					else
						alert("Terdapat kesalahan saat mengubah kode booking.");
				}
			})
		}
		
		var addRowBtn  = Y.one('#send-bc');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#panel-send-bc',
			headerContent: 'Masukkan Konten Email yang diinginkan',
			width        : 750,
			zIndex       : 5,
			centered     : true,
			modal        : true,
			visible      : false,
			render       : true,
			plugins      : [Y.Plugin.Drag]
		});
		panel.addButton({
			value  : 'Submit',
			section: Y.WidgetStdMod.FOOTER,
			action : function (e) {
				e.preventDefault();
				add_bc();
			}
		});
		panel.addButton({
			value  : 'Batal',
			section: Y.WidgetStdMod.FOOTER,
			action : function (e) {
				panel.hide();
			}
		});
		// When the addRowBtn is pressed, show the modal form.
		addRowBtn.on('click', function (e) {
			panel.show();
		});
	});
</script>