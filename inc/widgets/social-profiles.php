<?php 
/**
 * Social Profile Widget
 *
 * @package Bootitems_Core
 * @since version 1.0.0
*/
if ( bc_fs()->can_use_premium_code() ) {
	class Bootitems_Core_Social_Icons extends WP_Widget {
		
		function __construct() {
			parent::__construct(
			
			// Base ID of your widget
			'bootitems_core_social_icons',
			
			// Widget name will appear in UI
			esc_html__('Bootitems - Social Profiles', 'bootitems-core'),
			
			// Widget description
			array( 'description' => esc_html__( 'Display your social profile on widget areas', 'bootitems-core' ), )
			);
		}

		// Widget Backend
		public function form( $instance ) {
			
			$title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$facebook     = isset( $instance['facebook'] ) ? esc_url( $instance['facebook']) : '';
			$twitter      = isset( $instance['twitter'] ) ? esc_url( $instance['twitter']) : '';
			$instagram    = isset( $instance['instagram'] ) ? esc_url( $instance['instagram']) : '';
			$linkedin     = isset( $instance['linkedin'] ) ? esc_url( $instance['linkedin']) : '';
			$pinterest    = isset( $instance['pinterest'] ) ? esc_url( $instance['pinterest']) : '';
			$youtube      = isset( $instance['youtube'] ) ? esc_url( $instance['youtube']) : '';
			
		?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'bootitems-core' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Facebook:','bootitems-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_url( $facebook ); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Twitter:','bootitems-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_url( $twitter ); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php esc_html_e('Instagram:','bootitems-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_url( $instagram ); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php esc_html_e('Linkedin:','bootitems-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_url( $linkedin ); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php esc_html_e('Pinterest:','bootitems-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_url( $pinterest ); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php esc_html_e('Youtube:','bootitems-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_url( $youtube ); ?>">
		</p>

		<?php
		}
		
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance                 = array();
			$instance['title']        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : __('Working Hours', 'bootitems-core');
			$instance['facebook']     = (!empty($new_instance['facebook']) ) ? esc_url_raw($new_instance['facebook']) : '';
			$instance['twitter']      = (!empty($new_instance['twitter']) ) ? esc_url_raw($new_instance['twitter']) : '';
			$instance['instagram']    = (!empty($new_instance['instagram']) ) ? esc_url_raw($new_instance['instagram']) : '';
			$instance['linkedin']     = (!empty($new_instance['linkedin']) ) ? esc_url_raw($new_instance['linkedin']) : '';
			$instance['pinterest']    = (!empty($new_instance['pinterest']) ) ? esc_url_raw($new_instance['pinterest']) : '';
			$instance['youtube']      = (!empty($new_instance['youtube']) ) ? esc_url_raw($new_instance['youtube']) : '';
			return $instance;
		}
		
		
		// Creating widget front-end
		public function widget( $args, $instance ) {

			$title	     = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('Follow Us', 'bootitems-core') : $instance['title'], $instance, $this->id_base );
			$facebook    = isset( $instance['facebook'] ) ? $instance['facebook'] : '';
			$twitter     = isset( $instance['twitter'] ) ? $instance['twitter'] : '';
			$instagram   = isset( $instance['instagram'] ) ? $instance['instagram'] : '';
			$linkedin    = isset( $instance['linkedin'] ) ? $instance['linkedin'] : '';
			$pinterest   = isset( $instance['pinterest'] ) ? $instance['pinterest'] : '';
			$youtube     = isset( $instance['youtube'] ) ? $instance['youtube'] : '';

			echo $args['before_widget'];

			if ( ! empty( $title ) ){
				echo $args['before_title'] . $title . $args['after_title'];
			}

		?>
			<div class="social-icons crcl">
				<?php if(!empty($facebook) ){ ?>
					<a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook-f"></i><span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'bootitems-core' );?></span></a>
				<?php } ?>
				<?php if(!empty($twitter) ){ ?>
					<a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i><span class="screen-reader-text"><?php esc_html_e( 'Twitter', 'bootitems-core' );?></span></a>
				<?php } ?>
				<?php if(!empty($instagram) ){ ?>
					<a href="<?php echo esc_url($instagram); ?>"><i class="fa fa-instagram"></i><span class="screen-reader-text"><?php esc_html_e( 'Instagram', 'bootitems-core' );?></span></a>
				<?php } ?>
				<?php if(!empty($linkedin) ){ ?>
					<a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i><span class="screen-reader-text"><?php esc_html_e( 'Linkedin', 'bootitems-core' );?></span></a>
				<?php } ?>
				<?php if(!empty($pinterest) ){ ?>
					<a href="<?php echo esc_url($pinterest); ?>"><i class="fa fa-pinterest"></i><span class="screen-reader-text"><?php esc_html_e( 'Pinterest', 'bootitems-core' );?></span></a>
				<?php } ?>
				<?php if(!empty($youtube) ){ ?>
					<a href="<?php echo esc_url($youtube); ?>"><i class="fa fa-youtube"></i><span class="screen-reader-text"><?php esc_html_e( 'Youtube', 'bootitems-core' );?></span></a>
				<?php } ?>
			</div>
		<?php
			echo $args['after_widget'];
		}
	}
	// Register and load the widget
	function bootitems_core_social_icons_widget() {
		register_widget( 'Bootitems_Core_Social_Icons' );
	}
	add_action( 'widgets_init', 'bootitems_core_social_icons_widget' );
}