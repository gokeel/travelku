<!--Cindy Nordiansyah-->
<?php
	$id = $this->session->userdata('account_id');
?>
<style>
	/* unvisited link */
a:link {
    color: black;
}

/* visited link */
a:visited {
    color: black;
}

/* mouse over link */
a:hover {
    color: #FF00FF;
}

/* selected link */
a:active {
    color: #0000FF;
}
</style>
<section role="main" id="main"><!--tpl:web/dasboard-->
<!-- Main content -->

	<noscript class="message black-gradient simpler">
	Your browser does not support JavaScript! Some features won't work as expected...
	</noscript>
	<hgroup id="main-title" class="thin">
		<h1 style="color:white">Info Landing Page</h1>
	</hgroup>
	

    <!-- Content -->
	<div class="with-padding">
		<div class="twelve-columns twelve-columns-tablet twelve-columns-mobile">
			<h3 class="thin underline">Info landing page</h3>
			<a href="<?php echo $this->session->userdata('user_name');?>.hellotraveler.co.id"><?php echo $this->session->userdata('user_name');?>.hellotraveler.co.id</a>
		</div>
      
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
