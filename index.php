<?php

$file = "students.xml";

// Create XML file if not exists
if (!file_exists($file)) {
    $xml = new SimpleXMLElement("<students></students>");
    $xml->asXML($file);
}

// Add student
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $course = $_POST['course'];

    $xml = simplexml_load_file($file);

    $student = $xml->addChild("student");
    $student->addChild("name", $name);
    $student->addChild("age", $age);
    $student->addChild("course", $course);

    $xml->asXML($file);
}

// Load XML for display
$xml = simplexml_load_file($file);
?>

<!DOCTYPE html>
<html>
<head>
    <title>XML Student Management</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .container {
            width: 500px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 8px;
        }
        button {
            padding: 10px 15px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>XML Student Management</h2>

    <form method="post">
        <input type="text" name="name" placeholder="Enter Name" required><br>
        <input type="number" name="age" placeholder="Enter Age" required><br>
        <input type="text" name="course" placeholder="Enter Course" required><br>
        <button type="submit" name="add">Add Student</button>
    </form>

    <h3>Student List</h3>

    <table>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Course</th>
        </tr>

        <?php
        foreach ($xml->student as $s) {
            echo "<tr>";
            echo "<td>" . $s->name . "</td>";
            echo "<td>" . $s->age . "</td>";
            echo "<td>" . $s->course . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>