<?php
class OrphanAttribute {
    public static function getAttributes($conn, $orphan_id) {
        $stmt = $conn->prepare("
            SELECT a.name, eav.value
            FROM entity_attribute_values eav
            JOIN attributes a ON eav.attribute_id = a.attribute_id
            WHERE eav.entity_type_id = 1 AND eav.entity_id = ?
        ");
        $stmt->execute([$orphan_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function saveAttribute($conn, $orphan_id, $attribute_id, $value) {
        $stmt = $conn->prepare("
            INSERT INTO entity_attribute_values (entity_type_id, entity_id, attribute_id, value)
            VALUES (1, ?, ?, ?)
        ");
        return $stmt->execute([$orphan_id, $attribute_id, $value]);
    }

    public static function getAttributesByCategory($conn, $category) {
        $stmt = $conn->prepare("SELECT attribute_id, name FROM attributes WHERE category = ?");
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function addNewAttribute($conn, $name, $category, $data_type = 'string') {
        $stmt = $conn->prepare("INSERT INTO attributes (name, data_type, category) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $data_type, $category]);
    }
    
    
}
