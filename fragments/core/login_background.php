<?php
/**
 * @var rex_fragment $this
 * @psalm-scope-this rex_fragment
 */

// Prüfen ob wir uns im Winterzeitraum befinden (6. Dezember bis 24. Februar)
$currentDate = new DateTime();
$currentMonth = (int)$currentDate->format('n');
$currentDay = (int)$currentDate->format('j');

// Winter ist aktiv wenn:
// - Dezember (Monat 12) nach dem 6. Tag
// - Januar (Monat 1) komplett
// - Februar (Monat 2) bis einschließlich 24. Tag
$isWinter = ($currentMonth === 12 && $currentDay >= 6) ||
            ($currentMonth === 1) ||
            ($currentMonth === 2 && $currentDay <= 24);

// Für Testzwecke auf true setzen
$isWinter = true;

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
    
        <div class="snowfall"></div>
    
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

.snowfall {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1000;
}

.snowfall {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 2;
}

.individual-snowflake {
    position: fixed;
    width: 4px;
    height: 4px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    pointer-events: none;
    z-index: 2;
}

.accumulated-snow {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background: linear-gradient(180deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
    transition: height 0.3s ease-out;
    border-radius: 3px 3px 0 0;
    z-index: 3;
}

.sliding-snow {
    position: absolute;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 50%;
    animation: slide-down 1s ease-in forwards;
    z-index: 2;
}

@keyframes slide-down {
    0% {
        transform: translateY(0) translateX(0);
        opacity: 0.7;
    }
    100% {
        transform: translateY(100px) translateX(50px);
        opacity: 0;
    }
}

.snowfall::before, .snowfall::after {
    content: '';
    position: fixed;
    top: -100vh;
    left: 0;
    width: 100vw;
    height: 200vh;
    background-image: 
        radial-gradient(3px 3px at 20% 30%, rgba(255, 255, 255, 0.8) 50%, transparent),
        radial-gradient(2px 2px at 40% 70%, rgba(255, 255, 255, 0.6) 50%, transparent),
        radial-gradient(4px 4px at 60% 40%, rgba(255, 255, 255, 0.9) 50%, transparent),
        radial-gradient(2px 2px at 80% 60%, rgba(255, 255, 255, 0.7) 50%, transparent),
        radial-gradient(3px 3px at 30% 20%, rgba(255, 255, 255, 0.8) 50%, transparent),
        radial-gradient(2px 2px at 70% 50%, rgba(255, 255, 255, 0.6) 50%, transparent),
        radial-gradient(4px 4px at 90% 80%, rgba(255, 255, 255, 0.9) 50%, transparent);
    animation: snowfall 10s linear infinite;
    will-change: transform;
    background-size: 100% 100%;
}

.snowfall::after {
    background-image: 
        radial-gradient(3px 3px at 10% 40%, rgba(255, 255, 255, 0.8) 50%, transparent),
        radial-gradient(2px 2px at 30% 80%, rgba(255, 255, 255, 0.6) 50%, transparent),
        radial-gradient(4px 4px at 50% 30%, rgba(255, 255, 255, 0.9) 50%, transparent),
        radial-gradient(2px 2px at 70% 90%, rgba(255, 255, 255, 0.7) 50%, transparent),
        radial-gradient(3px 3px at 20% 10%, rgba(255, 255, 255, 0.8) 50%, transparent),
        radial-gradient(2px 2px at 60% 60%, rgba(255, 255, 255, 0.6) 50%, transparent),
        radial-gradient(4px 4px at 80% 70%, rgba(255, 255, 255, 0.9) 50%, transparent);
    animation: snowfall 15s linear infinite;
    animation-delay: -5s;
}

@keyframes snowfall {
    0% {
        transform: translateY(0) rotate(0deg);
    }
    100% {
        transform: translateY(100vh) rotate(360deg);
    }
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
    0%, 100% { opacity: <?= $isNight ? '0.3' : '0.4' ?>; transform: scale(1); }
    50% { opacity: <?= $isNight ? '0.4' : '0.6' ?>; transform: scale(1.1); }
}

/* Footer Styles */
.rex-global-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    padding: 1rem;
    z-index: 1000;
}

