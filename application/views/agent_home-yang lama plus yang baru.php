<style>
#chart-daily, #chart-monthly {
    margin:10px 10px 10px 10px;
    width:90%;
    max-width: 800px;
    height:400px;
}
</style>
<section role="main" id="main"><!--tpl:web/dasboard-->
<!-- Main content -->

<noscript class="message black-gradient simpler">
Your browser does not support JavaScript! Some features won't work as expected...
</noscript>
<div id="main-title" > <span class="head" style="float:right">Dashboard</span> 
  <!--  <h3>Aug <strong>26</strong></h3>-->
  
 <!-- <link rel="stylesheet" media="only all and (min-width: 1200px)" href="<?php echo CSS_DIR;?>/web/custom.css">-->
</div>
	
<div class="standard-tabs" >
	<ul class="tabs" style="margin-left:30px;">
		<li class="active"><a href="#report">Report</a></li>  <!--  <li><a href="#T-iFlight">International Flight</a></li>-->
		<li><a href="#news-agent">Berita Agen</a></li>  <!--  <li><a href="#T-iFlight">International Flight</a></li>-->
		<!--<li><a href="#T-Flight">Flight</a></li>  
		<li><a href="#T-KA">Kereta Api</a></li>
		<li><a href="#T-Hotel">Hotel</a></li>-->
	</ul>

    <!-- Content -->
	<div class="tabs-content">
	<!-- ---------REPORTING----------->
		<div id="report" class="">
			<div class="with-padding">
				<div class="twelve-columns twelve-columns-tablet twelve-columns-mobile">
					<p> </p>
					<h3 class="thin underline">Ubah Bulan, Tahun, dan Tipe Grafik</h3>
					<select id="year-show">
						<option value="">--Pilih Tahun--</option>
						<?php
							for($i=date('Y');$i>=2010;$i--){
								if ($i==date('Y'))
									echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
								else
									echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
					</select>
					<select id="month-show" >
						<option value="">--Pilih Bulan--</option>
						<option value="01">Januari</option>
						<option value="02">Februari</option>
						<option value="03">Maret</option>
						<option value="04">April</option>
						<option value="05">Mei</option>
						<option value="06">Juni</option>
						<option value="07">Juli</option>
						<option value="08">Agustus</option>
						<option value="09">September</option>
						<option value="10">Oktober</option>
						<option value="11">Nopember</option>
						<option value="12">Desember</option>
					</select>
					<select id="chart-type" >
						<option value="">--Pilih Tipe Grafik--</option>
						<option value="column" selected="selected">Column</option>
						<option value="line">Line</option>
						<option value="pie">Pie</option>
						<option value="combo">Combo</option>
						<option value="bar">Bar</option>
						<option value="marker">Marker</option>
						<option value="area">Area</option>
						<option value="spline">Spline</option>
						<option value="areaspline">Area Spline</option>
						<option value="combospline">Combo Spline</option>
					</select>
					<p><button id="show-chart">Tampilkan</button></p>
				</div>
			</div>
			<div style="clear:both;"></div>
			<div class="with-padding">
				<div class="twelve-columns twelve-columns-tablet twelve-columns-mobile">
					<p> </p>
					<h3 class="thin underline" id="title-daily">Statistik Penjualan - <?php echo date('F Y');?></h3>
					<div id="chart-daily"></div>
					<div id="data-daily"></div>
					<p></p>
				</div>
			</div>
			<div style="clear:both;"></div>
			<div class="with-padding">
				<div class="twelve-columns twelve-columns-tablet twelve-columns-mobile">
					<p> </p>
					<h3 class="thin underline" id="title-monthly">Statistik Penjualan Tahun <?php echo date('Y');?></h3>
					<div id="chart-monthly"></div>
					<div id="data-monthly"></div>
					<p></p>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
	
	<!-- ---------News Agent--------- -->
	<div id="news-agent" class="">
		<div style="clear: both; height: 20px;"></div>  
		<div class="bggrey" id="data-news-agent"> </div>
		<div style="clear: both; height: 20px;"></div>  
	</div>
    <!-- ---------T-Flight--------- -->
		<div id="T-Flight" class="">
			<div style="clear: both; height: 20px;"></div>  
			<div class="bggrey" id="formlokal">
				<form id="form_flight" style="margin:0 30px;" >
					<div style="float:left; width:260px;">
						<p>Dari</p>
						<select class="select" name="dari" id="flight-from" style="width:220px"> </select>
					</div>
					<div style="float:left; width:260px;">
						<p>Ke</p>
						<select class="select" name="ke" id="flight-to" style="width:220px"> </select>
					</div>
					<script>
					$(function() {
						$( "#tgl_berangkat" ).datepicker({"dateFormat": "yy-mm-dd"});
						$( "#tgl_pulang" ).datepicker({"dateFormat": "yy-mm-dd"});
					});
					</script>
					<div style="float:left; width:180px;">
						<p>Berangkat</p>
						<span class="input"> 
							<span class="icon-calendar"></span>
							<input readonly="readonly" type="text" name="flight-pergi" id="tgl_berangkat" class="input-unstyled datepicker_dashboard" value="" style="width: 80px;"/>
						</span>
					</div>
					<div style="float:left; width:260px;">
						<p>Kembali</p>
						<span class="input"> 
							<span class="icon-calendar"></span>
							<input readonly="readonly" type="text" name="flight-pulang" id="tgl_pulang" class="input-unstyled datepicker_dashboard" value="" style="width: 80px;"/>
						</span>
					</div>
					<br/>
				  <!-- tidak support untuk return
				  <div id="boxpulang" style="float:left; width:135px;">
					<p>Pulang</p>
					<span class="input"> 
					<span class="icon-calendar"></span>
					<input readonly="readonly" type="text" name="flight-pulang" id="tgl_pulang" class="input-unstyled datepicker_dashboard" value="" style="width: 80px;"/>
					</span>
				  </div>-->
				  
					<div style="float:left; width:80px;">
						<p> Dewasa </p>
						<span class="number input margin-right">
						<button type="button" class="button number-down">-</button>
						<input type="text" name="dewasa" id="dewasa" value="1" class="input-unstyled" style="width: 50px;" readonly="readonly" />
						<button type="button" class="button number-up">+</button>
						</span> 
					</div>
					<div style="float:left; width:80px;">
						<p> Anak <span class="note">(2-12th)</span> </p>
						<span class="number input margin-right">
						<button type="button" class="button number-down">-</button>
						<input type="text" name="anak" id="anak" value="0" class="input-unstyled" style="width: 50px;"  />
						<button type="button" class="button number-up">+</button>
						</span> 
					</div>
            
					<div style="float:left; width:80px;">
						<p> Bayi <span class="note">(<2th)</span> </p>
						<span class="number input margin-right">
						<button type="button" class="button number-down">-</button>
						<input type="text" name="bayi" id="bayi" value="0" class="input-unstyled" style="width: 50px;" readonly="readonly" />
						<button type="button" class="button number-up">+</button>
						</span> 
					</div>
            
					<div style="float:left; width:92px; padding-top:30px;">
						<input type="submit" name="submit" class="button blue-gradient" id="submit-flight" value="CARI" tabindex="8" style="float:left;">
						<!--<button type="submit" class="button blue-gradient" id="submit-flight">Cek</button>-->
						<div class="loader waiting big" style="display:none;"></div>
					</div>
				</form>
				<div style="clear: both; height: 10px;"></div>
				<div id="container_p"><strong>
					<span id="jumlah"><b class=""></b></span> </strong>
					<!-- Progress bar -->
					<div id="progress_bar" style="display: none;" class="ui-progress-bar ui-container hide-on-mobile">
						<div class="ui-progress hide-on-mobile">
						<span class="ui-label" style="display:none;">Processing <b class="value hide-on-mobile"></b></span>
						</div>
					</div>
				</div>
            <script>
              $(function() {
                $('#progress_bar .ui-progress .ui-label').hide();
                $('#progress_bar .ui-progress').css('width', '3%');
              });
            </script>
        <!-- end cek harga -->
			</div>
			<div style="clear: both; height: 30px;"></div>
			<div class="bggrey" id="result-flight"> </div>
      <!--<div class="bggrey" style="display: none;" id="div_flight_result">
        <h3 class="thin underline">Pencarian Rute</h3>
        <fieldset class="fieldset">
          <table class="simple-table responsive-table" id="tb_result">
            <thead>
              <tr>
                <th scope="col" class="">Airlines</th>
                <th scope="col" class="hide-on-mobile">F Number</th>
                <th scope="col" class="">Berangkat</th>
                <th scope="col" class="hide-on-mobile">Sampai</th>
                <th scope="col" class="hide-on-mobile">Fasilitas</th>
                <th scope="col" class="hide-on-mobile-portrait">Seat</th>
                <th scope="col" class="">Harga</th>
                <th scope="col" class=""></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </fieldset>
      </div>-->

			<div style="clear: both; height: 30px;"> </div>
      <!--<div class="boxhotel hide-on-mobile" style="text-align: center;">
                        <div style="clear: both; height: 10px;"></div>
                        <div style="clear: both;"> </div><div class="result_inner_right  hide-on-mobile" style="width: 250px;"><h3>Our Partner</h3><hr/><table><tr><td>
                        <div class="imgbox"><img src="http://www.hellotraveler.co.id/theme/theme_default/images/logomaskapai/airasia.jpg" /></div></td><td>
                        <div class="imgbox"><img src="http://www.hellotraveler.co.id/theme/theme_default/images/logomaskapai/batavia.jpg" /></div></td></tr><tr><td>
                        <div class="imgbox"><img src="http://www.hellotraveler.co.id/theme/theme_default/images/logomaskapai/garuda.jpg" /></div></td><td>
                        <div class="imgbox"><img src="http://www.hellotraveler.co.id/theme/theme_default/images/logomaskapai/kalstar.jpg" /></div></td></tr><tr><td>
                        <div class="imgbox"><img src="http://www.hellotraveler.co.id/theme/theme_default/images/logomaskapai/sky.jpg" /></div></td><td>
                        <div class="imgbox"><img src="http://www.hellotraveler.co.id/theme/theme_default/images/logomaskapai/sriwijaya.jpg" /></div></td></tr><tr><td>
                        <div class="imgbox"><img src="http://www.hellotraveler.co.id/theme/theme_default/images/logomaskapai/trigana.jpg" /></div></td><td>
                        <div class="imgbox"><img src="http://www.hellotraveler.co.id/theme/theme_default/images/logomaskapai/lion.jpg" /></div></td></tr><tr><td>
                        <div class="imgbox"><img src="http://www.hellotraveler.co.id/theme/theme_default/images/logomaskapai/citylink.jpg" /></div></td><td>
                        <div class="imgbox"><img src="http://www.hellotraveler.co.id/theme/theme_default/images/logomaskapai/mandala.jpg" /></div></td></tr><tr><td>
                        <div class="imgbox"><img src="http://www.hellotraveler.co.id/theme/theme_default/images/logomaskapai/tigerairways.jpg" /></div></td><td></tr></table>
                        </div>
                        <div class="result_inner_left  hide-on-mobile"><h3>Daftar Tiket Promo</h3><hr/>
                        <table class="simple-table responsive-table  hide-on-mobile" style="padding: 0px 1px;">
                            <thead><tr><th scope="col" style="text-align:center;">Maskapai</th>
                                <th scope="col" style="text-align:left;">Tanggal</th>
                                <th scope="col" style="text-align:left;">Dept</th>
                                <th scope="col" style="text-align:left;">Arriv</th>
                                <th scope="col" style="text-align:left;">Harga</th>
                            </tr></thead><tr><td style="text-align:center;padding: 0px 1px;"><img src="http://www.master18.tiket.com/images/tiket2/icon_lion_2.jpg" title="LION"/><br/>JT 804</td>
                                                 <td style="text-align:left;padding: 0px 1px;">28-08-2014</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Surabaya / 06:05</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Denpasar, Bali / 07:55</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Rp. 304.420</td></tr><tr><td style="text-align:center;padding: 0px 1px;"><img src="http://www.master18.tiket.com/images/tiket2/icon_sriwijaya_2.jpg" title="SRIWIJAYA"/><br/>SJ 9277</td>
                                                 <td style="text-align:left;padding: 0px 1px;">29-08-2014</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Denpasar, Bali / 17:30</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Surabaya / 17:20</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Rp. 304.420</td></tr><tr><td style="text-align:center;padding: 0px 1px;"><img src="http://www.master18.tiket.com/images/tiket2/icon_sriwijaya_2.jpg" title="SRIWIJAYA"/><br/>SJ 231</td>
                                                 <td style="text-align:left;padding: 0px 1px;">26-08-2014</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Yogyakarta / 10:30</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Jakarta / 11:40</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Rp. 265.920</td></tr><tr><td style="text-align:center;padding: 0px 1px;"><img src="http://www.master18.tiket.com/images/tiket2/icon__2.jpg" title=""/><br/>SL 8548</td>
                                                 <td style="text-align:left;padding: 0px 1px;">27-08-2014</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Bangkok, Don Mueang / 05:50</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Hat Yai / 07:15</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Rp. 261.000</td></tr><tr><td style="text-align:center;padding: 0px 1px;"><img src="http://www.master18.tiket.com/images/tiket2/icon_sriwijaya_2.jpg" title="SRIWIJAYA"/><br/>SJ 9277</td>
                                                 <td style="text-align:left;padding: 0px 1px;">01-09-2014</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Denpasar, Bali / 17:30</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Surabaya / 17:20</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Rp. 304.420</td></tr><tr><td style="text-align:center;padding: 0px 1px;"><img src="http://www.master18.tiket.com/images/tiket2/icon_airasia_2.jpg" title="AIRASIA"/><br/>QZ 8448</td>
                                                 <td style="text-align:left;padding: 0px 1px;">26-08-2014</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Denpasar, Bali / 08:00</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Yogyakarta / 08:10</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Rp. 368.220</td></tr><tr><td style="text-align:center;padding: 0px 1px;"><img src="http://www.master18.tiket.com/images/tiket2/icon_lion_2.jpg" title="LION"/><br/>JT 929</td>
                                                 <td style="text-align:left;padding: 0px 1px;">30-08-2014</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Denpasar, Bali / 07:00</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Surabaya / 06:50</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Rp. 304.420</td></tr><tr><td style="text-align:center;padding: 0px 1px;"><img src="http://www.master18.tiket.com/images/tiket2/icon_airasia_2.jpg" title="AIRASIA"/><br/>QZ 7552</td>
                                                 <td style="text-align:left;padding: 0px 1px;">30-08-2014</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Jakarta / 10:30</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Yogyakarta / 11:35</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Rp. 371.520</td></tr><tr><td style="text-align:center;padding: 0px 1px;"><img src="http://www.master18.tiket.com/images/tiket2/icon_lion_2.jpg" title="LION"/><br/>JT 511</td>
                                                 <td style="text-align:left;padding: 0px 1px;">30-08-2014</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Semarang / 06:20</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Jakarta / 07:25</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Rp. 338.300</td></tr><tr><td style="text-align:center;padding: 0px 1px;"><img src="http://www.master18.tiket.com/images/tiket2/icon_sriwijaya_2.jpg" title="SRIWIJAYA"/><br/>SJ 221</td>
                                                 <td style="text-align:left;padding: 0px 1px;">29-08-2014</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Semarang / 06:10</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Jakarta / 07:10</td>
                                                 <td style="text-align:left;padding: 0px 1px;">Rp. 338.300</td></tr></table></div><div style="clear: both;text-align: left;">*) harga dapat berubah setiap saat </div>
                        </div> -->
			<div style="clear: both; height: 30px;"> </div>
			<div style="clear: both;"> </div>
		</div>
     <!-- ---------/T-Flight--------- -->
     <!-- ---------Kereta Api--------- -->
    <div id="T-KA"  style="display: none;">
      <div class="bggrey">
      <form id="ka_form" style="position:relative; z-index:1110; margin-left:20px;">
       <div style="float:left; width:250px;">
       <p>Dari</p>
          <select class="select" name="dari" id="train-from" style="width:220px" >
		  </select>
       </div>
        <div style="float:left; width:250px;">
       <p>Ke</p>
          <select class="select" name="ke" id="train-to"  style="width:220px">
		  </select>
       </div>
       <script>
			$(function() {
				$( "#train-pergi" ).datepicker({"dateFormat": "yy-mm-dd"});
			});
		</script>
        <div style="float:left; width:135px;">
            <p>Berangkat</p>
            <span class="input"> 
            <span class="icon-calendar"></span>
            <input readonly="readonly" type="text" name="train-pergi" id="train-pergi" class="input-unstyled datepicker_dashboard" value="" style="width: 80px;"/>
            </span>
          </div>
          <div style="float:left; width:70px;">
            <p> Dewasa </p>
            <span class="number input margin-right">
            <button type="button" class="button number-down">-</button>
            <input type="text" name="dewasa" id="dewasaka" value="1" class="input-unstyled" style="width: 40px;" readonly="readonly" />
            <button type="button" class="button number-up">+</button>
            </span> </div>
          <div style="float:left; width:70px;">
            <p> Anak <span class="note"></span> </p>
            <span class="number input margin-right">
            <button type="button" class="button number-down">-</button>
            <input type="text" name="anak" id="anakka" value="0" class="input-unstyled" style="width: 40px;"  />
            <button type="button" class="button number-up">+</button>
            </span> </div>
            
            <div style="float:left; width:70px;">
            <p> Bayi <span class="note"></span> </p>
            <span class="number input margin-right">
            <button type="button" class="button number-down">-</button>
            <input type="text" name="bayi" id="bayika" value="0" class="input-unstyled" style="width: 40px;"  />
            <button type="button" class="button number-up">+</button>
            </span> </div>
            
          
            
          <div style="float:left; width:90px; padding-top:30px;">
			<input type="submit" class="button blue-gradient" id="submit-train" value="CARI">
            <!--<button type="submit" class="button blue-gradient" id="submit_ruteka">Cari</button>-->
            <div class="loader waiting big" style="display:none;"></div>
          </div>
          
       </form>
       <div style="clear: both; height: 30px;"> </div>
       </div>
       
       <div style="clear: both; height: 30px;"> </div>
	   <div class="bggrey" id="result-train"></div>
      <!--<div class="bggrey" style="display: none;" id="div_rail_result">
        <h3 class="thin underline">Jadwal Kereta</h3>
        <fieldset class="fieldset">
          <table class="simple-table responsive-table">
            <thead>
              <tr>
                <th scope="col" class="">Kereta</th>
                <th scope="col" class="hide-on-mobile">Berangkat</th>
                <th scope="col" class="hide-on-mobile">Sampai</th>
                <th scope="col" class="hide-on-mobile">Kelas/Sub</th>
                <th scope="col" class="hide-on-mobile">Kursi</th>
                <th scope="col" class="hide-on-mobile">Harga</th>
                <th scope="col" class=""></th>
              </tr>
            </thead>
            <tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody>
          </table>
        </fieldset>
      </div>
          -->
    
    </div>
    <!-- ---------/Kereta Api--------- -->
    
    <!-- ---------Hotel--------- -->
    <div id="T-Hotel" style="display: none;">
      <div class="bggrey">
        <form  id="hotel-form" style="position:relative; z-index:1110; margin-left:20px;">
          <div style="float:left; width:180px;">
            <p>Nama Kota atau hotel</p>
            <input type="text" id="query" class="input" name="query" value="" style="width:120px; ">
          </div>
		  <script>
			$(function() {
				$( "#checkin" ).datepicker({"dateFormat": "yy-mm-dd"});
				$( "#checkout" ).datepicker({"dateFormat": "yy-mm-dd"});
			});
			</script>
          <div style="float:left; width:280px;"> <span style="float:left;">
            <p>Check In</p>
            <span class="input"> <span class="icon-calendar"></span>
            <input type="text" class="input-unstyled datepicker_dashboard" id="checkin" name="checkin" style="width:65px; margin-right:10px;">
            </span> </span> <span style="float:left; margin-left:10px;">
            <p>Check out</p>
            <span class="input" > <span class="icon-calendar"></span>
            <input type="text" class="input-unstyled datepicker_dashboard" id="checkout" name="checkout" style="width:65px; margin-right:10px;">
            </span> </span> 
          </div>
          <div style="float:left; width:320px;"> <span style="float:left;">
            <p>Kamar</p>
            <span class="number input margin-right">
            <button type="button" class="button number-down">-</button>
            <input type="text" id="room" class="input-unstyled" name="room" value="1" style="width:40px; margin-right:10px;"  data-number-options='{"min":1,"max":10}'>
            <button type="button" class="button number-up">+</button>
            </span> </span> <span style="float:left;">
			<p>Malam</p>
            <span class="number input margin-right">
            <button type="button" class="button number-down">-</button>
            <input type="text" id="night" class="input-unstyled" name="night" value="1" style="width:40px; margin-right:10px;"  data-number-options='{"min":1,"max":10}'>
            <button type="button" class="button number-up">+</button>
            </span> </span> <span style="float:left;">
            <p>Dewasa</p>
            <span class="number input margin-right">
            <button type="button" class="button number-down">-</button>
            <input type="text" id="dewasahotel" class="input-unstyled" name="dewasa" value="2" style="width:40px; margin-right:10px;" data-number-options='{"min":0,"max":10}'>
            <button type="button" class="button number-up">+</button>
            </span> </span> <span style="float:left;">
            <p>Anak</p>
            <span class="number input margin-right">
            <button type="button" class="button number-down">-</button>
            <input type="text" id="anakhotel" class="input-unstyled" name="anak" value="0" style="width:40px; margin-right:10px;"  data-number-options='{"min":0,"max":10}'>
            <button type="button" class="button number-up">+</button>
            </span> </span>
          </div>
          <div style="float:left; width:110px; padding-top:30px;">
            <input type="submit" class="button blue-gradient" id="submit-hotel" value="CARI">
			<!--<input type="submit" class="button cari-hotel button red-gradient" id="submit_hotel" value="CARI" tabindex="8" >-->
            <div class="loader waiting big" style="display:none;"></div>
          </div>
        </form>
          <div style="clear: both; height: 30px;"></div>
          <div class="" style="text-align:center; margin-left:0.9%; ">
            <div id="msge_hotel" class="twelve-columns twelve-columns-tablet twelve-columns-mobile"> </div>
			<div class="bggrey" id="result-hotel"></div>
            <!--<div class="twelve-columns twelve-columns-tablet twelve-columns-mobile" style="display: ; border:0px solid #CCC;" id="hotel_result">
            </div>  -->
             <div style="clear: both; height: 30px;"></div>
          </div>
         </div>
    </div>
    <!-- ---------/Hotel--------- --> 
    
