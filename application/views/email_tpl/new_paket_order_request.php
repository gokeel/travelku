<html>
	<body>
		<p>Hai <?php echo $title.'. '.$first_name.' '.$last_name;?>,</p>
		<p></p>
		<p>Pesanan anda telah kami terima dengan detail berikut:</p>
		<p>ID Pesanan: <b><?php echo $order_id;?></b></p>
		<p></p>
		<?php
			if($currency=="IDR"){
				echo '<p>Total Harga yang harus Dibayar: Rp. ' . number_format($total_price, 0, ',', '.')$total_price.'</p>';
			}
			else {
				echo '<p>Kurs USD saat ini: 1 USD = IDR '.number_format($rate, 0, ',', '.').'</p>';
				echo '<p>Harga: USD '.number_format($total_price, 0, ',', '.').'</p>';
				echo '<p>Total Harga yang harus Dibayar(sesuai kurs): Rp. ' . number_format($total_price * $rate, 0, ',', '.').'</p>';
			}
		?>
		
		<p></p>
		<p></p>
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
		<p>Gunakan link berikut untuk membantu anda.</p>
		<p><a href="<?php echo base_url();?>index.php/webfront/general_payment_method">Metode Pembayaran</a></p>
		<p><a href="<?php echo base_url();?>index.php/webfront/confirm_payment">Konfirmasi Pembayaran</a></p>
		<p></p>
		<p>Salam,<br />
			Admin</p>
	</body>
</html>