<?php
/*
Widget Name: Instagram widget
Description: This widget is used to display a list of photos from Instagram network
Settings:
 Title - Widget's text title
 Hashtag - Choose the hashtag
 Number of photos - Limit the photos
 Caption - Choose whether to show the caption of the photo
 Date - Choose whether to show the date of the photo
*/

/**
 * @package Thelegalway
 */

if ( ! class_exists( 'Thelegalway_Instagram_Widget' ) ) {

	/**
	 * Class Thelegalway_Instagram_Widget.
	 */
	class Thelegalway_Instagram_Widget extends Cherry_Abstract_Widget {

		/**
		 * Instagram API server.
		 *
		 * @since 1.0.1
		 * @var string
		 */
		private $service_url = 'https://www.instagram.com/';

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 * @since 1.0.1 Removed `client_id` option.
		 */
		public function __construct() {
			$this->widget_cssclass    = 'widget-instagram';
			$this->widget_description = esc_html__( 'Display a list of photos from Instagram network.', 'thelegalway' );
			$this->widget_id          = 'thelegalway_widget_instagram';
			$this->widget_name        = esc_html__( 'Instagram', 'thelegalway' );
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'value' => esc_html__( 'Instagram', 'thelegalway' ),
					'label' => esc_html__( 'Title', 'thelegalway' ),
				),
				'tag' => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__( 'Hashtag (enter without `#` symbol)', 'thelegalway' ),
				),
				'image_counter' => array(
					'type'       => 'stepper',
					'value'      => '6',
					'max_value'  => '12',
					'min_value'  => '1',
					'step_value' => '1',
					'label'      => esc_html__( 'Number of photos', 'thelegalway' ),
				),
				'display_caption' => array(
					'type'  => 'checkbox',
					'value' => array(
						'display_caption_check' => 'false',
					),
					'options' => array(
						'display_caption_check' => esc_html__( 'Caption', 'thelegalway' ),
					),
				),
				'display_date' => array(
					'type'  => 'checkbox',
					'value' => array(
						'display_date_check' => 'false',
					),
					'options' => array(
						'display_date_check' => esc_html__( 'Date', 'thelegalway' ),
					),
				),
			);

			add_action( 'cherry_widget_after_update', array( $this, 'delete_cache' ) );
			parent::__construct();
		}

		/**
		 * Widget function.
		 *
		 * @see WP_Widget
		 * @since 1.0.0
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			if ( empty( $instance['tag'] ) ) {
				return print $args['before_widget'] . esc_html__( 'Please, enter #hashtag.', 'thelegalway' ) . $args['after_widget'];
			}

			$template = locate_template( 'inc/widgets/instagram/views/instagram.php', false, false );

			if ( empty( $template ) ) {
				return;
			}

			ob_start();

			$this->setup_widget_data( $args, $instance );

			$config        = array();
			$tag           = esc_attr( $instance['tag'] );
			$image_counter = absint( $instance['image_counter'] );
			$date_format   = get_option( 'date_format' );

			$date_enabled    = ( ! empty( $instance['display_date'] ) )    ? $instance['display_date'] : false;
			$caption_enabled = ( ! empty( $instance['display_caption'] ) ) ? $instance['display_caption'] : false;

			// Date.
			if ( is_array( $date_enabled ) && 'true' === $date_enabled['display_date_check'] ) {
				$date_enabled = true;
			} else {
				$date_enabled = false;
			}

			if ( $date_enabled ) {
				$config[] = 'date';
			}

			// Caption.
			if ( is_array( $caption_enabled ) && 'true' === $caption_enabled['display_caption_check'] ) {
				$caption_enabled = true;
			} else {
				$caption_enabled = false;
			}

			if ( $caption_enabled ) {
				$config[] = 'caption';
			}

			$photos = $this->get_photos( $tag, $image_counter, $config );

			if ( ! $photos ) {
				return print $args['before_widget'] . esc_html__( 'No photos. Maybe you entered a invalid hashtag.', 'thelegalway' ) . $args['after_widget'];
			}

			$this->widget_start( $args, $instance );

			printf( '<div class="%s">',
				join( ' ', apply_filters( 'thelegalway_instagram_widget_wrapper_class', array( 'instagram__items' ) ) )
			);

			foreach ( (array) $photos as $photo ) {
				$image   = $this->get_image( $photo );
				$caption = $this->get_caption( $photo );
				$date    = $this->get_date( $photo, $date_format );

				include $template;
			}

			echo '</div>';

			$this->widget_end( $args );
			$this->reset_widget_data();

			echo $this->cache_widget( $args, ob_get_clean() );
		}

		/**
		 * Retrieve a photos.
		 *
		 * @since  1.0.0
		 * @since  1.0.1  Removed `$clint_id` param. Changed Instagram URL to retrieve.
		 * @param  string $data        Hashtag.
		 * @param  int    $img_counter Number of images.
		 * @param  array  $config      Set of configuration.
		 * @return array
		 */
		public function get_photos( $data, $img_counter, $config ) {
			$transient_key = $this->get_transient_key(
				array( 'image_counter' => $img_counter, 'tag' => $data )
			);

			$cached = get_transient( $transient_key );

			if ( false !== $cached ) {
				return $cached;
			}

			$url = add_query_arg(
				array( '__a' => 1 ),
				sprintf( $this->get_tags_url(), $data )
			);
			$response = wp_remote_get( $url );

			if ( is_wp_error( $response ) || empty( $response ) || '200' != $response ['response']['code'] ) {
				return false;
			}

			$result = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( ! is_array( $result ) ) {
				return false;
			}

			if ( empty( $result['tag'] ) ) {
				return false;
			}

			/**
			 * Filter a order param for search photos by tag - `top_posts` or `media` (most recent).
			 *
			 * @since 1.0.1
			 * @var string
			 */
			$order = apply_filters( 'thelegalway_instagram_widget_order', 'media' );

			if ( empty( $result['tag'][ $order ]['nodes'] ) ) {
				return false;
			}

			$nodes   = $result['tag'][ $order ]['nodes'];
			$counter = 1;
			$photos  = array();

			foreach ( $nodes as $photo ) {

				if ( $counter > $img_counter ) {
					break;
				}

				$_photo          = array();
				$_photo['link']  = $photo['code'];
				$_photo['image'] = $photo['thumbnail_src'];

				if ( in_array( 'date', $config ) ) {
					$_photo['date'] = sanitize_text_field( $photo['date'] );
				}

				if ( in_array( 'caption', $config ) ) {
					$_photo['caption'] = wp_html_excerpt(
						$photo['caption'],
						apply_filters( 'thelegalway_instagram_widget_caption_length', 10 ),
						apply_filters( 'thelegalway_instagram_widget_caption_more', '&hellip;' )
					);
				}

				array_push( $photos, $_photo );
				$counter++;
			}

			set_transient( $transient_key, $photos, HOUR_IN_SECONDS );

			return $photos;
		}

		/**
		 * Get transient key to cache photos by key.
		 *
		 * @since  1.0.0
		 * @return string
		 */
		public function get_transient_key( $instance = null ) {

			if ( ! isset( $instance['image_counter'] ) || ! isset( $instance['tag'] ) ) {
				return '';
			}

			return md5( $instance['tag'] . $instance['image_counter'] );
		}

		/**
		 * Retrieve a HTML tag with date.
		 *
		 * @since  1.0.0
		 * @param  array  $photo  Item photo data.
		 * @param  string $format Date format.
		 * @return string
		 */
		public function get_date( $photo, $format ) {

			if ( empty( $photo['date'] ) ) {
				return;
			}

			return sprintf( '<time class="instagram__date" datetime="%s">%s</time>', date( 'Y-m-d\TH:i:sP', $photo['date'] ), date( $format, $photo['date'] ) );
		}

		/**
		 * Retrieve a caption.
		 *
		 * @since  1.0.0
		 * @param  array  $photo Item photo data.
		 * @return string
		 */
		public function get_caption( $photo ) {
			return ! empty( $photo['caption'] ) ? $photo['caption'] : '';
		}

		/**
		 * Retrieve a HTML link with image.
		 *
		 * @since  1.0.0
		 * @since  1.0.1  Changed link `href` attribute.
		 * @param  array  $photo Item photo data.
		 * @return string
		 */
		public function get_image( $photo ) {
			$link = sprintf( $this->get_post_url(), $photo['link'] );

			// Replace auto-generated photo size.
			$width  = apply_filters( 'thelegalway_instagram_image_size', 150, 'width' );
			$height = apply_filters( 'thelegalway_instagram_image_size', 150, 'height' );
			$image  = str_replace( '640x640', "{$width}x{$height}", $photo['image'] );

			return sprintf( '<a class="instagram__link" href="%s" target="_blank" rel="nofollow"><img class="instagram__img" src="%s" alt="" width="%s" height="%s"><span class="instagram__cover"></span></a>', esc_url( $link ), esc_url( $image ), $width, $height );
		}

		/**
		 * Retrieve a URL for tags.
		 *
		 * @since  1.0.1
		 * @return string
		 */
		public function get_tags_url() {
			return apply_filters( 'thelegalway_instagram_widget_get_tags_url', $this->service_url . 'explore/tags/%s/' );
		}

		/**
		 * Retrieve a URL for post.
		 *
		 * @since  1.0.1
		 * @return string
		 */
		public function get_post_url() {
			return apply_filters( 'thelegalway_instagram_widget_get_post_url', $this->service_url . 'p/%s/' );
		}

		/**
		 * Clear cache.
		 *
		 * @since 1.0.0
		 */
		public function delete_cache( $instance ) {
			delete_transient( $this->get_transient_key( $instance ) );
		}
	}

	add_action( 'widgets_init', 'thelegalway_register_instagram_widget' );
	/**
	 * Register instagram widget.
	 */
	function thelegalway_register_instagram_widget() {
		register_widget( 'Thelegalway_Instagram_Widget' );
	}
}
