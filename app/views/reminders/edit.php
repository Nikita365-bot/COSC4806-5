<?php require_once'app/views/templates/header.php'; ?>
<div class="container">
    <div class="page-header" id="banner">
       <div class="row">
          <div class="col-lg-12">
             <h1>Edit Reminder</h1>
             <p><a href="/reminders">← Back to Reminders</a></p>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form method="POST" action="/reminders/update/<?php echo $data['reminder']['id']; ?>">
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" 
                           value="<?php echo htmlspecialchars($data['reminder']['subject']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Reminder</button>
                <a href="/reminders" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php require_once "app/views/templates/footer.php"; ?>