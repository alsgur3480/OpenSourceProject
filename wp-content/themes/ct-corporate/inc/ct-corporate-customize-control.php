<?php
        /**
 * Customize for Layout picker, extend the WP customizer
 *
 */
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom layout control
 */
if ( ! class_exists( 'ct_corporate_Layout_Picker_Custom_Control' ) ) {
  class ct_corporate_Layout_Picker_Custom_Control extends WP_Customize_Control
  {
        /**
         * Render the content on the theme customizer page
         */
        public function render_content()
         {
              ?>
                  <label>
                    <span class="customize-layout-control customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <ul>

                    <li><br>
                      <input type="radio" name="<?php echo esc_attr($this->id); ?>" id="<?php echo esc_attr($this->id); ?>[right_sidebar]"  data-customize-setting-link="<?php echo esc_attr($this->id); ?>" value="3"  />
                          <label for="<?php echo esc_attr($this->id); ?>[right_sidebar]"><?php esc_html_e('Right Sidebar', 'ct-corporate'); ?></label>

                          </li>
                      <li><br>
                        <input type="radio" name="<?php echo esc_attr($this->id); ?>" id="<?php echo esc_attr($this->id); ?>[full_width]"  data-customize-setting-link="<?php echo esc_attr($this->id); ?>" value="1" />
                          <label for="<?php echo esc_attr($this->id); ?>[full_width]"><?php esc_html_e('No Sidebar', 'ct-corporate'); ?></label>
                          </li>
                      <li><br>
                        <input type="radio" name="<?php echo esc_attr($this->id); ?>" id="<?php echo esc_attr($this->id); ?>[left_sidebar]" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" value="2" />
                          <label for="<?php echo esc_attr($this->id); ?>[left_sidebar]"><?php esc_html_e('Left Sidebar', 'ct-corporate'); ?></label>
                          </li>

                    </ul>
                  </label>
              <?php
         }
  }
}

/**
 * Customize for textarea, extend the WP customizer
 *
 */



  if ( class_exists( 'WP_Customize_Control' ) ) {
      /**
       * Class to create a post control
       */
    if ( ! class_exists( 'ct_corporate_Post_Dropdown_control' ) ) {
      class ct_corporate_Page_Dropdown_control extends WP_Customize_Control {
            /**
             * Render the content on the theme customizer page
             */
            public function render_content() {
              $none = get_theme_mod($this->id);
                if (isset($none[0])) {
                  $none_selected = $none[0];
                } else {
                  $none_selected = get_theme_mod($this->id);
                }
              ?>
                  <label>
                      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                      <select multiple="multiple" data-customize-setting-link="<?php echo esc_attr($this->id); ?>">
                          <option value="none" <?php selected($none_selected, 'none' ); ?>><?php esc_html_e( 'None','ct-corporate' ); ?></option>
                              <?php  $posts = get_posts( array( 'posts_per_page'=> -1, 'post_type'=>'page' ) );
                              foreach ( $posts as $post ) { ?>
                                   <option value="<?php echo esc_attr($post->ID); ?>" <?php selected( $post->ID); ?>><?php echo esc_html($post->post_title); ?></option>
  							<?php } ?>
                      </select>
                  </label><br><br>
                  <?php
              }
          }
    }
/**
*
* Class to create custom category dropdown section
*
**/
  if ( ! class_exists( 'ct_corporate_Category_dropdown_control' ) ) {
      class ct_corporate_Category_dropdown_control extends WP_Customize_Control {

          public function render_content() {
              $cat_args = array(
                      'taxonomy' => 'category',
                      'orderby' => 'name',
                  );
              $categories = get_categories( $cat_args ); ?>
               <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
               <span><?php echo esc_html( $this->description ); ?></span><br>
                  <select data-customize-setting-link="<?php echo esc_attr($this->id); ?>">
                      <option value="none" <?php selected( get_theme_mod($this->id), 'none' ); ?>><?php esc_html_e( 'None','ct-corporate' ); ?></option>
                      <?php foreach ( $categories as $post ) { ?>
                              <option value="<?php echo esc_attr($post->term_id); ?>" <?php selected( $post->term_id); ?>><?php echo esc_html($post->name); ?></option>
                      <?php } ?>
                  </select> <br /><br />
              <?php
          }
      }
  }
}

if ( ! class_exists( 'ct_corporate_documentation_Custom_Text_Control' ) ) {
  class ct_corporate_documentation_Custom_Text_Control extends WP_Customize_Control {
          public $type = 'customtext';
          public $extra = ''; // we add this for the extra description

          public function enqueue() {
           wp_enqueue_style( 'ct-corporate-customizer-sort-style', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css' );
        }

          public function render_content() {
          ?>
          <p>
                <a class="ct_corporate_support" target="_blank" href="<?php echo esc_url('https://codethemes.co/ct-corporate-documentation/') ?>"><span class="dashicons dashicons-book-alt"></span><?php echo  esc_html__('Documentation', 'ct-corporate') ?></a>

                <a class="ct_corporate_support" target="_blank" href="<?php echo esc_url('https://codethemes.co/my-tickets/') ?>"><span class="dashicons dashicons-edit"></span><?php echo   esc_html__('Create a Ticket', 'ct-corporate') ?></a>

                <a class="ct_corporate_support" target="_blank" href="<?php echo esc_url('https://codethemes.co/product/ct-corporate-pro/') ?>"><span class="dashicons dashicons-star-filled"></span><?php echo   esc_html__('Buy Premium', 'ct-corporate') ?></a>

                <a class="support-image ct_corporate_support" target="_blank" href="<?php echo  esc_url('https://codethemes.co/support/#customization_support') ?>"><img src = "<?php echo esc_url(get_template_directory_uri() . '/img/wparmy.png') ?>" /> <?php echo esc_html__('Request Customization', 'ct-corporate'); ?></a>
              </p>

          <?php
          }
      }
}