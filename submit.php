<?php
// submit.php
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once 'db_connect.php'; // provides $pdo

// only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

function pv($k){ return isset($_POST[$k]) ? trim($_POST[$k]) : null; }

$name = pv('fullname');
$email = pv('email');
$phone = pv('phone');
$gender = pv('gender');
$course = pv('course');
$address = pv('address');

$errors = [];
if (!$name) $errors[] = 'Full name required';
if (!$email) $errors[] = 'Email required';
if ($phone && !preg_match('/^[0-9]{10}$/', $phone)) $errors[] = 'Phone must be 10 digits';

$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($errors) {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success'=>false, 'errors'=>$errors]);
        exit;
    } else {
        foreach ($errors as $e) echo "<p style='color:red;'>".htmlspecialchars($e)."</p>";
        exit;
    }
}

try {
    $stmt = $pdo->prepare("INSERT INTO student (fullname, email, phone, gender, course, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $gender, $course, $address]);

    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success'=>true, 'redirect'=>'success.php']);
        exit;
    } else {
        header('Location: success.php');
        exit;
    }
} catch (PDOException $e) {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success'=>false, 'error'=>$e->getMessage()]);
    } else {
        echo "<p style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    exit;
}
