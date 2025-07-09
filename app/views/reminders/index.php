
<?php require_once'app/views/templates/header.php'; ?>
<div class="container">
    <div class="page-header" id="banner">
       <div class="row">
          <div class="col-lg-12">
             <h1>My Reminders</h1>
             <p class="lead">Manage your personal reminders</p>
             <a href="/reminders/create" class="btn btn-primary">Create New Reminder</a>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
<?php
   if (!empty($data['reminders'])) {
       foreach ($data['reminders'] as $reminder) {
          echo "<div class='card mb-3'>";
          echo "<div class='card-body'>";
          echo "<h5 class='card-title'>" . htmlspecialchars($reminder['subject']) . "</h5>";
          if (!empty($reminder['created_at'])) {
              echo "<p class='card-text'><small class='text-muted'>Created: " . htmlspecialchars($reminder['created_at']) . "</small></p>";
          }
          echo "<div class='mt-2'>";
          echo "<a href='/reminders/edit/{$reminder['id']}' class='btn btn-sm btn-primary'>Edit</a> ";
          echo "<a href='/reminders/delete/{$reminder['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this reminder?');\">Delete</a>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
       }
   } else {
       echo "<p class='text-muted'>No reminders found. <a href='/reminders/create'>Create your first reminder</a>.</p>";
   }
?>
        </div>
    </div>
</div>

<?php require_once "app/views/templates/footer.php"; ?>
