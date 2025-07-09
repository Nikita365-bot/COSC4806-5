<?php

class Reminders extends Controller {

  public function index() {
    $R = $this->model('Reminder');
    $user_id = 11; 
    $list_of_reminders = $R->get_all_reminders($user_id);

    $this->view('reminders/index', ["reminders" => $list_of_reminders]);
  }

  public function create() {
    $this->view('reminders/create');
  }

  public function store() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $R = $this->model('Reminder');

      $data = [
        'user_id' => 11, // Fixed to user ID 11
        'subject' => $_POST['subject']
      ];
      
      $R->insert_reminder($data);
      header('Location: /reminders');
      exit();
    } else {
      header('Location: /reminders');
      exit();
    }
  }

  public function edit($id = null) {
    if (!$id) {
      header('Location: /reminders');
      exit;
    }

    $R = $this->model('Reminder');
    $reminder = $R->get_reminder_by_id($id);

    if (!$reminder) {
      header('Location: /reminders');
      exit;
    }

    $this->view('reminders/edit', ['reminder' => $reminder]);
  }

  public function update($id = null) {
    if (!$id || $_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /reminders');
      exit;
    }

    $R = $this->model('Reminder');
    
    $data = [
      'subject' => $_POST['subject'],
      'user_id' => 11 
    ];

    $R->update_reminder($id, $data);
    header('Location: /reminders');
    exit;
  }

  public function delete($id = null) {
      if (!$id) {
        header('Location: /reminders');
        exit;
      }

      $R = $this->model('Reminder');
      $R->delete_reminder($id, 11); // Fixed to user ID 11
      header('Location: /reminders');
      exit;
    }
}