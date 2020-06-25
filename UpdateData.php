<!DOCTYPE html>
<html>
<body>

<h1>Cập nhật DL sản phẩm</h1>

<?php
ini_set('display_errors', 1);
echo "Update database!";
?>

<form name="update" action="UpdateData.php" method="POST">
    <label for="id">ID sản phẩm:</label><input type="text" name="id" placeholder="nhập 1 id sản phẩm"/>
    <label for="newname">Tên mới:</label><input type="text" name="newname" placeholder="nhập tên mới cho id sản phẩm"/><br>
    <input type="submit" value="Cập Nhật">
</form>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
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

//$sql = 'UPDATE student '
//                . 'SET name = :name, '
//                . 'WHERE ID = :id';
// 
//      $stmt = $pdo->prepare($sql);
//      //bind values to the statement
//        $stmt->bindValue(':name', 'Lee');
//        $stmt->bindValue(':id', 'SV02');
        // update data in the database
//        $stmt->execute();

        // return the number of row affected
        //return $stmt->rowCount();
$sql = "UPDATE product SET product_name = '$_POST[newname]' WHERE product_id = '$_POST[id]'";
      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}
    
?>
</body>
</html>
