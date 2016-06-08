<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

var_dump($_POST);

if(isset($_POST) && !empty($_POST)){

    foreach ($_POST as $requests){

        $requests_small_array = explode("_",$requests);
        if($requests_small_array[0] == 'q1'){
            $question_1_array[] = $requests_small_array[1];
        }
        else if($requests_small_array[0] == 'q2'){
            $question_2_array[] = $requests_small_array[1];

        } else if($requests_small_array[0] == '1' ){
            $priorty_1 = explode("_",array_search('1', $_REQUEST))[1];
        } else if($requests_small_array[0] == '2' ){
            $priorty_2 = explode("_",array_search('2', $_REQUEST))[1];
        } else if($requests_small_array[0] == '3' ){
            $priorty_3 = explode("_",array_search('3', $_REQUEST))[1];
        }


    }

    $persona_from_personalisation = explode("-",get_the_category($priorty_1)[0]->slug)[1];

    $new_persona = $persona_from_personalisation;

    if(isset($_SESSION['user_id'])){

        $user_id = $_SESSION['user_id'];
        $question_1_array_string = implode("p",$question_1_array);
        $question_2_array_string = implode("p",$question_2_array);
        var_dump($new_persona);
        var_dump($question_1_array_string);
        var_dump($question_2_array_string);
        var_dump($priorty_1);
        var_dump($priorty_2);
        var_dump($priorty_3);
        var_dump($user_id);
        update_post_meta($user_id,'elv_personalisations_persona',$new_persona);
        update_post_meta($user_id,'elv_personalisations_q1',$question_1_array_string);
        update_post_meta($user_id,'elv_personalisations_q2',$question_2_array_string);
        update_post_meta($user_id,'elv_personalisations_p1',$priorty_1);
        update_post_meta($user_id,'elv_personalisations_p2',$priorty_2);
        update_post_meta($user_id,'elv_personalisations_p3',$priorty_3);

        $_SESSION['persona'] = $persona_from_personalisation;
        $_SESSION['persona_updated'] = $persona_from_personalisation;

    }

}

wp_redirect(get_site_url().'/personalised-home-page/');
$output = '<div class="container-fluid product-feature"></div>';
print balanceTags($output);
