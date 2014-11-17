<div id="content"  style="min-height:400px;"> 
  <div class="frametab">
		
		<h3 style="margin:5px 0 5px 5px;">Daftar Semua Komisi</h3>
		<div id="list"></div>
		
		
	</div>
	<div id="end"></div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_list();
	});
	function load_list(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_email_dist_list',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row: datajson[i].number_row, id:datajson[i].id, category: datajson[i].category, to:datajson[i].to, cc: datajson[i].cc, bcc: datajson[i].bcc, email_sender: datajson[i].email_sender, sender_name: datajson[i].sender_name};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable', function (Y) {
			/*------------------------------------*/
			var data_comm = data;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No.", width:"60px"},
					{key:"category", label:"Kategori"},
					{key:"to", label:"Daftar Penerima To"},
					{key:"cc", label:"Daftar Penerima Cc"},
					{key:"bcc", label:"Daftar Penerima Bcc"},
					{key:"email_sender", label:"Email Pengirim"},
					{key:"sender_name", label:"Nama Pengirim"},
					{
						key:"id", 
						label: "Ubah",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/setting_email_dist_modify/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				],
				data: data_comm,
				caption: "Email Distribusi Terdaftar"
			});
			table.render("#list");
		});
	}
</script>

 