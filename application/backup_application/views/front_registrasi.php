			<div id="content">
				<!-- KONTEN MULAI -->
				<div id="kolom1-second-reg">
					<div id="kontenkolom1">
						<!-- KOLOM 1 mulai --> 
						<div id="faqkonten">
							<div align="justify">
								<?php
									if ($this->uri->segment(3)=="success"){
										echo '<p align="justify"><span class="judul18">Hasil Registrasi</span><br />';
										echo 'Masukan anda telah kami terima. Email berisi informasi login telah kami kirimkan, mohon cek di folder spam apabila tidak masuk kedalam folder inbox anda.</p><br><br>';
									}
								?>
								<span class="judul46">Registrasi Agen</span>
								<br>
								<br>
								<form action="<?php echo base_url();?>index.php/admin/agent_register" method="post" id="registration">
									<input type="hidden" name="member_type" value="2">
									<p align="justify"><span class="judul18">Username</span><br />
									<input type="text" name="username" id="username" value="" size="40" tabindex="1" /></p>
									<p align="justify"><span class="judul18">Password</span><br />
									<input type="password" name="password" id="password" value="" size="40" tabindex="2"/></p>
									<p align="justify"><span class="judul18">Nama Lengkap</span><br />
									<input type="text" name="company_name" id="company_name" value="" size="40"tabindex="2"/></p>
									<p align="justify"><span class="judul18">Alamat Lengkap</span><br />
									<input type="text" name="address" id="address" value="" size="70" tabindex="3"/></p>
									<p align="justify"><span class="judul18">Kota</span><br />
									<select name="id_kota" data-placeholder="-- Pilih Kota --" id="id_kota" class="chzn-select"> </select></p>
									<p align="justify"><span class="judul18">Telepon/HP</span><br />
									<input type="text" name="telp_no" id="telp_no" value="" size="40" tabindex="3"/></p>
									<p align="justify"><span class="judul18">Email</span><br />
									<input type="email" name="email" id="email" value="" size="40" tabindex="3"/></p>
									<p align="justify"><span class="judul18">Perhatian</span><br />
									Dengan ini menyetujui Kebijakan Privasi, Syarat dan Ketentuan yang diberlakukan oleh Hellotraveler.co.id<br />
									<input class="button-1" type="submit" id="submit" tabindex="5" value="Submit" /></p>
								</form>
								
							</div>
						</div>
					</div>
				<!-- KONTEN end -->
				</div>
			

<script>
	function load_cities(){
		simple_load('<?php echo base_url();?>index.php/admin/get_cities', '#id_kota', '');
	}
	function simple_load(uri, el_sel, selected_id){
		$.ajax({
			type : "GET",
			url: uri,
			dataType: "json",
			success:function(data){
				insert_select(el_sel, data, selected_id);
			}
		})
	}
	function insert_select(el_sel, data, selected_id){
		
		var sel = $(el_sel);
		for(var i=0; i<data.length;i++){
			if (selected_id == '')
				sel.append('<option value="'+data[i].value+'">'+data[i].name+'</option>');
			else {
				if (selected_id == data[i].value)
					sel.append('<option value="'+data[i].value+'" selected="selected">'+data[i].name+'</option>');
				else
					sel.append('<option value="'+data[i].value+'">'+data[i].name+'</option>');
			}
		}
	}
	$( window ).load(function() {
		load_cities();
	});
</script>