.rex-nav-footer .list-inline {
    margin: 0;
    padding: 0;
    list-style: none;
    text-align: center;
}

.rex-nav-footer .list-inline li {
    display: inline-block;
    margin: 0 1rem;
}

.rex-nav-footer a {
    color: #fff;
    text-decoration: none;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.rex-nav-footer a:hover {
    opacity: 1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Spot animation
    const spot = document.querySelector('.light-spot');
    let mouseX = window.innerWidth / 2;
    let mouseY = window.innerHeight / 2;
    let currentX = mouseX;
    let currentY = mouseY;

    // Schnee-Akkumulation Setup
    const sections = document.querySelectorAll('.rex-page-section');
    const snowLayers = new Map();
    const maxSnowHeight = 30; // Maximale Schneehöhe in Pixeln
    const snowSlideThreshold = 25; // Ab dieser Höhe beginnt der Schnee abzurutschen

    // Erstelle für jede Section einen Schnee-Layer
    sections.forEach(section => {
        const snowLayer = document.createElement('div');
        snowLayer.className = 'accumulated-snow';
        section.style.position = 'relative';
        section.appendChild(snowLayer);
        snowLayers.set(section, {
            element: snowLayer,
            height: 0,
            snow: []
        });
    });

    // Schneeflocken erstellen und fallen lassen
    function createSnowflake() {
        const snowflake = document.createElement('div');
        snowflake.className = 'individual-snowflake';
        snowflake.style.left = Math.random() * 100 + 'vw';
        snowflake.style.animationDuration = (Math.random() * 3 + 2) + 's';
        document.querySelector('.snowfall').appendChild(snowflake);

        // Verfolge die Position der Schneeflocke
        let currentY = -10;
        let falling = true;

        function updateSnowflake() {
            if (!falling) return;

            currentY += 1;
            snowflake.style.top = currentY + 'px';

            // Prüfe Kollision mit Sections
            sections.forEach(section => {
                const sectionRect = section.getBoundingClientRect();
                const snowflakeRect = snowflake.getBoundingClientRect();

                if (falling &&
                    snowflakeRect.bottom >= sectionRect.top &&
                    snowflakeRect.top <= sectionRect.bottom &&
                    snowflakeRect.left >= sectionRect.left &&
                    snowflakeRect.right <= sectionRect.right) {
                    
                    falling = false;
                    snowflake.remove();

                    // Akkumuliere Schnee
                    const layerData = snowLayers.get(section);
                    layerData.height = Math.min(layerData.height + 0.5, maxSnowHeight);
                    layerData.element.style.height = layerData.height + 'px';

                    // Prüfe ob Schnee abrutschen soll
                    if (layerData.height >= snowSlideThreshold) {
                        slideSnow(section, layerData);
                    }
                }
            });

            if (falling && currentY < window.innerHeight) {
                requestAnimationFrame(updateSnowflake);
            } else if (falling) {
                snowflake.remove();
            }
        }

        requestAnimationFrame(updateSnowflake);
    }

    // Schnee abrutschen lassen
    function slideSnow(section, layerData) {
        const slideAmount = Math.random() * 5 + 5;
        layerData.height = Math.max(0, layerData.height - slideAmount);
        layerData.element.style.height = layerData.height + 'px';

        // Visueller Effekt für das Abrutschen
        const slidingSnow = document.createElement('div');
        slidingSnow.className = 'sliding-snow';
        section.appendChild(slidingSnow);

        setTimeout(() => {
            slidingSnow.remove();
        }, 1000);
    }

    // Schneeflocken periodisch erstellen
    setInterval(createSnowflake, 100);

    // Spot animation
    const animate = () => {
        currentX += (mouseX - currentX) * 0.05;
        currentY += (mouseY - currentY) * 0.05;
        if (spot) {
            spot.style.transform = `translate(${currentX}px, ${currentY}px) translate(-50%, -50%)`;
        }
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
