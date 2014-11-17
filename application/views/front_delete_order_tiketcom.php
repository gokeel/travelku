			<div id="content">
			<!-- KONTEN MULAI -->
				<div id="kolom1-second-faq">
					<div id="kontenkolom1">
					<!-- KOLOM 1 mulai --> 
						<div id="faqkonten">
							<p align="justify"><span class="judul46">Pembatalan Tiket <?php echo ($status=='200') ? 'Berhasil' : 'Gagal';?></span><br /><br /><br /></p>
							<?php
								if($status=='200')
									echo '<p align="justify"><span class="judul18">'.$message.'</span><br /><br /><br /></p>';
								else
									echo '<p align="justify"><span class="judul18">Pesan Kesalahan: '.$message.'</span><br /><br /><br /></p>';
							?>
							
						</div>
					</div>
				<!-- KONTEN end -->
				</div>
			</div>