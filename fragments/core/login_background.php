<?php

declare(strict_types=1);

/**
 * @var rex_fragment $this
 * @psalm-scope-this rex_fragment
 */
class TimeBasedTheme
{
    private int $month;
    private int $day;
    private int $hour;
    private int $year;

    /**
     * @var array<string, array{start: array{month: int, day: int}, end: array{month: int, day: int}, themes: array{day: array<int, array<string, mixed>>, night: array<int, array<string, mixed>>, lateDay?: array<int, array<string, mixed>>, lateNight?: array<int, array<string, mixed>>}}>
     */
    private array $seasons = [
        'winter' => [
            'start' => ['month' => 12, 'day' => 21],
            'end' => ['month' => 3, 'day' => 19],
            'themes' => [
                'day' => [
                    ['bg' => '#1a3c64', 'accents' => ['#2f5d8c', '#4682b4', '#b0c4de', '#e3f2fd'], 'spot' => 'rgba(224,255,255,0.2)'],
                    ['bg' => '#2B4570', 'accents' => ['#3E6396', '#5A8AC6', '#7AA2D4', '#A1C6E7'], 'spot' => 'rgba(161,198,231,0.2)'],
                    ['bg' => '#1F3F66', 'accents' => ['#2C5C94', '#4378B4', '#6A9AD1', '#8FB8E3'], 'spot' => 'rgba(143,184,227,0.2)'],
                    ['bg' => '#233E5C', 'accents' => ['#33578A', '#4A76AC', '#7FA6D6', '#C3DBF2'], 'spot' => 'rgba(195,219,242,0.2)']
                ],
                'night' => [
                    ['bg' => '#0a1a2f', 'accents' => ['#142d44', '#1e4059', '#2c5272', '#3a678c'], 'spot' => 'rgba(58,103,140,0.15)'],
                    ['bg' => '#0d1f38', 'accents' => ['#17324d', '#224662', '#305b7a', '#3e7093'], 'spot' => 'rgba(62,112,147,0.15)'],
                    ['bg' => '#081526', 'accents' => ['#11283f', '#1b3b55', '#284e6c', '#356283'], 'spot' => 'rgba(53,98,131,0.15)'],
                    ['bg' => '#0b1c33', 'accents' => ['#15304a', '#1f4560', '#335c7d', '#4a7599'], 'spot' => 'rgba(74,117,153,0.15)']
                ]
            ]
        ],
        'spring' => [
            'start' => ['month' => 3, 'day' => 20],
            'end' => ['month' => 6, 'day' => 20],
            // Fresh meadow green with buttery-yellow highlights - matches the
            // buttercup/tulip particles below. Explicitly not pink/magenta.
            'themes' => [
                'day' => [
                    ['bg' => '#4a8f3c', 'accents' => ['#7cbf4e', '#a9d967', '#d4ecab', '#fff3b0'], 'spot' => 'rgba(255,243,176,0.2)'],
                    ['bg' => '#3f7d33', 'accents' => ['#6bb047', '#9ecf5c', '#c8e896', '#fff6c2'], 'spot' => 'rgba(255,246,194,0.2)'],
                    ['bg' => '#568f3a', 'accents' => ['#82c150', '#abdb6e', '#d6f0a8', '#fff8c8'], 'spot' => 'rgba(255,248,200,0.2)'],
                    ['bg' => '#4d8636', 'accents' => ['#78b84a', '#a4d566', '#cfe9a0', '#fff4b8'], 'spot' => 'rgba(255,244,184,0.2)']
                ],
                'night' => [
                    ['bg' => '#1c3016', 'accents' => ['#2c4a20', '#3d642b', '#527f39', '#6a9a4c'], 'spot' => 'rgba(106,154,76,0.15)'],
                    ['bg' => '#152912', 'accents' => ['#25401c', '#345527', '#446f33', '#568942'], 'spot' => 'rgba(86,137,66,0.15)'],
                    ['bg' => '#122411', 'accents' => ['#1f3a1b', '#2c4f26', '#3a6432', '#48793f'], 'spot' => 'rgba(72,121,63,0.15)'],
                    ['bg' => '#193014', 'accents' => ['#28481f', '#385f2b', '#487638', '#598d46'], 'spot' => 'rgba(89,141,70,0.15)']
                ]
            ]
        ],
        'summer' => [
            'start' => ['month' => 6, 'day' => 21],
            'end' => ['month' => 9, 'day' => 21],
            'themes' => [
                'day' => [
                    ['bg' => '#25a7d7', 'accents' => ['#0e6cc4', '#0af', '#77daff', '#2962FF'], 'spot' => 'rgba(119,218,255,0.2)'],
                    ['bg' => '#1E95C4', 'accents' => ['#0D5EAF', '#09F', '#66D1FF', '#1E88E5'], 'spot' => 'rgba(102,209,255,0.2)'],
                    ['bg' => '#1C83B0', 'accents' => ['#0C509A', '#08E', '#55C8FF', '#1976D2'], 'spot' => 'rgba(85,200,255,0.2)'],
                    ['bg' => '#22A0C9', 'accents' => ['#0F63AE', '#12A6EE', '#83DFFF', '#3A78E0'], 'spot' => 'rgba(131,223,255,0.2)']
                ],
                'night' => [
                    ['bg' => '#0a3b4d', 'accents' => ['#0e4d64', '#125f7b', '#167192', '#1a83a9'], 'spot' => 'rgba(26,131,169,0.15)'],
                    ['bg' => '#082e3d', 'accents' => ['#0b3e52', '#0e4e67', '#115e7c', '#146e91'], 'spot' => 'rgba(20,110,145,0.15)'],
                    ['bg' => '#06222d', 'accents' => ['#082f3d', '#0a3c4d', '#0c495d', '#0e566d'], 'spot' => 'rgba(14,86,109,0.15)'],
                    ['bg' => '#093344', 'accents' => ['#0d4459', '#11556e', '#156683', '#197798'], 'spot' => 'rgba(25,119,152,0.15)']
                ],
                // Late summer (August into the equinox) trades the clear blue for a
                // golden, harvest-warm yellow-orange mood.
                'lateDay' => [
                    ['bg' => '#D98C2B', 'accents' => ['#F2A93C', '#FFC65C', '#FFDD94', '#FFF0C2'], 'spot' => 'rgba(255,221,148,0.2)'],
                    ['bg' => '#C97B24', 'accents' => ['#E89A3D', '#F5B85C', '#FFCE85', '#FFE7B8'], 'spot' => 'rgba(255,206,133,0.2)'],
                    ['bg' => '#E0993A', 'accents' => ['#F0B24E', '#FFCB6E', '#FFDE9B', '#FFF2CE'], 'spot' => 'rgba(255,222,155,0.2)'],
                    ['bg' => '#CC7A1F', 'accents' => ['#E3953A', '#F5B559', '#FFCF82', '#FFE6B2'], 'spot' => 'rgba(255,207,130,0.2)']
                ],
                'lateNight' => [
                    ['bg' => '#3d2410', 'accents' => ['#6b3d1a', '#96551f', '#c17527', '#e0a94a'], 'spot' => 'rgba(224,169,74,0.15)'],
                    ['bg' => '#33200f', 'accents' => ['#5c3618', '#82501f', '#ab6f28', '#d29a4a'], 'spot' => 'rgba(210,154,74,0.15)'],
                    ['bg' => '#452a13', 'accents' => ['#754321', '#9d602a', '#c68136', '#e6ab5c'], 'spot' => 'rgba(230,171,92,0.15)'],
                    ['bg' => '#382110', 'accents' => ['#63391b', '#8a5324', '#b3722e', '#d99a52'], 'spot' => 'rgba(217,154,82,0.15)']
                ]
            ]
        ],
        'autumn' => [
            'start' => ['month' => 9, 'day' => 22],
            'end' => ['month' => 12, 'day' => 20],
            'themes' => [
                'day' => [
                    ['bg' => '#c45d3c', 'accents' => ['#e67e51', '#ff9b6a', '#ffb38a', '#ffd0b5'], 'spot' => 'rgba(255,179,138,0.2)'],
                    ['bg' => '#B54E2F', 'accents' => ['#D96B40', '#F58755', '#FFAA82', '#FFC7AD'], 'spot' => 'rgba(255,170,130,0.2)'],
                    ['bg' => '#A64428', 'accents' => ['#CC5835', '#EB7644', '#FF9D75', '#FFBEA0'], 'spot' => 'rgba(255,157,117,0.2)'],
                    ['bg' => '#BD5433', 'accents' => ['#DE7248', '#F2924F', '#FFB07A', '#FFD3A8'], 'spot' => 'rgba(255,176,122,0.2)']
                ],
                'night' => [
                    ['bg' => '#4d251a', 'accents' => ['#662f21', '#7f3928', '#99432f', '#b24d36'], 'spot' => 'rgba(178,77,54,0.15)'],
                    ['bg' => '#3d1d14', 'accents' => ['#52261a', '#672f20', '#7c3826', '#91412c'], 'spot' => 'rgba(145,65,44,0.15)'],
                    ['bg' => '#2d1510', 'accents' => ['#3d1c15', '#4d231a', '#5d2a1f', '#6d3124'], 'spot' => 'rgba(109,49,36,0.15)'],
                    ['bg' => '#422016', 'accents' => ['#582a1e', '#6e3426', '#843e2e', '#9a4836'], 'spot' => 'rgba(154,72,54,0.15)']
                ]
            ]
        ]
    ];