</div> 
</div>    

<div style="text-align:center; margin-top: 20px;">
 <!--<div class="loader waiting big" style="display:none;"></div>-->

 </div>
<!--<div class="with-padding">
  <div style="clear: both; height: 30px;"></div>
  <div class="twelve-columns twelve-columns-tablet twelve-columns-mobile">
   
  
    
  </div>
  <div style="clear: both; height: 30px;"> </div>
</div>-->

<!-- End main content --> 
<script>
  $(document).ready(function(){
      $('.timepicker').datetimepicker({
          dateFormat:'dd-mm-yy',
          timeFormat:'HH:mm:ss',
          minDate:new Date(),
      });
      $('.timepicker_2').datetimepicker({
          dateFormat:'dd-mm-yy',
          timeFormat:'HH:mm:ss',
          maxDate:new Date(),
      });   
     });
function sortJSON(data, key, way) {
    return data.sort(function(a, b) {
        var x = a[key]; var y = b[key];
        if (way === '123' ) { return ((x < y) ? -1 : ((x > y) ? 1 : 0)); }
        if (way === '321') { return ((x > y) ? -1 : ((x < y) ? 1 : 0)); }
    });
}

</script>
<script>
function addDays(theDate, days) {
    return new Date(theDate.getTime() + days*24*60*60*1000);
}
 </script> 
