<!DOCTYPE html>

<html <?php language_attributes(); ?> id="home">
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  	<script src="<?php bloginfo('template_url'); ?>/js/jquery.lettering.js"></script>
	<meta charset="<?php bloginfo('charset'); ?>" />
<link href='http://fonts.googleapis.com/css?family=Prociono' rel='stylesheet' type='text/css'>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/global.css">
	<script>
  	$(document).ready(function() {
			$("#brand a").lettering('words').children("span").lettering();

		});
  	$(document).ready(function() {
  			$("nav a").lettering('words');
  			$("section h2").lettering('words');

		});
  </script>
  <script language="javascript">
	jQuery(document).ready(function ($){
		$("a[href*=#]").click(function() {
			var id = $(this).attr('href');
			 $('html, body').animate({
				 scrollTop: $(id).offset().top
			 }, 2000);
			 $('.current').removeClass('current');
			 $(this).addClass('current');
		 });
	});
	</script>
	</script>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
		<header>
			<div id="brand">
				<a href="http://lajanda.org/" class="float-logo" title="Learn Spanish at the Costa de La Luz"></a>
				<div class="offers">
					<a href="#s5">
						<?php $args = array( 'post_type' => 'ofertas', 'posts_per_page' => 3 );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
						the_title();
						endwhile; ?>
					</a>
				</div>
				<h1> <!-- BEGIN h1.brand -->
				<a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
				</h1> <!-- END h1.brand -->
			</div>
		</header>