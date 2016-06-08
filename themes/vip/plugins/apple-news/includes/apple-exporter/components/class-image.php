<?php
namespace Apple_Exporter\Components;

use \Apple_Exporter\Exporter as Exporter;

/**
 * Represents a simple image.
 *
 * @since 0.2.0
 */
class Image extends Component {

	/**
	 * Look for node matches for this component.
	 *
	 * @param DomNode $node
	 * @return mixed
	 * @static
	 * @access public
	 */
	public static function node_matches( $node ) {
		// Is this an image node?
		if (
		 	( 'img' == $node->nodeName || 'figure' == $node->nodeName )
			&& self::remote_file_exists( $node )
		) {
			return $node;
		}

		return null;
	}

	/**
	 * Build the component.
	 *
	 * @param string $text
	 * @access protected
	 */
	protected function build( $text ) {
		preg_match( '/src="([^"]*?)"/im', $text, $matches );
		$url      = esc_url_raw( apply_filters( 'apple_news_build_image_src', $matches[1], $text ) );
		$filename = preg_replace( '/\\?.*/', '', \Apple_News::get_filename( $url ) );

		$this->json = array(
			'role' => 'photo',
			'URL'  => $this->maybe_bundle_source( $url, $filename ),
		);

		// IMAGE ALIGNMENT is defined as follows:
		// 1. If there is a left or right alignment specified, respect it.
		// 2. If there is a center alignment specified:
		//	2.a If the image is big enough, use a full-width image
		//	2.b Otherwise auto-align
		// 3. Otherwise, if there is no alignment specified or set to "none", auto-align.
		if ( preg_match( '#align="left"#', $text ) || preg_match( '#class=".*?(?:alignleft).*?"#', $text ) ) {
			$this->set_anchor_position( Component::ANCHOR_LEFT );
		} else if ( preg_match( '#align="right"#', $text ) || preg_match( '#class=".*?(?:alignright).*?"#', $text ) ) {
			$this->set_anchor_position( Component::ANCHOR_RIGHT );
		} else if ( preg_match( '#align="center"#', $text ) || preg_match( '#class=".*?(?:aligncenter).*?"#', $text ) ) {
			list( $width, $height ) = getimagesize( $url );
			if ( $width < $this->get_setting( 'layout_width' ) ) {
				$this->set_anchor_position( Component::ANCHOR_AUTO );
			} else {
				$this->set_anchor_position( Component::ANCHOR_NONE );
			}
		} else {
			$this->set_anchor_position( Component::ANCHOR_AUTO );
		}

		// Full width images have top margin
		if ( Component::ANCHOR_NONE == $this->get_anchor_position() ) {
			$this->register_non_anchor_layout();
		} else {
			$this->register_anchor_layout();
		}

		// Check for caption
		if ( preg_match( '#<figcaption.*?>(.*?)</figcaption>#m', $text, $matches ) ) {
			$caption = trim( $matches[1] );
			$this->json['caption'] = $caption;
			$this->group_component( $caption );
		}
	}

	/**
	 * Register the anchor layout.
	 *
	 * @access private
	 */
	private function register_anchor_layout() {
		$this->json['layout'] = 'anchored-image';
		$this->register_layout( 'anchored-image', array(
			'margin' => array( 'top' => 25, 'bottom' => 25 ),
		) );
	}

	/**
	 * Register the non-anchor layout.
	 *
	 * @access private
	 */
	private function register_non_anchor_layout() {
		$this->json['layout'] = 'full-width-image';
		$this->register_full_width_layout( 'full-width-image', array(
			'margin' => array( 'top' => 25, 'bottom' => 25 ),
		) );
	}

	/**
	 * Find the caption alignment to use.
	 *
	 * @return string
	 * @access private
	 */
	private function find_caption_alignment() {
		$text_alignment = null;
		if ( Component::ANCHOR_NONE == $this->get_anchor_position() ) {
			return 'center';
		}

		switch ( $this->get_anchor_position() ) {
			case Component::ANCHOR_LEFT:
				return 'left';
			case Component::ANCHOR_AUTO:
				if ( 'left' == $this->get_setting( 'body_orientation' ) ) {
					return 'right';
				}
		}

		return 'left';
	}

	/**
	 * If the image has a caption, we have to also show a caption component.
	 * Let's instead, return the JSON as a Container instead of an Image.
	 *
	 * @param string $caption
	 * @access private
	 */
	private function group_component( $caption ) {
		$image_component = $this->json;
		$this->json = array(
			'role' => 'container',
			'components' => array(
				$image_component,
				array(
					'role'      => 'caption',
					'text'      => $caption,
					'textStyle' => array(
						'textAlignment' => $this->find_caption_alignment(),
						'fontSize'      => intval( $this->get_setting( 'body_size' ) - 2 ),
						'fontName'      => $this->get_setting( 'body_font' ),
					),
					'layout' => array(
						'margin' => array( 'top' => 20 ),
					),
				),
			),
		);
	}

}
