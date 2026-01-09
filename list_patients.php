<?php include 'headder_l.php'; ?>
<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .table img {
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Patient List</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Remarks</th>
                        <th>Scan Image</th>
                        <th>Added On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch all patients from the database
                    $sql = "SELECT * FROM patients ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['age']}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['remarks']}</td>
                                <td><img src='{$row['scan_image']}' alt='Scan Image'></td>
                                <td>{$row['created_at']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>No patients found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
