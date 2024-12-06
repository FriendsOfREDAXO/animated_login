<?php
/**
 * @var rex_fragment $this
 * @psalm-scope-this rex_fragment
 */
?>

<div class="animated-bg">
    <div class="shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
        <div class="shape shape4"></div>
        <div class="light-spot"></div>
    </div>
</div>

<style>
:root {
    --bg-primary: #0f172a;
    --accent1: #3b82f6;
    --accent2: #06b6d4;
    --accent3: #6366f1;
    --accent4: #8b5cf6;
}

.animated-bg {
    position: fixed;
    width: 100vw;
    height: 100vh;
    background: var(--bg-primary);
    overflow: hidden;
}

.shapes {
    width: 100%;
    height: 100%;
}

.shape {
    position: absolute;
    width: 120vw;
    height: 120vh;
    opacity: 0.5;
}

.shape1 {
    top: 10%;
    left: 15%;
    background: var(--accent1);
    animation: float1 20s infinite ease-in-out;
}

.shape2 {
    bottom: 20%;
    right: 15%;
    background: var(--accent2);
    animation: float2 25s infinite ease-in-out;
}

.shape3 {
    bottom: 15%;
    left: 20%;
    background: var(--accent3);
    animation: float3 30s infinite ease-in-out;
}

.shape4 {
    top: 20%;
    right: 20%;
    background: var(--accent4);
    animation: float4 22s infinite ease-in-out;
}

.light-spot {
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
    pointer-events: none;
    mix-blend-mode: overlay;
}

@keyframes float1 {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(20vw, 10vh) rotate(180deg); }
}

@keyframes float2 {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(-20vw, -10vh) rotate(-180deg); }
}

@keyframes float3 {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(10vw, -20vh) rotate(180deg); }
}

@keyframes float4 {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(-10vw, 20vh) rotate(-180deg); }
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
