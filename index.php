<?php

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>EconomyBookings — Car Rental</title>
  <style>
    /* Reset + base */
    *{box-sizing:border-box;margin:0;padding:0}
    html,body{font-family:Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; color:#1f2937;background:#f8fafc}
    a{color:inherit;text-decoration:none}

    /* Container */
    .container{max-width:1200px;margin:24px auto;padding:0 16px}

    /* Header */
    header{background:linear-gradient(90deg,#0f172a 0%,#0b1220 100%);color:#fff;padding:18px 0;border-radius:12px}
    .header-inner{display:flex;align-items:center;justify-content:space-between;gap:16px}
    .logo{display:flex;align-items:center;gap:12px}
    .logo img{width:48px;height:48px;border-radius:8px;object-fit:cover}
    .brand{font-weight:700;font-size:20px}
    .nav{display:flex;gap:12px;align-items:center}
    .btn{background:#06b6d4;color:#03203a;padding:10px 14px;border-radius:8px;font-weight:600}

    /* Search card */
    .search-card{background:#ffffff;padding:18px;border-radius:10px;box-shadow:0 6px 20px rgba(2,6,23,0.12);margin-top:18px}
    .search-grid{display:grid;grid-template-columns:1.6fr repeat(4,1fr) auto;gap:12px;align-items:center}
    .field{display:flex;flex-direction:column;gap:6px}
    label{font-size:12px;color:#475569}
    input[type=text],select{padding:10px;border:1px solid #e6eef5;border-radius:8px;font-size:14px}
    .search-btn{background:#06b6d4;color:#03203a;padding:12px 18px;border-radius:8px;border:none;cursor:pointer;font-weight:700}

    /* Features */
    .features{display:flex;gap:12px;flex-wrap:wrap;margin:22px 0}
    .feature{flex:1 1 220px;background:#fff;padding:14px;border-radius:10px;box-shadow:0 4px 14px rgba(2,6,23,0.06)}
    .feature h4{font-size:14px;margin-bottom:8px}
    .feature p{font-size:13px;color:#475569}

    /* Cars grid */
    .section-title{display:flex;justify-content:space-between;align-items:center;margin:14px 0}
    .cars{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
    .card{background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 6px 18px rgba(2,6,23,0.06);display:flex;flex-direction:column}
    .card .media{height:160px;background:linear-gradient(90deg,#e6f6fb,#ffffff);display:flex;align-items:center;justify-content:center}
    .card img{max-width:100%;max-height:140px}
    .card .body{padding:12px;flex:1;display:flex;flex-direction:column;gap:8px}
    .car-title{font-weight:700}
    .car-meta{font-size:13px;color:#64748b}
    .price-row{display:flex;justify-content:space-between;align-items:center;margin-top:auto}
    .price{font-weight:800;color:#0f172a}
    .cta{background:#06b6d4;color:#03203a;padding:8px 12px;border-radius:8px;font-weight:700;border:none;cursor:pointer}

    /* Popular destinations list (simple) */
    .destinations{display:flex;flex-wrap:wrap;gap:10px}
    .dest{background:#fff;padding:10px 12px;border-radius:8px;box-shadow:0 4px 10px rgba(2,6,23,0.05)}

    /* Footer */
    footer{margin-top:22px;padding:18px 0;text-align:center;color:#64748b}

    /* Responsive */
    @media (max-width:1000px){
      .search-grid{grid-template-columns:1fr 1fr;grid-auto-rows:minmax(48px,auto)}
      .search-grid .search-btn{grid-column:1 / -1}
      .cars{grid-template-columns:repeat(2,1fr)}
    }
    @media (max-width:640px){
      .header-inner{flex-direction:column;align-items:flex-start}
      .nav{width:100%;justify-content:space-between}
      .cars{grid-template-columns:1fr}
    }
  </style>
</head>
<body>
  <header>
    <div class="container header-inner">
      <div class="logo">
        <img src="https://via.placeholder.com/96x96.png?text=EB" alt="logo">
        <div>
          <div class="brand">EconomyBookings</div>
          <div style="font-size:12px;color:#9ca3af">Cheap car rentals worldwide</div>
        </div>
      </div>
      <nav class="nav">
        <a href="#" style="color:#cfecee">Deals</a>
        <a href="#" style="color:#cfecee">Help</a>
        <a class="btn" href="#">Sign in</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <section class="search-card">
      <form class="search-grid" onsubmit="event.preventDefault();alert('Search simulated — replace with real logic');">
        <div class="field">
          <label>Pick-up location</label>
          <input type="text" placeholder="Airport or city, e.g. Dubai" required>
        </div>
        <div class="field">
          <label>Pick-up date</label>
          <input type="text" placeholder="YYYY-MM-DD">
        </div>
        <div class="field">
          <label>Pick-up time</label>
          <input type="text" placeholder="10:00">
        </div>
        <div class="field">
          <label>Drop-off date</label>
          <input type="text" placeholder="YYYY-MM-DD">
        </div>
        <div class="field">
          <label>Drop-off time</label>
          <input type="text" placeholder="10:00">
        </div>
        <button class="search-btn" type="submit">Search</button>
      </form>

      <div class="features" style="margin-top:16px">
        <div class="feature"><h4>20,000+ locations</h4><p>Find cars at airports and city locations worldwide.</p></div>
        <div class="feature"><h4>600+ suppliers</h4><p>We compare many suppliers to give the best price.</p></div>
        <div class="feature"><h4>24/5 support</h4><p>Multi-language customer support to help your booking.</p></div>
      </div>
    </section>

    <div class="section-title">
      <h3>Popular deals</h3>
      <a href="#">View all</a>
    </div>

    <section class="cars">
      <!-- Card 1 -->
      <article class="card">
        <div class="media"><img src="https://via.placeholder.com/320x140.png?text=Toyota+Corolla" alt="Toyota Corolla"></div>
        <div class="body">
          <div class="car-title">Toyota Corolla or similar</div>
          <div class="car-meta">Compact — 4 seats — Manual</div>
          <div class="price-row">
            <div class="price">€24.50 / day</div>
            <button class="cta">Select</button>
          </div>
        </div>
      </article>

      <!-- Card 2 -->
      <article class="card">
        <div class="media"><img src="https://via.placeholder.com/320x140.png?text=Ford+Focus" alt="Ford Focus"></div>
        <div class="body">
          <div class="car-title">Ford Focus or similar</div>
          <div class="car-meta">Compact — 5 seats — Automatic</div>
          <div class="price-row">
            <div class="price">€29.90 / day</div>
            <button class="cta">Select</button>
          </div>
        </div>
      </article>

      <!-- Card 3 -->
      <article class="card">
        <div class="media"><img src="https://via.placeholder.com/320x140.png?text=SUV+Nissan+X-Trail" alt="SUV"></div>
        <div class="body">
          <div class="car-title">Nissan X-Trail or similar</div>
          <div class="car-meta">SUV — 5 seats — Automatic</div>
          <div class="price-row">
            <div class="price">€49.00 / day</div>
            <button class="cta">Select</button>
          </div>
        </div>
      </article>
    </section>

    <div class="section-title" style="margin-top:20px">
      <h3>Popular destinations</h3>
      <a href="#">See more</a>
    </div>

    <div class="destinations">
      <div class="dest">Dubai — from €31.25/day</div>
      <div class="dest">London — from €26.76/day</div>
      <div class="dest">Las Vegas — from €19.91/day</div>
      <div class="dest">Iceland — from €27.50/day</div>
      <div class="dest">Malaga — from €18.30/day</div>
    </div>

  </main>

  <footer>
    <div class="container">
      © 2008-2025 Booking Group Corporation Ltd. Cheap car rental. All rights reserved.
    </div>
  </footer>
</body>
</html>