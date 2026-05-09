<?php
class Orphan {
    public static function getAll($conn) {
        return $conn->query("SELECT * FROM orphans")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($conn, $first, $last, $dob, $history, $admission) {
        $stmt = $conn->prepare("INSERT INTO orphans (first_name, last_name, dob, medical_history, admission_date) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$first, $last, $dob, $history, $admission]);
    }

    public static function update($conn, $id, $first, $last, $dob, $history, $admission) {
        $stmt = $conn->prepare("UPDATE orphans SET first_name=?, last_name=?, dob=?, medical_history=?, admission_date=? WHERE orphan_id=?");
        return $stmt->execute([$first, $last, $dob, $history, $admission, $id]);
    }

    public static function delete($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM orphans WHERE orphan_id=?");
        return $stmt->execute([$id]);
    }
}
