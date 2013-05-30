<?php get_header(); ?>
<div class="page-wrap">	<!-- BEGIN div.page wrap -->
			<div class="slider">
				<div id="gallery-1" class="royalSlider rsDefault visibleNearby clear-fix">
					<?php 
					$the_query = new WP_Query(array(
						'post_type' => 'slides',
						'post_per_page' => -1
						));
					while ($the_query->have_posts()):
						$the_query->the_post();
					?>
					<?php $homeImage = get_field('slide_image'); print_r($homeImage); ?>

					<a class="rsImg" href="<?php echo $homeImage[url]; ?>"></a>

					<?php endwhile; ?>
				</div>	
			</div>
				<div class="social">
					<a href="https://www.facebook.com/InglesALaJanda" title="Clases de Ingles Cadiz vejer" class="icon-socialfacebook"></a>
					<a href="https://twitter.com/LaJandaVejer" title="Clases de Ingles Cadiz vejer" class="icon-socialtwitter"></a>
					<a href="mailto:info@lajanda.org" title="Clases de Ingles Cadiz vejer" class="icon-socialmail"></a>
					<a href="#" class="icon-socialphone" title="Clases de Ingles Cadiz vejer"></a>
					<a href="#" class="phone-number" title="Clases de Ingles Cadiz vejer">+34 956447060</a>
					<p>Jose Castrellon 22,Vejer de la Fra. 11150, CADIZ</p>
				</div>
				<?php    
				    $defaults = array(
				    'theme_location'  => 'main-nav',
				    'container'       => 'nav', 
				    'container_class' => 'main-nav', 
				    'echo'            => false,
				    'fallback_cb'     => false,
				    'items_wrap'      => '%3$s',
				    'depth'           => 0
				    );
				    echo strip_tags(wp_nav_menu( $defaults ), '<nav><a>');
				?>
				
				<hr class="style-eight">	
				<section id="s1"> <!-- BEGIN section#s1 -->
				<h2 class="recuperar">clases de recuperacion de ingles para todos los cursos de primaria y secundaria</a></h2>
							<p><?php
							  $home_page_post_id = 64;
							  $home_page_post = get_post( $home_page_post_id, ARRAY_A );
							  $content_home = $home_page_post['post_content'];
							  echo $content_home;
							?></p>
									<a href="#home" class="up"></a>
			</section>
			<section id="s2"> <!-- BEGIN section#s2 -->
				<h2 class="jornadas"><a href="#">jornadas en ingles para niños</a></h2>
					<p><?php
							  $home_page_post_id = 68;
							  $home_page_post = get_post( $home_page_post_id, ARRAY_A );
							  $content_home = $home_page_post['post_content'];
							  echo $content_home;
							?></p>
				<a href="#home" class="up"></a>
			</section>
			<section id="s3"> <!-- BEGIN section#s3 -->
				<h2 class="prep"><a href="#">clases de preparacion para B1</a></h2>
					<p><?php
							  $home_page_post_id = 69;
							  $home_page_post = get_post( $home_page_post_id, ARRAY_A );
							  $content_home = $home_page_post['post_content'];
							  echo $content_home;
							?></p>
				<a href="#home" class="up"></a>
			</section>
			<section id="s4"> <!-- BEGIN section#s4 -->
				<h2 class="adultos"><a href="#">ingles para adultos, todos los niveles</a></h2>
					<p><?php
							  $home_page_post_id = 70;
							  $home_page_post = get_post( $home_page_post_id, ARRAY_A );
							  $content_home = $home_page_post['post_content'];
							  echo $content_home;
							?></p>
				<a href="#home" class="up"></a>
			</section>
			<section id="s5"> <!-- BEGIN section#s5 -->
				<?php $args = array( 'post_type' => 'ofertas', 'posts_per_page' => 1 );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<article>
						<h2 class="adultos"><?php the_title(); ?></h2>
						<time>
						Publicado en: 
						<br />
							<?php the_date(); ?>
						</time>
						<br />
						Oferta vale desde <?php the_field('start_of_oferta'); ?>
						hasta: <?php the_field('end_of_oferta'); ?>
							<?php $offerImage = get_field('image_for_the_offer'); ?>
							<img src="<?php echo $offerImage[url] ?>" />
					<?php the_content(); ?>

					<?php endwhile; ?>

					</article>
				<a href="#home" class="up"></a>
			</section>
			<section id="s6"> <!-- BEGIN section#s4 -->
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article>
					<h2 class="prep">
						<?php the_title(); ?>
					</h2>
					<time>
						Publicado en: 
						<br />
						<?php echo get_the_date(); ?>
					</time>

					<?php the_content(); ?>
				</article>

			<?php endwhile; endif; ?>

					<a href="#home" class="up"></a>
			</section>
		</div>	<!-- END div.page wrap -->

<?php get_footer(); ?>
