<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();
?>
<!--Hero content-->
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
                <h2>Preparing for baby:<br> A comprehensive financial guide </h2>
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
        <img class="hero-image-sim img-responsive" src="img/hero_elevate-home_lg.jpg"/>
    </div>
</div>
</div>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        // Start the loop.
        while (have_posts()) : the_post();

            // Include the single post content template.
            get_template_part('template-parts/content', 'single');

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }

            if (is_singular('attachment')) {
                // Parent post navigation.
                the_post_navigation(array(
                    'prev_text' => _x('<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'twentysixteen'),
                ));
            } elseif (is_singular('post')) {
                // Previous/next post navigation.
                the_post_navigation(array(
                    'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('Next', 'twentysixteen') . '</span> ' .
                        '<span class="screen-reader-text">' . __('Next post:', 'twentysixteen') . '</span> ' .
                        '<span class="post-title">%title</span>',
                    'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous', 'twentysixteen') . '</span> ' .
                        '<span class="screen-reader-text">' . __('Previous post:', 'twentysixteen') . '</span> ' .
                        '<span class="post-title">%title</span>',
                ));
            }

            // End of the loop.
        endwhile;
        ?>
        <!--

         Feature area

        -->
        <div class="container-fluid bg-white l-padding-t-2 l-padding-b-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 author-bio">
                        <img src="/wp-content/uploads/2016/05/chat-brigit.jpg" class="img-circle chat-thumbnail" width="100px" height="100px">
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
                        <h3>Artice body</h3>
                        <p>
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
                            condimentum accumsan nisi interdum. Phasellus quis consequat nunc.
                        </p>
                        <p>Curabitur rhoncus rhoncus nisl ac convallis. Ut vel ante sit amet nunc efficitur feugiat.
                            Nullam
                            malesuada lacus in hendrerit mattis. Donec ac felis velit. Sed blandit nisi sit amet nibh
                            sollicitudin, venenatis pulvinar metus volutpat. Ut aliquam diam vitae est volutpat posuere.
                            Praesent sed eros justo. Aliquam consectetur tellus turpis, id posuere nisl lobortis ac.
                            Duis
                            gravida dapibus magna, fermentum laoreet nisl faucibus nec. Suspendisse potenti. Etiam
                            tempus
                            efficitur euismod. Nullam at risus id nunc placerat iaculis ut non eros. Praesent ut nisi
                            commodo,
                            pulvinar leo a, dictum nibh.</p>
                        <blockquote>Integer tincidunt nec felis in sagittis. Sed posuere finibus arcu, vitae tempus
                            nulla
                            porttitor quis.
                        </blockquote>
                        <p>Etiam molestie eget lacus eget condimentum. Quisque tincidunt nibh non libero viverra, non
                            elementum
                            felis egestas. Sed vel convallis ante, in interdum ex. Sed volutpat, libero non elementum
                            viverra,
                            odio metus consequat felis, interdum efficitur nisl purus vel lorem. Donec libero nulla,
                            euismod ac
                            arcu ut, ultrices feugiat libero. Quisque ullamcorper eleifend orci, id gravida tortor
                            lobortis
                            eget. Mauris eros sapien, venenatis vel euismod sit amet, faucibus non nunc. Curabitur sed
                            diam et
                            odio pulvinar volutpat nec ut ipsum. Morbi ornare in massa quis ultrices. Etiam ut ultrices
                            mauris.
                            Quisque sodales interdum nisl, id placerat ante euismod at.
                            <em>Ut in sapien eget odio pharetra dignissim eu et orci.</em> Cras ligula sem, dapibus sed
                            condimentum varius, porttitor vitae metus. Suspendisse non tellus vel justo convallis
                            blandit. Nunc
                            quis maximus nisi, dignissim vehicula diam.
                        </p>
                        <p>Aenean nec massa imperdiet, porta dolor vitae, consequat arcu.
                            <strong>Morbi et pulvinar libero. Maecenas at fringilla massa.</strong> Cras suscipit
                            pretium
                            viverra. Maecenas vitae pharetra purus. Aliquam pulvinar efficitur risus ut ultrices. Sed
                            fermentum,
                            nunc nec tincidunt mollis, velit tortor ornare nisl, vel semper augue felis quis tortor.
                            Fusce purus
                            turpis, tincidunt vel suscipit volutpat, pellentesque id erat. Duis volutpat lorem in odio
                            faucibus,
                            id lacinia ipsum vehicula. Donec ac justo iaculis, faucibus ipsum in, rhoncus massa.
                        </p>
                        <p>In fringilla, dui at posuere commodo, odio orci porta nulla, non finibus tellus erat eget
                            quam. Proin
                            risus justo, scelerisque vitae velit quis, tristique imperdiet orci. Nam dapibus ultrices
                            efficitur.
                            <strong>Sed ut vestibulum magna, sed facilisis enim.</strong> Nulla felis libero, tristique
                            sit amet
                            lorem in, facilisis lobortis ipsum. Curabitur metus erat, vestibulum auctor cursus non,
                            blandit et
                            neque. Curabitur vel auctor orci, at pharetra risus. Nunc eget nisl vehicula, accumsan
                            tortor ut,
                            dictum est.
                        </p>
                    </div>
                </div>
                <div class="row comments-area">
                    <div class="col-md-10 col-md-offset-2">
                        <h3>Responses</h3>
                        <div class="bg-grey">
                            <img src="/wp-content/uploads/2016/05/chat-brigit.jpg" class="img-circle chat-thumbnail" width="100px"
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

<?php get_sidebar(); ?>
<?php get_footer(); ?>
