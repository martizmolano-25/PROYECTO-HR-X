<?php
session_start();

// Credenciales válidas
$valid_user = "1014245906";
$valid_pass = "123";

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $usuario = trim($_POST['usuario'] ?? '');
    $clave   = trim($_POST['clave'] ?? '');

    if ($usuario === $valid_user && $clave === $valid_pass) {
        $_SESSION['logged_in'] = true;
        $_SESSION['usuario']   = $usuario;
        header("Location: roles.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ARCILLA MLC – Acceso</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --clay-dark:   #3b1f0e;
    --clay-mid:    #8b4513;
    --clay-warm:   #c1692a;
    --clay-light:  #e8a96e;
    --clay-pale:   #f5dfc0;
    --clay-cream:  #fdf3e7;
    --clay-gold:   #d4a253;
    --shadow-soft: 0 8px 40px rgba(59,31,14,0.18);
    --shadow-card: 0 24px 80px rgba(59,31,14,0.22);
  }

  body {
    font-family: 'DM Sans', sans-serif;
    min-height: 100vh;
    background: var(--clay-dark);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
  }

  /* Fondo con textura de arcilla */
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background:
      radial-gradient(ellipse 80% 60% at 15% 20%, rgba(193,105,42,0.35) 0%, transparent 60%),
      radial-gradient(ellipse 60% 80% at 85% 80%, rgba(139,69,19,0.4) 0%, transparent 55%),
      radial-gradient(ellipse 100% 100% at 50% 50%, rgba(59,31,14,0.95) 0%, #1a0c05 100%);
    z-index: 0;
  }

  /* Círculos decorativos */
  .deco-circle {
    position: fixed;
    border-radius: 50%;
    opacity: 0.06;
    pointer-events: none;
    z-index: 0;
  }
  .deco-circle.c1 {
    width: 600px; height: 600px;
    background: var(--clay-warm);
    top: -200px; left: -200px;
    animation: floatDeco 8s ease-in-out infinite;
  }
  .deco-circle.c2 {
    width: 400px; height: 400px;
    background: var(--clay-gold);
    bottom: -150px; right: -100px;
    animation: floatDeco 10s ease-in-out infinite reverse;
  }
  .deco-circle.c3 {
    width: 200px; height: 200px;
    background: var(--clay-light);
    top: 60%; left: 70%;
    animation: floatDeco 6s ease-in-out infinite;
  }

  @keyframes floatDeco {
    0%,100% { transform: translate(0,0) scale(1); }
    50%      { transform: translate(20px,20px) scale(1.05); }
  }

  /* Partículas pequeñas */
  .particles { position: fixed; inset: 0; z-index: 0; pointer-events: none; }
  .particle {
    position: absolute;
    width: 3px; height: 3px;
    border-radius: 50%;
    background: var(--clay-gold);
    opacity: 0;
    animation: particleFly linear infinite;
  }
  @keyframes particleFly {
    0%   { opacity: 0; transform: translateY(0) scale(0); }
    20%  { opacity: 0.6; }
    80%  { opacity: 0.3; }
    100% { opacity: 0; transform: translateY(-200px) scale(1.5); }
  }

  /* Wrapper principal */
  .page-wrapper {
    position: relative;
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0;
    animation: pageIn 0.9s cubic-bezier(.22,1,.36,1) both;
  }
  @keyframes pageIn {
    from { opacity: 0; transform: translateY(40px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* Banner superior */
  .banner {
    background: linear-gradient(135deg, var(--clay-mid) 0%, var(--clay-warm) 60%, var(--clay-gold) 100%);
    padding: 28px 52px 22px;
    text-align: center;
    border-radius: 24px 24px 0 0;
    box-shadow: 0 -4px 30px rgba(212,162,83,0.2);
    position: relative;
    overflow: hidden;
    min-width: 440px;
  }
  .banner::after {
    content: '';
    position: absolute;
    inset: 0;
    background: repeating-linear-gradient(
      45deg,
      rgba(255,255,255,0.03) 0px,
      rgba(255,255,255,0.03) 1px,
      transparent 1px,
      transparent 14px
    );
  }

  /* Logo / Imagen empresa */
  .logo-wrap {
    width: 88px; height: 88px;
    margin: 0 auto 14px;
    border-radius: 50%;
    background: var(--clay-cream);
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 4px 24px rgba(59,31,14,0.35), 0 0 0 4px rgba(255,255,255,0.18);
    position: relative;
    z-index: 1;
    overflow: hidden;
  }
  .logo-wrap svg { width: 56px; height: 56px; }

  .banner-title {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 900;
    color: #fff;
    letter-spacing: 0.06em;
    text-shadow: 0 2px 12px rgba(59,31,14,0.4);
    position: relative; z-index: 1;
    line-height: 1.1;
  }
  .banner-subtitle {
    font-size: 0.78rem;
    color: rgba(255,255,255,0.75);
    letter-spacing: 0.25em;
    text-transform: uppercase;
    margin-top: 6px;
    position: relative; z-index: 1;
  }

  /* Tarjeta de login */
  .card {
    background: var(--clay-cream);
    padding: 42px 52px 48px;
    border-radius: 0 0 24px 24px;
    box-shadow: var(--shadow-card);
    width: 440px;
    position: relative;
  }
  .card::before {
    content: '';
    position: absolute;
    top: 0; left: 40px; right: 40px;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--clay-gold), transparent);
  }

  .card-heading {
    font-family: 'Playfair Display', serif;
    font-size: 1.35rem;
    color: var(--clay-dark);
    margin-bottom: 28px;
    text-align: center;
  }
  .card-heading span {
    color: var(--clay-warm);
  }

  .form-group {
    margin-bottom: 20px;
  }
  .form-group label {
    display: block;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--clay-mid);
    margin-bottom: 8px;
  }
  .form-group input {
    width: 100%;
    padding: 13px 18px;
    border: 2px solid rgba(139,69,19,0.18);
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    color: var(--clay-dark);
    background: #fff;
    transition: border-color 0.25s, box-shadow 0.25s;
    outline: none;
  }
  .form-group input:focus {
    border-color: var(--clay-warm);
    box-shadow: 0 0 0 4px rgba(193,105,42,0.12);
  }
  .form-group input::placeholder { color: #c5a888; }

  .btn-login {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, var(--clay-mid) 0%, var(--clay-warm) 100%);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s, filter 0.2s;
    box-shadow: 0 6px 24px rgba(193,105,42,0.35);
    margin-top: 10px;
    position: relative;
    overflow: hidden;
  }
  .btn-login::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, transparent 60%);
    pointer-events: none;
  }
  .btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 32px rgba(193,105,42,0.45);
    filter: brightness(1.07);
  }
  .btn-login:active {
    transform: translateY(0);
    box-shadow: 0 4px 16px rgba(193,105,42,0.3);
  }

  .error-msg {
    background: rgba(180,40,40,0.1);
    border: 1.5px solid rgba(180,40,40,0.3);
    border-radius: 8px;
    color: #b42828;
    font-size: 0.85rem;
    padding: 10px 14px;
    margin-bottom: 20px;
    text-align: center;
    display: flex; align-items: center; gap: 8px; justify-content: center;
    animation: shake 0.4s ease;
  }
  @keyframes shake {
    0%,100%{ transform: translateX(0); }
    20%    { transform: translateX(-6px); }
    60%    { transform: translateX(6px); }
  }

  .footer-note {
    text-align: center;
    margin-top: 24px;
    font-size: 0.72rem;
    color: #b89070;
    letter-spacing: 0.05em;
  }

  /* Input icon wrapper */
  .input-wrap { position: relative; }
  .input-icon {
    position: absolute;
    right: 14px; top: 50%;
    transform: translateY(-50%);
    color: var(--clay-light);
    pointer-events: none;
  }
  .input-wrap input { padding-right: 44px; }
