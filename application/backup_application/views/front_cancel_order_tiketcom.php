			<div id="content">
				<!-- KONTEN MULAI -->
				<div id="kolom1-second-contact">
					<div id="kontenkolom1">
						<!-- KOLOM 1 mulai --> 
						<div id="contactkonten">
							<div align="justify"> <span class="judul46">Pembatalan Tiket</span><br /><br /><br />
								<?php
									if ($this->uri->segment(3)=="success"){
									  echo '<h4>Terima kasih telah melakukan pembayaran</h4>';
									  echo '<p>Kami akan segera melakukan pengecekan di sistem kami.</p>';
									}
								?>
								<p align="justify"><span class="judul18">Mohon untuk mengisi input berikut ini:</span><br /></p>

								<article>
									<form action="<?php echo base_url();?>index.php/order/tiketcom_cancel_order" method="post" id="ContactForm">
										<div>
											<div  class="wrapper"> <span>Order ID</span>
												<input type="text" name="orderId" id="orderId"/>
											</div>
											<input type="submit" value="Batalkan Tiket" class="button-1" style="float:right;"/>
										</div>
									</form>
								</article>
								
							</div>
						</div>
						
					<!-- KONTEN end -->
					</div>
				</div>