<?php
namespace TMC_Elementor_Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Repeater;
use Elementor\Utils;

class Tmc_Button extends Widget_Base{
    public function get_name()
    {
      return 'tmc_button';
    }
    public function get_icon()
    {
        return 'fa fa-info';
    }
    public function get_title()
    {
        return esc_html__('TMC Button', 'tmc');
    }
    public function get_categories()
    {
        return [ 'tmc-element-widgets' ];
    }
    protected function _register_controls()
    {
      // Tab Content
      $this->tmc_button_option();      
    }
    private function tmc_button_option(){
      $this->start_controls_section(
        'tmc_button',
        [
            'label' => esc_html__('Tmc Button', 'tmc'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]
      );
      $repeater = new Repeater();
      $repeater->add_control(
        'title',
        [
          'label'     => __( 'Title', 'tmc' ),
          'type'      => Controls_Manager::TEXT,
          'default'     => __( 'Button', 'tmc' ),
          'placeholder'   => __( 'Type your title', 'tmc' ),
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
        'button_list',
        [
          'label'   => __( 'Button', 'tmc' ),
          'type'    => Controls_Manager::REPEATER,
          'fields'  => $repeater->get_controls(),
          'default' => [
            [
              'title'       => __( 'D', 'tmc' ),
            ]
          ],
          'title_field' => '{{{ title }}}',
        ]
      );

      $this->end_controls_section();
    }
    protected function render()
    {
      $settings = $this->get_settings();
      $button_list = $settings['button_list'];
      ?>
      <div class="tmc-button-widget">
        <?php if(!empty($button_list) && is_array($button_list)):
        $i = 0;
          foreach ($button_list as $value) {
            $i++;
            $title = $value['title'];
            $url = !empty($value['url']['url']) ? $value['url']['url'] : '#';
            $link = ' href="' .  esc_url($url) . '" ';
            if ( isset($value['url']['is_external']) && $value['url']['is_external'] ) {
              $link .= ' target="_blank" ';
            }
            if ( isset($value['url']['nofollow']) && $value['url']['nofollow'] ) {
              $link .= ' rel="nofollow" ';
            }?>
            <a class="button-link type-<?php echo $i;?>" <?php echo $link;?>>
              <?php echo $title;?>
            </a>
          <?php }?>
        <?php endif;?>
      </div>
    <?php }
}