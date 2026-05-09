<?php
class AdoptionRequest {
    public static function getAll($conn) {
        $stmt = $conn->query("
            SELECT ar.request_id, ar.orphan_id, ar.guardian_id, o.first_name AS orphan_name, 
                   g.first_name AS guardian_name, ar.request_date, ar.status 
            FROM adoption_requests ar
            JOIN orphans o ON ar.orphan_id = o.orphan_id
            JOIN guardians g ON ar.guardian_id = g.guardian_id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($conn, $orphan_id, $guardian_id, $date, $status) {
        $stmt = $conn->prepare("INSERT INTO adoption_requests (orphan_id, guardian_id, request_date, status) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$orphan_id, $guardian_id, $date, $status]);
    }

    public static function update($conn, $id, $orphan_id, $guardian_id, $date, $status) {
        $stmt = $conn->prepare("UPDATE adoption_requests SET orphan_id=?, guardian_id=?, request_date=?, status=? WHERE request_id=?");
        return $stmt->execute([$orphan_id, $guardian_id, $date, $status, $id]);
    }

    public static function delete($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM adoption_requests WHERE request_id=?");
        return $stmt->execute([$id]);
    }
}
