<?php include 'headder_l.php'; ?>
<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Patient</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Add Patient Information</h2>
        <form action="patient.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Patient Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" name="contact" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea name="remarks" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="scan_image">Upload Scan Image</label>
                <input type="file" name="scan_image" class="form-control-file" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Add Patient</button>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $contact = $_POST['contact'];
        $remarks = $_POST['remarks'];

        // Handle file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["scan_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($_FILES["scan_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('File is not an image.');</script>";
            $uploadOk = 0;
        }

        // Allow only specific file formats
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            echo "<script>alert('Only JPG, JPEG, and PNG files are allowed.');</script>";
            $uploadOk = 0;
        }

        // Attempt to upload the file
        if ($uploadOk && move_uploaded_file($_FILES["scan_image"]["tmp_name"], $target_file)) {
            // Insert patient data into the database
            $sql = "INSERT INTO patients (name, age, gender, contact, remarks, scan_image) 
                    VALUES ('$name', '$age', '$gender', '$contact', '$remarks', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Patient information added successfully!');</script>";
            } else {
                echo "<script>alert('Error: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('There was an error uploading the file.');</script>";
        }
    }
    ?>
</body>
</html>