</style>
</head>
<body>

<div class="deco-circle c1"></div>
<div class="deco-circle c2"></div>
<div class="deco-circle c3"></div>

<div class="particles" id="particles"></div>

<div class="page-wrapper">

  <!-- Banner empresa -->
  <div class="banner">
    <div class="logo-wrap">
      <!-- Logo SVG representativo de arcilla/cerámica -->
      <svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="28" cy="28" r="26" fill="#8b4513" opacity=".12"/>
        <ellipse cx="28" cy="34" rx="18" ry="8" fill="#c1692a" opacity=".85"/>
        <ellipse cx="28" cy="30" rx="14" ry="12" fill="#e8a96e"/>
        <ellipse cx="28" cy="26" rx="10" ry="8" fill="#c1692a" opacity=".7"/>
        <ellipse cx="28" cy="22" rx="6" ry="4" fill="#8b4513" opacity=".5"/>
        <rect x="24" y="38" width="8" height="6" rx="2" fill="#8b4513" opacity=".6"/>
        <ellipse cx="28" cy="44" rx="8" ry="2.5" fill="#3b1f0e" opacity=".3"/>
      </svg>
    </div>
    <div class="banner-title">BIENVENIDOS<br>ARCILLA MLC</div>
    <div class="banner-subtitle">Sistema de Gestión Empresarial</div>
  </div>

  <!-- Tarjeta login -->
  <div class="card">
    <div class="card-heading">Iniciar <span>Sesión</span></div>

    <?php if ($error): ?>
    <div class="error-msg">
      <svg width="16" height="16" fill="none" viewBox="0 0 16 16"><circle cx="8" cy="8" r="7" stroke="#b42828" stroke-width="1.5"/><path d="M8 5v4M8 11v.5" stroke="#b42828" stroke-width="1.5" stroke-linecap="round"/></svg>
      <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
      <input type="hidden" name="action" value="login">

      <div class="form-group">
        <label for="usuario">Número de Identificación</label>
        <div class="input-wrap">
          <input type="text" id="usuario" name="usuario" placeholder="Ej. 1014245906"
                 value="<?= htmlspecialchars($_POST['usuario'] ?? '') ?>" required>
          <span class="input-icon">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" stroke="#c1692a" stroke-width="1.7"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" stroke="#c1692a" stroke-width="1.7" stroke-linecap="round"/></svg>
          </span>
        </div>
      </div>

      <div class="form-group">
        <label for="clave">Contraseña</label>
        <div class="input-wrap">
          <input type="password" id="clave" name="clave" placeholder="••••••••" required>
          <span class="input-icon">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24"><rect x="5" y="11" width="14" height="10" rx="2" stroke="#c1692a" stroke-width="1.7"/><path d="M8 11V7a4 4 0 018 0v4" stroke="#c1692a" stroke-width="1.7" stroke-linecap="round"/></svg>
          </span>
        </div>
      </div>

      <button type="submit" class="btn-login">INGRESAR AL SISTEMA</button>
    </form>

    <div class="footer-note">© 2025 ARCILLA MLC · Todos los derechos reservados</div>
  </div>
</div>

<script>
  // Partículas flotantes
  const container = document.getElementById('particles');
  for (let i = 0; i < 22; i++) {
    const p = document.createElement('div');
    p.className = 'particle';
    p.style.cssText = `
      left: ${Math.random()*100}%;
      bottom: ${Math.random()*30}%;
      animation-duration: ${4+Math.random()*6}s;
      animation-delay: ${Math.random()*6}s;
      opacity: 0;
      width: ${2+Math.random()*3}px;
      height: ${2+Math.random()*3}px;
    `;
    container.appendChild(p);
  }
</script>
</body>
</html>
