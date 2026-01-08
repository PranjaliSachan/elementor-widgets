<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Hero_Slider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'hero_slider_widget';
	}

	public function get_title() {
		return esc_html__( 'Accordion Hero Slider', 'accordion-hero-slider' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function register_controls() {

		// Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Slides', 'elementor-hero-slider' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'elementor-hero-slider' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Slide Title' , 'elementor-hero-slider' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'category', [
				'label' => esc_html__( 'Category / Industry', 'elementor-hero-slider' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Category' , 'elementor-hero-slider' ),
			]
		);

		$repeater->add_control(
			'description', [
				'label' => esc_html__( 'Description', 'elementor-hero-slider' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Slide description goes here.' , 'elementor-hero-slider' ),
			]
		);

		$repeater->add_control(
			'btn_text', [
				'label' => esc_html__( 'Button Text', 'elementor-hero-slider' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Explore' , 'elementor-hero-slider' ),
			]
		);

		$repeater->add_control(
			'btn_link', [
				'label' => esc_html__( 'Button Link', 'elementor-hero-slider' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor-hero-slider' ),
			]
		);

		$repeater->add_control(
			'color_start', [
				'label' => esc_html__( 'Gradient Start', 'elementor-hero-slider' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#1E1D28',
			]
		);

		$repeater->add_control(
			'color_end', [
				'label' => esc_html__( 'Gradient End', 'elementor-hero-slider' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#2D2C3A',
			]
		);

		// Nested Repeater for Logos
		$logo_repeater = new \Elementor\Repeater();

		$logo_repeater->add_control(
			'logo_image',
			[
				'label' => esc_html__( 'Logo Image', 'elementor-hero-slider' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$logo_repeater->add_control(
			'logo_name',
			[
				'label' => esc_html__( 'Client Name (Alt Text)', 'elementor-hero-slider' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Client Name', 'elementor-hero-slider' ),
			]
		);

		$repeater->add_control(
			'logos',
			[
				'label' => esc_html__( 'Client Logos (Max 5)', 'elementor-hero-slider' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $logo_repeater->get_controls(),
				'default' => [
					[ 'logo_name' => 'Client 1' ],
					[ 'logo_name' => 'Client 2' ],
				],
				'title_field' => '{{{ logo_name }}}',
			]
		);

		$this->add_control(
			'slides',
			[
				'label' => esc_html__( 'Slider Cards', 'elementor-hero-slider' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Deliver industry-leading solutions with expertise', 'elementor-hero-slider' ),
						'category' => esc_html__( 'Overview', 'elementor-hero-slider' ),
					],
				],
				'title_field' => '{{{ category }}}',
			]
		);

		$this->end_controls_section();

		// Style Tab
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Typography', 'elementor-hero-slider' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'elementor-hero-slider' ),
				'selector' => '{{WRAPPER}} .card__title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => esc_html__( 'Description Typography', 'elementor-hero-slider' ),
				'selector' => '{{WRAPPER}} .card__description',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['slides'] ) ) {
			return;
		}
		?>
		<div class="hero-slider-widget-container">
			<div class="hero-slider" id="hero-slider-<?php echo esc_attr( $this->get_id() ); ?>">
				<?php foreach ( $settings['slides'] as $index => $item ) : 
					$active_class = ( $index === 0 ) ? 'active' : '';
					$gradient = 'linear-gradient(135deg, ' . $item['color_start'] . ' 0%, ' . $item['color_end'] . ' 100%)';
				?>
					<div class="card <?php echo esc_attr( $active_class ); ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" data-index="<?php echo esc_attr( $index ); ?>">
						<div class="card__bg" style="background: <?php echo esc_attr( $gradient ); ?>;"></div>
						<div class="card__overlay"></div>
						
						<!-- Inactive Label -->
						<div class="card__inactive-label">
							<div class="label-top">
								<span class="dot"></span>
								<span class="vertical-text"><?php echo esc_html( $item['category'] ); ?></span>
							</div>
							<div class="label-bottom">
								<div class="plus-icon">
									<svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
								</div>
							</div>
						</div>

						<!-- Active Content -->
						<div class="card__active-content">
							<div class="active-header">
								<span class="category-name"><?php echo esc_html( $item['category'] ); ?></span>
								<span class="active-dot"></span>
							</div>
							<div class="active-body">
								<h2 class="card__title"><?php echo esc_html( $item['title'] ); ?></h2>
								<p class="card__description"><?php echo esc_html( $item['description'] ); ?></p>
								
                                <?php if ( ! empty( $item['btn_link']['url'] ) ) : ?>
                                    <div class="active-actions">
                                        <a href="<?php echo esc_url( $item['btn_link']['url'] ); ?>" class="explore-pill">
                                            <span class="btn-text"><?php echo esc_html( $item['btn_text'] ); ?></span>
                                            <span class="btn-arrow">
                                                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2.5" fill="none"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
								
								<div class="slider-footer">
									<div class="client-section">
										<span class="client-label">Clients</span>
										<div class="client-logos">
											<?php if ( ! empty( $item['logos'] ) ) : ?>
												<?php foreach ( $item['logos'] as $logo ) : ?>
													<div class="logo-item">
														<?php if ( ! empty( $logo['logo_image']['url'] ) && $logo['logo_image']['url'] !== \Elementor\Utils::get_placeholder_image_src() ) : ?>
															<img src="<?php echo esc_url( $logo['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( $logo['logo_name'] ); ?>" class="client-logo-img">
														<?php else : ?>
															<?php echo esc_html( $logo['logo_name'] ); ?>
														<?php endif; ?>
													</div>
												<?php endforeach; ?>
											<?php endif; ?>
										</div>
									</div>
									<div class="nav-controls">
										<div class="progress-bar-container">
											<div class="progress-bar-inner"></div>
										</div>
										<div class="nav-arrows">
											<button class="nav-arrow-btn prev-btn"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1.5" fill="none"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg></button>
											<button class="nav-arrow-btn next-btn"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1.5" fill="none"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}
