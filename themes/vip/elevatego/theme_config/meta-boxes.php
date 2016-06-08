<?php 

return array(
	'metaboxes'	=>	array(
		array(
			'id'             => 'page_metabox',            // meta box id, unique per meta box
			'title'          => _x('Page Settings','meta boxes','duality'),   // meta box title
			'post_type'      => array('page'),		// post types, accept custom post types as well, default is array('post'); optional
			'taxonomy'       => array(),    // taxonomy name, accept categories, post_tag and custom taxonomies
			'context'		 => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
			'priority'		 => 'low',						// order of meta box: high (default), low; optional
			'input_fields'   => array(          			// list of meta fields 
				'subtitle'=>array(
					'name'=> _x('Page Subtitle','meta boxes','duality'),
					'type'=>'text',
				),
				'description'=>array(
					'name'=> _x('Page Description','meta boxes','duality'),
					'type'=>'textarea',
				),

				'page_background'=>array(
		    		'name'=>'Page Background',
		    		'type'=>'image',
		    		'desc'=>'If you want a different background to be used for this page, then you can upload it here.'
		    	),
			)
		),

		array(
			'id'             => 'post_metabox',            // meta box id, unique per meta box
			'title'          => _x('Post Settings','meta boxes','duality'),   // meta box title
			'post_type'      => array('post'),		// post types, accept custom post types as well, default is array('post'); optional
			'taxonomy'       => array(),    // taxonomy name, accept categories, post_tag and custom taxonomies
			'context'		 => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
			'priority'		 => 'low',						// order of meta box: high (default), low; optional
			'input_fields'   => array(
				'post_thumbnail'=>array(
		    		'name'=>'Post Thumbnail',
		    		'type'=>'image',
		    		'desc'=>'Upload here post thumbnail.'
		    		),
				)
			),
		)
	);