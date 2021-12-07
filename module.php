<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Towns_Central_Featured_Products_Widget extends Widget_Base {

    public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		wp_register_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', [ 'elementor-frontend' ], '1.8.1', true );
		wp_register_script( 'featured-products-script', get_stylesheet_directory_uri() . '/includes/elementor/towns_central_featured_product/js/script.js', array( 'jquery' ), _S_VERSION, true );

		wp_register_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css' );
		wp_register_style( 'slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css' );
	}

    public function get_script_depends() {
		return [ 'slick', 'featured-products-script' ];
	}

	public function get_style_depends() {
		return [ 'slick', 'slick-theme' ];
	}

	public function get_name() {
		return 'towns_central_featured_products';
	}

	public function get_title() {
		return __( 'Towns Central Featured Products', 'townscentral' );
	}

	public function get_icon() {
		return 'eicon-wordpress';
	}

	public function get_categories() {
		return [ 'townscentral-widget' ];
	}

    protected function _register_controls() {

		$this->start_controls_section(
			'query_options',
			[
				'label' => __( 'Query', 'townscentral' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

            $this->add_control(
                'source',
                [
                    'label' => __( 'Source', 'townscentral' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'latest' => __( 'Latest', 'townscentral' ),
                        // 'page_query' => __( 'Page Query', 'townscentral' ),
                    ],
                    'default' => 'latest',
                    'save_default' => true,
                ]
            );


			$this->add_control(
				'featured_number_post',
				[
					'label' => __( 'Number Post', 'townscentral' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 200,
					'step' => 1,
					'default' => 3,
					'dynamic'       => array(
						'active' => true,
					),
				]
			);

		$this->end_controls_section();

        // Style Slide Text
        $this->start_controls_section(
			'text_title_style_section',
			[
				'label' => __( 'Title', 'townscentral' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'text_title_color',
                [
                    'label' => __( 'Text Title Color', 'townscentral' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tc-featured-products-listing__title h2 a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'text_title_typography',
                    'label' => __( 'Typography', 'townscentral' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .tc-featured-products-listing__title h2',
                ]
            );

        $this->end_controls_section();

        // Price Style
        $this->start_controls_section(
            'price_style_section',
            [
                'label' => __( 'Price', 'townscentral' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'regular_price_color',
                [
                    'label' => __( 'Regular Price Color', 'townscentral' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tc-featured-regular-price' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'regular_price_typography',
                    'label' => __( 'Typography', 'townscentral' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .tc-featured-regular-price',
                ]
            );

            $this->add_control(
                'cross_price_color',
                [
                    'label' => __( 'Cross Price Color', 'townscentral' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tc-featured-cross-price' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'cross_price_typography',
                    'label' => __( 'Typography', 'townscentral' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .tc-featured-cross-price',
                ]
            );

            // $this->add_control(
            //     'text_box_color',
            //     [
            //         'label' => __( 'Background Color', 'townscentral' ),
            //         'type' => \Elementor\Controls_Manager::COLOR,
            //         'scheme' => [
            //             'type' => \Elementor\Core\Schemes\Color::get_type(),
            //             'value' => \Elementor\Core\Schemes\Color::COLOR_1,
            //         ],
            //         'selectors' => [
            //             '{{WRAPPER}} .tc-carousel__text-content' => 'background-color: {{VALUE}}',
            //         ],
            //     ]
            // );


        $this->end_controls_section();
        
        // Description Style
        $this->start_controls_section(
            'description_style_section',
            [
                'label' => __( 'Description', 'townscentral' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'description_price_typography',
                    'label' => __( 'Typography', 'townscentral' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .tc-featured-products-listing__content-item',
                ]
            );

            $this->add_control(
                'description_color',
                [
                    'label' => __( 'description Color', 'townscentral' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tc-featured-products-listing__content-item' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'description_spacing',
                [
                    'label' => __('Spacing', 'townscentral' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 15,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tc-featured-products-listing__content-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'box_padding',
                [
                    'label' => __( 'Text Box Padding', 'townscentral' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .tc-featured-products-listing-wrapper__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
        
        // button_product style
        $this->start_controls_section(
            'button_product_style_section',
            [
                'label' => __( 'Button', 'townscentral' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_product_typography',
                    'label' => __( 'Typography', 'townscentral' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .tc-featured-btn',
                ]
            );

            $this->start_controls_tabs(
                'button_product__style_tab'
            );

                $this->start_controls_tab(
                    'button_product_normal_tab',
                    [
                        'label' => __( 'Normal', 'townscentral' ),
                    ]
                );

                    $this->add_control(
                        'button_product_normal_color',
                        [
                            'label' => __( 'Text Color', 'townscentral' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .tc-featured-btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'button_product_bg_normal_color',
                        [
                            'label' => __( 'Background Color', 'townscentral' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .tc-featured-btn' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'button_product_product_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'townscentral' ),
                    ]
                );

                $this->add_control(
                    'button_product_hover_color',
                    [
                        'label' => __( 'Text Color', 'townscentral' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => \Elementor\Core\Schemes\Color::get_type(),
                            'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .tc-featured-btn:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_control(
                    'button_product_bg_hover_color',
                    [
                        'label' => __( 'Background Color', 'townscentral' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => \Elementor\Core\Schemes\Color::get_type(),
                            'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .tc-featured-btn:hover' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_responsive_control(
                'button_product_padding',
                [
                    'label' => __( 'Padding', 'townscentral' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .tc-featured-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_product_border_radius',
                [
                    'label' => __( 'Border Radius', 'townscentral' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .tc-featured-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


	}

	protected function render() {
        $settings = $this->get_settings_for_display();
		$source	= $settings['source'];
		// $posts_per_page	= $settings['posts_per_page'];
		$numberposts = $settings['featured_number_post'];
        //$featured_img = $settings['featured_image']['url']; 

        // if( $source == "latest" ) {

            $args = array(
                'post_type' => 'deal',
                'post_status' => 'publish',
                'numberposts' => $numberposts,
                //'posts_per_page' => -1,
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'tc_featured',
                        'value' => true
                    )
                )
            );

        // }
        $posts = new \WP_Query( $args );

		if( $posts->have_posts() ): ?>

			<div class="tc-featured__products">
                

                
                <?php
                //echo $numberposts;
				while( $posts->have_posts() ): $posts->the_post();

                    get_template_part( 'template-parts/featured-products', 'loop' );
                 
				 endwhile; 
                 wp_reset_postdata();

                ?>

                        

			</div>
			
		<?php endif;
	}

}