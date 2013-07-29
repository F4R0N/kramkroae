<?php
$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

$givenName = $_GET['schoolName'];
$sql = "SELECT 
            ID, 
            SchoolName 
        FROM 
            Schools 
        WHERE 
            SchoolName 
        LIKE 
            '%" . mysql_real_escape_string($givenName) . "%'";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
    $schools[] = $row;
}
echo json_encode($schools);
?>
