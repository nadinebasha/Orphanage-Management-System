<?php
require_once __DIR__ . '/../models/Donation.php';
require_once __DIR__ . '/../../config/db_connection.php';

class DonationController {

    public static function handleUserDonation() {
        global $conn;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $donor = $_POST['donor_name'];
            $amount = $_POST['amount'];
            $desc = $_POST['description'];

            return Donation::create($conn, $donor, $amount, $desc);
        }
        return false;
    }

    public static function handleAdminActions() {
        global $conn;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $donation_id = $_POST['donation_id'] ?? null;
            $donor = $_POST['donor_name'];
            $amount = $_POST['amount'];
            $desc = $_POST['description'];
            $date = $_POST['date'];

            if ($donation_id) {
                Donation::update($conn, $donation_id, $donor, $amount, $desc, $date);
            } else {
                Donation::create($conn, $donor, $amount, $desc);
            }
            header("Location: manage_donations.php");
            exit;
        }

    }

    public static function getAllDonations() {
        global $conn;
        return Donation::getAll($conn);
    }
}
