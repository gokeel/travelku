			<div id="content">
				<!-- KONTEN MULAI -->
				<div id="kolom1-second-contact">
					<div id="kontenkolom1">
						<!-- KOLOM 1 mulai --> 
						<div id="contactkonten">
							<div align="justify"> <span class="judul46">Pesan Paket</span><br /><br /><br />
								<?php
									if ($this->uri->segment(4)=="success"){
									  echo '<h4>Terima kasih '.$this->uri->segment(5).', masukan anda telah kami terima</h4>';
									  echo '<p>Kami akan segera menghubungi anda pada jam kerja.</p>';
									}
								?>
								<p align="justify"><span class="judul18">Mohon untuk mengisi semua input berikut ini:</span><br /></p>

								<article>
									<form action="<?php echo base_url();?>index.php/order/add_order_paket" method="post" id="ContactForm">
										<div>
											<input type="hidden" name="post_id" value="<?php echo $this->uri->segment(3); ?>">
											
											<div  class="wrapper"> <span>Titel</span>
												<select id="conSalutation" type="text" name="title"><option value="Mr">Tuan</option><option value="Mrs">Nyonya</option><option value="Ms">Nona</option></select>
											</div>
											<div  class="wrapper"> <span>Nama Depan</span>
												<input type="text" name="first_name" id="first_name"/>
											</div>
											<div  class="wrapper"> <span>Nama Belakang</span>
												<input type="text" name="last_name" id="last_name" />
											</div>
											<div  class="wrapper"> <span>Telepon/HP</span>
												<input type="text" name="telp_no" id="telp_no" />
											</div>
											<div  class="wrapper"> <span>Email</span>
												<input type="text" name="email" id="email" />
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