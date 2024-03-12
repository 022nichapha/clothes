<?php
echo 'hello ' . $_POST['clothesID'];
if (isset($_POST['clothesID'])) {
    require 'conn.php';

    $sql = "UPDATE clothes
            SET 
           clothesName=:clothesName,
           price =:price,
           productID = :productID
            WHERE clothesID=:clothesID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':clothesID', $_POST['clothesID']);
    $stmt->bindParam(':clothesName', $_POST['clothesName']);
    $stmt->bindParam(':price', $_POST['price']);
    $stmt->bindParam(':productID', $_POST['productID']);

    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($stmt->execute()) {
        echo '
        <script type="text/javascript">
        
        $(document).ready(function(){
        
            swal({
                title: "Success!",
                text: "Successfuly update food information",
                type: "success",
                timer: 2500,
                showConfirmButton: false
              }, function(){
                    window.location.href = "index.php";
              });
        });
        
        </script>
        ';
    }
    $conn = null;
}
