<?php
/**
 * @var rex_fragment $this
 * @psalm-scope-this rex_fragment
 */

class TimeBasedTheme {
    private $month;
    private $hour;
    
    private $seasons = [
        'winter' => [[12,1,2], [
            'bg' => '#1a3c64',
            'accents' => ['#2f5d8c', '#4682b4', '#b0c4de', '#e3f2fd'],
            'spot' => 'rgba(224,255,255,0.2)'
        ]],
        'spring' => [[3,4,5], [
            'bg' => '#2d8a6d',
            'accents' => ['#43c59e', '#3dd8a8', '#98ecb3', '#d1ffe3'],
            'spot' => 'rgba(209,255,227,0.2)'
        ]],
        'summer' => [[6,7,8], [
            'bg' => '#25a7d7',
            'accents' => ['#0e6cc4', '#0af', '#77daff', '#2962FF'],
            'spot' => 'rgba(119,218,255,0.2)'
        ]],
        'autumn' => [[9,10,11], [
            'bg' => '#c45d3c',
            'accents' => ['#e67e51', '#ff9b6a', '#ffb38a', '#ffd0b5'],
            'spot' => 'rgba(255,179,138,0.2)'
        ]]
    ];

    private $dayTimes = [
        'dawn' => [[5,6,7,8], [
            'opacity' => 0.4,
            'blur' => '15px',
            'spotIntensity' => 0.3
        ]],
        'day' => [[9,10,11,12,13,14,15], [
            'opacity' => 0.3,
            'blur' => '20px',
            'spotIntensity' => 0.2
        ]],
        'dusk' => [[16,17,18,19], [
            'opacity' => 0.5,
            'blur' => '25px',
            'spotIntensity' => 0.4
        ]],
        'night' => [[20,21,22,23,0,1,2,3,4], [
            'opacity' => 0.6,
            'blur' => '30px',
            'spotIntensity' => 0.5
        ]]
    ];

    public function __construct() {
        $this->month = (int)date('n');
        $this->hour = (int)date('G');
    }

    public function getCurrentSeason() {
        foreach ($this->seasons as $season => $data) {
            if (in_array($this->month, $data[0])) {
                return ['name' => $season, 'theme' => $data[1]];
            }
        }
    }

    public function getDayTime() {
        foreach ($this->dayTimes as $time => $data) {
            if (in_array($this->hour, $data[0])) {
                return ['name' => $time, 'settings' => $data[1]];
            }
        }
    }

    public function shouldSnow() {
        return $this->getCurrentSeason()['name'] === 'winter';
    }
}

$theme = new TimeBasedTheme();
$currentSeason = $theme->getCurrentSeason();
$currentTime = $theme->getDayTime();
$showSnow = $theme->shouldSnow();

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

function generateSnowflakes($count) {
    $snowflakes = [];
    for ($i = 0; $i < $count; $i++) {
        $snowflakes[] = [
            'left' => rand(0, 100),
            'size' => rand(2, 6),
            'delay' => rand(0, 15),
            'duration' => rand(10, 20)
        ];
    }
    return $snowflakes;
}

$snowflakes = $showSnow ? generateSnowflakes(50) : [];
?>

<div class="box rex-background">
    <?php for ($i = 0; $i < 4; $i++): ?>
        <div class="shape shape<?= ($i + 1) ?>" style="
            width: <?= $sizes[$i]['width'] ?>;
            height: <?= $sizes[$i]['height'] ?>;
            top: <?= $sizes[$i]['top'] ?>;
            left: <?= $sizes[$i]['left'] ?>;
            transform: rotate(<?= $sizes[$i]['rotation'] ?>deg) scale(<?= $sizes[$i]['scale'] ?>);
            opacity: <?= $currentTime['settings']['opacity'] ?>;
            backdrop-filter: blur(<?= $currentTime['settings']['blur'] ?>);
            -webkit-backdrop-filter: blur(<?= $currentTime['settings']['blur'] ?>);
        "></div>
    <?php endfor; ?>
    
    <?php if ($showSnow): ?>
    <div class="snow-container">
        <?php foreach ($snowflakes as $flake): ?>
        <div class="snowflake" style="
            left: <?= $flake['left'] ?>%;
            width: <?= $flake['size'] ?>px;
            height: <?= $flake['size'] ?>px;
            animation-delay: -<?= $flake['delay'] ?>s;
            animation-duration: <?= $flake['duration'] ?>s;
        "></div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    
    <div class="light-spot"></div>
    <div class="glow glow1"></div>
    <div class="glow glow2"></div>
</div>

<style>
:root {
    --bg-primary: <?= $currentSeason['theme']['bg'] ?>;
    --accent1: <?= $currentSeason['theme']['accents'][0] ?>;
    --accent2: <?= $currentSeason['theme']['accents'][1] ?>;
    --accent3: <?= $currentSeason['theme']['accents'][2] ?>;
    --accent4: <?= $currentSeason['theme']['accents'][3] ?>;
    --spot-color: <?= $currentSeason['theme']['spot'] ?>;
    --spot-intensity: <?= $currentTime['settings']['spotIntensity'] ?>;
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
    transform-origin: center;
    z-index: -1;
    transition: all 0.5s ease-out;
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

.snow-container {
    position: fixed;
    width: 100vw;
    height: 100vh;
    top: 0;
    left: 0;
    z-index: 2;
    pointer-events: none;
}

.snowflake {
    position: absolute;
    background: white;
    border-radius: 50%;
    opacity: 0.8;
    animation: snowfall linear infinite;
}

.light-spot {
    position: fixed;
    width: 800px;
    height: 800px;
    background: radial-gradient(
        circle, 
        rgba(255,255,255,calc(0.2 * var(--spot-intensity))) 0%, 
        var(--spot-color) 50%, 
        rgba(255,255,255,0) 70%
    );
    pointer-events: none;
    mix-blend-mode: screen;
    z-index: 1;
    filter: blur(3px);
}

.glow {
    position: fixed;
    width: 150vw;
    height: 150vh;
    background: radial-gradient(
        circle, 
        var(--spot-color) 0%, 
        rgba(255,255,255,0) 70%
    );
    pointer-events: none;
    mix-blend-mode: screen;
    opacity: calc(0.4 * var(--spot-intensity));
    animation: pulse 8s infinite ease-in-out;
    filter: blur(5px);
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

@keyframes snowfall {
    0% {
        transform: translateY(-10vh) translateX(-20px);
        opacity: 0;
    }
    20% {
        opacity: 0.8;
    }
    100% {
        transform: translateY(110vh) translateX(20px);
        opacity: 0.2;
    }
}

@keyframes pulse {
    0%, 100% { opacity: calc(0.4 * var(--spot-intensity)); transform: scale(1); }
    50% { opacity: calc(0.6 * var(--spot-intensity)); transform: scale(1.1); }
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
