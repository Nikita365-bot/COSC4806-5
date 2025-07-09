
<?php require_once'app/views/templates/header.php'; ?>
<div class="container">
    <div class="page-header" id="banner">
       <div class="row">
          <div class="col-lg-12">
             <h1>Create New Note</h1>
             <p><a href="/notes">← Back to Notes</a></p>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form method="POST" action="/notes/store">
                <div class="mb-3">
                    <label for="subject" class="form-label">Note Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Note</button>
                <a href="/notes" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php require_once "app/views/templates/footer.php" ?>
