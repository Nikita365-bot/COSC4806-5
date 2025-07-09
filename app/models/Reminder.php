
<?php

class Reminder {
  private $db;

  public function __construct() {
    $this->db = db_connect();
  }

  public function get_all() {
    $stmt = $this->db->prepare("SELECT r.*, u.username FROM reminders r JOIN users u ON r.user_id = u.id ORDER BY r.created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_top_user() {
    $stmt = $this->db->prepare("SELECT u.username, COUNT(*) as reminder_count FROM reminders r JOIN users u ON r.user_id = u.id GROUP BY u.id ORDER BY reminder_count DESC LIMIT 1");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function get_all_reminders($user_id) {
    $stmt = $this->db->prepare("SELECT * FROM reminders WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_reminder_by_id($id) {
    $stmt = $this->db->prepare("SELECT * FROM reminders WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert_reminder($data) {
    $stmt = $this->db->prepare("INSERT INTO reminders (user_id, subject) VALUES (:user_id, :subject)");
    $stmt->execute([
      'user_id' => $data['user_id'],
      'subject' => $data['subject']
    ]);
  }

  public function update_reminder($id, $data) {
    $stmt = $this->db->prepare("UPDATE reminders SET subject = :subject WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
      'subject' => $data['subject'],
      'id' => $id,
      'user_id' => $data['user_id']
    ]);
  }

  public function delete_reminder($id, $user_id) {
    $stmt = $this->db->prepare("DELETE FROM reminders WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $user_id]);
  }
}
