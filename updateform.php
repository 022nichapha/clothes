<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Update clothes </title>
    <style type="text/css">
        body {
            background-color: #ffb300;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 30px;
        }

        h3 {
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        img {
            transition: transform 0.25s ease;
        }

        img:hover {
            transform: scale(1.5);
        }
    </style>

</head>

<body>

    <?php
    require 'conn.php';

    $sql_select = 'SELECT * from product order by productID';
    $stmt_s = $conn->prepare($sql_select);
    $stmt_s->execute();
    // echo "CustomerID = " . $_GET['CustomerID'];

    if (isset($_GET['clothesID'])) {
        $sql_select_clothes = 'SELECT * FROM clothes WHERE clothesID=:clothesID';
        $stmt_c = $conn->prepare($sql_select_clothes);
        $stmt_c->bindParam(':clothesID', $_GET['clothesID']);
        $stmt_c->execute();
        echo "get = " . $_GET['clothesID'];
        $result_c = $stmt_c->fetch(PDO::FETCH_ASSOC);
    }
    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-4"> <br>
                <h3>ฟอร์มแก้ไขข้อมูลสินค้า</h3>
                <form action="update.php" method="POST">

                    <input type="hidden" name="clothesID" value="<?php echo $result_c['clothesID']; ?>" readonly>

                    <label for="name" class="col-sm-2 col-form-label"> ชื่อเสื้อผ้า: </label>
                    <input type="text" name="clothesName" class="form-control" value="<?php echo $result_c['clothesName']; ?>">


                    <label for="name" class="col-sm-2 col-form-label"> ราคา : </label>
                    <input type="number" name="price" class="form-control" required value="<?php echo $result_c['price']; ?>">

                    <label for="name" class="col-sm-2 col-form-label"> ประเภทเสื้อผ้า: </label>
                    <label>Enter productID</label>

                    <select name="productID">

                        <?php
                        while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)) :
                        ?>

                            <option value="<?php echo $cc["productID"];  ?>">
                                <?php echo $cc["productName"]; ?>
                            </option>
                        <?php
                        endwhile
                        ?>
                    </select>

                    <br> <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>