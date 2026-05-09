<?php
session_start();
require_once __DIR__ . '/../../config/db_connection.php';
require_once __DIR__ . '/../controllers/ReportController.php';

ReportController::saveReport();