    /**
     * @var array<string, array{0: int[], 1: array{opacity: float, blur: string, spotIntensity: float}}>
     */
    private array $dayTimes = [
        'dawn' => [[5, 6, 7, 8], [
            'opacity' => 0.4,
            'blur' => '15px',
            'spotIntensity' => 0.3
        ]],
        'day' => [[9, 10, 11, 12, 13, 14, 15], [
            'opacity' => 0.3,
            'blur' => '20px',
            'spotIntensity' => 0.2
        ]],
        'dusk' => [[16, 17, 18, 19], [
            'opacity' => 0.5,
            'blur' => '25px',
            'spotIntensity' => 0.4
        ]],
        'night' => [[20, 21, 22, 23, 0, 1, 2, 3, 4], [
            'opacity' => 0.6,
            'blur' => '30px',
            'spotIntensity' => 0.5
        ]]
    ];

    public function __construct()
    {
        $this->month = (int)date('n');
        $this->day = (int)date('j');
        $this->hour = (int)date('G');
        $this->year = (int)date('Y');
    }

    /**
     * Checks if a given date falls within a specified date range.  Handles year wrapping.
     *
     * @param int $year The year of the date to check.
     * @param int $month The month of the date to check.
     * @param int $day The day of the date to check.
     * @param array{month: int, day: int} $start Start date (month and day).
     * @param array{month: int, day: int} $end End date (month and day).
     * @return bool True if the date is within the range, false otherwise.
     */
    private function isDateWithinRange(int $year, int $month, int $day, array $start, array $end): bool
    {
        $startDate = new DateTime();
        $startDate->setDate($start['month'] < $end['month'] ? $year : $year -1, $start['month'], $start['day']);

        $endDate = new DateTime();
        $endDate->setDate($start['month'] < $end['month'] ? $year : $year, $end['month'], $end['day']);

        $currentDate = new DateTime();
        $currentDate->setDate($year, $month, $day);

        return $currentDate >= $startDate && $currentDate <= $endDate;
    }


    /**
     * Resolves the active season key, honoring an explicit override (used by the
     * "browse all" arrow) before falling back to the date-based calculation.
     */
    private function resolveSeasonName(?string $forceSeason): string
    {
        if (null !== $forceSeason && isset($this->seasons[$forceSeason])) {
            return $forceSeason;
        }
        foreach ($this->seasons as $season => $data) {
            if ($this->isDateWithinRange($this->year, $this->month, $this->day, $data['start'], $data['end'])) {
                return $season;
            }
        }
        // Fallback, though this should never happen with full year coverage
        return 'winter';
    }

