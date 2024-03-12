<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="conn.php">
    <title>CRUD CLOTHES Information with Enlarge Image</title>
    <style type="text/css">
        body {
            background-color: #fffde7;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 30px;
        }

        h3 {
            margin-bottom: 20px;
        }

        form {
            background-color: #A15755;
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
            border: 1px solid #DBC5A5;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #A15755;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #A15755;
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
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h3>รายชื่อสินค้า <a href="add.php" class="btn btn-info float-end">+เพิ่มข้อมูล</a> </h3> <br />
                <!-- <table class="table table-striped  table-hover table-responsive table-bordered"> -->
                <table id="clothesTable" class="display table table-striped  table-hover table-responsive table-bordered ">

                    <thead align="center">
                        <tr>
                            <th width="10%">รหัสเสื้อผ้า</th>
                            <th width="10%">ชื่อเสื้อผ้า</th>
                            <th width="10%">ประเภทเสื้อผ้า</th>
                            <th width="10%">ราคา</th>
                            <th width="15%">ภาพ</th>
                            <th width="5%">แก้ไข</th>
                            <th width="5%">ลบ</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        require 'conn.php';
                        $sql =
                            'SELECT clothes.clothesID,clothes.clothesName,product.productName,clothes.price,clothes.img FROM clothes,product WHERE clothes.productID=product.productID';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $r) { ?>
                            <tr>
                                <td><?= $r['clothesID'] ?></td>
                                <td><?= $r['clothesName'] ?></td>
                                <td><?= $r['productName'] ?></td>
                                <td align="right"><?= $r['price'] ?></td>
                                <td><img src="./pic/<?= $r['img']; ?>" width="50px" height="50px" alt="image" onclick="enlargeImg()" id="image1"></td>
                                <td><a href="updateform.php?clothesID=<?= $r['clothesID'] ?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                <td><a href="delete.php?clothesID=<?= $r['clothesID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#clothesTable').DataTable();
        });
    </script>


</body>

</html>