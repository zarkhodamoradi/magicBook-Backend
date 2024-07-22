<?php
$host = "hotaka.liara.cloud";
$user = "root";
$password = "6f8Qa41M7Au2eWwBzkq8zHXb";
$databaseName = "Book";
$port = "31795";
$connect = new mysqli($host, $user, $password, $databaseName , $port);
$sql = "SELECT
Book.Id, 
Book.Title, 
Book.Price, 
Book.Description, 
GROUP_CONCAT(Category.categoryName SEPARATOR ', ') AS Category, 
Book.Image, 
Book.publishDate, 
Book.rating, 
Book.author,
Book.book_link
FROM 
Book
LEFT JOIN 
BookCategory ON Book.Id = BookCategory.bookId
LEFT JOIN 
Category ON BookCategory.categoryId = Category.categoryId
WHERE  Book.Id in
(SELECT BookCategory.BookId 
from BookCategory Where CategoryId In 
(SELECT CategoryId from Category WHERE 
Category.categoryName = '" . $_GET['Category'] . "' )) 
GROUP BY 
Book.Id";
$books = $connect->query($sql);

if ($books->num_rows > 0) {
   $array1 = [];
    while ($row = $books->fetch_assoc()) {
       array_push($array1, array(
          "Id" => ($row["Id"]),
          "Title" => ($row["Title"]),
          "Price" => ($row["Price"]),
          "Description" => ($row["Description"]),
          "Category" => ($row["Category"]),
          "Image" => ($row["Image"]),
          "rating" => ($row["rating"]),
          "publishDate" => ($row["publishDate"]),
          "author" => ($row["author"]),
          "book_link" => ($row["book_link"])
       )
       );
    }
   echo json_encode($array1);
} else {
   echo "";
}

$connect->close();
?>
