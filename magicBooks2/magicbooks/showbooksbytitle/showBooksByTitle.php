<?php
$host = "hotaka.liara.cloud";
$user = "root";
$password = "6f8Qa41M7Au2eWwBzkq8zHXb";
$databaseName = "Book";
$port = "31795";
$connect = new mysqli($host, $user, $password, $databaseName , $port);
$sql = "Select * from Book Where Title like '%" . $_GET['SearchedTitle'] . "%' ";
$books = $connect->query($sql);

if ($books->num_rows > 0) {
   $array1 = [];
   while ($row = $books->fetch_assoc()) {
      array_push($array1, array(
         "Id" => ($row["Id"]),
         "Title" => ($row["Title"]),
         "Price" => ($row["Price"]),
         "Description" => ($row["Description"]),
         "Image" => ($row["Image"]),
         "rating" => ($row["rating"]),
         "publishDate" => ($row["publishDate"]),
         "author" => ($row["author"])
      )
      );
   }
   echo json_encode($array1);
} else {
   echo "";
}

$connect->close();
?>