<html>
	<body>
		<p>Hai <?php echo $title.'. '.$first_name.' '.$last_name;?>,</p>
		<p></p>
		<p>Pesanan anda telah kami terima dengan detail berikut:<br />
		ID Pesanan: <?php echo $order_id;?><br />
		Hotel: <?php echo $hotel_name;?><br />
		Alamat: <?php echo $address;?><br />
		Checkin / Checkout: <?php echo $checkin.' / '.$checkout;?><br />
		Malam / Kamar: <?php echo $night.'  '.$room;?></p>
		Penumpang: Dewasa <?php echo $adult;?> - Anak <?php echo $child;?></p>
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