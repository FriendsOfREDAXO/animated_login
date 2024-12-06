<?php
/**
 * @var rex_fragment $this
 * @psalm-scope-this rex_fragment
 */

// Prüfen ob wir uns im Winterzeitraum befinden (6. Dezember bis 24. Februar)
$currentDate = new DateTime();
$winterStart = new DateTime('December 6');
$winterEnd = new DateTime('February 24');

// Stelle sicher, dass der Winterstart im gleichen Jahr oder Vorjahr liegt
if ($currentDate < $winterStart) {
    $winterStart->modify('-1 year');
}

$isWinter = $currentDate >= $winterStart && $currentDate <= $winterEnd;

// Prüfe ob es Tag oder Nacht ist (zwischen 18:00 und 06:00 = Nacht)
$hour = (int)$currentDate->format('H');
$isNight = $hour >= 18 || $hour < 6;

// Farbpaletten für Tag und Nacht
$dayColors = [
    ['bg' => '#25a7d7', 'accents' => ['#0e6cc4', '#0af', '#77daff', '#2962FF'], 'spot' => 'rgba(119,218,255,0.1)'],
    ['bg' => '#0e6cc4', 'accents' => ['#25a7d7', '#39d353', '#0af', '#1e88e5'], 'spot' => 'rgba(57,211,83,0.1)'],
    ['bg' => '#1e88e5', 'accents' => ['#2962FF', '#2ea043', '#25a7d7', '#77daff'], 'spot' => 'rgba(46,160,67,0.1)']
];

$nightColors = [
    ['bg' => '#1a237e', 'accents' => ['#0d47a1', '#1565c0', '#0277bd', '#01579b'], 'spot' => 'rgba(13,71,161,0.1)'],
    ['bg' => '#0d47a1', 'accents' => ['#1a237e', '#283593', '#1565c0', '#0277bd'], 'spot' => 'rgba(26,35,126,0.1)'],
    ['bg' => '#283593', 'accents' => ['#1a237e', '#0d47a1', '#1565c0', '#01579b'], 'spot' => 'rgba(13,71,161,0.1)']
];

$colors = $isNight ? $nightColors : $dayColors;
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
    
    <?php if ($isWinter): ?>
        <div class="snowfall"></div>
    <?php endif; ?>
    
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
    transition: background-color 1s ease;
}

.box {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
}

/* Bestehende Styles für shapes, etc. */
.shape {
    position: fixed;
    opacity: 0.3;
    transform-origin: center;
    z-index: -1;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    transition: all 0.5s ease-out;
}

/* Schneeflocken-Animation */
.snowfall {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    pointer-events: none;
    z-index: 1000;
    background-image: 
        radial-gradient(2px 2px at 20px 30px, #fff, rgba(0,0,0,0)),
        radial-gradient(2px 2px at 40px 70px, #fff, rgba(0,0,0,0)),
        radial-gradient(2px 2px at 50px 160px, #fff, rgba(0,0,0,0)),
        radial-gradient(2px 2px at 90px 40px, #fff, rgba(0,0,0,0)),
        radial-gradient(2px 2px at 130px 80px, #fff, rgba(0,0,0,0)),
        radial-gradient(2px 2px at 160px 120px, #fff, rgba(0,0,0,0));
    background-repeat: repeat;
    animation: snowfall 10s linear infinite;
}

@keyframes snowfall {
    0% { background-position: 0px 0px, 0px 0px, 0px 0px, 0px 0px, 0px 0px, 0px 0px; }
    100% { 
        background-position: 
            500px 1000px, 
            400px 900px, 
            300px 800px, 
            200px 700px,
            100px 600px,
            0px 500px; 
    }
}

/* Bestehende Animationen und weitere Styles bleiben gleich */
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
    opacity: <?= $isNight ? '0.3' : '0.4' ?>;
    animation: pulse 8s infinite ease-in-out;
}

/* Rest der bestehenden Styles... */
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
