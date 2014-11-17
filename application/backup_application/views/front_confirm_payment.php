			<div id="content">
				<!-- KONTEN MULAI -->
				<div id="kolom1-second-contact">
					<div id="kontenkolom1">
						<!-- KOLOM 1 mulai --> 
						<div id="contactkonten">
							<div align="justify"> <span class="judul46">Konfirmasi Pembayaran</span><br /><br /><br />
								<?php
									if ($this->uri->segment(3)=="success"){
									  echo '<h4>Terima kasih telah melakukan pembayaran</h4>';
									  echo '<p>Kami akan segera melakukan pengecekan di sistem kami.</p>';
									}
								?>
								<p align="justify"><span class="judul18">Mohon untuk mengisi semua input berikut ini:</span><br /></p>

								<article>
									<form action="<?php echo base_url();?>index.php/order/confirm_payment_order" method="post" id="ContactForm">
										<div>
											<div  class="wrapper"> <span>Order ID</span>
												<input type="text" name="order_id" id="order_id"/>
											</div>
											<div  class="wrapper"> <span>Tanggal Transfer</span>
												<input type="text" name="tgl-transfer" id="tgl-transfer" />
											</div>
											<div  class="wrapper"> <span>Bank Tujuan</span>
												<select name="bank_tujuan" id="bank-tujuan">
												</select>
											</div>
											<div  class="wrapper"> <span>Jumlah Dana</span>
												<input type="text" name="total" id="total" />
											</div>
											<div  class="wrapper"> <span>Nama Pemilik Rekening</span>
												<input type="text" name="sender" id="sender" />
											</div>
											<div  class="wrapper"> <span>Catatan Tambahan</span>
												<textarea name="note"></textarea>
											</div>
											<input type="submit" value="Submit" class="button-1" style="float:right;"/>
										</div>
									</form>
								</article>
								
							</div>
						</div>
						
					<!-- KONTEN end -->
					</div>
				</div>
<script>
	$(function() {
		$( "#tgl-transfer" ).datepicker({"dateFormat": "yy-mm-dd"});
	});

	$( window ).load(function() {
		$.ajax({
			type : "GET",
			url: "<?php echo base_url('index.php/order/get_banks');?>",
			//async: false,
			dataType: "json",
			success:function(data){
				//$('#bank-tujuan').append('<table border=0 id="table-bank" style="margin-left: 300px">');
				for (var i=0; i<data.length; i++){
					$('#bank-tujuan').append('<option value="'+data[i].bank_id+'">'+data[i].bank_name+'</option>');
				}
				
			}
		})
	})
</script>