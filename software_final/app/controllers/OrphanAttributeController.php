<?php
require_once __DIR__ . '/../models/OrphanAttribute.php';

class OrphanAttributeController {

    public static function manageAttributes() {
        global $conn;
    
        $role = $_SESSION['role'];
        $category = $role === 'nurse' ? 'medical' : 'academic';
    
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
            self::deleteAttribute($_GET['delete']);
            header("Location: manage_attributes.php");
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
            self::updateAttribute($_POST['update_id'], $_POST['update_name']);
            header("Location: manage_attributes.php");
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['update_id'])) {
            $name = $_POST['name'] ?? '';
            if ($name !== '') {
                self::addAttribute($name, $category);
                header("Location: manage_attributes.php");
                exit;
            }
        }
    
        return OrphanAttribute::getAttributesByCategory($conn, $category);
    }
    

    public static function getAttributesByCategory($category) {
        global $conn;
        return OrphanAttribute::getAttributesByCategory($conn, $category);
    }

    public static function addAttribute($name, $category, $data_type = 'string') {
        global $conn;
        return OrphanAttribute::addNewAttribute($conn, $name, $category, $data_type);
    }
    

    public static function updateAttribute($id, $name) {
        global $conn;
        $stmt = $conn->prepare("UPDATE attributes SET name = ? WHERE attribute_id = ?");
        return $stmt->execute([$name, $id]);
    }

    public static function deleteAttribute($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM attributes WHERE attribute_id = ?");
        return $stmt->execute([$id]);
    }


    public static function handleTeacherGradesSubmission() {
        global $conn;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orphan_id = $_POST['orphan_id'];
            $attributes = $_POST['attributes'] ?? [];

            foreach ($attributes as $attribute_id => $value) {
                if (trim($value) !== '') {
                    OrphanAttribute::saveAttribute($conn, $orphan_id, $attribute_id, $value);
                }
            }

            header("Location: teacher_dashboard.php");
            exit;
        }
    }

    public static function handleNurseAttributesSubmission() {
        global $conn;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orphan_id = $_POST['orphan_id'];
            $attributes = $_POST['attributes'] ?? [];

            foreach ($attributes as $attribute_id => $value) {
                if (trim($value) !== '') {
                    OrphanAttribute::saveAttribute($conn, $orphan_id, $attribute_id, $value);
                }
            }

            header("Location: nurse_dashboard.php");
            exit;
        }
    }
}
