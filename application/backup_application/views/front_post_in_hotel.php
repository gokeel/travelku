			<div id="content">
			<!-- KONTEN MULAI -->
				<div id="kolom1-second-faq">
					<div id="kontenkolom1">
					<!-- KOLOM 1 mulai --> 
						<div id="faqkonten">
							<p align="justify"><span class="judul46">Paket Hotel</span><br /><br /><br /></p>
						</div>
					</div>
				<!-- KONTEN end -->
				</div>
			</div>
<script>
	$( window ).load(function() {
		load_posts();
	})
	
	function load_posts(){
		var data = [];
		var d = new Date(); 
		var image_path = '<?php echo base_url();?>assets/uploads/posts/';
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/webfront/get_post_by_category/hotel/0/20',
			dataType: "json",
			success:function(datajson){
				var div = $('#faqkonten');
				for(var i=0; i<datajson.length; i++){
					var content_str = datajson[i].content;
					var content_cut = content_str.substring(0,200);
					div.append('<p align="justify">\
									<a href="<?php echo base_url();?>index.php/webfront/show_post/'+datajson[i].id+'" style="text-decoration:none">\
										<span class="judul18">'+datajson[i].title+'</span>\
									</a><br /><br /></p>\
									<img src="<?php echo base_url();?>assets/uploads/posts/'+datajson[i].image_file+'" width="263px" height="154px"/><span style="font-size:16px;">         Harga IDR <span style="color: green;">'+currency_separator(datajson[i].price,'.')+'</span></span><br />'+content_cut+'<a href="<?php echo base_url();?>index.php/webfront/show_post/'+datajson[i].id+'" style="text-decoration:none; color:#f59e00"><strong>read more</strong></a><br /><br /><br />');
				}
			}
		});
	}
</script>