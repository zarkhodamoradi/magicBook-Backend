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


$sql = "DELETE FROM UserLibrary WHERE UserLibrary.UserId = (SELECT Users.userID FROM Users WHERE userName = '$userName' ) and UserLibrary.BookId = $Id 
";

if ($connect->query($sql) === TRUE) {
  $response = array("success" => 1, "message" => "Book deleted successfully");
  echo json_encode($response);
} else {
  $response = array("success" => 0, "message" => "Book didn't delete successfully: " . $connect->error);
  echo json_encode($response);
}

$connect->close();
?>