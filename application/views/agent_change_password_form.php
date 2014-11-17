<!--Cindy Nordiansyah-->
<?php

	$id = $this->session->userdata('account_id');

?>
<section role="main" id="main"><!--tpl:web/dasboard-->
<!-- Main content -->

<noscript class="message black-gradient simpler">
Your browser does not support JavaScript! Some features won't work as expected...
</noscript>
<div id="main-title" > <span class="head" style="float:right">Ubah Password</span> 
  <!--  <h3>Aug <strong>26</strong></h3>-->
  
 <!-- <link rel="stylesheet" media="only all and (min-width: 1200px)" href="<?php echo CSS_DIR;?>/web/custom.css">-->
</div>
	

    <!-- Content -->
  <!--<div class="tabs-content">
    <!-- ---------T-Flight--------- -->
    <div id="edit-password" class="">
      <div style="clear: both; height: 20px;"></div>  
      <div class="bggrey" id="formlokal">
		<?php echo validation_errors(); ?>

        <form id="form_pass" style="margin:0 30px;" >
			
          <div style="float:left; width:260px;">
            <p>Password lama</p>
             <input type="password" id="password-now" class="input" name="password-now" value="" style="width:220px; ">
          </div>
          <div style="float:left; width:260px;">
            <p>Password baru</p>
             <input type="password" id="password-new" class="input" name="password-new" value="" style="width:220px; ">
          </div>
		 		             
          <div style="float:left; width:92px; padding-top:30px;">
			<input type="submit" name="submit" class="button blue-gradient" id="submit-pass" value="Ubah Password" tabindex="8" style="float:left;">
            <!--<button type="submit" class="button blue-gradient" id="submit-flight">Cek</button>-->
            <div class="loader waiting big" style="display:none;"></div>
          </div>
        </form>
        <div style="clear: both; height: 10px;"></div>
        
        <!-- end cek harga -->
      </div>
      <div style="clear: both; height: 30px;"></div>
	  <div class="bggrey" id="result-pass"> </div>
     

      <div style="clear: both; height: 30px;"> </div>
      
      <div style="clear: both; height: 30px;"> </div>
      <div style="clear: both;"> </div>
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
			$('#submit-pass').click(function(event) {
				//alert('oii');
				var form = $('#form_pass').serialize();
				event.preventDefault();
				$.ajax({
					type : "GET",
					url: '<?php echo base_url();?>index.php/agent/change_password',
					data: form,
					cache: false,
					dataType: "json",
					success:function(data){
							if(data==false){
								alert('Data tidak berhasil dimasukkan. Mohon contact system administrator anda.');
							}
							else{
								window.location.assign("<?php echo base_url('index.php/agent/change_password_form');?>");
							}
						}
				})
			});
			
			
			
		});
	</script>
