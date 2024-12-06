<?php
/**
 * @var rex_fragment $this
 * @psalm-scope-this rex_fragment
 */

$colors = [
    ['bg' => '#25a7d7', 'accents' => ['#0e6cc4', '#0af', '#77daff', '#2962FF'], 'spot' => 'rgba(119,218,255,0.1)'],
    ['bg' => '#0e6cc4', 'accents' => ['#25a7d7', '#39d353', '#0af', '#1e88e5'], 'spot' => 'rgba(57,211,83,0.1)'],
    ['bg' => '#1e88e5', 'accents' => ['#2962FF', '#2ea043', '#25a7d7', '#77daff'], 'spot' => 'rgba(46,160,67,0.1)']
];

$scheme = $colors[array_rand($colors)];

$sizes = [];
for ($i = 1; $i <= 4; $i++) {
    $sizes[] = [
        'width' => rand(80, 120) . 'vw',
        'height' => rand(80, 120) . 'vh',
        'top' => rand(-20, 0) . 'vh',
        'left' => rand(-20, 0) . 'vw',
        'rotation' => rand(-360, 360),
        'scale' => (rand(80, 120) / 100)
    ];
}
?>

<div class="box rex-background">
    <?php for ($i = 0; $i < 4; $i++): ?>
        <div class="shape shape<?= ($i + 1) ?>" style="
            width: <?= $sizes[$i]['width'] ?>;
            height: <?= $sizes[$i]['height'] ?>;
            top: <?= $sizes[$i]['top'] ?>;
            left: <?= $sizes[$i]['left'] ?>;
            transform: rotate(<?= $sizes[$i]['rotation'] ?>deg) scale(<?= $sizes[$i]['scale'] ?>);
        "></div>
    <?php endfor; ?>
    <div class="light-spot"></div>
    <div class="glow glow1"></div>
    <div class="glow glow2"></div>
</div>

<style>
:root {
    --bg-primary: <?= $scheme['bg'] ?>;
    --accent1: <?= $scheme['accents'][0] ?>;
    --accent2: <?= $scheme['accents'][1] ?>;
    --accent3: <?= $scheme['accents'][2] ?>;
    --accent4: <?= $scheme['accents'][3] ?>;
    --spot-color: <?= $scheme['spot'] ?>;
}

body {
    margin: 0;
    padding: 0;
    background: var(--bg-primary);
    overflow: hidden;
}

.box {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
}

.shape {
    position: fixed;
    opacity: 0.3;
    transform-origin: center;
    z-index: -1;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    transition: transform 0.5s ease-out;
}

.shape1 {
    background: var(--accent1);
    animation: float 60s infinite ease-in-out;
}

.shape2 {
    background: var(--accent2);
    animation: float 75s infinite ease-in-out reverse;
}

.shape3 {
    background: var(--accent3);
    animation: float 90s infinite ease-in-out;
    animation-delay: -30s;
}

.shape4 {
    background: var(--accent4);
    animation: float 85s infinite ease-in-out reverse;
    animation-delay: -45s;
}

.light-spot {
    position: fixed;
    width: 800px;
    height: 800px;
    background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, var(--spot-color) 50%, rgba(255,255,255,0) 70%);
    pointer-events: none;
    mix-blend-mode: screen;
    z-index: 1;
}

.glow {
    position: fixed;
    width: 150vw;
    height: 150vh;
    background: radial-gradient(circle, var(--spot-color) 0%, rgba(255,255,255,0) 70%);
    pointer-events: none;
    mix-blend-mode: screen;
    opacity: 0.4;
    animation: pulse 8s infinite ease-in-out;
}

.glow1 {
    top: -25vh;
    left: -25vw;
    animation-delay: -4s;
}

.glow2 {
    bottom: -25vh;
    right: -25vw;
}

@keyframes float {
    0%, 100% { 
        transform: rotate(<?= rand(-45, 45) ?>deg) translate(0, 0) scale(1); 
    }
    25% { 
        transform: rotate(<?= rand(30, 60) ?>deg) translate(<?= rand(5, 15) ?>vw, <?= rand(5, 15) ?>vh) scale(<?= (rand(90, 110) / 100) ?>); 
    }
    50% { 
        transform: rotate(<?= rand(75, 105) ?>deg) translate(<?= rand(-15, -5) ?>vw, <?= rand(-10, -5) ?>vh) scale(<?= (rand(90, 110) / 100) ?>); 
    }
    75% { 
        transform: rotate(<?= rand(30, 60) ?>deg) translate(<?= rand(-10, -5) ?>vw, <?= rand(5, 10) ?>vh) scale(<?= (rand(90, 110) / 100) ?>); 
    }
}

@keyframes pulse {
    0%, 100% { opacity: 0.4; transform: scale(1); }
    50% { opacity: 0.6; transform: scale(1.1); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const spot = document.querySelector('.light-spot');
    let mouseX = 0;
    let mouseY = 0;
    let currentX = 0;
    let currentY = 0;

    const animate = () => {
        currentX += (mouseX - currentX) * 0.05;
        currentY += (mouseY - currentY) * 0.05;
        spot.style.transform = `translate(${currentX}px, ${currentY}px) translate(-50%, -50%)`;
        requestAnimationFrame(animate);
    };

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    animate();
});
</script>

<footer class="rex-global-footer">
  <nav class="rex-nav-footer">
    <ul class="list-inline">
      <li><a href="https://www.yakamara.de" target="_blank" rel="noreferrer noopener">yakamara.de</a></li>
      <li><a href="https://www.redaxo.org" target="_blank" rel="noreferrer noopener">redaxo.org</a></li>
    </ul>
  </nav>
</footer>
