<?php
class Donation {
    public static function getAll($conn) {
        return $conn->query("SELECT * FROM donations")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($conn, $donor, $amount, $description) {
        $stmt = $conn->prepare("INSERT INTO donations (donor_name, amount, description, date) VALUES (?, ?, ?, NOW())");
        return $stmt->execute([$donor, $amount, $description]);
    }

    public static function update($conn, $id, $donor, $amount, $description, $date) {
        $stmt = $conn->prepare("UPDATE donations SET donor_name=?, amount=?, description=?, date=? WHERE donation_id=?");
        return $stmt->execute([$donor, $amount, $description, $date, $id]);
    }

}
