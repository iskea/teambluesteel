<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
</div><!-- .site-content -->
<script type='text/javascript' src='https://c.la9cs.salesforceliveagent.com/content/g/js/36.0/deployment.js'></script>
<script type='text/javascript'>
	liveagent.init('https://d.la9cs.salesforceliveagent.com/chat', '572p00000008OR2', '00Dp00000008fJe');
</script>
<footer id="colophon" class="site-footer row" role="contentinfo">
	<div class="container-fluid bg-black">
		<div class="container l-padding-t-2 l-padding-b-2">
			<div class="row">
				<?php if (has_nav_menu('social')) : ?>
					<?php

					//var_dump(wp_get_nav_menus());

					$navs = wp_get_nav_menus();

					foreach ($navs as $v) {

						if ($v->name == 'Footer') {
							$menuitems = wp_get_nav_menu_items($v);

							//var_dump(buildTree($menuitems, 0));

							$complete_menu_array = buildTree($menuitems, 0);
							foreach ($complete_menu_array as $k => $v) {

								?>
								<div class="col-md-3">
									<h5 class="footer-level-one-item">
										<?php
										if ($v->url == "" || $v->url == "#") { ?>
											<?php echo($v->post_title);
										} else {
											?>
											<a href="<?php echo($v->url); ?>" class="footer-level-one-item-link"><?php echo($v->post_title); ?></a>
											<?php
										} ?>
									</h5>
									<ul>
										<?php

										if (!empty($v->wpse_children)) {

											foreach ($v->wpse_children as $wpse_child) {

												?>
												<li class="footer-level-one-item">
													<a href="<?php echo $wpse_child->url; ?>" class="footer-level-two-item-link"><?php echo($wpse_child->post_title); ?></a>
													<ul>
														<?php

														if (!empty($wpse_child->wpse_children)) {

															foreach ($wpse_child->wpse_children as $wpse_child_child) {

																?>
																<li class="footer-level-three-item">
																	<a href="<?php echo $wpse_child_child->url; ?>" class="footer-level-three-item-link"><?php echo($wpse_child_child->post_title); ?></a>
																</li>
																<?php

															}
														}

														?>
													</ul>
												</li>
												<?php
											}
										}
										?>
									</ul>
								</div>
								<?php
							}
						}
					}
					?>
				<?php endif; ?>
			</div>
			<div class="row bg-black navbar-fixed-bottom sticky-cta">
				<div class="col-xs-6 col-sm-6 col-md-6 apply-now ">
					<div class="input-group">
						<span class="h1 text-primary hidden-xs">Recommended:</span>
						<select class="form-control input-sm">
							<option>Basic home loan</option>
							<option>Line of credit home loan</option>
							<option>Offset home loan</option>
						</select>
							<span class="input-group-btn">
								<button class="btn btn-primary" type="button">Apply now</button>
							</span>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 live-chat hidden-xs">
					<div class="chat-">
						<span class="h5">Need help?</span><a id="liveagent_button_online_573p00000008OW2-new" href="javascript://Chat" style="display: block;" onclick="liveagent.startChat('573p00000008OW2')" class="btn btn-default-inv">
							<span class="glyphicon glyphicon-headphones"><!-- fill --></span> Live chat
						</a><a id="liveagent_button_offline_573p00000008OW2-new" href="javascript://Chat" style="display: block;" onclick="liveagent.startChat('573p00000008OW2')" class="btn btn-default-inv">
							<span class="glyphicon glyphicon-headphones"><!-- fill --></span> Request a call </a>
						<img src="wp-content/uploads/2016/05/chat-brigit.jpg" class="img-circle chat-thumbnail" width="100px" height="100px">
					</div>
				</div>
			</div><!-- /.container -->
			<script type="text/javascript">
				if (!window._laq) {
					window._laq = [];
				}
				window._laq.push(function () {
					liveagent.showWhenOnline('573p00000008OW2', document.getElementById('liveagent_button_online_573p00000008OW2-new'));
					liveagent.showWhenOffline('573p00000008OW2', document.getElementById('liveagent_button_offline_573p00000008OW2-new'));
				});</script>
		</div>
	</div>
</footer><!-- .site-footer -->
<!--

Footer

-->
<!-- Bootstrap core JavaScript
================================================== -->
</div><!-- .site-inner -->
</div><!-- .site -->
<?php wp_footer(); ?>

</body>
</html>
