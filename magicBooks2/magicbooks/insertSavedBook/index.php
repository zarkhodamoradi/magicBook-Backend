<?php
$host = "hotaka.liara.cloud";
$user = "root";
$password = "6f8Qa41M7Au2eWwBzkq8zHXb";
$databaseName = "Book";
$port = "31795";
$connect = new mysqli($host, $user, $password, $databaseName , $port);
// Check connection
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}

$params = json_decode(file_get_contents('php://input'), true);

$userName = $connect->real_escape_string($params['userName']);
$Id = (int) $params['bookId'];


$sql = "INSERT INTO UserLibrary (UserId, BookId)
SELECT Users.userId, $Id
FROM Users
WHERE Users.username = '$userName';
";

if ($connect->query($sql) === TRUE) {
  $response = array("success" => 1, "message" => "Book inserted successfully");
  echo json_encode($response);
} else {
  $response = array("success" => 0, "message" => "Book didn't insert successfully: " . $connect->error);
  echo json_encode($response);
}

$connect->close();
?>