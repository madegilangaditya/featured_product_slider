class TownsCentralFeaturedProductsElementorHandler extends elementorModules.frontend.handlers.Base {
	
    getDefaultSettings() {
        return {
            selectors: {
                wrapper: '.tc-featured__products',
            },
        };
    }

    getDefaultElements() {
        const selectors = ( this.getSettings('selectors') );

        return {
            $wrapper: this.$element.find(selectors.wrapper),
        };
    }

    bindEvents() {
        this.elements.$wrapper.slick({
			variableWidth: false,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			centerMode: false,
			focusOnSelect: false,
			autoplaySpeed: 5000,
			arrows: false,
            dots: true,
			infinite: true,
			pauseOnHover: false,
			pauseOnFocus: false,
            responsive: [
                {
                  breakpoint: 767,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                  }
                },
            ]
        });
    }
	
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(TownsCentralFeaturedProductsElementorHandler, {
            $element,
        });
    };
    // Add our handler to the my-elementor Widget (this is the slug we get from get_name() in PHP)
    elementorFrontend.hooks.addAction('frontend/element_ready/towns_central_featured_products.default', addHandler);
})