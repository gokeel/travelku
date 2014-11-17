<?php $id = $this->uri->segment(3);?>
			<div id="content">
				<!-- KONTEN MULAI -->
				<div id="kolom1-second-contact">
					<div id="kontenkolom1">
						<!-- KOLOM 1 mulai --> 
						<div id="contactkonten">
							<div align="justify"> <span class="judul46"><div id="post-title"></div></span><br /><br /><br />
								<div id="post-image"></div>
								<div id="post-content"></div>
								<div id="post-price"></div>
								<div id="admin-fee"></div>
								<a href="<?php echo base_url();?>index.php/webfront/order_paket/<?php echo $id;?>"><button class="button-1" style="float:right">Pesan Sekarang</button></a>
							</div>
						</div>
						
					<!-- KONTEN end -->
					</div>
				</div>
<script>
	var admin_fee = 0;
	$( window ).load(function() {
		load_admin_fee();
		load_content();
	})
	function load_admin_fee(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_administration_fee/tour',
			dataType: "json",
			success:function(datajson){
				if(data.nominal!='')
					admin_fee = parseInt(datajson.nominal);
			}
		});
	}
	function load_content(){
		var data = [];
		var d = new Date(); 
		var image_path = '<?php echo base_url();?>assets/uploads/posts/';
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_content_by_id/<?php echo $id;?>',
			dataType: "json",
			success:function(datajson){
				//$('#category').val(datajson.category);
				$('#post-title').append(datajson.title);
				$("#post-content").append(datajson.content);
				$('#post-price').append('<p style="font-size:16px;">Harga IDR <span style="color: green;">'+currency_separator(datajson.price,'.')+'*</span></p>');
				$('#admin-fee').append('<p style="font-size:10px;">Biaya Administrasi <span style="color: green;">'+currency_separator(admin_fee,'.')+'*</span></p>');
				/*$('#point_reward').val(datajson.point_reward);
				$('#status').val(datajson.status);
				$("#is_promo-"+datajson.is_promo).prop("checked", true);
				$("#enabled-"+datajson.enabled).prop("checked", true);*/
				$("#post-image").append('<img src="'+image_path+datajson.image+'?ver='+d.getTime()+'" alt="no-picture" width="400px" height="280px" />');
			}
		});
	}
</script>