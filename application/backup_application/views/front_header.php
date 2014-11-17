<?php
	define('IMAGES_DIR', base_url('assets/themes/theme-2/images'));
	define('CSS_DIR', base_url('assets/themes/theme-2/css'));
	define('GENERAL_CSS_DIR', base_url('assets/css'));
	define('JS_DIR', base_url('assets/themes/theme-2/js'));
	define('GENERAL_JS_DIR', base_url('assets/js'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Hello Traveler</title>
<link rel="stylesheet" href="<?php echo CSS_DIR;?>/style.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo CSS_DIR;?>/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo CSS_DIR;?>/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo CSS_DIR;?>/flexslider.css" type="text/css" media="all">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/3.17.2/build/cssgrids/cssgrids-min.css">
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo JS_DIR;?>/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php echo JS_DIR;?>/cufon-yui.js"></script>
<script type="text/javascript" src="<?php echo JS_DIR;?>/cufon-replace.js"></script>
<script type="text/javascript" src="<?php echo JS_DIR;?>/Cabin_400.font.js"></script>
<script type="text/javascript" src="<?php echo JS_DIR;?>/tabs.js"></script>
<script type="text/javascript" src="<?php echo JS_DIR;?>/jquery.jqtransform.js" ></script>
<script type="text/javascript" src="<?php echo JS_DIR;?>/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="<?php echo JS_DIR;?>/atooltip.jquery.js"></script>
<script type="text/javascript" src="<?php echo JS_DIR;?>/script.js"></script>

<script type="text/javascript" src="<?php echo JS_DIR;?>/modernizr.custom.js"></script> 
<script src="<?php echo GENERAL_JS_DIR;?>/functions.js"></script>
<script src="http://yui.yahooapis.com/3.17.2/build/yui/yui-min.js"></script>

<script type="text/javascript" src="<?php echo JS_DIR;?>/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" href="<?php echo CSS_DIR;?>/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />

<style>
	#headerlogin {background-image:url(<?php echo IMAGES_DIR;?>/bg-login-red.png);}
	#headerlogin-second {background-image:url(<?php echo IMAGES_DIR;?>/bg_login.png);}
	/*#logo {background-image:url(<?php echo IMAGES_DIR;?>/logo-ht.png);}*/
	#logo-second {background-image:url(<?php echo IMAGES_DIR;?>/logo-ht.png);}
	#headershadow {background-image:url(<?php echo IMAGES_DIR;?>/bg-header-orange.png);}
	#bg-orange {background-image:url(<?php echo IMAGES_DIR;?>/bg-menu-orange.png);}
	.bg-awan {background-image:url(<?php echo IMAGES_DIR;?>/bg-awan.jpg);}
	#headermengapa-ki{background-image:url(<?php echo IMAGES_DIR;?>/bg-biru-pojokan_bawah.jpg);}
	#headermengapa-tgh {background-image:url(<?php echo IMAGES_DIR;?>/bg-biru_bawah.jpg);}
	#headermengapa-ka{background-image: url(<?php echo IMAGES_DIR;?>/bg-biru-pojokan_bawah-ka.jpg);}
	#headerpaket-ki{background-image:url(<?php echo IMAGES_DIR;?>/bg_kolom_ki.jpg);}
	#headerpaket-ka{background-image:url(<?php echo IMAGES_DIR;?>/bg_kolom_ka.jpg);}
	#headerhijau-ki{background-image:url(<?php echo IMAGES_DIR;?>/header_kolom_hijau_pojok.png);}
	#headerkuning-ki{background-image:url(<?php echo IMAGES_DIR;?>/bg_kuning_pojok.jpg);}
	#headerbiru-ki{background-image:url(<?php echo IMAGES_DIR;?>/bg-pojok-biru.png);}
	#headerhijau {background-image:url(<?php echo IMAGES_DIR;?>/header_kolom_hijau_tngh.png);}
	#headerkuning {background-image:url(<?php echo IMAGES_DIR;?>/bg_kuning.jpg);}
	#headerbiru {background-image:url(<?php echo IMAGES_DIR;?>/bg-biru.jpg);}
	#hargapaket {background-image:url(<?php echo IMAGES_DIR;?>/bg_tour_br.jpg);}
	#footerorange {background-image:url(<?php echo IMAGES_DIR;?>/footer-orange.jpg);}
	#footerorange-second {background-image:url(<?php echo IMAGES_DIR;?>/footer-orange.jpg);}
	#footerorange-second-hotel {background-image:url(<?php echo IMAGES_DIR;?>/footer-orange.jpg);}
	#footerorange-second-faq {background-image:url(<?php echo IMAGES_DIR;?>/footer-orange.jpg);}
	#footerorange-second-contact {background-image:url(<?php echo IMAGES_DIR;?>/footer-orange.jpg);}
	#footerorange-second-belitung {background-image:url(../images/footer-orange.jpg);}
	#callcenter {background-image:url(<?php echo IMAGES_DIR;?>/callcenter.jpg);}
	.jqTransformRadio {background:url(<?php echo IMAGES_DIR;?>/radio.png);}
	.jqTransformCheckbox {background:url(<?php echo IMAGES_DIR;?>/check.gif);}
	a.jqTransformSelectOpen {background:url(<?php echo IMAGES_DIR;?>/select.gif) 4px 6px no-repeat;}
	#form_2 .help {background:url(<?php echo IMAGES_DIR;?>/help.gif) 0 0 no-repeat;}
	.form_5 .help {background:url(<?php echo IMAGES_DIR;?>/help.gif) 0 0 no-repeat;}
	.form_5 h6 {background:url(<?php echo IMAGES_DIR;?>/marker_3.gif) 0 0 no-repeat;}
	.form_5 h5 {background:url(<?php echo IMAGES_DIR;?>/marker_4.gif) 0 0 no-repeat;}
	.form_5 .marker_left {background:url(<?php echo IMAGES_DIR;?>/marker_left.gif) 0 0 no-repeat;}
	.form_5 .marker_right {background:url(<?php echo IMAGES_DIR;?>/marker_right.gif) 0 0 no-repeat;}
	.tabs ul.nav li a {background:url(<?php echo IMAGES_DIR;?>/tabs.gif) 0 0 repeat-x #30c1fd;}
	.tabs ul.nav li a:hover, .tabs ul.nav .selected a {background:url(<?php echo IMAGES_DIR;?>/tabs_active.gif) top repeat-x #e7e6e6;}
	.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {background:url(<?php echo IMAGES_DIR;?>/tabs.gif) 0 0 repeat-x #30c1fd;}
	.tabs2 ul.nav li a:hover, .tabs2 ul.nav .selected a {background:url(<?php echo IMAGES_DIR;?>/tabs_active.gif) top repeat-x #e7e6e6;}
	.aToolTip {background:url(<?php echo IMAGES_DIR;?>/opacity_50_black.png) repeat;}
	.button1 {background:url(<?php echo IMAGES_DIR;?>/button_1.gif) 0 0px repeat-x #1d77e9;}
	.button1 strong {background:url(<?php echo IMAGES_DIR;?>/marker_2.gif) right 10px no-repeat;}
	.button1:hover {background:url(<?php echo IMAGES_DIR;?>/button_active.gif) 0 0 repeat-x #e7e6e6;}
	.button1:hover strong {background:url(<?php echo IMAGES_DIR;?>/marker_1.gif) right 10px no-repeat;}
	.link1 {background:url(<?php echo IMAGES_DIR;?>/marker_1.gif) 0 6px no-repeat;}
	.list1 li a {background:url(<?php echo IMAGES_DIR;?>/marker_1.gif) 0 4px no-repeat;}
	footer {background:url(<?php echo IMAGES_DIR;?>/bg_footer.gif) top repeat-x #d7dce6;}
	.jqTransformRadio {background:url(<?php echo IMAGES_DIR;?>/radio.png);}
	.jqTransformCheckbox {background:url(<?php echo IMAGES_DIR;?>/check.gif);}
	a.jqTransformSelectOpen {background:url(<?php echo IMAGES_DIR;?>/select.gif) 4px 6px no-repeat;}
	#form_2 .help {background:url(<?php echo IMAGES_DIR;?>/help.gif) 0 0 no-repeat;}
	.form_5 .help {background:url(<?php echo IMAGES_DIR;?>/help.gif) 0 0 no-repeat;}
	.form_5 h6 {background:url(<?php echo IMAGES_DIR;?>/marker_3.gif) 0 0 no-repeat;}
	.form_5 h5 {background:url(<?php echo IMAGES_DIR;?>/marker_4.gif) 0 0 no-repeat;}
	.form_5 .marker_left {background:url(<?php echo IMAGES_DIR;?>/marker_left.gif) 0 0 no-repeat;}
	.form_5 .marker_right {background:url(<?php echo IMAGES_DIR;?>/marker_right.gif) 0 0 no-repeat;}
	
	/*jQuery CSS*/
	.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
			background: url("<?php echo IMAGES_DIR;?>/tabs.gif") repeat-x scroll 50% 50% #459e00;
			border: 1px solid #327e04;
			color: #ffffff;
			font-weight: bold;
		}
	.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
			background: url("<?php echo IMAGES_DIR;?>/tabs_active.gif") repeat-x scroll 50% 50% #fafaf4;
			border: 1px solid #d4ccb0;
			color: #000000;
			font-weight: bold;
		}
	.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited {
			color: #555555;
			text-decoration: none;
		}
	
</style>

</head>

<body>

	<!--<div id="wrapper">-->
		<div id="headershadow"></div>
		<div id="bg-orange"></div>
		<div class="bg-awan" >
			<div id="homepage-slider">
				<div class="flexslider">
					<ul class="slides">
						<li> <img src="<?php echo IMAGES_DIR;?>/gambarutama1.png" alt="Carousel Item 1" /> </li>
						<li> <img src="<?php echo IMAGES_DIR;?>/gambarutama2.png" alt="Carousel Item 2" />  </li>
					</ul>
				</div>
			</div>
		</div>
	  <!-- Place in the <head>, after the three links -->
		<script type="text/javascript" charset="utf-8">
			$(window).load(function() {
				$('.flexslider').flexslider();
			});
		</script>
	  
		<div id="bodytengah">
			<div id="headerlogin">
				<a href="<?php echo base_url();?>index.php/admin" style="text-decoration:none">
					<span class="login">Login</span>
				</a> |
				<a href="<?php echo base_url();?>index.php/webfront/registrasi" style="text-decoration:none"><span class="login"> Registrasi Agen </span> </a> 
			</div>
			<div id="menu">
				<a href="<?php echo base_url();?>" style="text-decoration:none"><span class="menutext">HOME </span></a><span class="menutext">| </span>
				<a href="<?php echo base_url();?>index.php/webfront/show_post_tour" style="text-decoration:none"><span class="menutext">TOUR</span></a> <span class="menutext">| </span>
				<a href="<?php echo base_url();?>index.php/webfront/show_post_promo" style="text-decoration:none"><span class="menutext">PROMO</span> </a><span class="menutext">| </span>
				<a href="<?php echo base_url();?>index.php/webfront/show_post_hotel" style="text-decoration:none"><span class="menutext">HOTEL</span></a> <span class="menutext">| </span>
				<a href="<?php echo base_url();?>index.php/webfront/faq" style="text-decoration:none"><span class="menutext">FAQ </span></a><span class="menutext">| </span>
				<a href="<?php echo base_url();?>index.php/webfront/contact" style="text-decoration:none"><span class="menutext">CONTACT</span></a>
			</div>
			<div id="logo"><a href="<?php echo base_url();?>"><img src="<?php echo IMAGES_DIR;?>/logo-ht-new.png" /></a></div>