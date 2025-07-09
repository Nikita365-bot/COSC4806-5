<div class="container mt-5">

  <h2 class="mb-4">Admin Reports</h2>

  <!-- Static Alert -->
  <div class="alert alert-success" role="alert">
    Welcome back, Admin! Here are your system reports.
  </div>

  <!-- Optional Toast -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          Admin report loaded successfully!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <!-- All Reminders -->
  <div class="card mb-4">
    <div class="card-header">All Reminders</div>
    <ul class="list-group list-group-flush">
      <?php foreach ($data['all_reminders'] as $reminder): ?>
        <li class="list-group-item">
          <?= htmlspecialchars($reminder['subject']) ?> (User: <?= htmlspecialchars($reminder['username']) ?>)
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- Top User -->
  <div class="card mb-4">
    <div class="card-header">Top Reminder Creator</div>
    <div class="card-body">
      <?php if (!empty($data['top_user'])): ?>
        <p class="card-text">User: <strong><?= htmlspecialchars($data['top_user']['username']) ?></strong> with 
        <strong><?= $data['top_user']['reminder_count'] ?></strong> reminders</p>
      <?php else: ?>
        <p class="card-text text-muted">No reminders found.</p>
      <?php endif; ?>
    </div>
  </div>

  <!-- Login Counts -->
  <div class="card mb-4">
    <div class="card-header">Login Counts</div>
    <ul class="list-group list-group-flush">
      <?php foreach ($data['login_counts'] as $log): ?>
        <li class="list-group-item">
          <?= htmlspecialchars($log['username']) ?>: <?= $log['total'] ?> successful logins
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- Chart -->
  <div class="card">
    <div class="card-header">Login Chart</div>
    <div class="card-body">
      <canvas id="loginChart" width="600" height="300"></canvas>
    </div>
  </div>
</div>

<!-- Chart.js & Bootstrap Toast Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('loginChart').getContext('2d');
  const loginChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode(array_column($data['login_counts'], 'username')) ?>,
      datasets: [{
        label: 'Login Count',
        data: <?= json_encode(array_column($data['login_counts'], 'total')) ?>,
        backgroundColor: 'rgba(54, 162, 235, 0.6)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: { precision: 0 }
        }
      }
    }
  });

  // Auto show toast
  const toastEl = document.querySelector('.toast');
  const toast = new bootstrap.Toast(toastEl);
  toast.show();
</script>
