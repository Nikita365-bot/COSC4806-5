
<?php

class Notes extends Controller {

  public function index() {
    $N = $this->model('Note');
    $user_id = 11; // Fixed to user ID 11
    $list_of_notes = $N->get_all_notes($user_id);

    // Debug: Check what we're getting
    error_log("User ID: " . $user_id);
    error_log("Notes count: " . count($list_of_notes));
    error_log("Notes data: " . print_r($list_of_notes, true));

    $this->view('notes/index', ["notes" => $list_of_notes]);
  }

  public function create() {
    $this->view('notes/create');
  }

  public function store() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $N = $this->model('Note');

      $data = [
        'user_id' => 11, // Fixed to user ID 11
        'subject' => $_POST['subject']
      ];

      $N->insert_note($data);
      header('Location: /notes');
      exit;
    }
  }

  public function update($id = null) {
    if (!$id) {
      header('Location: /notes');
      exit;
    }

    $N = $this->model('Note');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = [
        'subject' => $_POST['subject']
      ];

      $N->update_note($id, $data);
      header('Location: /notes');
      exit;
    } else {
      $note = $N->get_note_by_id($id);
      $this->view('notes/edit', ['note' => $note]);
    }
  }

  public function delete($id = null) {
    if (!$id) {
      header('Location: /notes');
      exit;
    }

    $N = $this->model('Note');
    $N->delete_note($id);
    header('Location: /notes');
    exit;
  }
}
