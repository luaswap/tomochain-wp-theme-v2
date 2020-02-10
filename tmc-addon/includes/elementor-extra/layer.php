<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;

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
      // Columns.
      $this->add_responsive_control(
        'columns',
        [
          'type'           => Controls_Manager::SELECT,
          'label'          => '<i class="fa fa-columns"></i> ' . esc_html__( 'Columns', 'tmc' ),
          'default'        => 3,
          'tablet_default' => 2,
          'mobile_default' => 1,
          'options'        => [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
          ]
        ]
      );
      $repeater = new Repeater();      
      $repeater->add_control(
        'icon',
        [
          'label' => __( 'Icon', 'tmc' ),
          'type' => Controls_Manager::ICONS,
          'default' => [
            'value' => 'fas fa-star',
            'library' => 'solid',
          ],
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
        'id_content',
        [
          'type'        => Controls_Manager::TEXT,
          'label'       => esc_html__( 'ID Section', 'tmc' ),
          'description' => esc_html__('Including lowercase letters and dashes. Eg: product-setion','tmc')
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
              'layer' => __( 'Product', 'tmc' ),
            ],
            [
              'layer' => __( 'Protocol', 'tmc' ),
            ],
            [
              'layer' => __( 'Core Blockchain', 'tmc' ),
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
      $item_class = '';
      $mobile_class = ( ! empty( $settings['columns_mobile'] ) ? ' tmc-mobile-' . $settings['columns_mobile'] : '' );
      $tablet_class = ( ! empty( $settings['columns_tablet'] ) ? ' tmc-tablet-' . $settings['columns_tablet'] : '' );
      $desktop_class = ( ! empty( $settings['columns'] ) ? ' tmc-desktop-' . $settings['columns'] : '' );
      
      $grid_class = 'tmc-grid-col'.$desktop_class . $tablet_class . $mobile_class;
      ?>
        <div class="tmc-layer-widget">

            <?php if(!empty($layer) && is_array($layer)):?>
              <div class="tmc-layer-content <?php echo esc_attr($grid_class);?>">
                  <?php
                    foreach ( $layer as $s ) {                      
                      $st = isset($s['title']) ? $s['title'] : '';
                      $id = isset($s['id_content']) ? $s['id_content'] : '';
                      ?>
                      <a class="layer-item tmc-grid-item" href="#<?php echo esc_attr($id);?>">
                          <div class="layer-info">
                            <div class="layer-icon">
                              <?php Icons_Manager::render_icon( $s['icon'], [ 'aria-hidden' => 'true' ], 'i' );?>
                            </div>
                            <h3 class="layer-title"><?php echo esc_html($st);?></h3>
                          </div>
                      </a>
                  <?php }?>
              </div>
            <?php endif;?>
        </div>
        <?php
    }
}