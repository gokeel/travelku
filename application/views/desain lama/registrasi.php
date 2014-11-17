<style type="text/css">
<!--
.style1 {
	color: #FF9900;
	font-weight: bold;
	font-size:18px;
}
-->
</style>
<div class="main fullwidth">
	<section class="content" style="padding-top:10px; background:#DDD"> <!-- Content -->
		<div class="container">
			<?php
				if ($this->uri->segment(3)=="success"){
					echo '<h4>Masukan anda telah kami terima</h4>';
                    echo '<p>Email berisi informasi login telah kami kirimkan, mohon cek di folder spam apabila tidak masuk kedalam folder inbox anda.</p>';
					echo '<p>Kami akan segera menghubungi anda pada jam kerja.</p>';
				}
			?>
			<div class="span8 boxfix" style="margin-right:10px">            
				<div style="font-family:Arial; font-size:24px; font-weight:bold; color:#FF9900; padding-bottom:20px">
					<h3>Formulir Keagenan</h3>
					<p style="font-size:12px;color:black">Mohon untuk mengisi semua input berikut ini:</p>
					<form action="<?php echo base_url();?>index.php/admin/agent_register" method="post" id="registration">
						<input type="hidden" name="member_type" value="2">
						<input type="hidden" name="id_agen_upline" value="2">
						<div style="width:15%"><label>Username</label></div>
						<div style="width:35%">    <input type="text" name="username" id="username" value="" size="40" tabindex="1" /></div>
						<div style="width:15%"><label>Password</label></div>
						<div style="width:45%">    <input type="password" name="password" id="password" value="" size="40" tabindex="2"/></div>
						<div style="width:15%"><label>Nama Lengkap</label></div>
						<div style="width:35%">    <input type="text" name="company_name" id="company_name" value="" size="40"tabindex="2"/></div>
						<div style="width:15%"><label>Alamat lengkap </label></div>
						<div style="width:45%">    <input type="text" name="address" id="address" value="" size="70" tabindex="3"/></div>
						<div style="width:15%"><label>Kota </label></div>
						<div style="width:45%"> <select name="id_kota" data-placeholder="-- Pilih Kota --" id="id_kota" class="chzn-select"> </select></div>
						<div style="width:15%"><label>Telepon/HP</label></div>
						<div style="width:35%">    <input type="text" name="telp_no" id="telp_no" value="" size="40" tabindex="3"/></div>
						<div style="width:15%"><label>Email</label></div>
						<div style="width:35%">    <input type="email" name="email" id="email" value="" size="40" tabindex="3"/></div>
						<div style="width:15%"><label>Yahoo Messenger</label></div>
						<div style="width:35%">    <input type="email" name="yahoo_account" id="yahoo_account" value="" size="40" tabindex="3"/></div>
						
						<p class="input-wrap">
						<p style="color:black;font-size:11px;">By clicking the "submit" button below, i agree with hellotraveler.co.id <a href="" target="_blank">Privacy Policy</a> and <a href="" target="_blank">Terms &amp; Condition</a>.
						<input class="button" name="submit" type="submit" id="submit" tabindex="5" value="submit" />
						</p>
					</form>
				</div>
			</div>
			
		</div>
	</section>

</div> <!-- Close Header Wrapper -->  
    <div class="main homepage">
      <div class="container"> 
        <!--Dapatkan kemudahan transaksi melalui bebasterbang.com. Kami hadir untuk memberi solusi yang efektif dalam hal perjalanan dan liburan Anda.-->
        <div class="row-fluid" style="margin-bottom:10px;">
          <!-- KOLOM HOTEL MURAH  -->       
<div class="span8 boxfix" style="margin-right:10px">
                                <!-- response setelah submit
								<div class="contact-form-respons">
                                    <div class="infobox info-succes info-succes-alt clearfix">
                                        <span></span>
                                        <div class="infobox-wrap">
                                            <h4>Your message was succesfully send!</h4>
                                            <p>We will contact you as soon as possible. Please reload the page if you want to send a message again.</p>                                            
                                        </div>
                                        <a href="#" class="info-hide"></a>
                                    </div>
                                </div>
								-->
 


<!-- IIRRRRFFFFAAANNN -->
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