    /**
     * Resolves the active time-of-day key, honoring an explicit override before
     * falling back to the current hour.
     */
    private function resolveTimeName(?string $forceTime): string
    {
        if (null !== $forceTime && isset($this->dayTimes[$forceTime])) {
            return $forceTime;
        }
        foreach ($this->dayTimes as $time => $data) {
            if (in_array($this->hour, $data[0])) {
                return $time;
            }
        }
        // Fallback to night, though this should not normally happen.
        return 'night';
    }

    /**
     * @return string[]
     */
    public function getSeasonKeys(): array
    {
        return array_keys($this->seasons);
    }

    /**
     * @return string[]
     */
    public function getDayTimeKeys(): array
    {
        return array_keys($this->dayTimes);
    }

    /**
     * August through the autumn equinox counts as "late summer", where the palette
     * turns from clear blue to a golden yellow-orange.
     */
    public function isLateSummer(): bool
    {
        return 8 === $this->month || (9 === $this->month && $this->day <= 21);
    }

    /**
     * Gets the season for the current (or overridden) date.
     * @return array{name: string, theme: array<string, mixed>}
     */
    public function getCurrentSeasonByDate(?string $forceSeason = null, ?string $forceTime = null): array
    {
        $season = $this->resolveSeasonName($forceSeason);
        $timeOfDay = $this->isNight($forceTime) ? 'night' : 'day';
        $bucket = $timeOfDay;
        if ('summer' === $season && $this->isLateSummer()) {
            $lateBucket = 'night' === $timeOfDay ? 'lateNight' : 'lateDay';
            if (isset($this->seasons[$season]['themes'][$lateBucket])) {
                $bucket = $lateBucket;
            }
        }
        $palettes = $this->seasons[$season]['themes'][$bucket];
        $randomPalette = $palettes[array_rand($palettes)];
        return ['name' => $season, 'theme' => $randomPalette];
    }


    /**
     * Gets the current (or overridden) time of day (dawn, day, dusk, night).
     * @return array{name: string, settings: array{opacity: float, blur: string, spotIntensity: float}}
     */
    public function getDayTime(?string $forceTime = null): array
    {
        $time = $this->resolveTimeName($forceTime);
        return ['name' => $time, 'settings' => $this->dayTimes[$time][1]];
    }

    public function shouldSnow(?string $forceSeason = null): bool
    {
        return $this->resolveSeasonName($forceSeason) === 'winter';
    }

    public function isNight(?string $forceTime = null): bool
    {
        return $this->resolveTimeName($forceTime) === 'night';
    }
}

$theme = new TimeBasedTheme();
$seasonKeys = $theme->getSeasonKeys();
$dayTimeKeys = $theme->getDayTimeKeys();

// The bottom-right arrow lets a visitor browse through every season/time-of-day
// combination on demand; it does so by reloading with these two params, which we
// only honor when they match a real key (never trust $_GET beyond that check).
$forceSeason = $_GET['al_season'] ?? null;
$forceTime = $_GET['al_time'] ?? null;
$forceSeason = is_string($forceSeason) && in_array($forceSeason, $seasonKeys, true) ? $forceSeason : null;
$forceTime = is_string($forceTime) && in_array($forceTime, $dayTimeKeys, true) ? $forceTime : null;

$currentSeason = $theme->getCurrentSeasonByDate($forceSeason, $forceTime);
$currentTime = $theme->getDayTime($forceTime);
$showSnow = $theme->shouldSnow($forceSeason);
$isNight = $theme->isNight($forceTime);
$seasonName = $currentSeason['name'];
$timeName = $currentTime['name'];
$isLateSummer = $seasonName === 'summer' && $theme->isLateSummer();

// Ordered list of all 16 combinations, grouped by season, for the browse arrow to
// step through one at a time.
$themeCombos = [];
foreach ($seasonKeys as $seasonKey) {
    foreach ($dayTimeKeys as $timeKey) {
        $themeCombos[] = ['season' => $seasonKey, 'time' => $timeKey];
    }
}
$currentComboIndex = 0;
foreach ($themeCombos as $index => $combo) {
    if ($combo['season'] === $seasonName && $combo['time'] === $timeName) {
        $currentComboIndex = $index;
        break;
    }
}

// Tunes particle density, fall speed and an optional glow so that dawn/day/dusk/night
// each feel like their own moment within a season, not just a lighting change.
$timeFactors = [
    'dawn' => ['density' => 0.7, 'speed' => 0.9, 'glow' => false],
    'day' => ['density' => 1.0, 'speed' => 1.0, 'glow' => false],
    'dusk' => ['density' => 1.15, 'speed' => 1.1, 'glow' => true],
    'night' => ['density' => 0.85, 'speed' => 0.8, 'glow' => true]
][$timeName];

// Each visit gets a different number of shapes and a random motion style per shape,
// so the blob choreography never repeats the same way twice.
$blobMotions = ['float', 'drift', 'orbit', 'pulse'];
$shapeCount = rand(3, 5);
$sizes = [];
for ($i = 0; $i < $shapeCount; $i++) {
    $sizes[] = [
        'width' => rand(80, 120) . 'vw',
        'height' => rand(80, 120) . 'vh',
        'top' => rand(-20, 0) . 'vh',
        'left' => rand(-20, 0) . 'vw',
        'rotation' => rand(-360, 360),
        'scale' => (rand(80, 120) / 100),
        'motion' => $blobMotions[array_rand($blobMotions)],
        'duration' => rand(55, 95),
        'delay' => -rand(0, 45),
        'direction' => rand(0, 1) ? 'reverse' : 'normal',
        'accent' => ($i % 4) + 1
    ];
}

// Random parameter ranges per motion style, generated fresh on every render so the
// keyframes themselves (not just the timing) differ from visit to visit.
$motionRanges = [
    'float' => [
        'rotateA' => rand(-45, 45), 'rotateB' => rand(30, 60), 'rotateC' => rand(75, 105),
        'moveA' => rand(5, 15), 'moveB' => rand(-15, -5), 'moveC' => rand(-10, -5)
    ],
    'drift' => [
        'moveX1' => rand(10, 25), 'moveY1' => rand(-10, 10),
        'moveX2' => rand(-25, -10), 'moveY2' => rand(10, 25),
        'rotate' => rand(-20, 20)
    ],
    'orbit' => [
        'radiusX' => rand(10, 20), 'radiusY' => rand(8, 18),
        'rotate' => rand(180, 360)
    ],
    'pulse' => [
        'scaleUp' => (rand(105, 130) / 100), 'scaleDown' => (rand(75, 95) / 100),
        'moveX' => rand(-8, 8), 'moveY' => rand(-8, 8)
    ]
];

