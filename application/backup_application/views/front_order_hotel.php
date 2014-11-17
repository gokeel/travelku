			<div id="content">
			<!-- KONTEN MULAI -->
				<div id="kolom1-second-faq">
					<div id="kontenkolom1">
					<!-- KOLOM 1 mulai --> 
						<div id="faqkonten">
						</div>
					</div>
				<!-- KONTEN end -->
				</div>
			</div>
<script>
	$( window ).load(function() {
		show_hotel_order();
	});
	
	function show_hotel_order(){
			//cindy nordiansyah
			
			$('#faqkonten').empty();
						
			//$('#faqkonten').append('<span class="judul20">Pesanan Anda, <?php echo $this->input->get('checkin',TRUE);?> - <?php echo $this->input->get('checkout',TRUE);?> Kamar:<?php echo $this->input->get('room',TRUE);?> Malam:<?php echo $this->input->get('night',TRUE);?> Dewasa:<?php echo $this->input->get('dewasa',TRUE);?> Anak:<?php echo $this->input->get('anak',TRUE);?></span><br /><br>');
			
			//add order
			// $.ajax({
				// type : "GET",
				// url: '<?php echo base_url();?>index.php/hotel/add_order_hotel',
				// data: params,
				// cache: false,
				// dataType: "json",
				// success:function(data){
					// if(data==''){
						// $('#faqkonten').append('<p>Maaf, data tidak ada untuk pencarian ini.<p>');
					// }
					// else{
						//$('#faqkonten').append('<p>Berhasil Hore hore.<p>');
						//$('#faqkonten').append('<p>Harga mulai dari IDR '+currency_separator(data.items[0].search_queries.minprice, '.')+' - IDR '+currency_separator(data.items[0].search_queries.maxprice, '.')+'</p>');
						// if(data.items[0].diagnostic.status=="200"){

						// } else {
							// $('#faqkonten').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>'); 
						// }
					// }
				// }
			// })
			
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/hotel/tiketcom_show_order_hotel',
				cache: false,
				dataType: "json",
				success:function(data){
					if(data==''){
						$('#faqkonten').append('<p>Maaf, data tidak ada untuk pencarian ini.<p>');
					}
					else{
						if(data.items[0].diagnostic.status=="200"){
							var div = $("#faqkonten");
							var table = document.createElement('table');
							table.setAttribute('id', 'search-result');
							var tbody = document.createElement('tbody');
							
							if (data.items[0].myorder.data.length <=0) {
								$('#faqkonten').append('<p style="color:red">Pada saat ini Anda tidak memiliki pesanan kamar hotel.</p>'); 
							} else{
								//$('#faqkonten').append('<p>Total sebelum pajak: IDR '+currency_separator(data.items[0].myorder.total_without_tax, '.')+'<br /><br>Pajak       : IDR '+currency_separator(data.items[0].myorder.total_tax, '.')+'<br /><br>Total Pesanan Anda: IDR '+currency_separator(data.items[0].myorder.total, '.')+'</p>'); 
								for(var i=0; i<data.items[0].myorder.data.length;i++){
									var tr_body = document.createElement('tr');
									
									var td1 = document.createElement('td');
									var img = document.createElement('img');
									var path = data.items[0].myorder.data[i].order_photo;
									img.src = path.replace(/\\/g, '')
									img.setAttribute('width', '120px');
									img.setAttribute('height', '100px');
									td1.appendChild(img);
									var p1 = document.createElement('p');
									p1.appendChild(document.createTextNode(data.items[0].myorder.data[i].order_name));
									td1.appendChild(p1);
									//var p2 = document.createElement('p');
									//if (data.items[0].results.result[i].with_breakfasts == 1) {
										//p2.appendChild(document.createTextNode('termasuk sarapan'));
									//} else {
										//p2.appendChild(document.createTextNode('tidak termasuk sarapan'));
									//}
									//td1.appendChild(p2);
																		
									var td2 = document.createElement('td');
									td2.setAttribute('width', '250px');
									var p3 = document.createElement('p');
									p3.appendChild(document.createTextNode('Harga: IDR '+currency_separator(data.items[0].myorder.data[i].detail.price, '.')));
									td2.appendChild(p3);
									// var p4 = document.createElement('p');
									// p4.appendChild(document.createTextNode('Kamar Tersedia: '+data.items[0].results.result[i].room_available));
									// td2.appendChild(p4);
									// var p5 = document.createElement('p');
									// p5.appendChild(document.createTextNode('Fasilitas: '+data.items[0].results.result[i].room_facility));
									// td2.appendChild(p5);
									
									tr_body.appendChild(td1);
									tr_body.appendChild(td2);
									
									var el_td = document.createElement('td');
									var link_order = document.createElement('a');
									var str = document.createTextNode('Bayar');
									link_order.appendChild(str);
									
									//https://api.master18.tiket.com/order/checkout/120152/IDR
									var checkout_uri = data.items[0].checkout;
									var checkout_uri_split = checkout_uri.split("/order/checkout/");
																		
									link_order.setAttribute('href', '<?php echo base_url();?>index.php/hotel/tiketcom_checkout_order/'+checkout_uri_split[1]);

									link_order.setAttribute('class', 'tombol-pesan');
									el_td.appendChild(link_order);
									
									var link_delete = document.createElement('a');
									var strdel = document.createTextNode('Hapus');
									link_delete.appendChild(strdel);
									
									var delete_uri = data.items[0].myorder.data[i].delete_uri;
									var delete_uri_split = delete_uri.split("?");
									//https://api.master18.tiket.com/order/add/hotel?startdate=2012-06-11&enddate=2012-06-12&night=1&room=1&adult=2&child=0&minstar=0&maxstar=5&minprice=0&maxprice=1000&hotelname=0&room_id=666&hasPromo=0&token=1c78d7bc29690cd96dfce9e0350cfc51&output=json
																										
									link_delete.setAttribute('href', '<?php echo base_url();?>index.php/hotel/tiketcom_delete_order_hotel?'+delete_uri_split[1]);

									link_delete.setAttribute('class', 'tombol-pesan');
									el_td.appendChild(link_delete);
									
									tr_body.appendChild(el_td);
									
									table.appendChild(tr_body);
								}
							}
							div.append(table);
						}
						else {
						$('#faqkonten').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>'); 
						}
					}
				}
			})
			
			
			
	}
	
	$(document).ready(function() {

		/* This is basic - uses default settings */
		$('.fancybox').fancybox();
	});
</script>	