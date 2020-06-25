<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database interaction</title>
</head>
<body>
        <?php
        ini_set('display_errors', 1);
        if (empty(getenv("DATABASE_URL"))){
            $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
        }  else {
            echo getenv("dbname");
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

        $sql = "SELECT * FROM product_detail ORDER BY id";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();
    ?>
    <h1>Database interaction</h1>
    <button onclick="location.href='index.php'">Back to home page</button>
    <div class="container">
            <div class="grid-item">
                <a href="./InsertData.php" target="framename"><b>Inser data</b></a>
            </div>
            <div class="grid-item">
                <a href="./DeleteData.php" target="framename"><b>Delete data</b></a>
            </div>
            <div class="grid-item">
                <a href="UpdateData.php" target="framename"><b>Update data</b></a>
            </div>
            <div id ="displaychange" class="grid-item">
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>Product_ID</th>
                        <th>Product_name</th>
                        <th>NSX</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // tạo vòng lặp 
                        //while($r = mysql_fetch_array($result)){
                            foreach ($resultSet as $row) {
                    ?>
                    
                    <tr>
                        <td scope="row"><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['release_date'] ?></td>  
                        <td><?php echo $row['price'] ?></td>  
                    </tr>
                    
                    <?php
                            }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="./data.js"></script>
</body>
</html>