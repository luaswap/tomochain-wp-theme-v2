<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Repeater;
use Elementor\Utils;

class Press extends Widget_Base{
    public function get_name()
    {
      return 'tmc-press';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Press', 'tmc');
    }
    /*
    * Depend Style
    */
    public function get_style_depends() {
          return [
              'slick',
          ];
      }
    /*
    * Depend Script
    */
    public function get_script_depends() {
        return [
            'slick',
            'tmc-addon',
        ];
    }
    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_press_option();      
    }
    private function tmc_press_option(){
      $this->start_controls_section(
        'tmc_press',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );
      $this->add_control(
        'title_heading',
        [
          'label'     => __( 'Title', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'     => __( 'Press', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
        ]
      );
      $repeater = new Repeater();
      $repeater->add_control(
        'title',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Title', 'tmc' ),
        ]
      );
      $repeater->add_control(
        'image',
        [
          'type'      => Controls_Manager::MEDIA,
          'label'     => esc_html__( 'Image', 'tmc' ),
          'default'   => [
            'url'   => Utils::get_placeholder_image_src(),
          ],
        ]
      );

      $repeater->add_control(
        'desc',
        [
          'label'     => __( 'Description', 'tmc' ),
          'type'      => Controls_Manager::TEXTAREA,
          'placeholder'   => __( 'Type your description', 'tmc' ),
        ]
      );
      $repeater->add_control(
        'button_text',
        [
          'label'     => __( 'Button text', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'   => __('Read the article','tmc'),
          'placeholder'   => __( 'Type your description', 'tmc' ),
        ]
      );
      $repeater->add_control(
        'url',
        [
          'label'     => __( 'Url', 'tmc' ),
          'type'      => Controls_Manager::URL,
          'placeholder'   => __( 'https://your-link.com', 'tmc' ),
          'show_external' => true,
          'default'     => [
            'url'     => '',
            'is_external' => true,
            'nofollow' => true,
          ],
        ]
      );

      $this->add_control(
        'press_list',
        [
          'label' => __( 'Article List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'title' => __( 'Article 1', 'tmc' ),
            ],
            [
              'title' => __( 'Article 2', 'tmc' ),
            ],
            [
              'title' => __( 'Article 3', 'tmc' ),
            ],
            [
              'title' => __( 'Article 4', 'tmc' ),
            ],
          ],
          'title_field' => '{{{ title }}}',
        ]
      );

      $this->end_controls_section();
      
    }
    protected function render()
    {
       $settings = $this->get_settings();
       $press = $settings['press_list'];
        ?>
        <div class="tmc-press-widget">
          <?php if(!empty($settings['title_heading'])):?>
            <h2 class="title-heading scrollme">
              <?php echo $settings['title_heading'];?>
              <span class="animateme"
                data-when="enter"
                data-from="1"
                data-to="0"
                data-opacity="0"
                data-translatex="-200"
                data-translatey="0"
                data-rotatez="0">
              </span>
            </h2>
          <?php endif;?>

            <?php if(!empty($press) && is_array($press)):?>
              <div class="tmc-press-content">
                  <?php
                    foreach ( $press as $p ) {
                      $pt = isset($p['title']) ? $p['title'] : esc_html__('News','tmc');
                      $pi = isset($p['image']['url']) ? $p['image']['url'] : '';
                      $pd = isset($p['desc']) ? $p['desc'] : '';
                      $pb = isset($p['button_text']) ? $p['button_text'] : esc_html__('Read the article','tmc');
                      $p_url = !empty($p['url']['url']) ? $p['url']['url'] : '#';
                      $p_link_props = ' href="' . esc_url( $p_url ) . '" ';
                      if ( isset($p['url']['is_external']) && $p['url']['is_external'] ) {
                        $p_link_props .= ' target="_blank" ';
                      }
                      if ( isset($p['url']['nofollow']) && $p['url']['nofollow'] ) {
                        $p_link_props .= ' rel="nofollow" ';
                      }
                      ?>
                      <div class="p-item">
                          <img src="<?php echo esc_url($pi);?>" alt="<?php echo esc_attr($pt);?>">
                          <p class="desc"><?php wp_kses_post($pd);?></p>
                          <a class="read-more" <?php echo $p_link_props;?>><?php echo $pb?></a>
                      </div>
                  <?php }?>
              </div>
            <?php endif;?>
        </div>
        <?php
    }
}