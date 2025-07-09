<?php require_once'app/views/templates/header.php'; ?>
<div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Notes</li>
      </ol>
    </nav>
    <div class="page-header" id="banner">
       <div class="row">
          <div class="col-lg-12">
             <h1>Notes</h1>
             <p><a href="/notes/create">Create a new note</a></p>
          </div>
        </div>
    </div>

<?php
   if (!empty($data['notes'])) {
       foreach ($data['notes'] as $note) {
          echo "<div class='card mb-3'>";
          echo "<div class='card-body'>";
          echo "<h5 class='card-title'>" . htmlspecialchars($note['subject']) . "</h5>";
          if ($note['completed']) {
              echo "<span class='badge bg-success'>Completed</span>";
          } else {
              echo "<span class='badge bg-warning'>Pending</span>";
          }
          echo "<div class='mt-2'>";
          echo "<a href='/notes/update/{$note['id']}' class='btn btn-sm btn-primary'>Edit</a> ";
          echo "<a href='/notes/delete/{$note['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this note?');\">Delete</a>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
       }
   } else {
       echo "<p class='text-muted'>No notes found. <a href='/notes/create'>Create your first note</a>.</p>";
   }
?>
   
<?php require_once "app/views/templates/footer.php" ?>
