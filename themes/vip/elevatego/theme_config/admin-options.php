<?php

// 'size'=>'half_last',
// 'id'=>'logo_text',
// 'type'=>'text',
// 'note' => "Type the logo text here, then select a color, set a size and font",
// 'color_changer'=>true,
// 'font_changer'=>true,
// 'font_size_changer'=>array(1,10, 'em'),
// 'font_preview'=>array(true, true)

function make_input($size = null, $id = null, $type = null, $note = null, $values = null, $placeholder = null, $class= null) {
        $input_settings = array();
        $f = new ReflectionFunction('make_input');

        foreach ($f->getParameters() as $key => $value) {
               if(!empty($value->name))
                        $input_settings[$value->name] = ${$value->name};
        }

        return $input_settings;
}


return array(
        'favico' => array(
                'dir' => '/theme_config/icons/favicon.png'
        ),
        'tabs' => array(
                array(
                    'title' => 'General Options',
                    'icon' => 1,
                    'boxes' => array(
                            'Settings' => array(
                                    'icon' => 'customization',
                                    'size' => 'full',
                                    'columns' => true,
                                    'description' => '',
                                    'class' => '',
                                    'input_fields' => array(
                                            'Favicon' => make_input('half', 'favicon_link', 'image_upload', 'Here you can upload the favicon icon.' ),
                                            'Background Image' => make_input('half', 'background_image', 'image_upload', 'Here you can upload your background image.' ),
                                            'Background Color' => make_input('half', 'body_color', 'colorpicker', 'Here you can set a color for body background' ),
                                            'Canvas Color' => make_input('half', 'canvas_color', 'colorpicker', 'Here you can set a color for site canvas' ),
                                            'Background Repeat' => make_input('half', 'body_background_repeat', 'radio', '', array('Repeat', 'No-repeat', 'Repeat-X', 'Repeat-Y') ),
                                            'Background Position' => make_input('half', 'body_background_position', 'radio', '', array('Scroll', 'Fixed') ),
                                    ),      
                            ),

                            'Social Settings'=>array(
                                    'icon'=>'social',
                                    'description'=>'',
                                    'size'=>'full',
                                    'columns' => true,
                                    'class' => '',
                                    'input_fields'=>array(
                                            'ShareThis feature' => array(
                                                    'type'  => 'select',
                                                    'id'    => 'share_this',
                                                    'label' => 'Facebook',
                                                    'class' => 'social_search',
                                                    'size' => 'half',
                                                    'note' => 'To use this service please select your favorite social networks' ,
                                                    'multiple' => true,
                                                    'options'=>array('Google'=>'googleplus','Facebook'=>'facebook','Twitter'=>'twitter','Pinterest'=>'pinterest',"Linkedin"=>'linkedin')
                                            ),

                                            'Social Platforms' => array(
                                                    'id'=>'social_platforms',
                                                    'size'=>'half_last',
                                                    'type'=>'social_platforms',
                                                    'note'=>'Insert the link to the social share page.',
                                                    'platforms'=>array('facebook','twitter','linkedin','rss','dribbble','google','pinterest','instagram','youtube')
                                            )
                                    )
                            ),
                    )
                ),
                array(
                    'title' => 'Typography',
                    'icon' => 3,
                    'boxes' => array(
                        'Global Typography' => array(
                            'icon' => 'customization',
                            'size' => 'half',
                            'columns' => true,
                            'description' => '',
                            'class' => '',
                            'input_fields' => array(
                                'Global Typography'=>array(
                                        'size'=>'half',
                                        'id'=>'global_typo',
                                        'type'=>'text',
                                        'note' => "Here you can change global font color, font family and font size",
                                        'color_changer'=>true,
                                        'font_changer'=>true,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                            ),      
                        ),
                        'Links style' => array(
                            'icon' => 'customization',
                            'size' => 'half',
                            'columns' => true,
                            'description' => '',
                            'class' => '',
                            'input_fields' => array(
                                'Links options'=>array(
                                        'size'=>'half',
                                        'id'=>'links_settings',
                                        'type'=>'text',
                                        'note' => "Here you can change link's font color, font family and font size",
                                        'color_changer'=>true,
                                        'font_changer'=>true,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                            ),      
                        ),
                        'Headings style' => array(
                            'icon' => 'customization',
                            'size' => 'full',
                            'columns' => true,
                            'description' => '',
                            'class' => '',
                            'input_fields' => array(
                                'Headings options'=>array(
                                        'size'=>'full',
                                        'id'=>'headings_settings',
                                        'type'=>'text',
                                        'note' => "Here you can change color and font family for headings. Also bellow you can adjust heading font size.",
                                        'color_changer'=>true,
                                        'font_changer'=>true,
                                        'font_size_changer'=> false,
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 1'=>array(
                                        'size'=>'1_3',
                                        'id'=>'headings_one_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 2'=>array(
                                        'size'=>'1_3',
                                        'id'=>'headings_two_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 3'=>array(
                                        'size'=>'1_3_last',
                                        'id'=>'headings_three_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 4'=>array(
                                        'size'=>'1_3',
                                        'id'=>'headings_four_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 5'=>array(
                                        'size'=>'1_3',
                                        'id'=>'headings_five_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 6'=>array(
                                        'size'=>'1_3_last',
                                        'id'=>'headings_six_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                            ),      
                        ),
                    )
                ),
                array(
                    'title' => 'Customize defaults',
                    'icon' => 1,
                    'boxes' => array(
                            
                            'Main background colors' => array(
                                    'icon' => 'customization',
                                    'size' => 'full',
                                    'columns' => true,
                                    'description' => 'Overwrite default colors.',
                                    'class' => '',
                                    'input_fields' => array(
                                            'Primary' => make_input('1_3', 'primary_color', 'colorpicker', 'Choose primary color for your website. This will affect only specific elements.
To return to default color , open colorpicker and click the Clear button.' )
                                    ),      
                            ),
                    ),
                ),
                array(
                    'title' => 'Header',
                    'icon' => 8,
                    'boxes' => array(
                        'Header Settings' => array(
                            'icon' => 'customization',
                            'size' => 'full',
                            'columns' => true,
                            'description' => '',
                            'class' => '',
                            'input_fields' => array(
                                'Header Background' => make_input('half', 'header_bg', 'colorpicker', 'Here you can change background color for navigation bar.' ),
                                'Header Text' => make_input('half', 'header_text', 'colorpicker', 'Here you can change text color for navigation bar.' ),
                                'Contact Email' => make_input('1_3', 'contact_email', 'text', '' ),
                            ),      
                        ),
                        'Identity Settings' => array(
                            'icon' => 'customization',
                            'size' => 'full',
                            'columns' => true,
                            'description' => '',
                            'class' => 'identity-helper',
                            'input_fields' => array(
                                    'Logo' => make_input('half', 'logo_image', 'image_upload', 'Here you can insert your link to a image logo or upload a new logo image.' ),
                                    'Logo As Text'=>array(
                                                    'size'=>'half',
                                                    'id'=>'logo_text',
                                                    'type'=>'text',
                                                    'note' => "Type the logo text here, then select a color, set a size and font.",
                                                    'color_changer'=>true,
                                                    'font_changer'=>true,
                                                    'font_size_changer'=>array(1,300, 'px'),
                                                    'font_preview'=>array(true, true)
                                            )
                            ),      
                        )
                    )
                ),
                
                array(
                        'title' => '404 error',
                        'icon' => 8,
                        'boxes' => array(
                                '404 content page error' => array(
                                        'icon'=>'',
                                        'size'=>'full',
                                        'columns'=>true,
                                        'description'=>'Here you can drop your "404 error" page content',
                                            'input_fields' => array(
                                                'Page background' => make_input('half', 'error_background', 'image_upload', '' ),
                                                'Page title' => make_input('half_last', 'error_title', 'text', '' ),
                                                'Page subtitle' => make_input('half', 'error_subtitle', 'text', '' ),
                                                'Page Description' => make_input('half_last', 'error_description', 'textarea', '' ),
                                                'Page logo' => make_input('half', 'error_logo', 'image_upload', '' ),

                                            )
                                ),
                            )
                ),
                array(
                        'title' => 'Developer',
                        'icon' => 6,
                        'boxes' => array(
                                'Custom CSS' => array(
                                        'icon'=>'css',
                                        'size'=>'half',
                                        'description'=>'Here you can write your personal CSS for customizing the classes you choose to modify.',
                                            'input_fields' => array(
                                                    make_input('half', 'custom_css', 'textarea', '' )
                                            )
                                ),
                                'Custom js' => array(
                                        'icon'=>'css',
                                        'size'=>'half',
                                        'description'=>'Here you can write your personal JS for customizing the classes you choose to modify.',
                                            'input_fields' => array(
                                                    make_input('half', 'custom_js', 'textarea', '' )
                                            )
                                ),

                                'Twitter Settings'=>array(
                                        'icon' => 'customization',
                                        'description'=>"Used by the Twitter widget. Visit <a href='https://dev.twitter.com/apps/new' target='_blank'>Twitter Apps</a> , create your App , press 'Generate Access token at the bottom', insert the following from the 'Oauth' tab.",
                                        'size'=>'half',
                                        'columns'=>false,
                                        'input_fields' =>array(
                                                'Consumer Key' => array(
                                                        'id'    => 'twitter_consumerkey',
                                                        'type'  => 'text',
                                                        'size' => '1'
                                                ),
                                                'Consumer Secret' => array(
                                                        'id'    => 'twitter_consumersecret',
                                                        'type'  => 'text',
                                                        'size' => '1',
                                                ),
                                                'Access Token' => array(
                                                        'id'    => 'twitter_accesstoken',
                                                        'type'  => 'text',
                                                        'size' => '1',
                                                ),
                                                'Access Token Secret' => array(
                                                        'id'    => 'twitter_accesstokensecret',
                                                        'type'  => 'text',
                                                        'size' => '1',
                                                )
                                        )
                                ),
                            ),
                ),
        ),
        'option_saved_text' => 'Options successfully saved',
        'styles' => array( array('wp-color-picker'),'style','select2' ),
        'scripts' => array( array( 'jquery', 'jquery-ui-core','jquery-ui-datepicker','wp-color-picker' ), 'select2.min','jquery.cookie','tt_options', 'admin_js' )
);