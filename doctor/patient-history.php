<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <a href="/css/login.css"></a> -->
    <style>
        body{
            background-color: #006dd3;
            /* font-family: 'Inter', sans-serif; */
            font-weight: bold;
            font-size: 25px;
            /* border: ; */
        }
        .form{
            border: 2px solid black;
            text-align: center;
            margin: 100px 300px;
            padding: 100px;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <?php
    // Get the patient ID and history from the form
    if (isset($_GET['pid'])) {
        $patient_id = $_GET['pid'];
        // echo $patient_id;
        // Now you can use $patient_id in your code
    } else {
        // Handle the case where 'pid' is not set in the URL
        echo "Can't get patient_id";
    }
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["add_history"])) {
        // Include your database connection file
        include("../connection.php");

        // Prepare an insert statement
        $stmt = $database->prepare("INSERT INTO patient_history (pid,diagnosis,treatment,date_of_visit,history) VALUES (?, ?,?,?,?)");
        $stmt->bind_param("issss", $_GET['add_history'], $_GET['diagnosis'], $_GET['treatment'], $_GET['date_of_visit'],$_GET['history']);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    ?>

    <!-- Form for adding patient history -->
    <form method="get" action="" class="form">
        <label for="history">Patient ID:</label>
        <input type="" value=" <?php 
            echo $patient_id;
        ?>" name="pid">
       
        <br><br>
        <label for="history">Diagnosis:</label>
        <input type="text" name="diagnosis" id="">
        <br><br>
        <label for="history">Treatment:</label>
        <input type="text" name="treatment" id="">
        <br><br>
        <label for="history">Date_of_visit:</label>
        <input type="date" name="date_of_visit" id="">
        <br><br>
        <label for="history">Patient History:</label><br>
        <textarea id="history" name="history" rows="4" cols="50"></textarea><br><br>
        <input type="submit" name="add_history" value="submit">
    </form>
</body>

</html>