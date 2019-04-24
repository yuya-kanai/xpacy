<!DOCTYPE html>
<html>
<body>

<h1>  hello </h1>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM customers;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> id: ". $row["id"]. " - Name: ". $row["first_name"]. " " . $row["last_name"] . "<br>";
    }
} else {
    echo "0 results";
}

echo "My first PHP script!";
?>

</body>
</html>
