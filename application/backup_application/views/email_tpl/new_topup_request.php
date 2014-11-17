<html>
	<body>
		<p>Hai <?php echo $username;?>,</p>
		<p></p>
		<p>Permintaan top up anda senilai <?php echo $nominal;?> akan kami proses, mohon untuk menunggu.</p>
		<p></p>
		<p>Anda dapat mengetahui perkembangan status permintaan anda di link berikut ini atau melalui email yang kami kirimkan.</p>
		<a href="<?php echo base_url();?>index.php/agent/report_deposit/topup">Halaman Deposit Topup</a>
		<p></p>
		<p>Salam,<br />
			Admin</p>
	</body>
</html>