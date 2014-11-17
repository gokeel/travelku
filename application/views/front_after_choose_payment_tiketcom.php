			<div id="content">
			<!-- KONTEN MULAI -->
				<div id="kolom1-second-faq">
					<div id="kontenkolom1">
					<!-- KOLOM 1 mulai --> 
						<div id="faqkonten">
							<p align="justify"><span class="judul46">Pemilihan Metode Pembayaran <?php echo ($status=='200') ? 'Berhasil' : 'Gagal';?></span><br /><br /><br /></p>
							<?php
								if($status=='200'){
									echo '<p align="justify"><span class="judul18">'.$message.'</span><br /><br /><br /></p>';
									echo '<p align="justify"><span class="judul18">ID Pesanan: #'.$order_id.'</span><br /></p>';
									echo '<p align="justify"><span class="judul18">Total Harga: IDR '.number_format($total,0,',','.').'</span><br /><br /></p>';
									
									if($method=='KlikBCA'){
										echo '<p align="justify"><span class="judul18">Langkah Pembayaran:</span><br /><br /></p>';
										echo '<ol style="list-style-type: decimal;">';
										foreach($steps as $key => $value)
											echo '<li>'.$value.'</li>';
										
										echo '</ol>';
									}
									else if($method=='ATM Transfer'){
										echo '<p align="justify"><span class="judul18">Langkah Pembayaran:</span><br /><br /></p>';
										foreach($steps as $index){
											echo '<p style="font-size:14px;">'.$index['name'].'</p>';
											echo '<ol style="list-style-type: decimal;">';
											foreach($index['step'] as $key => $value){
												echo '<li>'.$value.'</li>';
											}
											echo '</ol><br /><br />';
										}
									}
								}
								else
									echo '<p align="justify"><span class="judul18">Pesan Kesalahan: '.$message.'</span><br /><br /><br /></p>';
							?>
							
						</div>
					</div>
				<!-- KONTEN end -->
				</div>
			</div>