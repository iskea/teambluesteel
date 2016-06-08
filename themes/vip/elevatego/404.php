<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<!--			<section class="error-404 not-found">-->
<!--				<header class="page-header">-->
<!--					<h1 class="page-title">--><?php //_e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?><!--</h1>-->
<!--				</header><!-- .page-header -->
<!---->
<!--				<div class="page-content">-->
<!--					<p>--><?php //_e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?><!--</p>-->
<!---->
<!--					--><?php //get_search_form(); ?>
<!--				</div><!-- .page-content -->
<!--			</section><!-- .error-404 -->

			<div class="container-fluid clearfix">
				<div class="container l-padding-t-3 l-padding-b-10">
					<div class="row">
						<div class="col-md-5 hero-area">
							<h1>Oops!</h1>
							<hr class="error-hr" />
							<h3>This page could not be found. Please navigate to <a href="">home</a> or try again later. </h3>
						</div>
						<div class="col-md-7 text-left">
							<span class="picon picon-0762-weather-rain-cloud huge-icon"><!-- fill --></span>
							<span class="error-404-text">404</span>
						</div>
					</div>
				</div>
				<div class="vertical-tab-bg">
					<div class="vertical-tab-bgimg active">
						<img class="hero-image-sim img-responsive" src="<?php echo get_template_directory_uri() ?>/img/hero_elevate-product_lg.jpg" />
					</div>
				</div>
			</div>

			<div class="container-fluid error-section">
				<div class="container l-padding-t-1 l-padding-b-3">
					<div class="row">
						<div class="col-md-4">
							<h5>Lifestages</h5>
							<div class=" error-feature-box">
								<div class="error-feature-box-image"><img src="<?php echo get_template_directory_uri() ?>/img/error-creditcards.jpg" alt="xxx" class="img-responsive" /></div>
								<div class="error-feature-box-title-n-description">
									<div class="error-feature-box-title">Financial advice</div>
									<div class="error-feature-box-description">Lorem ipsum dolor sit amot consectutur dt </div>
								</div>
							</div>
							<div class=" error-feature-box">
								<div class="error-feature-box-image"><img src="<?php echo get_template_directory_uri() ?>/img/error-transaction-account.jpg" alt="xxx" class="img-responsive" /></div>
								<div class="error-feature-box-title-n-description">
									<div class="error-feature-box-title">Starting a career</div>
									<div class="error-feature-box-description">Lorem ipsum dolor sit amot consectutur dt</div>
								</div>
							</div>
							<div class=" error-feature-box">
								<div class="error-feature-box-image"><img src="<?php echo get_template_directory_uri() ?>/img/error-savings-account.jpg" alt="xxx" class="img-responsive" /></div>
								<div class="error-feature-box-title-n-description">
									<div class="error-feature-box-title">Family decisions</div>
									<div class="error-feature-box-description">Lorem ipsum dolor sit amot consectutur dt</div>
								</div>
							</div>
						</div>


						<div class="col-md-4">
							<h5>Products</h5>
							<div class=" error-feature-box">
								<div class="error-feature-box-image"><img src="<?php echo get_template_directory_uri() ?>/img/error-creditcards.jpg" alt="xxx" class="img-responsive" /></div>
								<div class="error-feature-box-title-n-description">
									<div class="error-feature-box-title">Financial advice</div>
									<div class="error-feature-box-description">Lorem ipsum dolor sit amot consectutur dt</div>
								</div>
							</div>
							<div class=" error-feature-box">
								<div class="error-feature-box-image"><img src="<?php echo get_template_directory_uri() ?>/img/error-transaction-account.jpg" alt="xxx" class="img-responsive" /></div>
								<div class="error-feature-box-title-n-description">
									<div class="error-feature-box-title">Starting a career</div>
									<div class="error-feature-box-description">Lorem ipsum dolor sit amot consectutur dt</div>
								</div>
							</div>
							<div class=" error-feature-box">
								<div class="error-feature-box-image"><img src="<?php echo get_template_directory_uri() ?>/img/error-savings-account.jpg" alt="xxx" class="img-responsive" /></div>
								<div class="error-feature-box-title-n-description">
									<div class="error-feature-box-title">Family decisions</div>
									<div class="error-feature-box-description">Lorem ipsum dolor sit amot consectutur dt</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<h5>Tools & Calculators</h5>
							<div class=" error-feature-box">
								<div class="error-feature-box-image"><img src="<?php echo get_template_directory_uri() ?>/img/error-creditcards.jpg" alt="xxx" class="img-responsive" /></div>
								<div class="error-feature-box-title-n-description">
									<div class="error-feature-box-title">Financial advice</div>
									<div class="error-feature-box-description">Lorem ipsum dolor sit amot consectutur dt</div>
								</div>
							</div>
							<div class=" error-feature-box">
								<div class="error-feature-box-image"><img src="<?php echo get_template_directory_uri() ?>/img/error-transaction-account.jpg" alt="xxx" class="img-responsive" /></div>
								<div class="error-feature-box-title-n-description">
									<div class="error-feature-box-title">Starting a career</div>
									<div class="error-feature-box-description">Lorem ipsum dolor sit amot consectutur dt</div>
								</div>
							</div>
							<div class=" error-feature-box">
								<div class="error-feature-box-image"><img src="<?php echo get_template_directory_uri() ?>/img/error-savings-account.jpg" alt="xxx" class="img-responsive" /></div>
								<div class="error-feature-box-title-n-description">
									<div class="error-feature-box-title">Family decisions</div>
									<div class="error-feature-box-description">Lorem ipsum dolor sit amot consectutur dt</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</main><!-- .site-main -->

		<?php get_sidebar( 'content-bottom' ); ?>

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
