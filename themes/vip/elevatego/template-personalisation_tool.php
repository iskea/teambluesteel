<?php

/*
 *
 * Template Name: Personalisation Tool
 *
 * @package Wordpress
 *
*/

get_header();

$id = get_post();
$post = get_post($id);
$content = apply_filters('the_content', $post->post_content);

?>
<?php
$question_1_array = array();
$question_2_array = array();

$query = new WP_Query(array('post_type' => 'elv_pq', 'post_status' => 'publish', 'posts_per_page' => -1));

if ($query->have_posts()) {
	while ($query->have_posts()) : $query->the_post();

		if (wp_get_post_tags(get_the_ID())[0]->name == 'Q1') {

			$id_and_name = array();
			$id_and_name['id'] = get_the_ID();
			$id_and_name['icon'] = get_the_content();
			$id_and_name['name'] = get_the_title();
			$question_1_array[] = $id_and_name;

		} else {
			$id_and_name = array();
			$id_and_name['id'] = get_the_ID();
			$id_and_name['icon'] = get_the_content();
			$id_and_name['name'] = get_the_title();
			$question_2_array[] = $id_and_name;

		}
	endwhile;
	wp_reset_postdata();
} else {
	wp_die('No Questions');
}

?>
<div id="primary">
	<main id="main" class="site-main" role="main">
		<div class="vertical-tab-bg">
			<div class="vertical-tab-bgimg active">
				<img class="hero-image-sim img-responsive" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($id)); ?>" />
			</div>
		</div>
		<!-- multistep form -->
		<form class="personalisation-tool" id="msform" method="POST" action="<?php echo get_site_url(); ?>/personalisation-generator/">
			<div class="container-fluid clearfix">
				<div class="container personalisation-questions">
					<!--

					Question 1 of 3

					-->
					<div class="row text-center fieldset-class" id="q_btn_1">
						<h4 class="text-white">Question 1 of 3</h4>
						<h2 class="text-white">What best describes you?</h2>
						<div class="col-md-2 hidden-sm"><!-- fill --></div>
						<div class="col-sm-12 col-md-8 l-padding-b-10"><?php
							foreach ($question_1_array as $question) {
								?>
								<label class="pt-radio" for="q1_<?php echo $question['id'] ?>">
									<input type="radio" class="radio-button" name="q1" id="q1_<?php echo $question['id'] ?>" value="q1_<?php echo $question['id'] ?>">
									<div class="img-circle">
										<?php echo $question['icon'] ?>
									</div>
									<br /><?php echo $question['name'] ?>
								</label>
								<?php
							}
							?>
							<!--							<span class="next pt-buttons"><label class="pt_button" for="pt_btn_next"><input type="button" name="next" value="Next"/>Next question-->
							<!--									<span class="picon picon-0160-arrow-next-right"></span></label></span>-->
						</div>
						<div class="col-md-2 hidden-sm"><!-- fill --></div>
					</div>
					<!--

					Question 2 of 3

					-->
					<div class="row text-center fieldset-class" id="q_btn_2">
						<h4 class="text-white">Question 2 of 3</h4>
						<h2 class="text-white">What are your top 3 priorities?</h2>
						<div class="col-md-2 hidden-sm"><!-- fill --></div>
						<div class="col-md-8">
							<?php
							foreach ($question_2_array as $question) {
								?>
								<label class="pt-checkbox" for="q2_<?php echo $question['id'] ?>">
									<input type="checkbox" class="radio-button" name="q2" id="q2_<?php echo $question['id'] ?>" value="q2_<?php echo $question['id'] ?>">
									<div class="img-circle">
										<?php echo $question['icon'] ?>
									</div>
									<br /><?php echo $question['name'] ?>
								</label>
								<?php
							}
							?>
							<!--							<span class="previous pt-buttons"><label class="pt_button" for="pt_btn_previous"><input type="button" name="previous" value="Previous"/><span class="picon picon-0159-arrow-back-left"></span> Previous question</label></span>-->
							<!--							<span class="next-2 pt-buttons"><label class="pt_button" for="pt_btn_next"><input type="button" name="next" value="Next"/>Next question-->
							<!--									<span class="picon picon-0160-arrow-next-right"></span></label></span>-->
						</div>
						<div class="col-md-2 hidden-sm"><!-- fill --></div>
					</div>
					<!--

					Question 3 of 3

					-->
					<div class="row text-center fieldset-class pt-dnd" id="q_btn_3">
						<h4 class="text-white">Question 3 of 3</h4>
						<h2 class="text-white">Click and drag the order of priority</h2>
						<div class="col-md-2 hidden-sm"><!-- fill --></div>
						<div class="col-md-8 center-block pt-dnd-container">
							<div class="pt-dnd-priority-box no-border">
								<div class="col-md-12 pt-dnd-priority source" draggable="true">
									<label class="pt-dnd-label" id="selection-1"></label>
								</div>
							</div>
							<div class="pt-dnd-priority-box no-border">
								<div class="col-md-12 pt-dnd-priority source" draggable="true">
									<label class="pt-dnd-label" id="selection-2"></label>
								</div>
							</div>
							<div class="pt-dnd-priority-box no-border">
								<div class="col-md-12 pt-dnd-priority source" draggable="true">
									<label class="pt-dnd-label" id="selection-3"></label>
								</div>
							</div>
							<div class="pt-dnd-priority-box">
								<div class="priority-number">1</div>
								<div class="col-md-12 pt-dnd-priority target" draggable="true" id="priority-1">
									<div class="priority-filler"><!-- fill --></div>
								</div>
							</div>
							<div class="pt-dnd-priority-box">
								<div class="priority-number">2</div>
								<div class="col-md-12 pt-dnd-priority target" draggable="true" id="priority-2">
									<div class="priority-filler"><!-- fill --></div>
								</div>
							</div>
							<div class="pt-dnd-priority-box">
								<div class="priority-number">3</div>
								<div class="col-md-12 pt-dnd-priority target" draggable="true" id="priority-3">
									<div class="priority-filler"><!-- fill --></div>
								</div>
							</div>
						</div>
						<div class="col-md-2 hidden-sm"><!-- fill --></div>
						<!--						<input type="submit" name="submit" class="submit action-button" value="Submit"/>-->
					</div>
				</div>
			</div>
			<!-- BUTTONS -->
			<div class="container-fluid bg-black">
				<div class="container text-center l-padding-t-2 l-padding-b-2">
					<div id="btn_1" class="fieldset-buttons">
						<div class="col-md-3 text-left">
							<!-- fill -->
						</div>
						<div class="col-md-6 text-center">
							<span class="next pt-buttons"><label class="pt_button" for="pt_btn_skip">
									<button href="<?php echo get_site_url(); ?>" id="pt_btn_skip" class="skip action-button">
										<span class="picon picon-0040-exit-logout-door-emergency-outside"><!-- fill --></span><br />Skip
									</button>
								</label></span>
						</div>
						<div class="col-md-3 text-right">
							<span class="next pt-buttons"><label class="pt_button" for="pt_btn_next">
									<button type="button" name="next">Next question
										<span class="picon picon-0160-arrow-next-right"><!-- fill --></span></button>
								</label></span>
						</div>
					</div>
					<div id="btn_2" class="fieldset-buttons">
						<div class="col-md-3 text-left">
							<span class="previous pt-buttons"><label class="pt_button" for="pt_btn_previous">
									<button type="button" name="previous">
										<span class="picon picon-0159-arrow-back-left"><!-- fill --></span> Previous question
									</button>
								</label></span>
						</div>
						<div class="col-md-6 text-center">
							<span class="next-2 pt-buttons"><label class="pt_button" for="pt_btn_skip"><a href="<?php echo get_site_url(); ?>" id="pt_btn_skip" class="skip action-button"><span class="picon picon-0040-exit-logout-door-emergency-outside"><!-- fill --></span><br />Skip</a></label></span>
						</div>
						<div class="col-md-3 text-right">
							<span class="next-2 pt-buttons"><label class="pt_button" for="pt_btn_next">
									<button type="button" name="next">Next question
										<span class="picon picon-0160-arrow-next-right"><!-- fill --></span></button>
								</label></span>
						</div>
					</div>
					<div id="btn_3" class="fieldset-buttons">
						<div class="col-md-3 text-left">
							<span class="previous pt-buttons"><label class="pt_button" for="pt_btn_previous">
									<button type="button" name="previous">
										<span class="picon picon-0159-arrow-back-left"><!-- fill --></span> Previous question
									</button>
								</label></span>
						</div>
						<div class="col-md-6 text-center">
							<span class="next-2 pt-buttons"><label class="pt_button" for="pt_btn_skip"><a href="<?php echo get_site_url(); ?>" id="pt_btn_skip" class="skip action-button"><span class="picon picon-0040-exit-logout-door-emergency-outside"><!-- fill --></span><br />Skip</a></label></span>
						</div>
						<div class="col-md-3 text-right">
							<span class="next pt-buttons">
								<label class="pt_button" for="pt_btn_submit">
									<button type="submit" name="submit" id="pt_btn_submit" class="submit action-button">Submit
										<span class="picon picon-0160-arrow-next-right"><!-- fill --></span></button>
								</label>
							</span>
						</div>
					</div>
				</div>
			</div>
		</form>
