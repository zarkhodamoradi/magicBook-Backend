<?php
$host = "hotaka.liara.cloud";
$user = "root";
$password = "6f8Qa41M7Au2eWwBzkq8zHXb";
$databaseName = "Book";
$port = "31795";
$connect = new mysqli($host, $user, $password, $databaseName, $port);
$connect->query("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
$sql = " SELECT  categoryName FROM BookCategory inner join Category on BookCategory.CategoryId = Category.categoryId
GROUP by BookCategory.CategoryId
ORDER by  COUNT(*) DESC";
$categories = $connect->query($sql);

if ($categories->num_rows > 0) {
    $array1 = [];
    while ($row = $categories->fetch_assoc()) {
        array_push(
            $array1,
            array(
               "categoryName" => ($row["categoryName"]),
            )
        );
    }
    echo json_encode($array1);

} else {

    echo "0";
}
;

$connect->close();
?> 

