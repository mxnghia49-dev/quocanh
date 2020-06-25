<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>Thêm DL vào table product</h1>
    <ul>
        <form name="InsertData" action="InsertData.php" method="POST" >
            <li>id:</li><li><input type="text" name="id" /></li>
            <li>name:</li><li><input type="text" name="name" /></li>
            <li>Release Date:</li><li><input type="date" name="relase_date" /></li>
            <li>Price:</li><li><input type="text" name="price" /></li>
            <li><input type="submit" value="Insert" /></li>
        </form>
    </ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
    "host=ec2-54-161-208-31.compute-1.amazonaws.com;user=jcwdhzxbqxlrxc;password=ebf3e16f7582aa53774e4e2bb989c0e5cb361ac2d3584e19a56425daf1fd8871;dbname=delgmnoujcvbdf",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO student (stuid, fname, email, classname) values (:id, :name, :email, :class)');

//$stmt->bindParam(':id','SV03');
//$stmt->bindParam(':name','Ho Hong Linh');
//$stmt->bindParam(':email', 'Linhhh@fpt.edu.vn');
//$stmt->bindParam(':class', 'GCD018');
//$stmt->execute();
//$sql = "INSERT INTO student(stuid, fname, email, classname) VALUES('SV02', 'Hong Thanh','thanhh@fpt.edu.vn','GCD018')";
$sql = "INSERT INTO product_detail(id, name, release_date, price) VALUES ('$_POST[id]','$_POST[name]', '$_POST[release_date]', '$_POST[price]')";
$stmt = $pdo->prepare($sql);

    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }

?>
</body>
</html>
