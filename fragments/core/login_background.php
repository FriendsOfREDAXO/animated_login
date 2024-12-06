<?php
/**
 * @var rex_fragment $this
 * @psalm-scope-this rex_fragment
 */

$colors = [
    [
        'bg' => '#25a7d7',
        'accents' => ['#0e6cc4', '#0af', '#77daff', '#2962FF']
    ],
    [
        'bg' => '#0e6cc4',
        'accents' => ['#25a7d7', '#77daff', '#0af', '#1e88e5']
    ],
    [
        'bg' => '#1e88e5',
        'accents' => ['#2962FF', '#0e6cc4', '#25a7d7', '#77daff']
    ]
];

$scheme = $colors[array_rand($colors)];
?>

<div class="box rex-background">
    <div class="shape shape1"></div>
    <div class="shape shape2"></div>
    <div class="shape shape3"></div>
    <div class="shape shape4"></div>
    <div class="light-spot"></div>
</div>

<style>
:root {
    --bg-primary: <?= $scheme['bg'] ?>;
    --accent1: <?= $scheme['accents'][0] ?>;
    --accent2: <?= $scheme['accents'][1] ?>;
    --accent3: <?= $scheme['accents'][2] ?>;
    --accent4: <?= $scheme['accents'][3] ?>;
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
    width: 100vw;
    height: 100vh;
    opacity: 0.3;
    top: 0;
    left: 0;
    transform-origin: center;
    z-index: -1;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

.shape1 {
    background: var(--accent1);
    animation: float 30s infinite ease-in-out;
}

.shape2 {
    background: var(--accent2);
    animation: float 35s infinite ease-in-out reverse;
}

.shape3 {
    background: var(--accent3);
    animation: float 40s infinite ease-in-out;
    animation-delay: -10s;
}

.shape4 {
    background: var(--accent4);
    animation: float 45s infinite ease-in-out reverse;
    animation-delay: -20s;
}

.light-spot {
    position: fixed;
    width: 800px;
    height: 800px;
    background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(119,218,255,0.1) 50%, rgba(255,255,255,0) 70%);
    pointer-events: none;
    mix-blend-mode: screen;
    z-index: 1;
}

@keyframes float {
    0%, 100% { transform: rotate(0deg) translate(0, 0); }
    25% { transform: rotate(90deg) translate(20vw, 20vh); }
    50% { transform: rotate(180deg) translate(-20vw, -10vh); }
    75% { transform: rotate(270deg) translate(-10vw, 15vh); }
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
        currentX += (mouseX - currentX) * 0.1;
        currentY += (mouseY - currentY) * 0.1;
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
