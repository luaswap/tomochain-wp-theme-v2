<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Repeater;
use Elementor\Utils;

class Layer extends Widget_Base{
    public function get_name()
    {
      return 'tmc-layer';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Layer', 'tmc');
    }

    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_layer_option();      
    }
    private function tmc_layer_option(){
      $this->start_controls_section(
        'tmc_layer',
        [
            'label' => esc_html__('General', 'tmc')
        ]
      );
      $repeater = new Repeater();
      $repeater->add_control(
        'layer',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Layer', 'tmc' ),
        ]
      );
      $repeater->add_control(
        'color',
        [
          'label' => __( 'Color', 'tmc' ),
          'type' => Controls_Manager::COLOR,
        ]
      );
      $repeater->add_control(
        'title',
        [
          'type'      => Controls_Manager::TEXT,
          'label'     => esc_html__( 'Title', 'tmc' ),
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

      $this->add_control(
        'layer_list',
        [
          'label' => __( 'layer List', 'tmc' ),
          'type' => Controls_Manager::REPEATER,
          'fields' => $repeater->get_controls(),
          'default' => [
            [
              'layer' => __( 'layer 1', 'tmc' ),
            ],
          ],
          'title_field' => '{{{ layer }}}',
        ]
      );

      $this->end_controls_section();
      
    }
    protected function render()
    {
      $settings = $this->get_settings();
      $layer = $settings['layer_list'];
      $mobile_class = ( ! empty( $settings['columns_mobile'] ) ? ' tmc-mobile-' . $settings['columns_mobile'] : '' );
      $tablet_class = ( ! empty( $settings['columns_tablet'] ) ? ' tmc-tablet-' . $settings['columns_tablet'] : '' );
      $desktop_class = ( ! empty( $settings['columns'] ) ? ' tmc-desktop-' . $settings['columns'] : '' );
      $grid_class = 'tmc-grid-col'.$desktop_class . $tablet_class . $mobile_class;
      ?>
        <div class="tmc-layer-widget">

            <?php if(!empty($layer) && is_array($layer)):?>
              <div class="tmc-layer-content <?php echo esc_attr($grid_class)?>">
                  <?php
                    foreach ( $layer as $s ) {
                      $sn = isset($s['layer']) ? $s['layer'] : '';
                      $st = isset($s['title']) ? $s['title'] : '';
                      $sd = isset($s['desc']) ? $s['desc'] : '';
                      $color = isset($s['color']) ? $s['color'] : '#00E8B4';
                       ?>
                      <div class="tmc-grid-item">
                          <div class="layer-header">
                            <div class="tmc-cube" style="background-color:<?php echo $color;?>"></div>
                            <span class="layer-number" style="background-color:<?php echo $color;?>"><?php echo $sn;?></span>
                            <span class="line" style="background-color:<?php echo $color;?>"></span>
                          </div>
                          <div class="layer-info">
                            <h3 class="layer-title"><?php echo $st;?></h3>
                            <p class="desc"><?php echo $sd;?></p>
                          </div>
                      </div>
                  <?php }?>
              </div>
            <?php endif;?>
        </div>
        <?php
    }
}