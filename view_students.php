<?php
require_once 'db_connect.php'; // $pdo

$stmt = $pdo->query("SELECT id, fullname, email, phone, gender, course, address, reg_date FROM student ORDER BY id DESC");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Registered Students</title>
<link rel="stylesheet" href="style.css"></head><body>
<div class="view-container">
  <h2>Registered Students</h2>
  <table>
    <tr><th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>Gender</th><th>Course</th><th>Address</th><th>Reg Date</th></tr>
    <?php if ($rows): foreach ($rows as $r): ?>
      <tr>
        <td><?php echo htmlspecialchars($r['id']); ?></td>
        <td><?php echo htmlspecialchars($r['fullname']); ?></td>
        <td><?php echo htmlspecialchars($r['email']); ?></td>
        <td><?php echo htmlspecialchars($r['phone']); ?></td>
        <td><?php echo htmlspecialchars($r['gender']); ?></td>
        <td><?php echo htmlspecialchars($r['course']); ?></td>
        <td><?php echo htmlspecialchars($r['address']); ?></td>
        <td><?php echo htmlspecialchars($r['reg_date']); ?></td>
      </tr>
    <?php endforeach; else: ?>
      <tr><td colspan="8">No students yet.</td></tr>
    <?php endif; ?>
  </table>
  <p><a href="index.html" class="btn">Register another</a></p>
</div>
</body></html>
