(function ($) {
    function initFunfactCounter(scope) {
        const counters = scope.querySelectorAll(".funfact-number");

        counters.forEach((counter) => {
            if (counter.classList.contains("is-counted")) return;
            counter.classList.add("is-counted");

            const end = parseInt(counter.dataset.end, 10);
            let current = 0;

            const update = () => {
                current += Math.ceil(end / 60);

                if (current >= end) {
                    counter.textContent = end;
                } else {
                    counter.textContent = current;
                    requestAnimationFrame(update);
                }
            };

            update();
        });
    }

    // FRONTEND
    document.addEventListener("DOMContentLoaded", () => {
        initFunfactCounter(document);
    });

    // ELEMENTOR EDITOR
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/funfact_counters.default",
            function ($scope) {
                initFunfactCounter($scope[0]);
            }
        );
    });
})(jQuery);
