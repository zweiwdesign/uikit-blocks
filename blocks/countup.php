<?php
$size = $block->size();
$color = $block->color();
$align = $block->align();
$text = $block->text()->toInt();
?>

<div class="counter <?= $size ?> <?= $color ?> <?= $align ?>" data-target="<?= $text ?>"><?= $text ?></div>

<?php
// Verhindern, dass das Skript mehrfach eingefügt wird
if (!defined('COUNTER_SCRIPT_INCLUDED')) {
    define('COUNTER_SCRIPT_INCLUDED', true);
?>
<script>
document.addEventListener('DOMContentLoaded', () => {

    const counters = document.querySelectorAll('.counter');
    const duration = 2000; // Dauer in Millisekunden

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = +counter.getAttribute('data-target');
                const increment = target / (duration / 16.67);
                let count = 0;

                const updateCount = () => {
                    count += increment;
                    const progress = count / target;
                    const easedProgress = easeInOutQuad(progress);
                    const displayCount = Math.floor(easedProgress * target);

                    counter.innerText = displayCount;

                    if (progress < 1) {
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.innerText = target;
                    }
                };

                updateCount();
                observer.unobserve(counter); // Stop observing once the counter starts
            }
        });
    }, {
        threshold: 0.5 // Trigger when 50% of the element is visible
    });

    counters.forEach(counter => {
        observer.observe(counter);
    });

    function easeInOutQuad(t) {
        return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
    }
});
</script>
<?php
}
?>