// Season-specific ambient particles. Winter keeps its snow; the other seasons get
// their own drifting motif so the page feels different across the whole year, not
// just in December.
/**
 * @param int $count
 * @param float $speed Fall-speed multiplier; >1 is faster, <1 slower.
 * @return array<int, array<string, mixed>>
 */
function generateSnowflakes(int $count, float $speed = 1.0): array
{
    $snowflakes = [];
    for ($i = 0; $i < $count; $i++) {
        $snowflakes[] = [
            'size' => rand(3, 8) / 2,
            'left' => rand(-20, 120),
            'opacity' => (rand(60, 90) / 100),
            'delay' => (rand(0, 500) / 100),
            'duration' => rand(8, 20) / $speed,
            'sway' => rand(10, 50) / 10
        ];
    }
    return $snowflakes;
}

/**
 * Spring's ambient particles: a mix of tumbling buttercups (a little 5-dot flower
 * cluster, spinning hard as it falls) and gentler drifting tulip cups.
 *
 * @param int $count
 * @param float $speed Fall-speed multiplier; >1 is faster, <1 slower.
 * @return array<int, array<string, mixed>>
 */
function generatePetals(int $count, float $speed = 1.0): array
{
    $tulipColors = ['gold', 'cream', 'sage'];
    $petals = [];
    for ($i = 0; $i < $count; $i++) {
        $type = rand(0, 1) ? 'buttercup' : 'tulip';
        $petals[] = [
            'size' => rand(8, 16),
            'left' => rand(-20, 120),
            'opacity' => (rand(50, 85) / 100),
            'delay' => (rand(0, 800) / 100),
            'duration' => rand(14, 26) / $speed,
            'sway' => rand(20, 60),
            'type' => $type,
            'tulipColor' => $tulipColors[array_rand($tulipColors)],
            // Buttercups tumble through several full turns; tulips just wobble gently.
            'spin' => ($type === 'buttercup' ? rand(720, 1260) : rand(180, 420)) * (rand(0, 1) ? 1 : -1)
        ];
    }
    return $petals;
}

/**
 * @param int $count
 * @param float $speed Fall-speed multiplier; >1 is faster, <1 slower.
 * @return array<int, array<string, mixed>>
 */
function generateLeaves(int $count, float $speed = 1.0): array
{
    $leaves = [];
    for ($i = 0; $i < $count; $i++) {
        $leaves[] = [
            'size' => rand(10, 20),
            'left' => rand(-20, 120),
            'opacity' => (rand(55, 90) / 100),
            'delay' => (rand(0, 900) / 100),
            'duration' => rand(10, 20) / $speed,
            'sway' => rand(30, 80),
            'spin' => rand(360, 720) * (rand(0, 1) ? 1 : -1),
            'accent' => rand(1, 4)
        ];
    }
    return $leaves;
}

/**
 * @param int $count
 * @param float $speed Roam-speed multiplier; >1 is faster, <1 slower.
 * @return array<int, array<string, mixed>>
 */
function generateFireflies(int $count, float $speed = 1.0): array
{
    $fireflies = [];
    for ($i = 0; $i < $count; $i++) {
        $fireflies[] = [
            'size' => rand(2, 4),
            'left' => rand(0, 100),
            'top' => rand(0, 100),
            'delay' => (rand(0, 1000) / 100),
            'duration' => rand(6, 14) / $speed,
            'roam' => rand(30, 90)
        ];
    }
    return $fireflies;
}

/**
 * @param int $count
 * @param float $speed Drift-speed multiplier; >1 is faster, <1 slower.
 * @return array<int, array<string, mixed>>
 */
function generateBokeh(int $count, float $speed = 1.0): array
{
    $bokeh = [];
    for ($i = 0; $i < $count; $i++) {
        $bokeh[] = [
            'size' => rand(30, 90),
            'left' => rand(-10, 110),
            'top' => rand(0, 100),
            'opacity' => (rand(8, 20) / 100),
            'delay' => (rand(0, 1200) / 100),
            'duration' => rand(18, 35) / $speed
        ];
    }
    return $bokeh;
}

$snowflakes = [];
$petals = [];
$leaves = [];
$fireflies = [];
$bokeh = [];
$glowParticles = $timeFactors['glow'];

switch ($seasonName) {
    case 'winter':
        $snowflakes = generateSnowflakes((int)round(150 * $timeFactors['density']), $timeFactors['speed']);
        break;
    case 'spring':
        $petals = generatePetals((int)round(60 * $timeFactors['density']), $timeFactors['speed']);
        break;
    case 'autumn':
        $leaves = generateLeaves((int)round(45 * $timeFactors['density']), $timeFactors['speed']);
        break;
    case 'summer':
        if ($isNight) {
            $fireflies = generateFireflies((int)round(35 * $timeFactors['density']), $timeFactors['speed']);
        } else {
            $bokeh = generateBokeh((int)round(18 * $timeFactors['density']), $timeFactors['speed']);
        }
        break;
}

// Two distinct corners for the glow spots, so the ambient light layout also
// varies between visits instead of always sitting top-left / bottom-right.
$corners = ['top-left', 'top-right', 'bottom-left', 'bottom-right'];
shuffle($corners);
$glowCorners = array_slice($corners, 0, 2);

// Summer gets a sun flare with light rays and lens-flare "ghosts". It pulls its
// colors from the same --accent/--spot variables as everything else, so it turns
// warm and golden for late summer without any extra branching.
$showSunFlare = $seasonName === 'summer' && !$isNight;
$sunTop = rand(6, 22) . 'vh';
$sunLeft = rand(58, 88) . 'vw';
$flareRotateDir = rand(0, 1) ? 'normal' : 'reverse';

/**
 * @param string $corner
 * @return string
 */
function cornerToCss(string $corner): string
{
    [$vertical, $horizontal] = explode('-', $corner);
    return "$vertical: -25vh; $horizontal: -25vw;";
}
?>

