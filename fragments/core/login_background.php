<script>
document.addEventListener('DOMContentLoaded', () => {
    // Spot-Animation
    const spot = document.querySelector('.light-spot');
    let mouseX = window.innerWidth / 2;
    let mouseY = window.innerHeight / 2;
    let currentX = mouseX;
    let currentY = mouseY;

    // Schneefall-System
    if (document.querySelector('.snow-container')) {
        const snowContainer = document.querySelector('.snow-container');
        const landedSnowContainer = document.createElement('div');
        landedSnowContainer.className = 'landed-snow-container';
        snowContainer.appendChild(landedSnowContainer);

        const SEGMENT_COUNT = 50;
        const segments = new Array(SEGMENT_COUNT).fill(0);
        const MAX_SNOW_HEIGHT = 80;
        let totalSnowflakes = 0;

        function createLandedSnowflake(x, size) {
            const snowflake = document.createElement('div');
            snowflake.className = 'landed-snowflake';
            const segmentIndex = Math.floor((x / window.innerWidth) * SEGMENT_COUNT);
            
            if (segments[segmentIndex] < MAX_SNOW_HEIGHT) {
                const xPos = x;
                const yPos = segments[segmentIndex];
                
                snowflake.style.cssText = `
                    left: ${xPos}px;
                    bottom: ${yPos}px;
                    width: ${size}px;
                    height: ${size}px;
                    z-index: ${Math.floor(yPos)};
                `;
                
                landedSnowContainer.appendChild(snowflake);
                segments[segmentIndex] += size * 0.5;
                totalSnowflakes++;

                // Automatisches Abrutschen bei zu viel Schnee
                if (segments[segmentIndex] > MAX_SNOW_HEIGHT * 0.8) {
                    const diff = segments[segmentIndex] - (MAX_SNOW_HEIGHT * 0.7);
                    // Verteile überschüssigen Schnee auf Nachbarsegmente
                    if (segmentIndex > 0) {
                        segments[segmentIndex - 1] += diff * 0.3;
                    }
                    if (segmentIndex < SEGMENT_COUNT - 1) {
                        segments[segmentIndex + 1] += diff * 0.3;
                    }
                    segments[segmentIndex] = MAX_SNOW_HEIGHT * 0.7;
                }
            }
        }

        // Schneeflocken beobachten
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting && entry.boundingClientRect.bottom > window.innerHeight - MAX_SNOW_HEIGHT) {
                    const snowflake = entry.target;
                    const rect = snowflake.getBoundingClientRect();
                    const size = parseFloat(snowflake.style.width);
                    
                    // Erstelle gelandete Schneeflocke
                    createLandedSnowflake(rect.left, size);
                    
                    // Setze fallende Schneeflocke zurück
                    snowflake.style.left = Math.random() * 100 + '%';
                    snowflake.style.top = '-5vh';
                }
            });
        }, {
            threshold: 0,
            rootMargin: '0px 0px -50px 0px'
        });

        // Beobachte alle Schneeflocken
        document.querySelectorAll('.snowflake').forEach(snowflake => {
            if (!snowflake.isObserved) {
                observer.observe(snowflake);
                snowflake.isObserved = true;
            }
        });
    }

    // Spot animation
    function animate() {
        currentX += (mouseX - currentX) * 0.05;
        currentY += (mouseY - currentY) * 0.05;
        if (spot) {
            spot.style.transform = `translate(${currentX}px, ${currentY}px) translate(-50%, -50%)`;
        }
        requestAnimationFrame(animate);
    }

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    animate();
});
</script><?php
/**
 * @var rex_fragment $this
 * @psalm-scope-this rex_fragment
 */

class TimeBasedTheme {
    private $month;
    private $hour;
    
