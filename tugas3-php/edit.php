<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script>
        function validateForm() {
            var first_name = document.getElementById("first_name").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;
            var address = document.getElementById("address").value;

            if (first_name.trim() === '' || email.trim() === '' || phone.trim() === '' || address.trim() === '') {
                alert("Harap isi semua kolom!");
                return false;
            } else {
                alert("Data Berhasil Diubah");
                return true;
            }
        }
    </script>
    <style>
        body {
            padding: 20px;
            background-color: peachpuff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-success" style="margin-bottom:5px; margin-top:20px;" href="index.php"> HOME
                </a><br><br>
                <table class="table table-striped table-bordered">
                    <?php
                    include 'koneksi.php';
                    date_default_timezone_set('Asia/Jakarta');

                    if (isset($_GET['id'])) {
                        $customer_id = $_GET['id'];
                        $query = mysqli_query($conn, "SELECT * FROM customer WHERE id = $customer_id");

                        if (mysqli_num_rows($query) > 0) {
                            $customer = mysqli_fetch_assoc($query);
                        } else {
                            echo "Customer not found.";
                            exit;
                        }
                    } else {
                        echo "Customer ID is missing.";
                        exit;
                    }

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $first_name = $_POST['first_name'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $address = $_POST['address'];
                        $updated_at = date('Y-m-d H:i:s');

                        $update_query = "UPDATE customer SET first_name='$first_name', email='$email', phone='$phone', address='$address', updated_at='$updated_at' WHERE id = $customer_id";
                        $update_result = mysqli_query($conn, $update_query);

                        header("Location:index.php");
                    }
                    ?>

                    <h1>Edit Customer:</h1>
                    <form method="post" onsubmit="return validateForm();">
                        <div class="form-group">
                            <label for="first_name">Nama:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="<?php echo $customer['first_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo $customer['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Telepon:</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="<?php echo $customer['phone']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat:</label>
                            <textarea class="form-control" id="address"
                                name="address"><?php echo $customer['address']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</html>