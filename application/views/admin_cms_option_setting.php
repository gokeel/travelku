<div id="content"  style="min-height:400px;"> 
	<div class="frametab">
		<h3 style="margin:5px 0 5px 5px;">Daftar Opsi Untuk Ditampilkan ke Front-End Website</h3>
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
			url: '<?php echo base_url();?>index.php/admin/get_options',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row: datajson[i].number_row, id:datajson[i].id, parameter:datajson[i].parameter, readable: datajson[i].readable, value: datajson[i].value};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var d = new Date(); 
			var data_user = data;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No.", width:"60px"},
					{key:"parameter", label:"Parameter"},
					{key:"readable", label:"Keterangan"},
					{label:"Teks/Gambar yang Ditampilkan",
						nodeFormatter:function(o){
							if(o.data.parameter=="company_logo")
								o.cell.setHTML('<img src="<?php echo base_url();?>assets/uploads/option_images/'+o.data.value+'?ver='+d.getTime()+'" alt="image" />');
							else
								o.cell.set('text', o.data.value);
							return false;
						}
					},
					{
						key:"id", 
						label: "Ubah",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/option_modify/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>&nbsp;&nbsp;&nbsp;&nbsp;',
						allowHTML: true
					}
				],
				data: data_user,
				caption: "",
				rowsPerPage: 100
			});
			table.render("#list");
		});
	}
	
</script>