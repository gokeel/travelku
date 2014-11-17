			<div id="content">
			<!-- KONTEN MULAI -->
				<div id="kolom1-second-faq">
					<div id="kontenkolom1">
					<!-- KOLOM 1 mulai --> 
						<div id="faqkonten">
							<p align="justify"><span class="judul46">Pilih Metode Pembayaran</span><br /><br /><br /></p>
							<img id="progress" src="<?php echo IMAGES_DIR; ?>/spiffygif_34x34.gif" />
							<div id="messages"></div>
							<div id="result"></div>
						</div>
					</div>
				<!-- KONTEN end -->
				</div>
			</div>
<script>
	var new_token = '';
	var order_id = '';
	var price = '';
	var msg = '';
	$( window ).load(function() {
		load_available_payments();
	});
	function load_available_payments(){
		$("#progress").show();
		$("#result").empty();
		
		$.ajax({
			type : "GET",
			url: '<?php echo base_url();?>index.php/order/tiketcom_get_available_payment?token=<?php echo $this->uri->segment(3);?>&id=<?php echo $this->uri->segment(4);?>',
			cache: false,
			dataType: "json",
			success:function(data){
				if(data.status!="200"){
					$("#messages").append('<p style="color:red">Pesan Kesalahan: '+data.message+'</p>');
					$("#progress").hide();
				}
				else{
					for(var i=0;i<data.list.length;i++){
						var form_start = '<form method="post" action="'+data.list[i].link+'">';
						var form_end = '</form>';
						var msg = (data.list[i].message=="" ? "-" : data.list[i].message);
						var order_id = '<p>Order ID: <strong>'+data.order_id+'</strong></p>';
						var price;
						if(data.list[i].text=="Kartu Kredit" || data.list[i].text=="Credit Card")
							price = '<p>Total : <strong>'+data.price_no_discount+'</strong></p><br /><br />';
						else
							price = '<p>Total : <strong>'+data.price_with_discount+'</strong></p><br /><br />';
						var any_input = '';
						var guides = '';
						if(data.list[i].text=="KlikBCA"){
							var form_start = '<form method="post" action="<?php echo base_url();?>index.php/order/tiketcom_checkout_payment">';
							any_input = '<input type="hidden" name="method" value="'+data.list[i].text+'">\
										<input type="hidden" name="token" value="'+data.token+'">\
										<input type="hidden" name="link" value="'+data.list[i].link+'">\
										<label for="user_id">User ID KlikBCA</label><input type="text" name="user_bca" id="user_id" /><br />';
							guides = '<p align="justify"><span class="judul18">Petunjuk</span><br /><br /></p>\
									<ul style="list-style-type: square">\
										<li>Jika setelah transaksi anda mendapatkan pesan kesalahan seperti "Transaction Failed" atau "Transaksi Gagal", mohon untuk menghubungi Call Center kami melalui email atau telepon yang tertera di website ini. Pesan ini memungkinkan dana anda telah tertarik dan transaksi berhasil namun pesan tidak sesuai. Mohon cek email anda untuk melihat booking voucher, jika setelah 15 menit anda belum menerima, mohon untuk menghubungi Call Center kami.</li>\
										<li>User ID KlikBCA yang dimasukkan adalah User ID KlikBCA yang telah aktif.</li>\
										<li>Mohon untuk melakukan pembayaran hanya melalui KlikBCA dengan User ID yang sama saat memasukkan User ID.</li>\
										<li>Pembayaran harus dilakukan dalam waktu 60 menit setelah booking. Transaksi akan dibatalkan jika pembayaran tidak dilakukan dalam periode waktu yang telah ditentukan.</li>\
										<li>Setelah melakukan pembayaran, anda akan menerima e-mail dalam waktu 5 menit berisi informasi kode booking dan detil.</li>\
									</ul>\
									';
						}
						else if(data.list[i].text=="ATM Transfer"){
							var form_start = '<form method="post" action="<?php echo base_url();?>index.php/order/tiketcom_checkout_payment">';
							any_input = '<input type="hidden" name="method" value="'+data.list[i].text+'">\
										<input type="hidden" name="token" value="'+data.token+'">\
										<input type="hidden" name="link" value="'+data.list[i].link+'">\
										';
							guides = '<p align="justify"><span class="judul18">Petunjuk</span><br /><br /></p>\
									<ul style="list-style-type: square">\
										<li>Hanya melalui jaringan ATM Bersama atau ATM Prima yang dapat diproses dalam metode pembayaran ini. Untuk Internet Banking/Mobile Banking/melalui Teller/non ATM, mohon menggunakan metode pembayaran yang lain dan tersedia.</li>\
										<li>Setiap transaksi akan dikenakan charge sesuai regulasi oleh ATM Bersama/ATM Prima/Alto.</li>\
										<li>Untuk pengguna ATM Mandiri, minimum transaksi adalah IDR 50.000.</li>\
										<li>Pembayaran harus dilakukan dalam waktu 60 menit setelah booking. Transaksi akan dibatalkan jika pembayaran tidak dilakukan dalam periode waktu yang telah ditentukan.</li>\
										<li>Setelah melakukan pembayaran, anda akan menerima e-mail dalam waktu 5 menit berisi informasi kode booking dan detil.</li>\
									</ul>';
						}
						else if(data.list[i].text=="CIMB Clicks"){
							var form_start = '<form method="post" action="'+data.list[i].link+'&checkouttoken='+data.token+'">';
							guides = '<p align="justify"><span class="judul18">Petunjuk</span><br /><br /></p>\
									<p>Anda akan diarahkan ke halaman lain untuk meminta detil akun.</p>';
						}
						else if(data.list[i].text=="ePAY BRI"){
							var form_start = '<form method="post" action="'+data.list[i].link+'&checkouttoken='+data.token+'">';
							guides = '<p align="justify"><span class="judul18">Petunjuk</span><br /><br /></p>\
									<p>Anda akan diarahkan ke halaman lain untuk meminta detil akun.</p>';
						}
						else if(data.list[i].text=="BCA KlikPay"){
							var form_start = '<form method="post" action="'+data.list[i].link+'&checkouttoken='+data.token+'">';
							guides = '<p align="justify"><span class="judul18">Petunjuk</span><br /><br /></p>\
									<p>Anda akan diarahkan ke halaman lain untuk meminta detil akun.</p>';
						}
						else if(data.list[i].text=="Kartu Kredit" || data.list[i].text=="Credit Card"){
							var form_start = '<form method="post" action="'+data.list[i].link+'&checkouttoken='+data.token+'">';
							guides = '<p align="justify"><span class="judul18">Petunjuk</span><br /><br /></p>\
									<p>Anda akan diarahkan ke halaman lain untuk meminta detil akun.</p>';
						}
						else if(data.list[i].text=="Mandiri Clickpay"){
							var form_start = '<form method="post" action="<?php echo base_url();?>index.php/order/tiketcom_checkout_payment">';
							any_input = '<input type="hidden" name="method" value="'+data.list[i].text+'">\
										<input type="hidden" name="token" value="'+data.token+'">\
										<input type="hidden" name="link" value="'+data.list[i].link+'">\
										<label for="card_no">No Kartu Debit</label><input type="text" name="card_no" id="card_no" /><br />\
										<label>APPLI: <strong>3</strong></label>\
										<label>Input 1: <strong>10 digit terakhir nomor kartu</strong></label>\
										<label>Input 2: <strong>'+data.price_with_discount+'</strong></label>\
										<label>Input 3: <strong>'+data.order_id+'</strong></label>\
										<label for="token_response">Respon Token Mandiri</label><input type="text" name="token_response" id="token_response" /><br />\
										';
							guides = '<p align="justify"><span class="judul18">Petunjuk</span><br /><br /></p>\
									<ul style="list-style-type: square">\
										<li>Aktifkan Token Mandiri anda dan masukkan password.</li>\
										<li>Tekan 3 saat muncul "APPLI".</li>\
										<li>Masukkan 10 digit terakhir kartu debit anda.</li>\
										<li>Masukkan nilai total transaksi anda yaitu '+data.price_with_discount+' .</li>\
										<li>Masukkan ID transaksi anda yaitu '+data.order_id+' .</li>\
										<li>Setelah mendapat respon dari token mandiri, masukkan ke dalam input di atas ini.</li>\
									</ul>';
						}
						
						if(data.list[i].link!="#" && data.list[i].text!="Mandiri Clickpay"){
							$("#result").append('<h3>'+data.list[i].text+'</h3>\
									<div>\
										'+order_id+price+'\
										'+form_start+'\
										<p>Catatan: '+msg+'</p>\
										'+any_input+'\
										'+guides+'\
										<input type="submit" value="Continue & Finish Booking" class="button-1">\
										'+form_end+'\
									</div>\
									');
						}
					}
					// add input for deposit
					$("#result").append('<h3>Deposit</h3>\
							<div>\
								<form method="post" action="<?php echo base_url();?>index.php/order/tiketcom_checkout_payment">\
								<input type="hidden" name="method" value="Deposit">\
								<input type="hidden" name="token" value="<?php echo $this->uri->segment(3);?>">\
								<input type="hidden" name="link" value="<?php echo $this->config->item('api_server');?>/checkout/checkout_payment/8">\
								<ul style="list-style-type: square">\
									<li>Segera lakukan pembayaran dalam 60 menit.</li>\
									<li>Segera lakukan konfirmasi ulang melalui halaman konfirmasi pembayaran yang akan ditampilkan setelah menekan tombol di bawah ini.</li>\
								</ul>\
								<input type="submit" value="Continue & Finish Booking" class="button-1">\
								</form>\
							</div>\
					');
					
					$("#progress").hide();
					$( "#result" ).accordion();
				}
					
			}
		});
		
	}
</script>