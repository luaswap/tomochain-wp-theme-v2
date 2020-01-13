<?php
/**
 * tmc team.
 *
 * @since 1.0.0
 */
namespace TMC_Elementor_Widgets;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Utils;

class Team_Member extends Widget_Base {
	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'tmc-team-member';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return esc_html__( 'TMC Team Member', 'tmc' );
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'fa fa-users';
	}

	/**
	 * Get widget categories.
	 *
	 */
	public function get_categories() {
		return [ 'tmc-element-widgets' ];
	}
    /**
	 * Register Widget controls.
	 */
	protected function _register_controls() {
		// Tab Content
		$this->tmc_team_option();
	}
	/*
	* Config
	*/
	private function tmc_team_option(){
		$this->start_controls_section(
			'tmc_team_section',
			[
				'label' => esc_html__( 'General Options', 'tmc' )
			]
		);
	
		$this->add_control(
			'tmc_team',
			[
				'label'       => esc_html__( 'Team Item', 'tmc' ),
				'type'        => Controls_Manager::REPEATER,
				'default'	  => [
					[
						'title'		=> 'Member 1',
						'position'	=> 'Back-end Developer'
					],
					[
						'title'		=> 'Member 2',
						'position'	=> 'Designer'
					],
					[
						'title'		=> 'Member 3',
						'position'	=> 'Frond-end'
					],
				],
				'fields'      => [
					[
						'type' 			=> Controls_Manager::MEDIA,
						'name'  		=> 'image',
						'label' 		=> esc_html__( 'Choose Image', 'tmc' ),
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'type' 			=> Controls_Manager::TEXT,
						'name'  		=> 'title',
						'label' 		=> esc_html__( 'Name', 'tmc' ),
					],
					[
						'type' 			=> Controls_Manager::TEXT,
						'name'  		=> 'position',
						'label' 		=> esc_html__( 'Position', 'tmc' ),
					],
					[
						'label' 	=> esc_html__( 'Social 1', 'tmc' ),
						'type' 		=> Controls_Manager::HEADING,
						'name' 		=> 'social1',
						'separator' => 'before',
					],
					[
						'label' 	=> esc_html__( 'Icon', 'tmc' ),
						'type' 		=> Controls_Manager::ICONS,
						'name'		=> 'icon1',
						'default' 	=> [
							'value' 	=> 'fab fa-facebook-square',
						],
					],
					[
						'label' 		=> esc_html__( 'Link', 'tmc' ),
						'type' 			=> Controls_Manager::URL,
						'name' 			=> 'link1',
						'placeholder' 	=> esc_html__( 'https://your-link.com', 'tmc' ),
					],
					
					[
						'label' 	=> esc_html__( 'Social 2', 'tmc' ),
						'type' 		=> Controls_Manager::HEADING,
						'name' 		=> 'social2',
						'separator' => 'before',
					],
					[
						'label' 	=> esc_html__( 'Icon', 'tmc' ),
						'type' 		=> Controls_Manager::ICONS,
						'name'		=> 'icon2',
						'default' 	=> [
							'value' 	=> 'fab fa-twitter-square',
						],
					],
					[
						'label' 		=> esc_html__( 'Link', 'tmc' ),
						'type' 			=> Controls_Manager::URL,
						'name' 			=> 'link2',
						'placeholder' 	=> esc_html__( 'https://your-link.com', 'tmc' ),
					],
					[
						'label' 	=> esc_html__( 'Social 3', 'tmc' ),
						'type' 		=> Controls_Manager::HEADING,
						'name' 		=> 'social3',
						'separator' => 'before',
					],
					[
						'label' 	=> esc_html__( 'Icon', 'tmc' ),
						'type' 		=> Controls_Manager::ICONS,
						'name'		=> 'icon3',
						'default' 	=> [
							'value' 	=> 'fab fa-linkedin',
						],
					],
					[
						'label' 		=> esc_html__( 'Link', 'tmc' ),
						'type' 			=> Controls_Manager::URL,
						'name' 			=> 'link3',
						'placeholder' 	=> esc_html__( 'https://your-link.com', 'tmc' ),
					],

					[
						'label' 	=> esc_html__( 'Social 4', 'tmc' ),
						'type' 		=> Controls_Manager::HEADING,
						'name' 		=> 'social4',
						'separator' => 'before',
					],
					[
						'label' 	=> esc_html__( 'Icon', 'tmc' ),
						'type' 		=> Controls_Manager::ICONS,
						'name'		=> 'icon4',
						'default' 	=> [
							'value' 	=> 'fab fa-github',
						],
					],
					[
						'label' 		=> esc_html__( 'Link', 'tmc' ),
						'type' 			=> Controls_Manager::URL,
						'name' 			=> 'link4',
						'placeholder' 	=> esc_html__( 'https://your-link.com', 'tmc' ),
					],
				],
				'title_field' 	=> '{{title}}',
			]
		);
		$this->end_controls_section();
	}
	/*
	* Render Widget
	*/
	protected function render() {
		// Get settings.
		$settings = $this->get_settings();
		echo '<div class="tmc-team-widget">';
			echo '<div class="tmc-team-wrap">';
				foreach ( $settings['tmc_team'] as $value ) {
					$image = $value['image'];
					?>
					<div class="tmc-team-item">
						<div class="tmc-team-box">
							<img src="<?php echo esc_url($image['url'])?>" alt="<?php echo esc_attr($value['title']);?>">
							<div class="team-info">
								<h4 class="team-name"><?php echo esc_html($value['title']);?></h4>
								<p class="team-position"><?php echo esc_html($value['position']);?></p>
								<ul class="social">
									<?php
									if($value['link1']['url']){
										$link_props1 = ' href="' . esc_url($value['link1']['url']) . '" ';
										if ( $value['link1']['is_external'] === 'on' ) {
											$link_props1 .= ' target="_blank" ';
										}
										if ( $value['link1']['nofollow'] === 'on' ) {
											$link_props1 .= ' rel="nofollow" ';
										}
									}
									if($value['link2']['url']){

										$link_props2 = ' href="' . esc_url($value['link2']['url']) . '" ';
										if ( $value['link2']['is_external'] === 'on' ) {
											$link_props2 .= ' target="_blank" ';
										}
										if ( $value['link2']['nofollow'] === 'on' ) {
											$link_props2 .= ' rel="nofollow" ';
										}
									}
									if($value['link3']['url']){

										$link_props3 = ' href="' . esc_url($value['link3']['url']) . '" ';
										if ( $value['link3']['is_external'] === 'on' ) {
											$link_props3 .= ' target="_blank" ';
										}
										if ( $value['link3']['nofollow'] === 'on' ) {
											$link_props3 .= ' rel="nofollow" ';
										}
									}
									if($value['link4']['url']){
										$link_props4 = ' href="' . esc_url($value['link4']['url']) . '" ';
										if ( $value['link4']['is_external'] === 'on' ) {
											$link_props4 .= ' target="_blank" ';
										}
										if ( $value['link4']['nofollow'] === 'on' ) {
											$link_props4 .= ' rel="nofollow" ';
										}
									}
									if(!empty($value['link1']['url']))
										echo '<li><a '. $link_props1 .'><i class="'. esc_attr($value['icon1']['value']) .'"></i></a></li>';
									if(!empty($value['link2']['url']))
										echo '<li><a '. $link_props2 .'><i class="'. esc_attr($value['icon2']['value']) .'"></i></a></li>';
									if(!empty($value['link3']['url']))
										echo '<li><a '. $link_props3 .'><i class="'. esc_attr($value['icon3']['value']) .'"></i></a></li>';
									if(!empty($value['link4']['url']))
										echo '<li><a '. $link_props4 .'><i class="'. esc_attr($value['icon4']['value']) .'"></i></a></li>';

									?>
								</ul>
							</div>
						</div>
					</div><!-- .tmc-team-item -->
				<?php }
			echo '</div><!-- . tmc-team-wrap -->';
		echo '</div><!-- .tmc-team-widget -->';
	}
}