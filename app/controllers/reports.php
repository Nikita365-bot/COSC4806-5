<?php
class Reports extends Controller {
  public function index() {

    if (!isset($_SESSION['username']) || strtolower($_SESSION['username']) !== 'admin') {
      header('Location: /login');
      exit;
    }


    $Reminder = $this->model('Reminder');
    $User = $this->model('User');


    $data = [
      'all_reminders' => $Reminder->get_all(),
      'top_user' => $Reminder->get_top_user(),
      'login_counts' => $User->get_login_counts(),
    ];


    $this->view('reports/index', $data);
  }
}