<!--&tpl:web/dasboard--></section>
	<!-- Side tabs shortcuts -->
    
	<!-- input flsh news-->
		<!--<input type="textarea" id="news_flash" hidden="hidden" value="&lt;ul&gt;&lt;h4 class=&quot;green underline&quot;&gt;CLOSING ALL TRANSAKSI&lt;/h4&gt;&lt;p&gt;&lt;p style=&quot;color: #444444; font-family: Arial, Helvetica, sans-serif; font-size: 14px; background-color: #f5f5f5;&quot;&gt;Bersama&amp;nbsp;&lt;span id=&quot;tg522l_6&quot; class=&quot;tg522l&quot; style=&quot;list-style: none; float: none; padding: 0px; margin: 0px; border-width: 1px; border-style: solid; border-top-color: transparent; border-right-color: transparent; border-left-color: transparent; text-decoration: underline; cursor: pointer; display: inline !important; color: #009900 !important;&quot;&gt;ini&lt;/span&gt;&amp;nbsp;kami informasikan bahwa CLOSING ALL TRANSAKSI sedang Mengalami Gangguan&lt;/p&gt;
&lt;p style=&quot;color: #444444; font-family: Arial, Helvetica, sans-serif; font-size: 14px; background-color: #f5f5f5;&quot;&gt;Dan akan kami closing sementara waktu yang ditentuan.&lt;/p&gt;
&lt;p style=&quot;color: #444444; font-family: Arial, Helvetica, sans-serif; font-size: 14px; background-color: #f5f5f5;&quot;&gt;Kami mohon maaf atas ketidaknyamanan yang terjadi. Atas pengertian, dukungan dan kerjasamanya, kami mengucapkan terimakasih&lt;/p&gt;
&lt;p style=&quot;color: #444444; font-family: Arial, Helvetica, sans-serif; font-size: 14px; background-color: #f5f5f5;&quot;&gt;&amp;nbsp;&lt;/p&gt;
&lt;p style=&quot;color: #444444; font-family: Arial, Helvetica, sans-serif; font-size: 14px; background-color: #f5f5f5;&quot;&gt;&amp;nbsp;&lt;/p&gt;
&lt;p style=&quot;color: #444444; font-family: Arial, Helvetica, sans-serif; font-size: 14px; background-color: #f5f5f5;&quot;&gt;&amp;nbsp;&lt;/p&gt;
&lt;p style=&quot;color: #444444; font-family: Arial, Helvetica, sans-serif; font-size: 14px; background-color: #f5f5f5;&quot;&gt;14 Juni 2014 &amp;nbsp;Administrator HELLO TRAVELER&lt;/p&gt;&lt;p&gt;"  />-->

	<!-- load agent_navigation.php -->


	
	<script>
		$( window ).load(function() {
			load_all_airport('<?php echo base_url();?>index.php/flight/get_all_airport', "#flight-from");
			load_all_airport('<?php echo base_url();?>index.php/flight/get_all_airport', "#flight-to");
			
			load_all_station('<?php echo base_url();?>index.php/train/get_all_station', "#train-from");
			load_all_station('<?php echo base_url();?>index.php/train/get_all_station', "#train-to");
			
			var yy = <?php echo date('Y')?>;
			var mm = '<?php echo date('m')?>';
			load_chart_daily(yy, mm, 'column');
			load_chart_monthly(yy, 'column');
			
			load_news_agent()
		});
		
		function load_news_agent(){
			var div = $('#data-news-agent');
			div.empty();
			div.append('<h3 class="thin underline">Berita Agen dari Pusat</h3>');
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/admin/get_news_agents',
				data: 'q=pub',
				cache: false,
				dataType: "json",
				success:function(data){
					if(data==''){
						div.append('<p>Maaf, data tidak ditemukan.<p>');
					}
					else{
						var table = document.createElement('table');
						var thead = document.createElement('thead');
						var tr_head = document.createElement('tr');
						tr_head.appendChild(set_td_data('th', 'Judul'));
						tr_head.appendChild(set_td_data('th', 'Berita'));
						tr_head.appendChild(set_td_data('th', 'Tgl Publish'));
						table.appendChild(tr_head);
									
						var tbody = document.createElement('tbody');
						for(var i=0; i<data.length;i++){
							var tr_body = document.createElement('tr');
							tr_body.appendChild(set_td_data('td', data[i].title));
							var el_td = document.createElement('td');
							el_td.innerHTML = data[i].content; // using HTML
							tr_body.appendChild(el_td);
							
							//tr_body.appendChild(set_td_data('td', $(this).html(data[i].content)));
							tr_body.appendChild(set_td_data('td', data[i].publish_date));
							
							table.appendChild(tr_body);
						}
								
						div.append(table);
					}
				}
			})
		}
		
		
		function get_number_of_days(yy, mm){
			var result;
			if (mm=='01' ) result = 31;			
			else if (mm=='02' ) {
				if (yy%4==0) result = 29;
				else result = 28;
			}
			else if (mm=='03') result = 31;
			else if (mm=='04') result = 30;
			else if (mm=='05') result = 31;
			else if (mm=='06') result = 30;
			else if (mm=='07') result = 31;
			else if (mm=='08') result = 31;
			else if (mm=='09') result = 30;
			else if (mm=='10') result = 31;
			else if (mm=='11') result = 30;
			else if (mm=='12') result = 31;
			
			return result;
		}
		
		function load_chart_daily(yy, mm, chart_type){
			$('#chart-daily').empty();
			$('#data-daily').empty();
			var data_table = [];
			var data_total = [];
			var data_omzet = [];
			$.ajax({
				type : "GET",
				async: false,
				url: '<?php echo base_url();?>index.php/agent/get_daily_sales/'+yy+'-'+mm,
				dataType: "json",
				success:function(datajson){
					for(var k=0; k<datajson.length; k++)
						data_table[k] = {day: datajson[k].day, total: datajson[k].total, omzet: datajson[k].omzet};
					var days = get_number_of_days(yy,mm);
					for(var j=1;j<=days;j++){
						var dd;
						if(j<10) dd = '0'+j;
						else dd = j;
						
						var day = yy+'-'+mm+'-'+dd;
						data_total[j-1] = {category:dd, values:0};
						data_omzet[j-1] = {category:dd, values:0};
						for(var i=0; i<datajson.length;i++){
							if (day==datajson[i].day){
								data_total[j-1] = {category:dd, values:datajson[i].total};
								data_omzet[j-1] = {category:dd, values:datajson[i].omzet};
							}
						}
					}
					
						
				}
			});
			YUI().use('charts', function (Y) 
				{ 
					var myDataValues = data_omzet;
					var styleDef = {
						axes:{
							values:{label:{color:"#a2a2a2"}}
						},
						series:{
							values:{
								marker:{
									fill:{color:"#64FE2E"},
									border:{color:"#ff0000"}
								},
								line:{color:"#64FE2E"}
							}
						}
					}
					var mychart = new Y.Chart({
						dataProvider:myDataValues, 
						render:"#chart-daily",
						styles:styleDef,
						type: chart_type
					});
				});
			YUI().use('datatable', function (Y) {
				/*------------------------------------*/
				
				var table = new Y.DataTable({
					columns: [
						{key:"day", label:"Tanggal"},
						{key:"total", label:"Jumlah Transaksi Penjualan"},
						{key:"omzet", label:"Omzet"}
					],
					data: data_table,
					caption: "Data Penjualan Harian"
				});
				table.render("#data-daily");
			});
		}
		
		function load_chart_monthly(yy, chart_type){
			$('#chart-monthly').empty();
			$('#data-monthly').empty();
			var data_table = [];
			var data_total = [];
			var data_omzet = [];
			$.ajax({
				type : "GET",
				async: false,
				url: '<?php echo base_url();?>index.php/agent/get_monthly_sales/'+yy,
				dataType: "json",
				success:function(datajson){
					for(var k=0; k<datajson.length; k++)
						data_table[k] = {month: datajson[k].month, total: datajson[k].total, omzet: datajson[k].omzet};
					for(var j=1;j<=12;j++){
						var mm;
						if(j<10) mm = '0'+j;
						else mm = j;
						
						var month = yy+'-'+mm;
						data_total[j-1] = {category:mm, values:0};
						data_omzet[j-1] = {category:mm, values:0};
						for(var i=0; i<datajson.length;i++){
							if (month==datajson[i].month){
								data_total[j-1] = {category:mm, values:datajson[i].total};
								data_omzet[j-1] = {category:mm, values:datajson[i].omzet};
							}
						}
					}
					
						
				}
			});
			YUI().use('charts', function (Y) 
				{ 
					var myDataValues = data_omzet;
					var styleDef = {
						axes:{
							values:{label:{color:"#a2a2a2"}}
						},
						series:{
							values:{
								marker:{
									fill:{color:"#64FE2E"},
									border:{color:"#ff0000"}
								},
								line:{color:"#64FE2E"}
							}
						}
					}
					var mychart = new Y.Chart({
						dataProvider:myDataValues, 
						render:"#chart-monthly",
						styles:styleDef,
						type: chart_type
					});
				});
			YUI().use('datatable', function (Y) {
				/*------------------------------------*/
				
				var table = new Y.DataTable({
					columns: [
						{key:"month", label:"Tanggal"},
						{key:"total", label:"Jumlah Transaksi Penjualan"},
						{key:"omzet", label:"Omzet"}
					],
					data: data_table,
					caption: "Data Penjualan Bulana"
				});
				table.render("#data-monthly");
			});
		}
		
		$(document).ready(function() {
			/*search flights*/
			$('#submit-flight').click(function(event) {
				//alert('oii');
				$('#result-flight').empty();
				$('#result-flight').append('<h3 class="thin underline">Hasil Pencarian Data Pesawat (Urutan dari harga termurah), '+document.getElementById('flight-from').value+'-'+document.getElementById('flight-to').value+' Tanggal Berangkat: '+document.getElementById('tgl_berangkat').value+'</h3>');
				var form = $('#form_flight').serialize();
				event.preventDefault();
				$.ajax({
					type : "GET",
					url: '<?php echo base_url();?>index.php/flight/search_flights',
					data: form,
					cache: false,
					dataType: "json",
					success:function(data){
							if(data==''){
								$('#result-flight').append('<p>Maaf, data tidak ada untuk rute ini.<p>');
							}
							else{
								if(data.items[0].diagnostic.status=="200"){
									var div = $("#result-flight");
									var table = document.createElement('table');
									var thead = document.createElement('thead');
									var tr_head = document.createElement('tr');
									tr_head.appendChild(set_td_data('th', 'Maskapai'));
									tr_head.appendChild(set_td_data('th', 'Kode Penerbangan'));
									tr_head.appendChild(set_td_data('th', 'Rute & Jam'));
									tr_head.appendChild(set_td_data('th', 'Harga'));
									tr_head.appendChild(set_td_data('th', 'Pesan'));
									table.appendChild(tr_head);
									
									var tbody = document.createElement('tbody');
									
									
									for(var i=0; i<data.items[0].departures.result.length;i++){
										var tr_body = document.createElement('tr');
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].airlines_name));
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].flight_number));
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].full_via));
										//tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].price_value));
										// detail untuk price tiap usia
										var td1 = document.createElement('td');
										var p1 = document.createElement('p');
										p1.appendChild(document.createTextNode('Dewasa: '+data.items[0].departures.result[i].price_adult));
										td1.appendChild(p1);
										
										var p2 = document.createElement('p');
										p2.appendChild(document.createTextNode('Anak(3-9thn): '+data.items[0].departures.result[i].price_child));
										td1.appendChild(p2);
										
										var p3 = document.createElement('p');
										p3.appendChild(document.createTextNode('Bayi: '+data.items[0].departures.result[i].price_infant));
										td1.appendChild(p3);
										
										tr_body.appendChild(td1);
										
										var el_td = document.createElement('td');
										var link_order = document.createElement('a');
										var str = document.createTextNode('Pesan');
										link_order.appendChild(str);
										link_order.setAttribute('href', '<?php echo base_url();?>index.php/order/order_page/flight/'+data.items[0].departures.result[i].flight_id+'/'+data.items[0].search_queries.date);
										link_order.setAttribute('class', 'border-order');
										el_td.appendChild(link_order);
										tr_body.appendChild(el_td);
										
										table.appendChild(tr_body);
									}
									
									div.append(table);
								}
								else {
									$('#result-flight').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>');
								}
							}
						}
				})
			});
			/*search trains*/
			$('#submit-train').click(function(event) {
				$('#result-train').empty();
				$('#result-train').append('<h3 class="thin underline">Hasil Pencarian Data Kereta Api, '+document.getElementById('train-from').value+'-'+document.getElementById('train-to').value+' Tanggal Berangkat: '+document.getElementById('train-pergi').value+'</h3>');
				var form = $('#ka_form').serialize();
				event.preventDefault();
				$.ajax({
					type : "GET",
					url: '<?php echo base_url();?>index.php/train/search_trains',
					data: form,
					cache: false,
					dataType: "json",
					success:function(data){
							if(data==''){
								$('#result-train').append('<p>Maaf, data tidak ada untuk rute ini.<p>');
							}
							else{
								if(data.items[0].diagnostic.status=="200"){
									var div = $("#result-train");
									var table = document.createElement('table');
									var thead = document.createElement('thead');
									var tr_head = document.createElement('tr');
									tr_head.appendChild(set_td_data('th', 'Kereta Api (Kelas)'));
									tr_head.appendChild(set_td_data('th', 'Kursi Tersedia'));
									tr_head.appendChild(set_td_data('th', 'Pergi'));
									tr_head.appendChild(set_td_data('th', 'Tiba'));
									tr_head.appendChild(set_td_data('th', 'Durasi'));
									tr_head.appendChild(set_td_data('th', 'Harga'));
									tr_head.appendChild(set_td_data('th', 'Pesan'));
									table.appendChild(tr_head);
									
									var tbody = document.createElement('tbody');
									
									
									for(var i=0; i<data.items[0].departures.result.length;i++){
										var kelas = data.items[0].departures.result[i].class_name;
										
										var tr_body = document.createElement('tr');
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].train_name+' ('+kelas.toUpperCase()+', subclass: '+data.items[0].departures.result[i].subclass_name+')'));
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].detail_availability));
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].departure_time));
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].arrival_time));
										tr_body.appendChild(set_td_data('td', data.items[0].departures.result[i].duration));
										
										var td1 = document.createElement('td');
										var p1 = document.createElement('p');
										p1.appendChild(document.createTextNode('Dewasa: '+data.items[0].departures.result[i].price_adult));
										td1.appendChild(p1);
										
										var p2 = document.createElement('p');
										p2.appendChild(document.createTextNode('Anak(3-9thn): '+data.items[0].departures.result[i].price_child));
										td1.appendChild(p2);
										
										var p3 = document.createElement('p');
										p3.appendChild(document.createTextNode('Bayi: '+data.items[0].departures.result[i].price_infant));
										td1.appendChild(p3);
										
										tr_body.appendChild(td1);
										
										var el_td = document.createElement('td');
										var link_order = document.createElement('a');
										var str = document.createTextNode('Pesan');
										link_order.appendChild(str);
										link_order.setAttribute('href', '<?php echo base_url();?>index.php/order/order_page/train/'+data.items[0].departures.result[i].schedule_id+'/'+data.items[0].search_queries.date+'/'+document.getElementById('train-from').value+'/'+document.getElementById('train-to').value+'/'+document.getElementById('dewasaka').value+'/'+document.getElementById('anakka').value+'/'+document.getElementById('bayika').value);
										//link_order.setAttribute('href', '<?php echo base_url();?>index.php/order/staging_order/'+data.items[0].departures.result[i].schedule_id);
										link_order.setAttribute('class', 'border-order');
										el_td.appendChild(link_order);
										tr_body.appendChild(el_td);
										
										table.appendChild(tr_body);
									}
									
									div.append(table);
								}
								else {
									$('#result-train').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>');
								}
							}
						}
				})
			});
			$('#submit-hotel').click(function(event) {
				$('#result-hotel').empty();
				$('#result-hotel').append('<h3 class="thin underline">Hasil Pencarian Data Hotel, '+document.getElementById('checkin').value+'-'+document.getElementById('checkout').value+' Kamar:'+document.getElementById('room').value+' Malam:'+document.getElementById('night').value+' Dewasa:'+document.getElementById('dewasahotel').value+' Anak:'+document.getElementById('anakhotel').value+'</h3>');
				var form = $('#hotel-form').serialize();
				event.preventDefault();
				$.ajax({
					type : "GET",
					url: '<?php echo base_url();?>index.php/hotel/search_hotels',
					data: form,
					cache: false,
					dataType: "json",
					success:function(data){
							if(data==''){
								$('#result-hotel').append('<p>Maaf, data tidak ada untuk rute ini.<p>');
							}
							else{
								if(data.items[0].diagnostic.status=="200"){
									var div = $("#result-hotel");
									var table = document.createElement('table');
									var tbody = document.createElement('tbody');
																	
									for(var i=0; i<data.items[0].results.result.length;i++){
										var tr_body = document.createElement('tr');
										
										var td1 = document.createElement('td');
										var img = document.createElement('img');
										var path = data.items[0].results.result[i].photo_primary;
										img.src = path.replace(/\\/g, '')
										img.setAttribute('width', '120px');
										img.setAttribute('height', '100px');
										td1.appendChild(img);
										var p1 = document.createElement('p');
										p1.appendChild(document.createTextNode(data.items[0].results.result[i].name));
										td1.appendChild(p1);
										var p2 = document.createElement('p');
										p2.appendChild(document.createTextNode(data.items[0].results.result[i].address));
										td1.appendChild(p2);
										
										var td2 = document.createElement('td');
										td2.setAttribute('width', '250px');
										var p3 = document.createElement('p');
										p3.appendChild(document.createTextNode('Harga: '+data.items[0].results.result[i].price));
										td2.appendChild(p3);
										var p4 = document.createElement('p');
										p4.appendChild(document.createTextNode('Kamar Tersedia: '+data.items[0].results.result[i].room_available));
										td2.appendChild(p4);
										var p6 = document.createElement('p');
										p6.appendChild(document.createTextNode('Bintang : '+data.items[0].results.result[i].star_rating));
										td2.appendChild(p6);
										var p7 = document.createElement('p');
										p7.appendChild(document.createTextNode('Rating Pelanggan: '+data.items[0].results.result[i].rating+'/10'));
										td2.appendChild(p7);
										var p5 = document.createElement('p');
										p5.appendChild(document.createTextNode('Fasilitas: '+data.items[0].results.result[i].room_facility_name));
										td2.appendChild(p5);
										
										tr_body.appendChild(td1);
										tr_body.appendChild(td2);
										
										var el_td = document.createElement('td');
										var link_order = document.createElement('a');
										var str = document.createTextNode('Pesan');
										link_order.appendChild(str);
										link_order.setAttribute('href', '<?php echo base_url();?>index.php/order/order_page/hotel/'+data.items[0].results.result[i].id+'/'+document.getElementById('query').value+'/'+document.getElementById('checkin').value+'/'+document.getElementById('checkout').value+'/'+document.getElementById('room').value+'/'+document.getElementById('dewasahotel').value+'/'+document.getElementById('anakhotel').value+'/'+document.getElementById('night').value);
										link_order.setAttribute('class', 'border-order');
										el_td.appendChild(link_order);
										tr_body.appendChild(el_td);
										
										table.appendChild(tr_body);
									}
									
									div.append(table);
								}
								else {
									$('#result-hotel').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>');
								}
							}
						}
				})
			});
			$('#show-chart').click(function(event) {
				var year = document.getElementById('year-show').value;
				var month = document.getElementById('month-show').value;
				var chart= document.getElementById('chart-type').value;
				var month_text = $('#month-show option:selected').text();
				$('#title-daily').html('Statistik Penjualan - '+month_text+' '+year);
				$('#title-monthly').html('Statistik Penjualan Tahun '+year);
				load_chart_daily(year, month, chart);
				load_chart_monthly(year, chart);
			});
		});

	</script>
