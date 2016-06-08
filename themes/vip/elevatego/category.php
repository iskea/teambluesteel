<?php



$a_articles = array();
$a_featured_articles = array();
$a_tags = array();
$a_likes = array();
$args = array('numberposts' => '-1');
$recent_posts = get_posts($args);
foreach ($recent_posts as $recent) {
	$recent = (array)$recent;
	$a_articles[$recent['ID']] = $recent;
	$a_articles[$recent['ID']]['meta'] = get_post_meta($recent['ID']);
	$a_articles[$recent['ID']]['img'] = wp_get_attachment_url(get_post_thumbnail_id($recent['ID']));

	if (isset($a_articles[$recent['ID']]['meta']['elv_posts_featured'])) {

		if ($a_articles[$recent['ID']]['meta']['elv_posts_featured'][0] == 2) {
			$a_featured_articles[$recent['ID']] = $recent['ID'];

		}

	}

	$a_tag = array();
	$a_tag = get_the_tags($recent['ID']);

//    var_dump( $a_tag  );
//    if( !empty($a_tag) ) {
//        foreach (get_the_tags($recent['ID']) as $v) {
//            $a_tags[$v][] = $recent['ID'];
////        }
//    }

	//var_dump( $a_articles[ $recent['ID'] ]['meta']['elv_posts_likes'][0] ); exit();

	$a_likes[$recent['ID']]['likes'] = (isset($a_articles[$recent['ID']]['meta']['elv_posts_likes'][0]) ? $a_articles[$recent['ID']]['meta']['elv_posts_likes'][0] : 0);
	$a_likes[$recent['ID']]['dislikes'] = (isset($a_articles[$recent['ID']]['meta']['elv_posts_dislikes'][0]) ? $a_articles[$recent['ID']]['meta']['elv_posts_dislikes'][0] : 0);
	//$a_likes[ $recent['ID'] ]['bookmarks'] = $a_articles[ $recent['ID'] ]['meta']['elv_personalisations_bookmarks'];

}


