			<div id="content">
			<!-- KONTEN MULAI -->
				<div id="kolom1-second-faq">
					<div id="kontenkolom1">
					<!-- KOLOM 1 mulai --> 
						<div id="faqkonten">
							<p align="justify"><span class="judul46">Order Berhasil</span><br /><br /><br /></p>
							<p align="justify"><span class="judul18">ID Pesanan anda: <?php echo $this->uri->segment(3);?></span><br /><br /><br /></p>
							<p>Mohon cek email anda sebagai pengingat ID pesanan ketika melakukan konfirmasi pembayaran<br /><br /><br /></p>
							<p align="justify"><span class="judul18"><u>Metode Pembayaran Tiket</u></span><br /><br /><br /></p>
							<p>Mohon untuk melakukan pembayaran melalui opsi bank di bawah ini:</p>
							<div id="data-bank"></div>
							
						</div>
					</div>
				<!-- KONTEN end -->
				</div>
			</div>
<script>
	$( window ).load(function() {
		$.ajax({
			type : "GET",
			url: "<?php echo base_url('index.php/order/get_banks');?>",
			//async: false,
			dataType: "json",
			success:function(data){
				$('#data-bank').append('<a style="text-align:left;" href="<?php echo base_url();?>index.php/webfront/confirm_payment"><button class="button-1">Konfirmasi Pembayaran</button></a>');
				$('#data-bank').append('<table border=0 id="table-bank" style="margin-left: 30px">');
				for (var i=0; i<data.length; i++){
					$('#table-bank').append('<tr>\
						<td><img src="<?php echo base_url();?>assets/images/payment/'+data[i].logo+'" width="180px" height="120px"></td>\
						<td><p>Bank '+data[i].bank_name+'</p>\
							<p>Cabang: '+data[i].branch+', '+data[i].city+'</p>\
							<p>Rekening: '+data[i].account_number+'</p>\
							<p>Atas Nama: '+data[i].holder+'</p>\
						</td>\
					</tr>');
				}
				
			}
		})
	})
</script>