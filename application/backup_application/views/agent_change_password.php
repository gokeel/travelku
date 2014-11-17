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
		<h1 style="color:white">Ubah Password Agen</h1>
	</hgroup>
	

    <!-- Content -->
	<div class="with-padding">
		<div class="twelve-columns twelve-columns-tablet twelve-columns-mobile">
			<h3 class="thin underline">Ubah password</h3>
			<?php echo '<p style="color: blue;">'.$message.'</p>'; ?>
			<form id="form_pass" style="margin:0 30px;" method="post" action="<?php echo base_url();?>index.php/agent/user_change_password">
				
				<div style="float:left; width:260px;">
					<p>Password lama</p>
					<input type="password" id="password-now" class="input" name="password-now" value="" style="width:220px; ">
				</div>
				<div style="float:left; width:260px;">
					<p>Password baru</p>
					<input type="password" id="password-new" class="input" name="password-new" value="" style="width:220px; ">
				</div>
								 
				<div style="float:left; width:92px; padding-top:30px;">
					<input type="submit" class="button blue-gradient" id="submit-pass" value="Ubah Password" tabindex="8" style="float:left;">
				</div>
				<div style="clear: both; height: 250px;"> </div>
				<p></p>
			</form>
			
		</div>
      
    </div>
   

<div style="text-align:center; margin-top: 20px;">
 <!--<div class="loader waiting big" style="display:none;"></div>-->

 </div>


</section>



	
	<script>
		$( window ).load(function() {
			
		});
		
		$(document).ready(function() {
			/*search flights*/
			$('#submit-passss').click(function(event) {
				//alert('oii');
				var form = $('#form_pass').serialize();
				//event.preventDefault();
				$.ajax({
					type : "POST",
					url: '<?php echo base_url();?>index.php/agent/user_change_password',
					data: form,
					cache: false,
					dataType: "json",
					success:function(data){
							if(data==false){
								alert('Data tidak berhasil dimasukkan. Mohon contact system administrator anda.');
							}
							else{
								window.location.assign("<?php echo base_url('index.php/agent/change_password');?>");
							}
						}
				})
			});
			
			
			
		});
	</script>
