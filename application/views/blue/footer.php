	<div class="footerbg">
		<div class="container">	
			<div class="col-md-3">
				<span class="ftitleblack">Let's socialize</span>
				<div class="scont">
					<a target="_blank" href="<?php echo prep_url($facebook_link);?>" class="social1b"><img src="<?php echo BLUE_THEME_DIR;?>/images/icon-facebook.png" alt=""/></a>
					<a target="_blank" href="<?php echo prep_url($twitter_link);?>" class="social2b"><img src="<?php echo BLUE_THEME_DIR;?>/images/icon-twitter.png" alt=""/></a>
					<a target="_blank" href="<?php echo prep_url($gplus_link);?>" class="social3b"><img src="<?php echo BLUE_THEME_DIR;?>/images/icon-gplus.png" alt=""/></a>
					<a target="_blank" href="<?php echo prep_url($youtube_link);?>" class="social4b"><img src="<?php echo BLUE_THEME_DIR;?>/images/icon-youtube.png" alt=""/></a>
					<br/><br/><br/>
					<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/uploads/option_images/<?php echo $company_logo;?>" width="130px" height="70px" alt="" /></a><br/>
					<span class="grey2">&copy; 2014  |  <a href="#">Privacy Policy</a><br/>
					All Rights Reserved </span>
					<br/><br/>
					
				</div>
			</div>
			<!-- End of column 1-->
			
			<div class="col-md-3">
				<span class="ftitleblack">Travel Specialists</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/umrah/0/9">Paket Umroh & Haji</a></li>
					<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/tour/0/9">Paket Tour</a></li>
					<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/promo/0/9">Paket Promo</a></li>
					<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/hotel/0/9">Paket Hotel</a></li>
				</ul>
			</div>
			<!-- End of column 2-->		
			
			<div class="col-md-3">
				<span class="ftitleblack">Layanan Tambahan</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="<?php echo base_url();?>index.php/webfront/load_faq_content">Keagenan</a></li>
					<li><a href="<?php echo base_url();?>index.php/webfront/agent_registration">Registrasi Agen</a></li>
					<li><a href="<?php echo base_url();?>index.php/webfront/confirm_payment_tiketcom">Konfirmasi Pembayaran Tiket</a></li>
					<li><a href="<?php echo base_url();?>index.php/webfront/confirm_payment">Konfirmasi Pembayaran Paket</a></li>
					<li><a href="<?php echo base_url();?>index.php/webfront/cancel_order_tiketcom">Pembatalan Tiket</a></li>
				</ul>				
			</div>
			<!-- End of column 3-->		
			
			<div class="col-md-3 grey">
				<!--<span class="ftitleblack">Newsletter</span>
				<div class="relative">
					<input type="email" class="form-control fccustom2black" id="exampleInputEmail1" placeholder="Enter email">
					<button type="submit" class="btn btn-default btncustom">Submit<img src="<?php echo BLUE_THEME_DIR;?>/images/arrow.png" alt=""/></button>
				</div>
				<br/><br/>-->
				<span class="ftitleblack">Customer support</span><br/><br/>
				<div id="ym-customer-service"></div>
				<span class="pnr"><?php echo $support_by_call;?></span><br/>
				<span class="grey2"><?php echo $support_by_email;?></span>
			</div>			
			<!-- End of column 4-->			
		
			
		</div>	
	</div>
	<div class="footerbg3">
		<div class="container center grey"> 
		<a href="<?php echo base_url();?>">Home</a> | 
		<a href="<?php echo base_url();?>index.php/webfront/load_about_content">Tentang Kami</a> | 
		<a href="<?php echo base_url();?>index.php/webfront/load_termcondition_content">Syarat & Ketentuan</a> | 
		<a href="<?php echo base_url();?>index.php/webfront/load_contact_content">Contact</a>
		<a href="#top" class="gotop scroll"><img src="<?php echo BLUE_THEME_DIR;?>/images/spacer.png" alt=""/></a>
		</div>
	</div>
	<script>
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/other/get_yahoo_by_type/customer-service',
			dataType: "json",
			success:function(datajson){
				var div = $('#ym-customer-service');
				for(var i=0; i<datajson.length;i++)
					//data_via[i] = {number_row: datajson[i].number_row, id:datajson[i].id, name:datajson[i].name, type:datajson[i].type};
					div.append('</span><a href="ymsgr:SendIM?'+datajson[i].username+'">\
						<img border=0 src="http://opi.yahoo.com/online?u='+datajson[i].username+'&m=g&t=9"></a>&nbsp;&nbsp;'+datajson[i].username+'<br/><br/>');
			}
		});
	</script>