</div>
<!-- jQuery -->
<script src="<?php echo get_template_directory_uri() ?>/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.easing.min.js" type="text/javascript"></script>
</main><!-- .site-main -->
</div><!-- .content-area -->
<script>
	$(document).ready(function () {
		//jQuery time
		var current_fs, next_fs, previous_fs; //fieldsets
		var left, opacity, scale; //fieldset properties which we will animate
		var animating; //flag to prevent quick multi-click glitches

		$(".fieldset-class").hide();
		$(".fieldset-class#q_btn_1").show();
		$(".fieldset-buttons").hide();
		$(".fieldset-buttons#btn_1").show();

		$(".next").click(function () {
			if (animating) return false;
			animating = true;

			current_fs = $(this).parent().parent().attr("id");
			next_fs = $(this).parent().parent().next().attr("id");

			//alert("current_fs: " + current_fs + "\nnext_fs: " + next_fs);
			//activate next step on progressbar using the index of next_fs
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			//show the next fieldset
			$("#" + next_fs).show();
			$("#q_" + next_fs).show();
			//hide the current fieldset with style
			$("#" + current_fs).hide();
			$("#q_" + current_fs).animate({opacity: 0}, {
				step: function (now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale current_fs down to 80%
					scale = 1 - (1 - now) * 0.2;
					//2. bring next_fs from the right(50%)
					left = (now * 50) + "%";
					//3. increase opacity of next_fs to 1 as it moves in
					opacity = 1 - now;
					$("#q_" + current_fs).css({'transform': 'scale(' + scale + ')'});
					$("#q_" + next_fs).css({'left': left, 'opacity': opacity});
				}, duration: 800, complete: function () {
					$("#q_" + current_fs).hide();
					animating = false;
				}, //this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
		});

		$(".previous").click(function () {

			if (animating) return false;
			animating = true;

			current_fs = $(this).parent().parent().attr("id");
			previous_fs = $(this).parent().parent().prev().attr("id");
			//			alert("current_fs: " + current_fs + "\nprevious_fs: " + previous_fs);
			//de-activate current step on progressbar
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

			//show the previous fieldset
			$("#" + previous_fs).show();
			$("#q_" + previous_fs).show();
			//hide the current fieldset with style
			$("#" + current_fs).hide();
			$("#q_" + current_fs).animate({opacity: 0}, {
				step: function (now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale previous_fs from 80% to 100%
					scale = 0.8 + (1 - now) * 0.2;
					//2. take current_fs to the right(50%) - from 0%
					left = ((1 - now) * 50) + "%";
					//3. increase opacity of previous_fs to 1 as it moves in
					opacity = 1 - now;
					$("#q_" + current_fs).css({'left': left});
					$("#q_" + previous_fs).css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
				}, duration: 800, complete: function () {
					$("#q_" + current_fs).hide();
					$(".selected-in-step-2").remove();
					animating = false;
				}, //this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
		});

		/* Transition to step 3 */
		$(".next-2").click(function () {
			var selection_number = 1;
			$(".pt-checkbox input[type=checkbox]:checked").each(function () {
				//prepending to step 3
				$("#selection-" + selection_number).prepend("<div class='selected-in-step-2'>" + $(this).parent().html() + "</div>");
				selection_number++;
				//alert($(this).parent().html())
			});

			if (animating) return false;
			animating = true;

			current_fs = $(this).parent().parent().attr("id");
			next_fs = $(this).parent().parent().next().attr("id");

			//			alert("current_fs: " + current_fs + "\nnext_fs: " + next_fs);
			//activate next step on progressbar using the index of next_fs
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			//show the next fieldset
			$("#" + next_fs).show();
			$("#q_" + next_fs).show();
			$("#" + current_fs).hide();
			//hide the current fieldset with style
			$("#q_" + current_fs).animate({opacity: 0}, {
				step: function (now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale current_fs down to 80%
					scale = 1 - (1 - now) * 0.2;
					//2. bring next_fs from the right(50%)
					left = (now * 50) + "%";
					//3. increase opacity of next_fs to 1 as it moves in
					opacity = 1 - now;
					$("#q_" + current_fs).css({'transform': 'scale(' + scale + ')'});
					$("#q_" + next_fs).css({'left': left, 'opacity': opacity});
				}, duration: 800, complete: function () {
					$("#q_" + current_fs).hide();
					animating = false;
				}, //this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
		});
	});
</script>
<?php get_footer(); ?>

