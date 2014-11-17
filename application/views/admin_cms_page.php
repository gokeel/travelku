<div id="content"  style="min-height:400px;"> 
	<div class="frametab">
		<a href="<?php echo base_url();?>index.php/admin/content_add_page"><button style="margin:10px; float:right;padding: 4px 5px;">Tambah Konten/Paket</button></a>
		<h3 style="margin:5px 0 5px 5px;">Daftar Semua Konten & Paket</h3>
		<div id="list"></div>
	</div>
	<div id="end"></div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_contents();
	})
	
	function load_contents(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_posts',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {id:parseInt(datajson[i].id), category:datajson[i].category, title: datajson[i].title, is_promo: datajson[i].is_promo, price: currency_separator(datajson[i].price, '.'), author: datajson[i].author, status: datajson[i].status, enabled: datajson[i].enabled, point_reward: datajson[i].point_reward, creation_date: datajson[i].creation_date, publish_date: datajson[i].publish_date, image_slider: datajson[i].image_slider};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_user = data;
			var table = new Y.DataTable({
				columns: [
					{key:"id", label:"ID", sortable: true},
					{key:"category", label:"Kategori", sortable: true},
					{key:"title", label:"Judul"},
					{label:"Promo?",
						nodeFormatter:function(o){
							if(o.data.is_promo=="true")
								o.cell.set('text', 'Ya');
							else
								o.cell.set('text', 'Tidak');
						}
					},
					{label:"Image Slider?",
						nodeFormatter:function(o){
							if(o.data.image_slider=="true")
								o.cell.set('text', 'Ya');
							else
								o.cell.set('text', 'Tidak');
						}
					},
					{key:"price", label:"Harga"},
					{key:"point_reward", label:"Poin Reward"},
					{key:"author", label:"Penulis"},
					{key:"status", label:"Status"},
					{key:"creation_date", label:"Tgl Dibuat"},
					{key:"publish_date", label:"Tgl Publish"},
					{label:"Ditampilkan?",
						nodeFormatter:function(o){
							if(o.data.enabled=="true")
								o.cell.set('text', 'Ya');
							else
								o.cell.set('text', 'Tidak');
						}
					},
					{
						key:"id", 
						label: "Ubah",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/content_modify/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>&nbsp;&nbsp;&nbsp;&nbsp;',
						allowHTML: true
					},
					{
						key:"id",
						label:"Hapus",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/del_post/{value}" onclick="return prompt_delete_item();" ><img src="<?php echo IMAGES_DIR;?>/delete.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				],
				data: data_user,
				caption: "",
				rowsPerPage: 50
			});
			table.render("#list");
		});
	}
	
</script>