<div class="box rex-background">
    <?php foreach ($sizes as $i => $shape) : ?>
        <div class="shape shape-accent<?= $shape['accent'] ?>" style="
            width: <?= $shape['width'] ?>;
            height: <?= $shape['height'] ?>;
            top: <?= $shape['top'] ?>;
            left: <?= $shape['left'] ?>;
            transform: rotate(<?= $shape['rotation'] ?>deg) scale(<?= $shape['scale'] ?>);
            opacity: <?= $currentTime['settings']['opacity'] ?>;
            backdrop-filter: blur(<?= $currentTime['settings']['blur'] ?>);
            -webkit-backdrop-filter: blur(<?= $currentTime['settings']['blur'] ?>);
            animation: motion-<?= $shape['motion'] ?> <?= $shape['duration'] ?>s infinite ease-in-out <?= $shape['direction'] ?>;
            animation-delay: <?= $shape['delay'] ?>s;
        "></div>
    <?php endforeach; ?>

    <?php if ($showSunFlare) : ?>
        <div class="sun-flare" style="top: <?= $sunTop ?>; left: <?= $sunLeft ?>;">
            <div class="flare-rays" style="animation-direction: <?= $flareRotateDir ?>;"></div>
            <div class="flare-core"></div>
            <div class="flare-ghost flare-ghost1"></div>
            <div class="flare-ghost flare-ghost2"></div>
            <div class="flare-ghost flare-ghost3"></div>
        </div>
    <?php endif; ?>

    <?php if ($snowflakes) : ?>
        <div class="ambient-container">
            <div class="snow-layer back"></div>
            <div class="snow-layer middle"></div>
            <div class="snow-layer front"></div>
            <?php foreach ($snowflakes as $flake) : ?>
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
        </div>
    <?php endif; ?>

    <?php if ($petals) : ?>
        <div class="ambient-container">
            <?php foreach ($petals as $petal) : ?>
                <?php
                $isButtercup = $petal['type'] === 'buttercup';
                $petalTypeClass = $isButtercup ? 'petal-buttercup' : 'petal-tulip petal-tulip-' . $petal['tulipColor'];
                ?>
                <div class="petal <?= $petalTypeClass ?>" style="
            width: <?= $petal['size'] ?>px;
            height: <?= $isButtercup ? $petal['size'] : round($petal['size'] * 1.3) ?>px;
            left: <?= $petal['left'] ?>%;
            opacity: <?= $petal['opacity'] ?>;
            animation: petal-fall <?= $petal['duration'] ?>s linear infinite;
            animation-delay: -<?= $petal['delay'] ?>s;
            --sway: <?= $petal['sway'] ?>px;
            --spin: <?= $petal['spin'] ?>deg;
            <?= $glowParticles ? 'box-shadow: 0 0 8px 2px currentColor;' : '' ?>
        "></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($leaves) : ?>
        <div class="ambient-container">
            <?php foreach ($leaves as $leaf) : ?>
                <div class="leaf leaf-accent<?= $leaf['accent'] ?><?= $glowParticles ? ' glow' : '' ?>" style="
            width: <?= $leaf['size'] ?>px;
            height: <?= $leaf['size'] ?>px;
            left: <?= $leaf['left'] ?>%;
            opacity: <?= $leaf['opacity'] ?>;
            animation: leaf-fall <?= $leaf['duration'] ?>s linear infinite;
            animation-delay: -<?= $leaf['delay'] ?>s;
            --sway: <?= $leaf['sway'] ?>px;
            --spin: <?= $leaf['spin'] ?>deg;
        "></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($fireflies) : ?>
        <div class="ambient-container">
            <?php foreach ($fireflies as $bug) : ?>
                <div class="firefly" style="
            width: <?= $bug['size'] ?>px;
            height: <?= $bug['size'] ?>px;
            left: <?= $bug['left'] ?>%;
            top: <?= $bug['top'] ?>%;
            animation: firefly-roam <?= $bug['duration'] ?>s ease-in-out infinite;
            animation-delay: -<?= $bug['delay'] ?>s;
            --roam: <?= $bug['roam'] ?>px;
        "></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($bokeh) : ?>
        <div class="ambient-container">
            <?php foreach ($bokeh as $b) : ?>
                <div class="bokeh<?= ($timeName === 'dusk' || $isLateSummer) ? ' warm' : '' ?>" style="
            width: <?= $b['size'] ?>px;
            height: <?= $b['size'] ?>px;
            left: <?= $b['left'] ?>%;
            top: <?= $b['top'] ?>%;
            opacity: <?= $b['opacity'] ?>;
            animation: bokeh-drift <?= $b['duration'] ?>s ease-in-out infinite;
            animation-delay: -<?= $b['delay'] ?>s;
        "></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="light-spot"></div>
    <div class="glow" style="<?= cornerToCss($glowCorners[0]) ?>"></div>
    <div class="glow" style="<?= cornerToCss($glowCorners[1]) ?> animation-delay: -4s;"></div>
</div>

<button type="button" class="theme-browse-btn" title="Nächstes Erscheinungsbild ansehen" aria-label="Nächstes Erscheinungsbild ansehen">
    <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M8 5l8 7-8 7z"/></svg>
