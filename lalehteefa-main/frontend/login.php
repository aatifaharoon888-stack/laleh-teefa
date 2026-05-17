<?php require_once __DIR__ . '/bootstrap.php'; ?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign In · Laleh</title>
<link rel="icon" href="assets/favicon.svg" type="image/svg+xml" sizes="any">
<link rel="apple-touch-icon" href="assets/favicon.svg">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/finesse.css">
</head><body>
<main class="auth-page">
  <aside class="auth-art">
    <h2>"Style isn't worn — it's <span>composed</span>." Welcome back to your atelier.</h2>
  </aside>
  <section class="auth-form-wrap">
    <form class="auth-form" onsubmit="doLogin(event)">
      <a href="index.php" class="logo">LA<span style="color:var(--accent)">LEH</span></a>
      <h1>Welcome back.</h1>
      <p class="sub">Sign in to your atelier.</p>
      <div class="msg"></div>
      <div class="field"><label>Email</label><input type="email" name="email" required></div>
      <div class="field"><label>Password</label><input type="password" name="password" minlength="6" required></div>
      <button class="btn btn-primary">Enter Studio â†’</button>
      <p class="alt">New here? <a href="signup.php">Create an atelier</a></p>
    </form>
  </section>
</main>
<div id="floating-slot"></div>
<script src="js/finesse.js"></script>
<script src="js/auth.js"></script>
</body></html>