    private $seasons = [
        'winter' => [[12,1,2], [
            'day' => [
                ['bg' => '#1a3c64', 'accents' => ['#2f5d8c', '#4682b4', '#b0c4de', '#e3f2fd'], 'spot' => 'rgba(224,255,255,0.2)'],
                ['bg' => '#2B4570', 'accents' => ['#3E6396', '#5A8AC6', '#7AA2D4', '#A1C6E7'], 'spot' => 'rgba(161,198,231,0.2)'],
                ['bg' => '#1F3F66', 'accents' => ['#2C5C94', '#4378B4', '#6A9AD1', '#8FB8E3'], 'spot' => 'rgba(143,184,227,0.2)']
            ],
            'night' => [
                ['bg' => '#0a1a2f', 'accents' => ['#142d44', '#1e4059', '#2c5272', '#3a678c'], 'spot' => 'rgba(58,103,140,0.15)'],
                ['bg' => '#0d1f38', 'accents' => ['#17324d', '#224662', '#305b7a', '#3e7093'], 'spot' => 'rgba(62,112,147,0.15)'],
                ['bg' => '#081526', 'accents' => ['#11283f', '#1b3b55', '#284e6c', '#356283'], 'spot' => 'rgba(53,98,131,0.15)']
            ]
        ]],
        'spring' => [[3,4,5], [
            'day' => [
                ['bg' => '#2d8a6d', 'accents' => ['#43c59e', '#3dd8a8', '#98ecb3', '#d1ffe3'], 'spot' => 'rgba(209,255,227,0.2)'],
                ['bg' => '#3B7A59', 'accents' => ['#4FAB7B', '#65C693', '#8CE0B1', '#B3F5CF'], 'spot' => 'rgba(179,245,207,0.2)'],
                ['bg' => '#256B4F', 'accents' => ['#368C6A', '#4CB389', '#71D1A7', '#96E8C5'], 'spot' => 'rgba(150,232,197,0.2)']
            ],
            'night' => [
                ['bg' => '#1a4d3d', 'accents' => ['#246852', '#2e8668', '#38a47e', '#42c294'], 'spot' => 'rgba(66,194,148,0.15)'],
                ['bg' => '#143c30', 'accents' => ['#1d5744', '#267258', '#2f8d6c', '#38a880'], 'spot' => 'rgba(56,168,128,0.15)'],
                ['bg' => '#0f2f26', 'accents' => ['#174938', '#1f634a', '#277d5c', '#2f976e'], 'spot' => 'rgba(47,151,110,0.15)']
            ]
        ]],
        'summer' => [[6,7,8], [
            'day' => [
                ['bg' => '#25a7d7', 'accents' => ['#0e6cc4', '#0af', '#77daff', '#2962FF'], 'spot' => 'rgba(119,218,255,0.2)'],
                ['bg' => '#1E95C4', 'accents' => ['#0D5EAF', '#09F', '#66D1FF', '#1E88E5'], 'spot' => 'rgba(102,209,255,0.2)'],
                ['bg' => '#1C83B0', 'accents' => ['#0C509A', '#08E', '#55C8FF', '#1976D2'], 'spot' => 'rgba(85,200,255,0.2)']
            ],
            'night' => [
                ['bg' => '#0a3b4d', 'accents' => ['#0e4d64', '#125f7b', '#167192', '#1a83a9'], 'spot' => 'rgba(26,131,169,0.15)'],
                ['bg' => '#082e3d', 'accents' => ['#0b3e52', '#0e4e67', '#115e7c', '#146e91'], 'spot' => 'rgba(20,110,145,0.15)'],
                ['bg' => '#06222d', 'accents' => ['#082f3d', '#0a3c4d', '#0c495d', '#0e566d'], 'spot' => 'rgba(14,86,109,0.15)']
            ]
        ]],
        'autumn' => [[9,10,11], [
            'day' => [
                ['bg' => '#c45d3c', 'accents' => ['#e67e51', '#ff9b6a', '#ffb38a', '#ffd0b5'], 'spot' => 'rgba(255,179,138,0.2)'],
                ['bg' => '#B54E2F', 'accents' => ['#D96B40', '#F58755', '#FFAA82', '#FFC7AD'], 'spot' => 'rgba(255,170,130,0.2)'],
                ['bg' => '#A64428', 'accents' => ['#CC5835', '#EB7644', '#FF9D75', '#FFBEA0'], 'spot' => 'rgba(255,157,117,0.2)']
            ],
            'night' => [
                ['bg' => '#4d251a', 'accents' => ['#662f21', '#7f3928', '#99432f', '#b24d36'], 'spot' => 'rgba(178,77,54,0.15)'],
                ['bg' => '#3d1d14', 'accents' => ['#52261a', '#672f20', '#7c3826', '#91412c'], 'spot' => 'rgba(145,65,44,0.15)'],
                ['bg' => '#2d1510', 'accents' => ['#3d1c15', '#4d231a', '#5d2a1f', '#6d3124'], 'spot' => 'rgba(109,49,36,0.15)']
            ]
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
                $timeOfDay = $this->isNight() ? 'night' : 'day';
                // Wähle zufällig eine Farbpalette aus dem entsprechenden Tag/Nacht-Array
                $palettes = $data[1][$timeOfDay];
                $randomPalette = $palettes[array_rand($palettes)];
                return ['name' => $season, 'theme' => $randomPalette];
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

    public function isNight() {
        return in_array($this->hour, $this->dayTimes['night'][0]);
    }
}

$theme = new TimeBasedTheme();
$currentSeason = $theme->getCurrentSeason();
$currentTime = $theme->getDayTime();
$showSnow = $theme->shouldSnow();
$isNight = $theme->isNight();

// Hintergrund-Formen generieren
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

// Schneeflocken generieren
function generateSnowflakes($count) {
    $snowflakes = [];
    for ($i = 0; $i < $count; $i++) {
        $snowflakes[] = [
            'size' => rand(3, 8) / 2, // Feinere Größenabstufung zwischen 1.5 und 4px
            'left' => rand(-20, 120),
            'opacity' => (rand(60, 90) / 100),
            'delay' => (rand(0, 500) / 100),
            'duration' => rand(8, 20),
            'sway' => rand(10, 50) / 10 // Schwankungsstärke
        ];
    }
    return $snowflakes;
}

$snowflakes = $showSnow ? generateSnowflakes(150) : [];
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
        <div class="snow-layer back"></div>
        <div class="snow-layer middle"></div>
        <div class="snow-layer front"></div>
        <?php foreach ($snowflakes as $flake): ?>
        <div class="snowflake" style="
            width: <?= $flake['size'] ?>px;
            height: <?= $flake['size'] ?>px;
            left: <?= $flake['left'] ?>%;
            opacity: <?= $flake['opacity'] ?>;
            animation: snowfall <?= $flake['duration'] ?>s linear infinite;
            animation-delay: -<?= $flake['delay'] ?>s;
            --sway: <?= $flake['sway'] ?>px;
        "></div>
        <?php endforeach; ?>
        <div class="snow-ground"></div>
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
    --snow-color: <?= $isNight ? 'rgba(210,220,255,0.9)' : 'rgba(255,255,255,0.9)' ?>;
    --snow-shadow: <?= $isNight ? 'rgba(70,130,180,0.2)' : 'rgba(200,200,255,0.2)' ?>;
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

.shape1 { background: var(--accent1); animation: float 60s infinite ease-in-out; }
.shape2 { background: var(--accent2); animation: float 75s infinite ease-in-out reverse; }
.shape3 { background: var(--accent3); animation: float 90s infinite ease-in-out; animation-delay: -30s; }
.shape4 { background: var(--accent4); animation: float 85s infinite ease-in-out reverse; animation-delay: -45s; }

/* Schnee-Container und Ebenen */
.snow-container {
    position: fixed;
    width: 100vw;
    height: 100vh;
    top: 0;
    left: 0;
    pointer-events: none;
    z-index: 2;
    perspective: 100px;
    perspective-origin: 50% 50%;
}

.snow-layer {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 20px 30px, var(--snow-color), transparent),
        radial-gradient(2px 2px at 40px 70px, var(--snow-color), transparent),
        radial-gradient(3px 3px at 50px 160px, var(--snow-color), transparent),
        radial-gradient(2px 2px at 90px 40px, var(--snow-color), transparent),
        radial-gradient(2px 2px at 130px 80px, var(--snow-color), transparent),
        radial-gradient(3px 3px at 160px 120px, var(--snow-color), transparent);
    background-repeat: repeat;
    animation: snow-layer linear infinite;
}

.snow-layer.back {
    opacity: 0.6;
    animation-duration: 35s;
    transform: translateZ(-100px) scale(2);
}

.snow-layer.middle {
    opacity: 0.8;
    animation-duration: 25s;
    transform: translateZ(-50px) scale(1.5);
}

.snow-layer.front {
    opacity: 1;
    animation-duration: 15s;
    transform: translateZ(0) scale(1);
}

/* Einzelne Schneeflocken */
.snowflake {
    position: absolute;
    background: var(--snow-color);
    border-radius: 50%;
    box-shadow: 0 0 2px var(--snow-shadow);
    pointer-events: none;
    transform-origin: center;
    will-change: transform;
}

/* Akkumulierter Schnee am Boden */
.landed-snow-container {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100px;
    pointer-events: none;
    z-index: 3;
}

.landed-snowflake {
    position: absolute;
    background: var(--snow-color);
    border-radius: 50%;
    box-shadow: 0 2px 5px var(--snow-shadow);
    animation: snowLanding 0.5s ease-out;
    pointer-events: none;
}

@keyframes snowLanding {
    0% {
        transform: scale(0.5) translateY(-10px);
        opacity: 0.5;
    }
    50% {
        transform: scale(1.2) translateY(2px);
        opacity: 0.8;
    }
    100% {
        transform: scale(1) translateY(0);
        opacity: 1;
    }
}

/* Lichteffekte */
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
}

.glow1 { top: -25vh; left: -25vw; animation-delay: -4s; }
.glow2 { bottom: -25vh; right: -25vw; }

/* Animationen */
@keyframes float {
    0%, 100% { transform: rotate(<?= rand(-45, 45) ?>deg) translate(0, 0) scale(1); }
    25% { transform: rotate(<?= rand(30, 60) ?>deg) translate(<?= rand(5, 15) ?>vw, <?= rand(5, 15) ?>vh) scale(<?= (rand(90, 110) / 100) ?>); }
    50% { transform: rotate(<?= rand(75, 105) ?>deg) translate(<?= rand(-15, -5) ?>vw, <?= rand(-10, -5) ?>vh) scale(<?= (rand(90, 110) / 100) ?>); }
    75% { transform: rotate(<?= rand(30, 60) ?>deg) translate(<?= rand(-10, -5) ?>vw, <?= rand(5, 10) ?>vh) scale(<?= (rand(90, 110) / 100) ?>); }
}

@keyframes snow-layer {
    from { transform: translateY(-100%) rotate(0deg); }
    to { transform: translateY(100%) rotate(360deg); }
}

@keyframes snowfall {
    0% {
        transform: translateY(-10vh) translateX(calc(var(--sway) * -1));
    }
    25% {
        transform: translateY(25vh) translateX(var(--sway));
    }
    50% {
        transform: translateY(50vh) translateX(calc(var(--sway) * -0.5));
    }
    75% {
        transform: translateY(75vh) translateX(var(--sway));
    }
    100% {
        transform: translateY(110vh) translateX(calc(var(--sway) * -1));
    }
}

@keyframes snow-accumulate {
    from { transform: scaleY(0); }
    to { transform: scaleY(1); }
}

@keyframes pulse {
    0%, 100% { opacity: calc(0.4 * var(--spot-intensity)); transform: scale(1); }
    50% { opacity: calc(0.6 * var(--spot-intensity)); transform: scale(1.1); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Spot-Animation
    const spot = document.querySelector('.light-spot');
    let mouseX = window.innerWidth / 2;
    let mouseY = window.innerHeight / 2;
    let currentX = mouseX;
    let currentY = mouseY;

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

    // Schneefall-Optimierung
    if (document.querySelector('.snow-container')) {
        const snowContainer = document.querySelector('.snow-container');
        let snowHeight = 0;
        const maxSnowHeight = 50; // Maximale Schneehöhe in Pixeln
        
        // Schneehöhen für verschiedene Bereiche
        const snowHeights = new Array(20).fill(0);
        const sections = document.querySelectorAll('.rex-page-section');
        
        // Schneeflocken beobachten
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const snowflake = entry.target;
                if (!entry.isIntersecting && entry.boundingClientRect.y > window.innerHeight) {
                    // Schneeflocke hat den unteren Bildschirmrand erreicht
                    const xPos = parseInt(snowflake.style.left);
                    const sectionIndex = Math.floor((xPos / window.innerWidth) * snowHeights.length);
                    
                    if (sectionIndex >= 0 && sectionIndex < snowHeights.length) {
                        // Schnee akkumulieren
                        if (snowHeights[sectionIndex] < maxSnowHeight) {
                            snowHeights[sectionIndex] += 0.5;
                            updateSnowGround();
                        }
                    }
                    
                    // Schneeflocke zurücksetzen
                    resetSnowflake(snowflake);
                }
            });
        }, {
            threshold: 0,
            rootMargin: '0px 0px -20px 0px'
        });

        // Schneeflocken zurücksetzen
        function resetSnowflake(snowflake) {
            const startLeft = Math.random() * 120 - 20; // -20 bis 100
            snowflake.style.left = `${startLeft}%`;
            snowflake.style.top = '-5vh';
            
            // Animation neu starten
            snowflake.style.animation = 'none';
            snowflake.offsetHeight; // Force reflow
            snowflake.style.animation = null;
        }

        // Schneeboden aktualisieren
        function updateSnowGround() {
            const ground = document.querySelector('.snow-ground');
            if (ground) {
                const maxHeight = Math.max(...snowHeights);
                ground.style.height = `${maxHeight}px`;
                
                // Wellenförmige Oberfläche erzeugen
                let gradient = 'linear-gradient(180deg, transparent 0%, var(--snow-color) 100%)';
                if (maxHeight > 5) {
                    const steps = snowHeights.map((height, i) => {
                        const percent = (height / maxHeight) * 100;
                        return `${(i / snowHeights.length) * 100}% ${100 - percent}%`;
                    }).join(', ');
                    gradient = `linear-gradient(180deg, transparent ${steps}, var(--snow-color) 100%)`;
                }
                ground.style.maskImage = gradient;
                ground.style.webkitMaskImage = gradient;
            }
        }

        // Initiale Schneeflocken beobachten
        document.querySelectorAll('.snowflake').forEach(snowflake => {
            observer.observe(snowflake);
        });

        // Periodisch neue Schneeflocken erzeugen
        setInterval(() => {
            const snowflakes = document.querySelectorAll('.snowflake');
            snowflakes.forEach(snowflake => {
                if (!snowflake.isObserved) {
                    observer.observe(snowflake);
                    snowflake.isObserved = true;
                }
            });
        }, 1000);

        // Performance-Optimierung
        document.querySelectorAll('.snowflake').forEach(snowflake => {
            snowflake.style.willChange = 'transform';
        });
    }

    // Start der Spot-Animation
    animate();
});</script>

<footer class="rex-global-footer">
  <nav class="rex-nav-footer">
    <ul class="list-inline">
      <li><a href="https://www.yakamara.de" target="_blank" rel="noreferrer noopener">yakamara.de</a></li>
      <li><a href="https://www.redaxo.org" target="_blank" rel="noreferrer noopener">redaxo.org</a></li>
    </ul>
  </nav>
</footer>
