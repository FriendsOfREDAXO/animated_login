<?php
/**
 * @var rex_fragment $this
 * @psalm-scope-this rex_fragment
 */
?>

<?php
/**
 * @var rex_fragment $this
 * @psalm-scope-this rex_fragment
 */
?>

<div class="gradients-container">
    <div class="g1"></div>
    <div class="g2"></div>
    <div class="g3"></div>
    <div class="g4"></div>
    <div class="g5"></div>
    <div class="interactive"></div>
</div>

<style>
:root {
    --color-bg1: #000;
    --color-bg2: #25a7d7;
    --color1: 59, 89, 152;
    --color2: 66, 103, 178;
    --color3: 0, 132, 180;
    --color4: 255, 255, 80;
    --color5: 33, 150, 243;
    --color-interactive: 255, 255, 255;
    --circle-size: 80%;
    --blending: soft-light;
}

body {
    background: linear-gradient(40deg, var(--color-bg1), var(--color-bg2));
    overflow: hidden;
}

.gradients-container {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1;
}

.g1, .g2, .g3, .g4, .g5, .interactive {
    position: absolute;
    background: radial-gradient(circle at center, rgba(var(--color1), 0.8) 0, rgba(var(--color1), 0) 50%) no-repeat;
    mix-blend-mode: var(--blending);
    width: var(--circle-size);
    height: var(--circle-size);
}

.interactive {
    width: 800px;
    height: 800px;
    background: radial-gradient(circle at center, rgba(var(--color-interactive), 0.8) 0, rgba(var(--color-interactive), 0) 50%) no-repeat;
    transform: translate(-50%, -50%);
}

.g1 { animation: moveVertical 30s ease infinite; }
.g2 { animation: moveInCircle 20s reverse infinite; }
.g3 { animation: moveInCircle 40s linear infinite; }
.g4 { animation: moveHorizontal 40s ease infinite; }
.g5 { animation: moveInCircle 20s ease infinite; }

@keyframes moveInCircle {
    0% { transform: rotate(0deg); }
    50% { transform: rotate(180deg); }
    100% { transform: rotate(360deg); }
}

@keyframes moveVertical {
    0% { transform: translateY(-50%); }
    50% { transform: translateY(50%); }
    100% { transform: translateY(-50%); }
}

@keyframes moveHorizontal {
    0% { transform: translateX(-50%) translateY(-10%); }
    50% { transform: translateX(50%) translateY(10%); }
    100% { transform: translateX(-50%) translateY(-10%); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const interBubble = document.querySelector('.interactive');
    let curX = 0;
    let curY = 0;
    let tgX = 0;
    let tgY = 0;

    const move = () => {
        curX += (tgX - curX) / 10;
        curY += (tgY - curY) / 10;
        interBubble.style.transform = `translate(${Math.round(curX)}px, ${Math.round(curY)}px)`;
        requestAnimationFrame(move);
    };

    window.addEventListener('mousemove', (event) => {
        tgX = event.clientX - 400;
        tgY = event.clientY - 400;
    });

    move();
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
