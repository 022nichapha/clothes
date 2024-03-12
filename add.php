<!--<!DOCTYPE html>-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>add clothesshop</title>
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

    if (isset($_POST['submit'])) {
        //if ((isset($_POST['customerID']) && isset($_POST['name'])) != null)
        if (!empty($_POST['clothesID']) && !empty($_POST['clothesName'])) {
            echo '<br>' . $_POST['clothesID'];

            $uploadFile = $_FILES['img']['name'];
            $tmpFile = $_FILES['img']['tmp_name'];
            echo " upload file = " . $uploadFile;
            echo " tmp file = " . $tmpFile;

            $sql = "INSERT INTO clothes
							values (:clothesID, :productID, :clothesName, :price, :img)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':clothesID', $_POST['clothesID']);
            $stmt->bindParam(':productID', $_POST['productID']);
            $stmt->bindParam(':clothesName', $_POST['clothesName']);
            $stmt->bindParam(':price', $_POST['price']);
            $stmt->bindParam(':img', $uploadFile);
            echo "img = " . $uploadFile;


            $fullpath = "./img/" . $uploadFile;
            echo " fullpath = " . $fullpath;
            move_uploaded_file($tmpFile, $fullpath);

            echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

            try {
                if ($stmt->execute()) :
                    //$message = 'Successfully add new customer';
                    echo '
                        <script type="text/javascript">        
                        $(document).ready(function(){
                    
                            swal({
                                title: "Success!",
                                text: "Successfuly add customer",
                                type: "success",
                                timer: 3000,
                                showConfirmButton: false
                            }, function(){
                                    window.location.href = "index.php";
                            });
                        });                    
                        </script>
                    ';
                else :
                    $message = 'Fail to add new customer';
                endif;
                // echo $message;
            } catch (PDOException $e) {
                echo 'Fail! ' . $e;
            }
            $conn = null;
        }
    }
    ?>




    <div class="container">
        <div class="row">
            <div class="col-md-4"> <br>
                <h3>ฟอร์มเพิ่มรายการเสื้อผ้า</h3>
                <form action="add.php" method="POST" enctype="multipart/form-data">
                    <!-- ศึกษาเพิ่มเติมการอัปโหลดไฟล์ https://www.w3schools.com/php/php_file_upload.asp -->
                    <input type="text" placeholder="Enter clothes ID" name="clothesID" required>
                    <br> <br>
                    <input type="text" placeholder="clothesName" name="clothesName">
                    <br> <br>
                    <input type="number" placeholder="price" name="price">
                    <br> <br>
                    <label>Enter ProductID</label>

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
                    <br> <br>
                    แนบรูปภาพ:
                    <input type="file" name="img" required>
                    <br><br>
                    <input type="submit" value="Submit" name="submit" />
                </form>
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