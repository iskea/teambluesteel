<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */


?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="container l-padding-t-10 l-padding-b-10">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">You.Macquarie</a></li>
				<li><a href="#">Lifestages </a></li>
				<li><a href="#">Family decisions</a></li>
				<li class="active">Expertise</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-md-6 vertical-tab-container vertical-tab-inverse">
				<!-- credit cards section -->
				<div class="vertical-tab-content active">
					<h2><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>h2>
					<br/>
					<div class="social-action">
						<h4 class="pull-left">
                                <span
									class="picon picon-0653-like-heart-favorite-rating-love inline-icon"><!-- fill --></span>
							90
						</h4>
						<h4 class="pull-left">
                        <span
							class="picon picon picon-0274-chat-message-comment-bubble inline-icon"><!-- fill --></span>
							3
						</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Hero image -->
	<div class="vertical-tab-bg">
		<div class="vertical-tab-bgimg active">
			<img class="hero-image-sim img-responsive" src="<?php twentysixteen_post_thumbnail(); ?>"/>
		</div>
	</div>
	</div>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<!--

             Feature area

            -->

<!--			--><?php
//
//			$query = new WP_Query(array('post_type' => 'elv_authors'));
//
//
//			var_dump( $query );
//
//			while ($query->have_posts()) : $query->the_post();
//
//				if (get_post_meta(get_the_ID(), 'elv_feature_tag', true) == '1') {
//
//					$col_1_heading = get_the_title(get_the_ID());
//					$col_1_description = get_the_content(null, false);
//					$col_1_link = get_post_meta(get_the_ID(), 'elv_tiles_link', true);
//					$col_1_button = get_post_meta(get_the_ID(), 'elv_feature_cta', true);
//
//				} else if (get_post_meta(get_the_ID(), 'elv_feature_tag', true) == '2') {
//
//					$col_2_heading = get_the_title(get_the_ID());
//					$col_2_description = get_the_content(null, false);
//					$col_2_link = get_post_meta(get_the_ID(), 'elv_tiles_link', true);
//					$col_2_button = get_post_meta(get_the_ID(), 'elv_feature_cta', true);
//
//				} else if (get_post_meta(get_the_ID(), 'elv_feature_tag', true) == '3') {
//
//					$col_3_heading = get_the_title(get_the_ID());
//					$col_3_description = get_the_content(null, false);
//					$col_3_link = get_post_meta(get_the_ID(), 'elv_tiles_link', true);
//					$col_3_button = get_post_meta(get_the_ID(), 'elv_feature_cta', true);
//
//				} else {
//
//					$col_4_heading = get_the_title(get_the_ID());
//					$col_4_description = get_the_content(null, false);
//					$col_4_link = get_post_meta(get_the_ID(), 'elv_tiles_link', true);
//					$col_4_button = get_post_meta(get_the_ID(), 'elv_feature_cta', true);
//
//				}
//
//			endwhile;
//
//
//			?>
			<div class="container-fluid bg-white l-padding-t-2 l-padding-b-2">
				<div class="container">
					<div class="row">
						<div class="col-md-2 author-bio">
							<img src="img/chat-brigit.jpg" class="img-circle chat-thumbnail" width="100px" height="100px">
							<p>I write about ways to help achieving your savings and budgeting goals.
							<p><strong>4</strong> Articles <strong>244</strong> Followers</p>
							<a class="btn btn-success">Follow me</a>
							<div class="tag-cloud">
								<p>Filters</p>
								<span class="badge">Savings</span>
								<span class="badge">Family</span>
								<span class="badge">Blog</span>
								<span class="badge">Budgeting</span>
								<span class="badge">Finance</span>
							</div>


							</p>
							<h3>Author bio</h3>
						</div>
						<div class="col-md-10">
							<h3>Article body</h3>
							<?php the_content(); ?>

						</div>
					</div>
					<div class="row comments-area">
						<div class="col-md-10 col-md-offset-2">
							<h3>Responses</h3>
							<div class="bg-grey">
								<img src="img/chat-brigit.jpg" class="img-circle chat-thumbnail" width="100px"
									 height="100px">
								<h4>Kimberly Harrington
									<small>17 April 2016</small>
								</h4>
								<strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Duis ac tempus
								ante.
								Integer tincidunt nec felis in sagittis. Sed posuere finibus arcu, vitae tempus nulla
								porttitor
								quis. Nulla suscipit ante quis urna lacinia laoreet. Vivamus finibus pretium consequat.
								Etiam quis
								dui in tellus mollis ullamcorper. Donec dui lorem, cursus eget felis eu, fermentum tempus
								elit.
								Mauris gravida dignissim tempus. Donec vulputate dictum sagittis. Donec non velit nisi. In
								hac
								habitasse platea dictumst. Duis lacus dui, vehicula nec pellentesque quis, molestie in quam.
								Ut
								consequat ligula ut neque sodales, cursus porta est gravida. Donec hendrerit lorem ac purus
								aliquam,
								condimentum accumsan nisi interdum. Phasellus quis consequat nunc.                </p>
							</div>
							<div class="bg-grey">
								<h4><a href="">Read more comments</a></h4></div>
						</div>
					</div>
					<div class="row comments-area">
						<div class="col-md-10 col-md-offset-2">
							<h3>Join the conversation</h3>
							<div class="bg-grey">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">Email address</label>
										<input type="email" class="form-control" id="exampleInputEmail1"
											   placeholder="Your name">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Password</label>
										<input type="text" class="form-control" id="exampleInputPassword1"
											   placeholder="Your email">
									</div>
									<div class="form-group">
										<textarea class="form-control" rows="3"></textarea>
									</div>
									<button type="submit" class="btn btn-primary btn-block">Submit</button>
								</form>
							</div>
						</div>
					</div>
				</div>
		</main><!-- .site-main -->

		<?php get_sidebar('content-bottom'); ?>

	</div><!-- .content-area -->


</article><!-- #post-## -->
