<!--Cindy Nordiansyah-->
<?php
	$id = $this->session->userdata('account_id');
?>
<style>
	/* unvisited link */
a:link {
    color: black;
}

/* visited link */
a:visited {
    color: black;
}

/* mouse over link */
a:hover {
    color: #FF00FF;
}

/* selected link */
a:active {
    color: #0000FF;
}
</style>
<section role="main" id="main"><!--tpl:web/dasboard-->
<!-- Main content -->

	<noscript class="message black-gradient simpler">
	Your browser does not support JavaScript! Some features won't work as expected...
	</noscript>
	<hgroup id="main-title" class="thin">
		<h1 style="color:white">Info Landing Page</h1>
	</hgroup>
	

    <!-- Content -->
	<div class="with-padding">
		<div class="twelve-columns twelve-columns-tablet twelve-columns-mobile">
			<h3 class="thin underline">Info landing page</h3>
			<a href="<?php echo $this->session->userdata('user_name');?>.travelku.co"><?php echo $this->session->userdata('user_name');?>.travelku.co</a>
		</div>
      
    </div>
</section>