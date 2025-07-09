
<?php

class Note {
  private $db;

  public function __construct() {
    $this->db = db_connect();
  }

  public function get_all_notes($user_id) {
    $stmt = $this->db->prepare("SELECT * FROM notes WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_note_by_id($id) {
    $stmt = $this->db->prepare("SELECT * FROM notes WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert_note($data) {
    $stmt = $this->db->prepare("INSERT INTO notes (user_id, subject) VALUES (:user_id, :subject)");
    $stmt->execute([
      'user_id' => $data['user_id'],
      'subject' => $data['subject']
    ]);
  }

  public function update_note($id, $data) {
    $stmt = $this->db->prepare("UPDATE notes SET subject = :subject WHERE id = :id");
    $stmt->execute([
      'subject' => $data['subject'],
      'id' => $id
    ]);
  }

  public function delete_note($id) {
    $stmt = $this->db->prepare("DELETE FROM notes WHERE id = ?");
    $stmt->execute([$id]);
  }
}
