<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$user_id = $_SESSION['user_id'];

?>
	<div class="container l-padding-t-3 l-padding-b-10">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 l-padding-t-1 l-padding-b-1 text-center">
				<div class="row text-center">
					<h4>Welcome to Your.Macquarie</h4>
					<h2>Your financial priorities</h2>
					<div class="text-center personalised-home">
						<?php if (get_post_meta($user_id, 'elv_personalisations_p1')[0]) { ?>
						<!-- circle 1 -->
						<div class="col-md-4">
							<div class="img-circle selected-choice" title="<?php echo get_the_title(get_post_meta($user_id, 'elv_personalisations_p1')[0]) ?>">
								<?php echo get_post_field("post_content", get_post_meta($user_id, 'elv_personalisations_p1')[0]) ?>
								<span class="img-circle-number">1</span>
							</div>
							<h4><?php echo get_the_title(get_post_meta($user_id, 'elv_personalisations_p1')[0]) ?></h4>
						</div>
						<?php }
						if (get_post_meta($user_id, 'elv_personalisations_p2')[0]) { ?>
							<!-- circle 2 -->
							<div class="col-md-4">
								<div class="img-circle" title="<?php echo get_the_title(get_post_meta($user_id, 'elv_personalisations_p2')[0]) ?>">
									<?php echo get_post_field("post_content", get_post_meta($user_id, 'elv_personalisations_p2')[0]) ?>
									<span class="img-circle-number">2</span>
								</div>
								<h4><?php echo get_the_title(get_post_meta($user_id, 'elv_personalisations_p2')[0]) ?></h4>
							</div>
						<?php }
						if (get_post_meta($user_id, 'elv_personalisations_p3')[0]) { ?>
							<!-- circle 3 -->
							<div class="col-md-4">
								<div class="img-circle" title="<?php echo get_the_title(get_post_meta($user_id, 'elv_personalisations_p3')[0]) ?>">
									<?php echo get_post_field("post_content", get_post_meta($user_id, 'elv_personalisations_p3')[0]) ?>
									<span class="img-circle-number">3</span>
								</div>
								<h4><?php echo get_the_title(get_post_meta($user_id, 'elv_personalisations_p3')[0]) ?></h4>
							</div>
						<?php } if((!get_post_meta($user_id, 'elv_personalisations_p3')[0]) && (!get_post_meta($user_id, 'elv_personalisations_p2')[0]) && (!get_post_meta($user_id, 'elv_personalisations_p1')[0]) ) { ?>
							<p class="lead text-center"><a href="<?php echo get_site_url(); ?>/personalisation-tool">Please select your financial priorities</a></p>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
print "";