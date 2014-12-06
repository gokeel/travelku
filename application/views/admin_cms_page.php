<script type="text/javascript">
YUI().use('tabview', function(Y) {
    var tabview = new Y.TabView({srcNode:'#tabs'});
    tabview.render();
});
</script>
<div id="content"  style="min-height:400px;"> 
	<div class="frametab">
		<h3 style="margin:5px 0 5px 5px;">Daftar Semua Konten</h3>
		<div id="tabs">
			<ul>
				<li><a href="#paket">Paket</a></li>
				<li><a href="#non-paket">Non Paket</a></li>
				<!--<li><a href="#tab-7">Paket Promo</a></li>-->
			</ul>
			<div>
				<div id="paket">
					<div id="paket-true"></div>
				</div>
				<div id="non-paket">
					<div id="paket-false"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="end"></div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_paket('true');
		load_paket('false');
	})
	
	function load_paket(is_paket){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_posts/'+is_paket,
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {id:parseInt(datajson[i].id), category:datajson[i].category, title: datajson[i].title, rating: datajson[i].star_rating, is_promo: datajson[i].is_promo, price: currency_separator(datajson[i].price, '.'), author: datajson[i].author, status: datajson[i].status, enabled: datajson[i].enabled, point_reward: datajson[i].point_reward, creation_date: datajson[i].creation_date, publish_date: datajson[i].publish_date, image_slider: datajson[i].image_slider, purchasing_price: datajson[i].purchasing_price};
			}
		});
		var column_paket ;
		if(is_paket=='true'){
			column_paket = [
					{key:"id", label:"ID", sortable: true},
					{key:"category", label:"Kategori", sortable: true},
					{key:"title", label:"Judul"},
					{key:"rating", label:"Rating"},
					{label:"Promo?",
						nodeFormatter:function(o){
							if(o.data.is_promo=="true")
								o.cell.set('text', 'Ya');
							else
								o.cell.set('text', 'Tidak');
						}
					},
					{label:"Banner",
						nodeFormatter:function(o){
							if(o.data.image_slider=="true")
								o.cell.set('text', 'Ya');
							else
								o.cell.set('text', 'Tidak');
						}
					},
					{key:"price", label:"Harga Jual"},
					{key:"purchasing_price", label:"Harga Beli"},
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
						label: "Detil/Ubah",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/content_modify/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>&nbsp;&nbsp;&nbsp;&nbsp;',
						allowHTML: true
					},
					{
						key:"id",
						label:"Hapus",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/del_post/{value}" onclick="return prompt_delete_item();" ><img src="<?php echo IMAGES_DIR;?>/delete.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				]
		}
		else{
			column_paket = [
					{key:"id", label:"ID", sortable: true},
					{key:"category", label:"Kategori", sortable: true},
					{key:"title", label:"Judul"},
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
						formatter:'<a href="<?php echo base_url();?>index.php/admin/content_modify_nonpaket/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>&nbsp;&nbsp;&nbsp;&nbsp;',
						allowHTML: true
					}
				]
		}
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_user = data;
			var table = new Y.DataTable({
				columns: column_paket,
				data: data_user,
				caption: "",
				rowsPerPage: 50
			});
			table.render("#paket-"+is_paket);
		});
	}
	
</script>