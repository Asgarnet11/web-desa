export function initCountUp() {
    const counters = document.querySelectorAll('[data-count-target]');
    if (!counters.length) return;

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.countTarget, 10);
                const duration = 1200; // ms
                const start = 0;
                const startTime = performance.now();

                function update(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    // easeOutQuad
                    const ease = 1 - (1 - progress) * (1 - progress);
                    const current = Math.floor(start + (target - start) * ease);
                    el.textContent = current.toLocaleString('id-ID');

                    if (progress < 1) {
                        requestAnimationFrame(update);
                    } else {
                        el.textContent = target.toLocaleString('id-ID');
                    }
                }

                requestAnimationFrame(update);
                obs.unobserve(el);
            }
        });
    }, { threshold: 0.2 });

    counters.forEach(el => observer.observe(el));
}
