<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = !empty($css) ? vc_shortcode_custom_css_class( $css ) : '';



        $all_article_ids = get_post_meta($_SESSION['user_id'], 'elv_personalisations_bookmarks', true);
        $all_article_ids_array = explode(',',$all_article_ids);
        $article_html = '';
        foreach ($all_article_ids_array as $all_article_id){

                $tags_html ='';
               if (!empty($all_tags)) {
                $tagcount=0;
                foreach ($all_tags as $tag) {
                        $tags_html .=  '<span class="badge"><a href="'.get_home_url().'/expertise-author?author_post_id='.$tag->term_id.'" class="text-black">'.$tag->name.'</a></span>';
                        $tagcount++;
                                if($tagcount >= 1){
                                         break;
                                        }
                                }
                 }

                $article_html .= '<div class="container"> <div class="row"><div class="col-sm-12 col-md-12"><div class="col-sm-12 col-md-12 secondary-article" style="background-image: url('.wp_get_attachment_url( get_post_thumbnail_id($all_article_id) ).'">
                <div class="col-md-9 col-md-offset-4 bg-white caption">
                        <h3>'.get_the_title($all_article_id).'</h3>
                        <h5>
                                <small class="article-date"><strong>'.get_post($all_article_id)->post_date.'</strong> |</small>
                                <small class="article-views"> <em><a href="'.get_home_url().'/expertise-author?author_post_id='.get_post_meta($all_article_id,"elv_posts_authors")[0].'"
                                 class="">'.get_the_title(get_post_meta($all_article_id,"elv_posts_authors")[0]).'</a></em></small>
                        </h5>
                        <div>
                                '.$tags_html.'
                        </div>
                        <div class="social-action">
                                <h4 class="pull-left">
                                        <span class="picon picon-0663-like-thumb-up-vote inline-icon thumbs-up"><!-- fill --></span>
                                        <span class="thumbs-up-numvote">'.get_post_meta($all_article_id,"elv_posts_likes")[0].'</span>
                                </h4>
                                <h4 class="pull-left">
                                        <span class="picon picon-0664-dislike-thumb-down-vote inline-icon thumbs-down"><!-- fill --></span>
                                        <span class="thumbs-down-numvote">'.get_post_meta($all_article_id,"elv_posts_dislikes")[0].'</span>
                                </h4>
                        </div>
                </div>
        </div></div></div></div><br/>';





        }


//print balanceTags($r);




print balanceTags($article_html);