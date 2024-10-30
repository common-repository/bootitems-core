<?php
    /**
	 * Contact Us widgets
	 *
	 * @package Bootitems_Core
	 * @since version 1.0.0
	*/
if ( bc_fs()->can_use_premium_code() ) {
	class Bootitems_Core_Contact_Us extends WP_Widget {
		
		function __construct() {
			parent::__construct(
			
			// Base ID of your widget
			'bootitems_core_contact_us',
			
			// Widget name will appear in UI
			esc_html__('Bootitems - Contact Us', 'bootitems-core'),
			
			// Widget description
			array( 'description' => esc_html__( 'Show contact information on widget area.', 'bootitems-core' ), )
			);
		}

		// Widget Backend
		public function form( $instance ) {
			
			$title       = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$address_location  = isset( $instance['address_location'] ) ? esc_html( $instance['address_location'] ) : '';
			$phone    = isset( $instance['phone'] ) ? esc_html( $instance['phone'] ) : '';
			$email    = isset( $instance['email'] ) ? esc_html( $instance['email'] ) : '';

		?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'bootitems-core' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'address_location' )); ?>"><?php _e( 'Address:', 'bootitems-core' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address_location' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address_location' ) ); ?>"><?php echo wp_kses_post( $address_location ); ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone Number:', 'bootitems-core' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_html( $phone ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email Address:', 'bootitems-core' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_html( $email ); ?>" />
		</p>	

		<?php
		}
		
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			
			$instance                = array();
			$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : __('Contact Us', 'bootitems-core');
			$instance['address_location']  = ( ! empty( $new_instance['address_location'] ) ) ? strip_tags( $new_instance['address_location'] ) : '';
			$instance['phone']       = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
			$instance['email']       = ( ! empty( $new_instance['email'] ) ) ? sanitize_email( $new_instance['email'] ) : '';

			return $instance;
		}
		
		
		// Creating widget front-end
		public function widget( $args, $instance ) {

			$title	     = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('Contact Us', 'bootitems-core') : $instance['title'], $instance, $this->id_base );
			$address_location  = isset( $instance['address_location'] ) ? esc_html($instance['address_location']) : '';
			$phone   	 = isset( $instance['phone'] ) ? esc_html( $instance['phone'] ) : '';
			$email   	 = isset( $instance['email'] ) ? antispambot(esc_html( $instance['email'] )) : '';

			echo $args['before_widget'];

			if ( ! empty( $title ) ){
				echo $args['before_title'] . $title . $args['after_title'];
			}

		?>
		<div class="widget-contact">

			<?php if(!empty($address_location) ){ ?>
				<p class="location"><?php echo esc_html($address_location); ?></p>
			<?php } ?>

			<?php if(!empty($phone) ){ ?>
				<p class="phone"><span><?php esc_html_e('Call Now','bootitems-core'); ?></span> <a href="<?php echo esc_attr('tel:' . preg_replace( '/[^\d+]/', '', $phone ) ); ?>"><?php echo esc_html($phone); ?></a></p>
			<?php } ?>

			<?php if(!empty($email) ){ ?>
				<p class="email"><span><?php esc_html_e('Email Us','bootitems-core'); ?></span> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
			<?php } ?>

		</div>

		<?php
			echo $args['after_widget'];
		}
	}
	// Register and load the widget
	function bootitems_core_contact_us_widget() {
		
		register_widget( 'Bootitems_Core_Contact_Us' );
		
	}
	add_action( 'widgets_init', 'bootitems_core_contact_us_widget' );
}