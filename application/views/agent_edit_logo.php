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
		<h1 style="color:white">Ubah Logo Agen</h1>
	</hgroup>
    <!-- Content -->
	<div class="with-padding">
		<div class="twelve-columns twelve-columns-tablet twelve-columns-mobile">
			<h3 class="thin underline">Ubah logo agen untuk ditampilkan di homepage</h3>
			<?php echo '<p style="color: blue;">'.$message.'</p>'; ?>
			<div id="logo-agen">
				
			</div>
			<form id="form_logo" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/agent/do_upload_logo">
				<div style="float:left; width:260px; padding-top:120px;">
					<input type="file" name="userfile" class="input-unstyled" style="width: 260px; height:30px; size="20" />
				</div>
	   
				<div style="float:left; width:92px; padding-top:105px;">
					<input type="submit" class="button blue-gradient" id="submit-logo" value="Upload" tabindex="8" style="float:left;">
				</div>
			</form>
		</div> 
	</div>    
</section>
		
	<script>
		$( window ).load(function() {
			show_logo();
		});
		function show_logo() {
			var d = new Date();
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/agent/show_logo',
				async:false,
				dataType: "json",
				success:function(data){
					if (data.logo_agent=='' || data.logo_agent==null)
						$('#logo-agen').append('<p>Belum ada logo yang dipasang.</p>');
					else
						$('#logo-agen').append('<img src="<?php echo base_url();?>assets/uploads/agent_logos/'+data.logo_agent+'?ver='+d.getTime()+'" alt="picture" width="250px" height="250px"  />');
					//$('#mylogo').attr('src', '<?php echo base_url();?>assets/uploads/agent-logo/'+logoname);
				}
			});
		}
		$(document).ready(function() {
			$('#sufsfgbmit-logo').click(function(event) {
			
			var form = $('#form_logo').serialize();
			event.preventDefault();
			$.ajax({
				type : "GET",
				url: "<?php echo base_url().'index.php/agent/do_upload_logo/'.$id;?>",
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
						if(data==false){
							alert('Data tidak berhasil dimasukkan. Mohon contact system administrator anda.');
						}
						else{
							//var hel = 'temp';
							window.location.assign("<?php echo base_url('index.php/agent/edit_logo');?>");
						}
					}
				})
			});	
		});
	</script>
