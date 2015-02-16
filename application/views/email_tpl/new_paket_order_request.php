<html>
	<body>
		<p>Hai <?php echo $title.'. '.$first_name.' '.$last_name;?>,</p>
		<p></p>
		<p>Pesanan anda telah kami terima dengan detil berikut:<br />
		ID Pesanan: <?php echo $order_id;?><br />
		Email Anda: <?php echo $customer_email;?>
		</p>
		<?php
		/*	if($currency=="IDR"){
				echo '<p>Total Harga yang harus Dibayar: Rp. ' . number_format($total_price, 0, ',', '.').'</p>';
			}
			else {
				echo '<p>Kurs USD saat ini: 1 USD = IDR '.number_format($rate, 0, ',', '.').'</p>';
				echo '<p>Harga: USD '.number_format($total_price, 0, ',', '.').'</p>';
				echo '<p>Total Harga yang harus Dibayar(sesuai kurs): Rp. ' . number_format($total_price * $rate, 0, ',', '.').'</p>';
			}
		*/
		?>
		<p></p><br /><br />
		<p>Cek pemesanan anda di link berikut: <br />
			<a href="<?php echo base_url();?>index.php/webfront/detail_order?order_id=<?php echo $order_id;?>&email=<?php echo $customer_email;?>">Cek Pemesanan</a><br />
			Masukkan ID dan email anda di atas ke dalam formulir yang tampil
		</p>
		<p>Gunakan link berikut untuk membantu anda.</p>
		<p><a href="<?php echo base_url();?>index.php/webfront/general_payment_method">Metode Pembayaran</a></p>
		<p><a href="<?php echo base_url();?>index.php/webfront/confirm_payment">Konfirmasi Pembayaran</a></p>
		<p></p>
		<p>Salam,<br />
			Admin Ticketing</p>
	</body>
</html>