</button>

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
        --buttercup-color: <?= $isNight ? 'rgba(255,224,120,0.85)' : 'rgba(255,214,64,0.95)' ?>;
        --tulip-gold: <?= $isNight ? 'rgba(220,180,70,0.85)' : 'rgba(230,178,52,0.95)' ?>;
        --tulip-cream: <?= $isNight ? 'rgba(225,222,180,0.85)' : 'rgba(250,245,210,0.97)' ?>;
        --tulip-sage: <?= $isNight ? 'rgba(150,190,120,0.85)' : 'rgba(150,195,110,0.95)' ?>;
        --firefly-color: <?= $isNight ? 'rgba(255,244,150,0.9)' : 'rgba(255,244,150,0.6)' ?>;
    }

    body {
        margin: 0;
        padding: 0;
        background: var(--bg-primary);
        overflow: hidden;
        perspective: 1200px;
    }

    /* The login form slides down from above into place, with just a light tilt
       for a touch of 3D depth rather than a full flip. */
    #rex-form-login {
        animation: form-fly-in 0.6s cubic-bezier(0.55, 0, 0.85, 0.15) both;
        transform-style: preserve-3d;
        transform-origin: 50% 0%;
        backface-visibility: hidden;
    }

    .box {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
    }

    /* The season/time engine already picks the scene's mood, but the OS/browser's
       own light-vs-dark preference still nudges the whole thing brighter or moodier
       on top of that, so switching it is actually visible everywhere, not just on
       the one neutral UI button below. */
    @media (prefers-color-scheme: dark) {
        .box {
            filter: brightness(0.88) saturate(1.08);
        }
    }

    @media (prefers-color-scheme: light) {
        .box {
            filter: brightness(1.12) saturate(0.95);
        }
    }

    .shape {
        position: fixed;
        transform-origin: center;
        z-index: -1;
        transition: all 0.5s ease-out;
    }

    .shape-accent1 { background: var(--accent1); }
    .shape-accent2 { background: var(--accent2); }
    .shape-accent3 { background: var(--accent3); }
    .shape-accent4 { background: var(--accent4); }

    /* Shared ambient particle container, reused for snow/petals/leaves/fireflies/bokeh */
    .ambient-container {
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
        background-image: radial-gradient(2px 2px at 20px 30px, var(--snow-color), transparent),
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

    .snowflake {
        position: absolute;
        background: var(--snow-color);
        border-radius: 50%;
        box-shadow: 0 0 2px var(--snow-shadow);
        pointer-events: none;
        transform-origin: center;
        will-change: transform;
    }

    /* Spring: buttercups and tulips drifting down. Glow (dusk/night) is computed
       inline per particle so it can be combined with the type's own color. */
    .petal {
        position: absolute;
        top: -5%;
        pointer-events: none;
        will-change: transform;
    }

    /* A small glossy yellow bead - a plain round shape reads more like a flower
       at this size than an attempt at literal petal geometry would. */
    .petal-buttercup {
        background: radial-gradient(circle at 35% 25%, rgba(255, 255, 255, 0.7) 0%, var(--buttercup-color) 60%);
        color: var(--buttercup-color);
        border-radius: 50%;
    }

    /* An elongated cup shape, taller than wide, in one of three tulip colors */
    .petal-tulip {
        border-radius: 50% 50% 15% 15%;
    }

    .petal-tulip-gold { background: radial-gradient(circle at 35% 25%, rgba(255, 255, 255, 0.5) 0%, var(--tulip-gold) 60%); color: var(--tulip-gold); }
    .petal-tulip-cream { background: radial-gradient(circle at 35% 25%, rgba(255, 255, 255, 0.5) 0%, var(--tulip-cream) 60%); color: var(--tulip-cream); }
    .petal-tulip-sage { background: radial-gradient(circle at 35% 25%, rgba(255, 255, 255, 0.5) 0%, var(--tulip-sage) 60%); color: var(--tulip-sage); }

    /* Autumn: falling, tumbling leaves tinted with the season's accents */
    .leaf {
        position: absolute;
        top: -5%;
        border-radius: 0 60% 0 60%;
        pointer-events: none;
        will-change: transform;
    }

    .leaf.glow {
        box-shadow: 0 0 8px 2px currentColor;
    }

    .leaf-accent1 { background: var(--accent1); color: var(--accent1); }
    .leaf-accent2 { background: var(--accent2); color: var(--accent2); }
    .leaf-accent3 { background: var(--accent3); color: var(--accent3); }
    .leaf-accent4 { background: var(--accent4); color: var(--accent4); }

    /* Summer night: twinkling fireflies roaming the scene */
    .firefly {
        position: absolute;
        border-radius: 50%;
        background: var(--firefly-color);
        box-shadow: 0 0 6px 2px var(--firefly-color);
        pointer-events: none;
        will-change: transform, opacity;
    }

    /* Summer day: soft drifting light bokeh; dusk gets a warm golden-hour tint */
    .bokeh {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 70%);
        pointer-events: none;
        will-change: transform, opacity;
    }

    .bokeh.warm {
        background: radial-gradient(circle, rgba(255, 200, 120, 0.85) 0%, rgba(255, 200, 120, 0) 70%);
    }

    /* Light effects */
    .light-spot {
        position: fixed;
        width: 800px;
        height: 800px;
        background: radial-gradient(circle,
                rgba(255, 255, 255, calc(0.2 * var(--spot-intensity))) 0%,
                var(--spot-color) 50%,
                rgba(255, 255, 255, 0) 70%);
        pointer-events: none;
        mix-blend-mode: screen;
        z-index: 1;
    }

    .glow {
        position: fixed;
        width: 150vw;
        height: 150vh;
        background: radial-gradient(circle,
                var(--spot-color) 0%,
                rgba(255, 255, 255, 0) 70%);
        pointer-events: none;
        mix-blend-mode: screen;
        opacity: calc(0.4 * var(--spot-intensity));
        animation: pulse 8s infinite ease-in-out;
    }

    /* Login-Formular als Glass-Panel: leicht transparent mit Weichzeichner-Hintergrund,
       damit die animierte Szene dahinter durchscheint statt von einer harten Box verdeckt
       zu werden - passend zum bereits vorhandenen Glass-Look des Browse-Buttons unten. */
    #rex-page-login .panel.panel-default {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 12px;
        backdrop-filter: blur(16px) saturate(140%);
        -webkit-backdrop-filter: blur(16px) saturate(140%);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
    }

    #rex-page-login .panel.panel-default .panel-body,
    #rex-page-login .panel.panel-default .panel-footer {
        background: transparent;
        border-color: rgba(255, 255, 255, 0.2);
    }

    /* Die Eingabefelder sind ein HELLES Glas (weisser Schleier), deshalb hier bewusst
       dunkler statt heller Text/Icons - weiss-auf-weiss waere sonst unlesbar. */
    #rex-page-login .form-control {
        background: rgba(255, 255, 255, 0.55);
        border: 1px solid rgba(255, 255, 255, 0.6);
        color: #241a2e;
    }

    #rex-page-login .form-control::placeholder {
        color: rgba(36, 26, 46, 0.6);
    }

    #rex-page-login .form-control:focus {
        background: rgba(255, 255, 255, 0.78);
        border-color: rgba(255, 255, 255, 0.95);
        box-shadow: none;
    }

    /* Icon-/Augen-Buttons links und rechts am Feld - dieselbe helle Glas-Optik statt
       der Standard-Grautoene des Themes, die auf dem transparenten Panel deplatziert wirkten. */
    #rex-page-login .input-group-addon,
    #rex-page-login .input-group-btn .btn {
        background: rgba(255, 255, 255, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.55);
        color: #241a2e;
    }

    #rex-page-login .input-group-btn .btn:hover,
    #rex-page-login .input-group-btn .btn:focus {
        background: rgba(255, 255, 255, 0.6);
        color: #241a2e;
    }

    #rex-page-login label {
        color: rgba(255, 255, 255, 0.95);
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    }

    /* Arrow to browse through every season/time-of-day combination */
    .theme-browse-btn {
        position: fixed;
        bottom: 24px;
        right: 24px;
        width: 44px;
        height: 44px;
        border: 1px solid rgba(255, 255, 255, 0.35);
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        color: rgba(255, 255, 255, 0.85);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .theme-browse-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: scale(1.08);
    }

    .theme-browse-btn:active {
        transform: scale(0.95);
    }

    /* The browse button is the one bit of neutral UI chrome on this page (everything
       else is intentionally colored by the season/time theme), so it's the one thing
       that follows the visitor's OS light/dark preference rather than our palette.
       Both branches are spelled out explicitly (even though dark repeats the base
       values) so the behavior is unambiguous when testing/toggling either way. */
    @media (prefers-color-scheme: dark) {
        .theme-browse-btn {
            border-color: rgba(255, 255, 255, 0.35);
            background: rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.85);
        }

        .theme-browse-btn:hover {
            background: rgba(255, 255, 255, 0.25);
        }
    }

    @media (prefers-color-scheme: light) {
        .theme-browse-btn {
            border-color: rgba(0, 0, 0, 0.25);
            background: rgba(0, 0, 0, 0.12);
            color: rgba(0, 0, 0, 0.75);
        }

        .theme-browse-btn:hover {
            background: rgba(0, 0, 0, 0.22);
        }
    }

    /* Summer: a sun flare with rotating light rays and trailing lens-flare ghosts.
       Colors ride on the existing --accent/--spot variables, so this turns warm and
       golden for late summer automatically instead of needing its own palette. */
    .sun-flare {
        position: fixed;
        width: 0;
        height: 0;
        z-index: 1;
        pointer-events: none;
    }

    .flare-core {
        position: absolute;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        background: radial-gradient(circle, rgba(255, 255, 255, 0.95) 0%, var(--accent3) 35%, rgba(255, 255, 255, 0) 70%);
        mix-blend-mode: screen;
        filter: blur(2px);
        animation: flare-pulse 6s ease-in-out infinite;
    }

    .flare-rays {
        position: absolute;
        width: 600px;
        height: 600px;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        background: conic-gradient(from 0deg,
                transparent 0deg, rgba(255, 255, 255, 0.25) 3deg, transparent 8deg,
                transparent 40deg, rgba(255, 255, 255, 0.15) 43deg, transparent 48deg,
                transparent 90deg, rgba(255, 255, 255, 0.2) 93deg, transparent 98deg,
                transparent 140deg, rgba(255, 255, 255, 0.15) 143deg, transparent 148deg,
                transparent 180deg, rgba(255, 255, 255, 0.2) 183deg, transparent 188deg,
                transparent 220deg, rgba(255, 255, 255, 0.15) 223deg, transparent 228deg,
                transparent 270deg, rgba(255, 255, 255, 0.2) 273deg, transparent 278deg,
                transparent 320deg, rgba(255, 255, 255, 0.15) 323deg, transparent 328deg,
                transparent 360deg);
        mix-blend-mode: screen;
        opacity: 0.5;
        animation: flare-rotate 100s linear infinite;
    }

    .flare-ghost {
        position: absolute;
        border-radius: 50%;
        mix-blend-mode: screen;
    }

    .flare-ghost1 {
        width: 40px;
        height: 40px;
        background: radial-gradient(circle, var(--accent2) 0%, rgba(255, 255, 255, 0) 70%);
        opacity: 0.5;
        transform: translate(-140px, 110px) translate(-50%, -50%);
    }

    .flare-ghost2 {
        width: 26px;
        height: 26px;
        background: radial-gradient(circle, var(--accent4) 0%, rgba(255, 255, 255, 0) 70%);
        opacity: 0.4;
        transform: translate(-260px, 200px) translate(-50%, -50%);
    }

    .flare-ghost3 {
        width: 70px;
        height: 70px;
        border: 1px solid var(--accent3);
        opacity: 0.25;
        transform: translate(-380px, 290px) translate(-50%, -50%);
    }

    /* Animations */
    @keyframes motion-float {

        0%,
        100% {
            transform: rotate(<?= $motionRanges['float']['rotateA'] ?>deg) translate(0, 0) scale(1);
        }

        25% {
            transform: rotate(<?= $motionRanges['float']['rotateB'] ?>deg) translate(<?= $motionRanges['float']['moveA'] ?>vw, <?= $motionRanges['float']['moveA'] ?>vh) scale(<?= (rand(90, 110) / 100) ?>);
        }

        50% {
            transform: rotate(<?= $motionRanges['float']['rotateC'] ?>deg) translate(<?= $motionRanges['float']['moveB'] ?>vw, <?= $motionRanges['float']['moveC'] ?>vh) scale(<?= (rand(90, 110) / 100) ?>);
        }

        75% {
            transform: rotate(<?= $motionRanges['float']['rotateB'] ?>deg) translate(<?= $motionRanges['float']['moveC'] ?>vw, <?= $motionRanges['float']['moveA'] ?>vh) scale(<?= (rand(90, 110) / 100) ?>);
        }
    }

    @keyframes motion-drift {

        0%,
        100% {
            transform: translate(0, 0) rotate(0deg);
        }

        33% {
            transform: translate(<?= $motionRanges['drift']['moveX1'] ?>vw, <?= $motionRanges['drift']['moveY1'] ?>vh) rotate(<?= $motionRanges['drift']['rotate'] ?>deg);
        }

        66% {
            transform: translate(<?= $motionRanges['drift']['moveX2'] ?>vw, <?= $motionRanges['drift']['moveY2'] ?>vh) rotate(<?= -$motionRanges['drift']['rotate'] ?>deg);
        }
    }

    @keyframes motion-orbit {

        0% {
            transform: translate(0, 0) rotate(0deg);
        }

        25% {
            transform: translate(<?= $motionRanges['orbit']['radiusX'] ?>vw, -<?= $motionRanges['orbit']['radiusY'] ?>vh) rotate(<?= $motionRanges['orbit']['rotate'] * 0.25 ?>deg);
        }

        50% {
            transform: translate(0, -<?= $motionRanges['orbit']['radiusY'] * 2 ?>vh) rotate(<?= $motionRanges['orbit']['rotate'] * 0.5 ?>deg);
        }

        75% {
            transform: translate(-<?= $motionRanges['orbit']['radiusX'] ?>vw, -<?= $motionRanges['orbit']['radiusY'] ?>vh) rotate(<?= $motionRanges['orbit']['rotate'] * 0.75 ?>deg);
        }

        100% {
            transform: translate(0, 0) rotate(<?= $motionRanges['orbit']['rotate'] ?>deg);
        }
    }

    @keyframes motion-pulse {

        0%,
        100% {
            transform: scale(1) translate(0, 0);
        }

        50% {
            transform: scale(<?= $motionRanges['pulse']['scaleUp'] ?>) translate(<?= $motionRanges['pulse']['moveX'] ?>vw, <?= $motionRanges['pulse']['moveY'] ?>vh);
        }

        75% {
            transform: scale(<?= $motionRanges['pulse']['scaleDown'] ?>) translate(<?= -$motionRanges['pulse']['moveX'] ?>vw, <?= -$motionRanges['pulse']['moveY'] ?>vh);
        }
    }

    @keyframes snow-layer {
        from {
            transform: translateY(-100%) rotate(0deg);
        }

        to {
            transform: translateY(100%) rotate(360deg);
        }
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

    @keyframes petal-fall {
        0% {
            transform: translateY(-10vh) translateX(calc(var(--sway) * -1)) rotate(0deg);
        }

        50% {
            transform: translateY(50vh) translateX(var(--sway)) rotate(calc(var(--spin) * 0.5));
        }

        100% {
            transform: translateY(110vh) translateX(calc(var(--sway) * -1)) rotate(var(--spin));
        }
    }

    @keyframes leaf-fall {
        0% {
            transform: translateY(-10vh) translateX(calc(var(--sway) * -1)) rotate(0deg);
        }

        30% {
            transform: translateY(30vh) translateX(var(--sway)) rotate(calc(var(--spin) * 0.3));
        }

        60% {
            transform: translateY(65vh) translateX(calc(var(--sway) * -0.6)) rotate(calc(var(--spin) * 0.6));
        }

        100% {
            transform: translateY(110vh) translateX(var(--sway)) rotate(var(--spin));
        }
    }

    @keyframes firefly-roam {
        0%, 100% {
            transform: translate(0, 0);
            opacity: 0.2;
        }

        25% {
            transform: translate(var(--roam), calc(var(--roam) * -0.6));
            opacity: 1;
        }

        50% {
            transform: translate(calc(var(--roam) * -0.4), calc(var(--roam) * -1));
            opacity: 0.4;
        }

        75% {
            transform: translate(calc(var(--roam) * -1), calc(var(--roam) * 0.3));
            opacity: 0.9;
        }
    }

    @keyframes bokeh-drift {
        0%, 100% {
            transform: translateY(0) scale(1);
        }

        50% {
            transform: translateY(-6vh) scale(1.15);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: calc(0.4 * var(--spot-intensity));
            transform: scale(1);
        }

        50% {
            opacity: calc(0.6 * var(--spot-intensity));
            transform: scale(1.1);
        }
    }

    @keyframes flare-pulse {

        0%,
        100% {
            opacity: 0.85;
            transform: translate(-50%, -50%) scale(1);
        }

        50% {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.08);
        }
    }

    @keyframes flare-rotate {
        from {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        to {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    @keyframes form-fly-in {
        0% {
            opacity: 0;
            transform: translateY(-90px) rotateX(12deg);
        }

        55% {
            opacity: 1;
        }

        100% {
            opacity: 1;
            transform: translateY(0) rotateX(0deg);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        #rex-form-login {
            animation: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Light spot: follows the mouse when it moves, otherwise drifts on its own
        // slow, gentle path so the scene stays alive even without interaction.
        const spot = document.querySelector('.light-spot');
        let mouseX = window.innerWidth / 2;
        let mouseY = window.innerHeight / 2;
        let currentX = mouseX;
        let currentY = mouseY;
        let idleSince = Date.now();
        const idleDelay = 4000;
        const idleStart = Date.now() + Math.random() * 10000;

        const animate = () => {
            const idle = Date.now() - idleSince > idleDelay;
            if (idle) {
                const t = (Date.now() - idleStart) / 1000;
                mouseX = window.innerWidth / 2 + Math.sin(t * 0.15) * window.innerWidth * 0.3;
                mouseY = window.innerHeight / 2 + Math.cos(t * 0.11) * window.innerHeight * 0.3;
            }

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
            idleSince = Date.now();
        });

        // Start spot animation
        animate();

        // Browse arrow: step through all season/time-of-day combinations by
        // reloading with the matching override params.
        const browseBtn = document.querySelector('.theme-browse-btn');
        const combos = <?= json_encode($themeCombos, JSON_THROW_ON_ERROR) ?>;
        const currentComboIndex = <?= $currentComboIndex ?>;
        if (browseBtn) {
            browseBtn.addEventListener('click', () => {
                const next = combos[(currentComboIndex + 1) % combos.length];
                const url = new URL(window.location.href);
                url.searchParams.set('al_season', next.season);
                url.searchParams.set('al_time', next.time);
                window.location.href = url.toString();
            });
        }
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
