<html>
	<body>
		<p>Hai <?php echo $title.'. '.$first_name.' '.$last_name;?>,</p>
		<p></p>
		<p>Pesanan anda telah kami terima dengan detil berikut:<br />
		ID Pesanan: <?php echo $order_id;?><br />
		Email Anda: <?php echo $customer_email;?>
		</p>
		<p>Total Harga Tiket: <?php echo $total_price;?></p>
		<!--<p>Biaya Administrasi: <?php echo $admin_fee;?></p>-->
		<p></p>
		<!--Total Harga yang harus Dibayar: <?php echo intval($total_price)+intval($admin_fee);?></p>
		<p></p>
		<p></p>-->
		<p>Harap melakukan pembayaran dan mengkonfirmasi pembayaran.</p> 
		<p></p>
		<p><u>Silahkan mengirim ke salah satu bank terdaftar berikut:</u></p>
		<?php
		foreach ($banks as $index){
			echo '<ul style="list-style-type: square">';
			echo '<li><b>'.$index['bank_name'].'</b><br/>a/n. '.$index['holder_name'].'<br/>No. Rekening '.$index['account_number'].'<br/>Cabang '.$index['branch'].', '.$index['city'];
			echo '</ul><br />';
		}
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