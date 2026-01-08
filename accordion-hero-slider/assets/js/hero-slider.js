/* Version: 1.0.1 - Explicit jQuery Refactor */
(function ($) {
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/hero_slider_widget.default', function ($scope) {
            const $container = $scope.find('.hero-slider');
            const cards = $container.find('.card');
            const AUTO_PLAY_INTERVAL = 10000;
            let activeIndex = 0;
            let autoPlayTimer = null;
            let progressInterval = null;

            function updateCards() {
                cards.each(function (index) {
                    if (index === activeIndex) {
                        $(this).addClass('active');
                    } else {
                        $(this).removeClass('active');
                    }
                });
                startProgress();
            }

            function startProgress() {
                if (autoPlayTimer) clearTimeout(autoPlayTimer);
                if (progressInterval) clearInterval(progressInterval);

                const $activeCard = $(cards[activeIndex]);
                const $progressBar = $activeCard.find('.progress-bar-inner');

                $container.find('.progress-bar-inner').css('width', '0%');

                if (!$progressBar.length) return;

                let start = Date.now();

                progressInterval = setInterval(() => {
                    let elapsed = Date.now() - start;
                    let progress = Math.min((elapsed / AUTO_PLAY_INTERVAL) * 100, 100);
                    $progressBar.css('width', progress + '%');

                    if (progress >= 100) {
                        nextCard();
                    }
                }, 50);
            }

            function nextCard() {
                activeIndex = (activeIndex + 1) % cards.length;
                updateCards();
            }

            function prevCard() {
                activeIndex = (activeIndex - 1 + cards.length) % cards.length;
                updateCards();
            }

            cards.on('click', function () {
                const index = $(this).data('index');
                if (activeIndex !== index) {
                    activeIndex = index;
                    updateCards();
                }
            });

            $container.find('.prev-btn').on('click', function (e) {
                e.stopPropagation();
                prevCard();
            });

            $container.find('.next-btn').on('click', function (e) {
                e.stopPropagation();
                nextCard();
            });

            // Initial call
            updateCards();
        });
    });
})(jQuery);
