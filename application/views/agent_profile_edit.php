<!--Cindy Nordiansyah-->
<?php
	$id = $this->session->userdata('account_id');
?>

<section role="main" id="main"><!--tpl:web/dasboard-->
<!-- Main content -->

	<noscript class="message black-gradient simpler">
	Your browser does not support JavaScript! Some features won't work as expected...
	</noscript>
	<hgroup id="main-title" class="thin">
		<h1 style="color:white">Ubah Profil</h1>
	</hgroup>
	<!-- ---------Form edit profil--------- -->
    <div class="with-padding">
		<div class="twelve-columns twelve-columns-tablet twelve-columns-mobile">
        	<form  id="profile-form" style="margin:0 30px;">     				
				<h3 class="thin underline">Ubah Profil Agen</h3>
				<div style="float:left; width:280px;">
					<p>Nama Agen </p>
					<input type="text" id="nama-agent" class="input" name="agent_name" value="" style="width:220px; ">
				</div>
						
				<div style="float:left; width:280px;">
					<p>Alamat </p>
					<input type="text" id="alamat-agent" class="input" name="agent_address" value="" style="width:220px; ">
				</div>
			
				<div style="float:left; width:280px;">
					<p>Nomor Telepon </p>
					<input type="text" id="telp-agent" class="input" name="agent_phone" value="" style="width:220px; ">
				</div>
			
				<div style="float:left; width:280px;">
					<p>Kota </p>
					<select id="kota-agent" name="agent_city"></select>
				</div>
			 
				<div style="float:left; width:280px;">
					<p>Fax </p>
					<input type="text" id="fax-agent" class="input" name="agent_fax" value="" style="width:220px; ">
				</div>
			 
				<div style="float:left; width:280px;">
					<p>Akun Yahoo! </p>
					<input type="text" id="ym-agent" class="input" name="agent_yahoo" value="" style="width:220px; ">
				</div>
			  
				<div style="float:left; width:280px;">
					<p>Website </p>
					<input type="text" id="website-agent" class="input" name="agent_website" value="" style="width:220px; ">
				</div>
			
				<div style="float:left; width:280px;">
					<p>Email </p>
					<input type="text" id="email-agent" class="input" name="agent_email" value="" style="width:220px; ">
				</div>
				<div style="float:left; width:90px; padding-top:30px;">
					<p><input type="submit" class="button blue-gradient" id="edit-profil" value="Ubah Profile"></p>
					<div class="loader waiting big" style="display:none;"></div>
				</div>
		
		
			</form>	  
			<div style="clear: both; height: 250px;"> </div>
			<p></p>
		</div>   
	</div>
</section>
<!-- End main content --> 
	
<script>
	var city_id;
	$( window ).load(function() {
		load_data_profile();
		load_cities();
	});
	$(document).ready(function() {
		$('#edit-profil').click(function(event) {
			
			var form = $('#profile-form').serialize();
			event.preventDefault();
			$.ajax({
				type : "GET",
				url: "<?php echo base_url().'index.php/agent/profil_update'?>",
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
						if(data==false){
							alert('Data tidak berhasil dimasukkan. Mohon contact system administrator anda.');
						}
						else{
							//var hel = 'temp';
							window.location.assign("<?php echo base_url('index.php/agent/profile_edit');?>");
						}
					}
			})
		});
	});
	function load_data_profile(){
		$.ajax({
			type : "GET",
			url: '<?php echo base_url();?>index.php/agent/show_profil',
			async: false,
			dataType: "json",
			success:function(data){
				$('#nama-agent').val(data.nama_agent);
				$('#alamat-agent').val(data.alamat_agent);
				$('#telp-agent').val(data.telp_agent);
				$('#kota-agent').val(data.kota_agent);
				city_id = data.kota_agent;
				$('#fax-agent').val(data.fax_agent);
				$('#ym-agent').val(data.ym_agent);
				$('#website-agent').val(data.website_agent);
				$('#email-agent').val(data.email_agent);

				
			}
		})
	}
	function load_cities(){
		simple_load('<?php echo base_url();?>index.php/admin/get_cities', '#kota-agent', city_id);
	}
	
	
</script>
