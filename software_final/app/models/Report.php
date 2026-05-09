<?php
class Report {
    public static function getTotalOrphans($conn) {
        return $conn->query("SELECT COUNT(*) FROM orphans")->fetchColumn();
    }

    public static function getTotalDonations($conn) {
        return $conn->query("SELECT SUM(amount) FROM donations")->fetchColumn();
    }

    public static function getTotalApprovedAdoptions($conn) {
        return $conn->query("SELECT COUNT(*) FROM adoption_requests WHERE status='Approved'")->fetchColumn();
    }
    public static function getAll($conn) {
        $stmt = $conn->query("
            SELECT r.report_id, r.report, r.created_at,
                   o.orphan_id, o.first_name AS orphan_fname, o.last_name AS orphan_lname,
                   u.username AS nurse_name,
                   (
                     SELECT value
                     FROM entity_attribute_values eav
                     WHERE eav.entity_id = o.orphan_id
                       AND eav.attribute_id = 1
                       AND eav.entity_type_id = 1
                     ORDER BY eav_id DESC LIMIT 1
                   ) AS blood_type
            FROM nurse_reports r
            JOIN orphans o ON r.orphan_id = o.orphan_id
            JOIN users u ON r.nurse_id = u.user_id
            ORDER BY r.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getAttributesForOrphan($conn, $orphan_id) {
        $stmt = $conn->prepare("
            SELECT a.name, eav.value
            FROM entity_attribute_values eav
            JOIN attributes a ON a.attribute_id = eav.attribute_id
            WHERE eav.entity_type_id = 1 AND eav.entity_id = ?
        ");
        $stmt->execute([$orphan_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

