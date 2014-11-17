			<div id="content">
				<!-- KONTEN MULAI -->
				<div id="kolom1-second-contact">
					<div id="kontenkolom1">
						<!-- KOLOM 1 mulai --> 
						<div id="contactkonten">
							<div align="justify"> <span class="judul46">Konfirmasi Pembayaran Khusus Tiket</span><br /><br /><br />
								<?php
									if ($this->uri->segment(3)=="success"){
									  echo '<h4>Terima kasih telah melakukan pembayaran</h4>';
									  echo '<p>Kami akan segera melakukan pengecekan di sistem kami.</p>';
									}
								?>
								<p align="justify"><span class="judul18">Mohon untuk mengisi semua input berikut ini:</span><br /></p>

								<article>
									<form action="<?php echo base_url();?>index.php/order/tiketcom_confirm_payment" method="post" id="ContactForm">
										<div>
											<div  class="wrapper"> <span>Order ID</span>
												<input type="text" name="orderId" id="orderId"/>
											</div>
											<div  class="wrapper"> <span>Tanggal Transfer</span>
												<input type="text" name="datepayment" id="datepayment" />
											</div>
											<div  class="wrapper"> <span>Bank Tujuan</span>
												<select name="destination">
													<option value="bcatransfer">BCA</option>
													<option value="mandiritransfer">Mandiri</option>
													<option value="bnitransfer">BNI</option>
												</select>
											</div>
											<div  class="wrapper"> <span>Jumlah Dana</span>
												<input type="text" name="total" id="total" />
											</div>
											<div  class="wrapper"> <span>Bank Pengirim</span>
												<input type="text" name="bankName" id="bankName" />
											</div>
											<div  class="wrapper"> <span>Nama Pemilik Rekening</span>
												<input type="text" name="ownName" id="ownName" />
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
		$( "#datepayment" ).datepicker({"dateFormat": "yy-mm-dd"});
	});
</script>