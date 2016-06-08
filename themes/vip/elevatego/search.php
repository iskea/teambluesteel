
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			

			if ( have_posts() ) : ?>

			<div class="search-container">

			<?php

			$count = 0;

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'search' );

			endwhile;

		else :

		endif;
		?>

			</div>
			</div><!-- /morphsearch-content -->
			<span class="morphsearch-close"></span>

		</main><!-- .site-main -->
	</section><!-- .content-area -->
