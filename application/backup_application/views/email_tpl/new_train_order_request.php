<html>
	<body>
		<p>Hai <?php echo $title.'. '.$first_name.' '.$last_name;?>,</p>
		<p></p>
		<p>Pesanan anda telah kami terima dengan detail berikut:<br />
		ID Pesanan: <?php echo $order_id;?><br />
		Kereta: <?php echo $train_name;?><br />
		Rute: <?php echo $route;?><br />
		Tanggal Keberangkatan: <?php echo $departure_date.'  '.$time_travel;?></p>
		Penumpang: Dewasa <?php echo $adult;?> - Anak <?php echo $child;?> - Bayi <?php echo $infant;?></p>
		<p></p>
		<p>Total Harga Tiket: <?php echo $total_price;?></p>
		<p>Biaya Administrasi: <?php echo $admin_fee;?></p>
		<p></p>
		Total Harga yang harus Dibayar: <?php echo intval($total_price)+intval($admin_fee);?></p>
		<p></p>
		<p></p>
		<p>Harap melakukan pembayaran dan mengkonfirmasi pembayaran. Gunakan link berikut untuk membantu anda.</p>
		<p><a href="<?php echo base_url();?>index.php/webfront/payment_method">Metode Pembayaran</a></p>
		<p><a href="<?php echo base_url();?>index.php/webfront/confirm_payment">Konfirmasi Pembayaran</a></p>
		<p></p>
		<p>Salam,<br />
			Admin</p>
	</body>
</html>