get_header(); ?>
<div id="primary">
	<main id="main" class="site-main" role="main">
		<div class="container l-padding-t-3 l-padding-b-3">
			<div class="row">
				<div class="col-md-5 l-padding-b-2 l-padding-t-1">
					<div class="hero-area text-black">
						<div class="p">Your.Macquarie /</div>
						<h1>Expertise</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="vertical-tab-bg">
			<div class="vertical-tab-bgimg active">
				<img class="hero-image-sim img-responsive" src="<?php echo wp_get_attachment_url(the_post_thumbnail()); ?>"/>
			</div>
		</div>
		<div class="row">
			<!--

			 New and noteworthy

			-->
			<div class="container-fluid bg-white l-padding-b-2">
				<div class="container">
					<div class="col-md-12 l-padding-b-2 pull-up-1-5em">
						<div class="col-md-2 feature-expertise-label">New & noteworthy</div>
					</div>
					<?php
					$args = array('numberposts' => '6');
					$recent_posts = wp_get_recent_posts($args);
					foreach ($recent_posts as $recent) {
						?>
						<?php
						echo '<div class="col-md-2"><a href="' . get_permalink($recent['ID']) . '" class="text-black"><img src="' . wp_get_attachment_url(get_post_thumbnail_id($recent['ID'])) . '" class="img-responsive" /></a>';
						echo '<p><a href="' . get_permalink($recent['ID']) . '" class="text-black">' . $recent["post_title"] . '</a></p></div>';
					} ?>
				</div>
			</div>
			<!--

			 Featured article

			-->
			<div class="container-fluid bg-grey l-padding-t-2 l-padding-b-2">
				<div class="container trending-article">
					<h2>Featured</h2>
					<?php
					$count=0;

					foreach ($a_featured_articles as $a_featured_article) {

						$all_tags = wp_get_post_tags($a_articles[$a_featured_article]['ID'], array('orderby' => 'count', 'order' => 'DESC'));

						?>
						<?php if ($count==0) { ?>
							<div class="col-sm-12 col-md-6 primary-article dark-gradient-btm" style="background-image: url(<?php echo $a_articles[$a_featured_article]['img'] ?>)">
								<div class="col-md-11 caption">
									<h3><?php echo $a_articles[$a_featured_article]['post_title'] ?></h3>
									<h5>
										<small class="article-date"><strong><?php echo $a_articles[$a_featured_article]['post_date'] ?></strong> |</small>
										<small class="article-views"> <em><a href="<?php echo get_home_url()?>/expertise-author?author_post_id=<?php echo get_the_id($a_articles[$a_featured_article]['meta']['elv_posts_authors'][0]); ?>" class=""><?php echo get_the_title($a_articles[$a_featured_article]['meta']['elv_posts_authors'][0]); ?></a></em></small>
									</h5>
									<div>
									<?php if (!empty($all_tags)) {
										$tagcount=0;
										foreach ($all_tags as $tag) {
											?>
											<span class="badge"><a href="<?php echo get_home_url()?>/expertise-tags?title_tag=<?php echo $tag->term_id ?>" class="text-black"><?php echo $tag->name; ?></a></span>
										<?php if($tagcount++ >= 2) { break;}}
									} ?>
									</div>
									<div class="social-action">
										<h4 class="pull-left">
											<span class="picon picon-0663-like-thumb-up-vote inline-icon thumbs-up"><!-- fill --></span>
											<span class="thumbs-up-numvote"><?php echo($a_articles[$a_featured_article]['meta']['elv_posts_likes'][0]); ?></span>
										</h4>
										<h4 class="pull-left">
											<span class="picon picon-0664-dislike-thumb-down-vote inline-icon thumbs-down"><!-- fill --></span>
											<span class="thumbs-down-numvote"><?php echo($a_articles[$a_featured_article]['meta']['elv_posts_dislikes'][0]); ?></span>
										</h4>
									</div>
								</div>
							</div><div class="col-sm-12 col-md-6">
						<?php } else { ?>
							<div class="col-sm-12 col-md-12 secondary-article" style="background-image: url(<?php echo $a_articles[$a_featured_article]['img'] ?>)">
								<div class="col-md-9 col-md-offset-4 bg-white caption">
									<h3><?php echo $a_articles[$a_featured_article]['post_title'] ?></h3>
									<h5>
										<small class="article-date"><strong><?php echo $a_articles[$a_featured_article]['post_date'] ?></strong> |</small>
										<small class="article-views"> <em><a href="<?php echo get_home_url()?>/expertise-author?author_post_id=<?php echo get_the_id($a_articles[$a_featured_article]['meta']['elv_posts_authors'][0]); ?>" class=""><?php echo get_the_title($a_articles[$a_featured_article]['meta']['elv_posts_authors'][0]); ?></a></em></small>
									</h5>
									<div>
									<?php if (!empty($all_tags)) {
										$tagcount=0;
										foreach ($all_tags as $tag) {
											?>
											<span class="badge"><a href="<?php echo get_home_url()?>/expertise-tags?title_tag=<?php echo $tag->term_id ?>" class="text-black"><?php echo $tag->name; ?></a></span>
											<?php if($tagcount++ >= 2) { break;}}
									} ?>
									</div>
									<div class="social-action">
										<h4 class="pull-left">
											<span class="picon picon-0663-like-thumb-up-vote inline-icon thumbs-up"><!-- fill --></span>
											<span class="thumbs-up-numvote"><?php echo($a_articles[$a_featured_article]['meta']['elv_posts_likes'][0]); ?></span>
										</h4>
										<h4 class="pull-left">
											<span class="picon picon-0664-dislike-thumb-down-vote inline-icon thumbs-down"><!-- fill --></span>
											<span class="thumbs-down-numvote"><?php echo($a_articles[$a_featured_article]['meta']['elv_posts_dislikes'][0]); ?></span>
										</h4>
									</div>
								</div>
							</div>
						<?php }
						if($count++ >= 3) { break; };
						?>
					<?php } ?>
					</div>
				</div>
			</div>
			<!--

			 Saved expertise

			-->
			<div class="container-fluid bg-white l-padding-b-2">
				<div class="container">
					<h2>Bookmarked articles</h2>
					<div class="row">
						<?php

						$bookmarkedcount=0;
						$post_ids = explode(",",get_post_meta($_SESSION['user_id'], 'elv_personalisations_bookmarks')[0]);
						if (!empty($post_ids)) {
							foreach ($post_ids as $post_id) {
								?>
								<?php
								echo '<div class="col-md-2"><a href="' . get_permalink($post_id) . '" class="text-black"><img src="' . wp_get_attachment_url(get_post_thumbnail_id($post_id)) . '" class="img-responsive" /></a>';
								echo '<p><a href="' . get_permalink($post_id) . '" class="text-black">' . get_the_title($post_id) . '</a></p></div>';
								if ($bookmarkedcount++ >= 5) {
									break;
								}
							}
						} else {
							echo '<h4 class="text-center"><span class="picon picon-0035-bookmark-tag inline-icon"><!-- fill --></span> Bookmark your favourite articles, then find them here to read later.</h4>';
						}?>
					</div>
				</div>
			</div>
			<!--

			Popular tags

			-->
			<div class="container-fluid bg-white l-padding-b-2">
				<div class="container popular-tags">
					<h2>Popular tags:</h2>
					<span class="tags">
						<?php
						$all_tags = get_tags(array('number' => '10', 'orderby' => 'count', 'order' => 'DESC'));

						if (!empty($all_tags)) {
						$tagcount=0;
						foreach ($all_tags as $tag) {
							?>
							<span class="badge"><a href="<?php echo get_home_url()?>/expertise-tags?title_tag=<?php echo $tag->term_id ?>" class="text-black"><?php echo $tag->name; ?></a></span>
						<?php }
						} ?>
					</span>
				</div>
			</div>
			<!--

			Lifestage column tiles

			-->
			<div class="container-fluid bg-grey l-padding-t-2 l-padding-b-2">
				<div class="container tile-columns static-columns">
					<h4>Your.Macquarie</h4>
					<h2>Lifestages</h2>
					<div class="row column-content">
						<div class=" col-md-3 l-padding-b-1">
							<div class="bg-blue feature-tile fixed-height-420 dark-gradient-btm" style="background: url(<?php echo the_post_thumbnail_url(); ?>) 50%;">
								<div class="tile-body text-center">
									<img src="">
									<h3 class="text-white">
										<a href="<?php echo get_home_url()?>/yourmacquarie/lifestages/starting-your-career" class="text-white">Starting your career</a>
									</h3>
								</div>
							</div>
						</div>
						<div class=" col-md-3 l-padding-b-1">
							<div class="bg-blue feature-tile fixed-height-420 dark-gradient-btm" style="background: url(<?php echo the_post_thumbnail_url(); ?>) 50%;">
								<div class="tile-body text-center">
									<img src="">
									<h3 class="text-white">
										<a href="<?php echo get_home_url()?>/yourmacquarie/lifestages/starting-your-career" class="text-white">Getting financially savvy</a>
									</h3>
								</div>
							</div>
						</div>
						<div class=" col-md-3 l-padding-b-1">
							<div class="bg-blue feature-tile fixed-height-420 dark-gradient-btm" style="background: url(<?php echo the_post_thumbnail_url(); ?>) 50%;">
								<div class="tile-body text-center">
									<img src="">
									<h3 class="text-white">
										<a href="<?php echo get_home_url()?>/yourmacquarie/lifestages/starting-your-career" class="text-white">Building<br />wealth</a>
									</h3>
								</div>
							</div>
						</div>
						<div class=" col-md-3 l-padding-b-1">
							<div class="bg-blue feature-tile fixed-height-420 dark-gradient-btm" style="background: url(<?php echo the_post_thumbnail_url(); ?>) 50%;">
								<div class="tile-body text-center">
									<img src="">
									<h3 class="text-white">
										<a href="<?php echo get_home_url()?>/yourmacquarie/lifestages/starting-your-career" class="text-white">Preparing for retirement</a>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid bg-white l-padding-t-2 l-padding-b-2">

	<?php
		$filter1 = "Bank";
		$filter2 = "Borrow";
		$filter3 = "Rewards";
		$filter4 = "Expertise";
		$s_inline_style = '';
		$s_tiles  = '';
		$s_tiles  .= '
		<div class="container tile-columns">
			<div class="row l-padding-t-2">
				<div class="col-md-8 col-md-push-2 l-padding-t-1 center-block">
					<ul class="nav nav-pills nav-justified">
						<li role="presentation" class="active"><a class="tile-filter" data-filter="*">All</a></li>
						<li role="presentation"><a class="tile-filter" data-filter=".cat-'. strtolower($filter1) .'">'. ucwords (strtolower($filter1)) .'</a></li>
						<li role="presentation"><a class="tile-filter" data-filter=".cat-'. strtolower($filter2) .'">'. ucwords (strtolower($filter2)) .'</a></li>
						<li role="presentation"><a class="tile-filter" data-filter=".cat-'. strtolower($filter3) .'">'. ucwords (strtolower($filter3)) .'</a></li>
						<li role="presentation"><a class="tile-filter" data-filter=".cat-'. strtolower($filter4) .'">'. ucwords (strtolower($filter4)) .'</a></li>
					</ul>
				</div>
			</div>
			<div class="row l-padding-t-2 l-padding-b-2 column-content">' . PHP_EOL;


			$args_expertise = array( 'numberposts' => -1);

			$o_query_expertise = get_posts( $args_expertise );

			//var_dump($o_query_expertise);
			if ($o_query_expertise) {
				foreach ($o_query_expertise as $expertise) {

					$s_featured_img_url = wp_get_attachment_url( get_post_thumbnail_id($expertise->ID) );

					if ($s_featured_img_url != '') {
					$s_inline_style = ' style="background: linear-gradient( rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25) ), url(' . $s_featured_img_url . ');"';
					}
					//var_dump($expertise);

					$all_article_tags_name  = array();
					$all_article_tags = wp_get_post_tags( $expertise->ID );


					if(empty($all_article_tags)){

					} else {

					foreach ($all_article_tags as $all_article_tag) {
					$all_article_tags_name[] = $all_article_tag->name;
					}


					if(in_array($filter1,$all_article_tags_name)){
					$s_tiles .= '
					<div class="grid-item animate col-md-4 l-padding-b-1 cat-'.$filter1.'">
						<div class="bg-blue feature-tile "'.$s_inline_style.'>
							<div class="tile-head"><span class="h4">Expertise</span></div>
							<div class="tile-body">
								<img src="">
								<h2 class="text-white">
									'. nl2br($expertise->post_title) .'
								</h2>
								<div class="tile-link">
									<a class="" href="'.get_permalink($expertise->ID).'">Learn more</a>
								</div>
							</div>
						</div>
					</div>
	
	
					' . PHP_EOL;

					} else if (in_array($filter2,$all_article_tags_name)){

					$s_tiles .= '
					<div class="grid-item animate col-md-4 l-padding-b-1 cat-'.$filter2.'">
						<div class="bg-blue feature-tile "'.$s_inline_style.'>
							<div class="tile-head"><span class="h4">Expertise</span></div>
							<div class="tile-body">
								<img src="">
								<h2 class="text-white">
									'. nl2br($expertise->post_title) .'
								</h2>
								<div class="tile-link">
									<a class="" href="'.get_permalink($expertise->ID).'">Learn more</a>
								</div>
							</div>
						</div>
					</div>
		
		
					' . PHP_EOL;

					} else if (in_array($filter3,$all_article_tags_name)){

					$s_tiles .= '
					<div class="grid-item animate col-md-4 l-padding-b-1 cat-'.$filter3.'">
						<div class="bg-blue feature-tile "'.$s_inline_style.'>
							<div class="tile-head"><span class="h4">Expertise</span></div>
							<div class="tile-body">
								<img src="">
								<h2 class="text-white">
									'. nl2br($expertise->post_title) .'
								</h2>
								<div class="tile-link">
									<a class="" href="'.get_permalink($expertise->ID).'">Learn more</a>
								</div>
							</div>
						</div>
					</div>
			
			
					' . PHP_EOL;

					} else {
					$s_tiles .= '
					<div class="grid-item animate col-md-4 l-padding-b-1 cat-'.$filter4.'">
						<div class="bg-blue feature-tile "'.$s_inline_style.'>
							<div class="tile-head"><span class="h4">Expertise</span></div>
							<div class="tile-body">
								<img src="">
								<h2 class="text-white">
									'. nl2br($expertise->post_title) .'
								</h2>
								<div class="tile-link">
									<a class="" href="'.get_permalink($expertise->ID).'">Learn more</a>
								</div>
							</div>
						</div>
					</div>
					' . PHP_EOL;
					}
				}
			}
		}

		wp_reset_postdata();

		$s_tiles .= '	</div>' . PHP_EOL . '</div>';
			echo $s_tiles;
?>

		</div>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php get_footer(); ?>

