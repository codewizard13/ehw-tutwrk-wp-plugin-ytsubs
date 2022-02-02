<?php

/**
 * Adds Foo_Widget widget.
 */
class Youtube_Subs_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'youtubesubs_widget', // Base ID
			esc_html__( 'YouTube Subs', 'yts_domain' ), // Name
			array( 'description' => esc_html__( 'Widget to display YouTube subs', 'yts_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget']; // Whatever you want to display BEFORE widget (<div>, etc)
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

        // Widget Content Output
		// echo esc_html__( 'Hello, World!', 'yts_domain' );
        echo '<div class="g-ytsubscribe" data-channelid=' . $instance['channel'] .' data-layout="full" data-count="default"></div>';

		echo $args['after_widget']; // Whatever you want to display AFTER widget (<div>, etc)
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'YouTube Subs', 'yts_domain' );
		
		$channel = ! empty( $instance['channel'] ) ? $instance['channel'] : esc_html__( 'UCp93Jok5b2D4-LbIM4ZNNqA', 'yts_domain' );
				
		?>

        <!-- TITLE -->
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_attr_e( 'Title:', 'yts_domain' ); ?>
            </label> 
            <input 
                class="widefat"
                id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
                name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
                type="text"
                value="<?php echo esc_attr( $title ); ?>">
		</p>

        <!-- CHANNEL -->
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'channel' ) ); ?>">
                <?php esc_attr_e( 'Channel:', 'yts_domain' ); ?>
            </label> 
            <input 
                class="widefat"
                id="<?php echo esc_attr( $this->get_field_id( 'channel' ) ); ?>" 
                name="<?php echo esc_attr( $this->get_field_name( 'channel' ) ); ?>" 
                type="text"
                value="<?php echo esc_attr( $channel ); ?>">
		</p>

	<!-- LAYOUT -->
	<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>">
                <?php esc_attr_e( 'Layout:', 'yts_domain' ); ?>
            </label>

            <select 
                class="widefat"
                id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" 
                name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
			</select>
		</p>
		
		
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		$instance['channel'] = ( ! empty( $new_instance['channel'] ) ) ? sanitize_text_field( $new_instance['channel'] ) : '';

		return $instance;
	}

} // class Foo_Widget