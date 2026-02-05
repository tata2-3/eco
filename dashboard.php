<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ECO-NET | Dashboard</title>

<style>
* {
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

/* NO PAGE SCROLL */
html, body {
  height: 100%;
  margin: 0;
  background: #f3f7f1;
}

/* HEADER */
.header {
  height: 80px;
  background: linear-gradient(90deg, #3e7c2b, #7fb34d);
  padding: 15px 30px;
  color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header-left {
  display: flex;
  align-items: center;
  gap: 10px;
}

.logo {
  width: 50px;
}

.header-left h1 {
  font-size: 22px;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 20px;
}

.dashboard-title {
  background: #fff;
  color: #3e7c2b;
  font-size: 18px;
  font-weight: bold;
  padding: 4px 10px;
  border-radius: 4px;
}

.admin-actions {
  display: flex;
  align-items: center;
  gap: 10px;
}

.header-btn {
  background: #7fb34d;
  color: #fff;
  padding: 6px 12px;
  border-radius: 6px;
  text-decoration: none;
  font-size: 12px;
}

.header-btn:hover,
.header-btn.active {
  background: #4e8b2e;
}

/* MAIN CONTAINER */
.container {
  height: calc(100vh - 80px);
  padding: 20px 30px;
}

/* DASHBOARD SECTION */
#dashboard-section {
  height: 100%;
  display: flex;
  flex-direction: column;
  gap: 20px;
  overflow-y: auto; /* vertical scroll */
  padding-right: 10px; 
}

/* TOP SECTION */
.top-section {
  display: flex;
  gap: 20px;
}

/* CARDS */
.cards { flex: 1; }

.card {
  padding: 15px 25px; /* slightly reduced top/bottom padding */
  border-radius: 12px;
  color: #fff;
  height: 90%; /* decrease card size by ~10% */
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.card h3 {
  margin: -35px 0 10px 0; /* gap below title kept suitable */
}

.green {
  background: linear-gradient(135deg, #4e8b2e, #7fb34d);
}

.detections-content {
  display: flex;
  align-items: center;
  gap: 10px; /* gap between number and icon */
}

.detections-number {
  font-size: 44px;
  font-weight: bold;
  margin: 0;
}

.detections-icon {
  width: 60px;
}

/* CHART */
.charts { flex: 1; }

.chart-box {
  background: #fff;
  border-radius: 16px;
  padding: 25px;
  height: 100%;
  text-align: center;
}

.pie {
  width: 140px;
  height: 140px;
  border-radius: 50%;
  background: conic-gradient(
    #4e8b2e 0% 40%,
    #7fb34d 40% 75%,
    #b5dc7a 75% 100%
  );
  margin: auto;
}

/* TABLE */
.table-box {
  flex: 1;
  background: #fff;
  border-radius: 14px;
  padding: 15px;
  display: flex;
  flex-direction: column;
  max-height: 400px; /* optional: limit table height */
}

.table-box h3 {
  margin: 0 0 10px 0;
  padding: 10px;
  background: rgba(67, 151, 21, 0.45);
  color: #0b4b0b;
  border-radius: 8px;
}

.table-wrapper {
  flex: 1;
  overflow-y: auto; /* table scroll if too long */
}

table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}

thead th {
  position: sticky;
  top: 0;
  background: #eaf3e3;
  z-index: 1;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

tbody tr:hover {
  background: #f3f7f1;
}

/* VIDEO */
#video-section {
  height: 100%;
  display: none;
}

.video-frame {
  height: 100%;
  background: #bfc4c0;
  padding: 6px;
  border-radius: 12px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.video-frame video {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
  border-radius: 8px;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
  <div class="header-left">
    <img src="econetlogo.png" class="logo">
    <h1>ECO-NET <span class="dashboard-title">Dashboard</span></h1>
  </div>

  <div class="admin-actions">
    <a href="#" class="header-btn active" onclick="showSection('dashboard')">Dashboard</a>
    <a href="#" class="header-btn" onclick="showSection('video')">Video</a>
    <a href="change_credentials.php" class="header-btn">Change Credentials</a>
    <a href="logout.php" class="header-btn">Logout</a>
  </div>
</div>

<div class="container">

<!-- DASHBOARD -->
<div id="dashboard-section">

  <div class="top-section">
    <div class="cards">
      <div class="card green">
        <h3>Total Detections</h3>
        <div class="detections-content">
          <p class="detections-number">1,256</p>
          <img src="bottle.png" class="detections-icon">
        </div>
      </div>
    </div>

    <div class="charts">
      <div class="chart-box">
        <h3>Storage</h3>
        <div class="pie"></div>
      </div>
    </div>
  </div>

  <div class="table-box">
    <h3>Recent Detections</h3>
    <div class="table-wrapper">
      <table>
        <thead>
          <tr><th>ID</th><th>Size</th><th>Date</th><th>Time</th></tr>
        </thead>
        <tbody>
          <tr><td>1</td><td>Small</td><td>2026-01-27</td><td>10:15</td></tr>
          <tr><td>2</td><td>Large</td><td>2026-01-27</td><td>10:24</td></tr>
          <tr><td>3</td><td>Medium</td><td>2026-01-27</td><td>10:48</td></tr>
          <tr><td>4</td><td>Small</td><td>2026-01-27</td><td>11:02</td></tr>
          <tr><td>5</td><td>Large</td><td>2026-01-27</td><td>11:18</td></tr>
          <tr><td>6</td><td>Medium</td><td>2026-01-27</td><td>11:36</td></tr>
          <tr><td>7</td><td>Small</td><td>2026-01-27</td><td>11:50</td></tr>
          <tr><td>8</td><td>Large</td><td>2026-01-27</td><td>12:05</td></tr>
          <tr><td>9</td><td>Medium</td><td>2026-01-27</td><td>12:21</td></tr>
          <tr><td>10</td><td>Small</td><td>2026-01-27</td><td>12:37</td></tr>
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- VIDEO -->
<div id="video-section">
  <div class="video-frame">
    <video autoplay loop muted playsinline>
      <source src="ecovid.mp4" type="video/mp4">
    </video>
  </div>
</div>

</div>

<script>
function showSection(section) {
  document.getElementById('dashboard-section').style.display =
    section === 'dashboard' ? 'flex' : 'none';

  document.getElementById('video-section').style.display =
    section === 'video' ? 'block' : 'none';

  document.querySelectorAll('.header-btn').forEach(btn => btn.classList.remove('active'));
  event.target.classList.add('active');
}
</script>

</body>
</html>
