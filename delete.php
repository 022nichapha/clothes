<?php
if (isset($_GET["clothesID"])) {
    $strclothesID = $_GET["clothesID"];
}

require('conn.php');


$sql = "DELETE  FROM clothes WHERE clothesID = :clothesID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':clothesID', $strclothesID);

echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

if ($stmt->execute()) {
    // $message = "Successfully delete customer" . $_GET['CustomerID'] . ".";
    echo '
        <script type="text/javascript">
        $(document).ready(function(){
        
            swal({
                title: "Success!",
                text: "Successfuly  delete food information",
                type: "success",
                timer: 2500,
                showConfirmButton: false
              }, function(){
                    window.location.href = "index.php";
              });
        });
        </script>
        ';
} else {
    $message = "Fail to delete food information.";
}

$conn = null;

//header("Location:index.php");
