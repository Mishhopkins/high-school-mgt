<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your head content here -->
</head>
<body>
    <h1>Create Teacher Schedule</h1>
    <form action="create_schedule.php" method="POST">
        <label for="teacher">Teacher:</label>
        <select name="teacher" id="teacher">
            <!-- Fetch and populate teacher names from the database -->
            <?php
            include_once('../../service/dbconnection.php');
            $sql = "SELECT * FROM teachers;";
            $res = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>

        <!-- Input field for Subject -->
        <label for="subject">Subject:</label>
        <select name="subject" id="subject">
            <!-- Fetch and populate subjects from the database -->
            <?php
            $sql_subjects = "SELECT * FROM subjects;";
            $res_subjects = mysqli_query($link, $sql_subjects);
            while ($row_subjects = mysqli_fetch_assoc($res_subjects)) {
                echo "<option value='" . $row_subjects['id'] . "'>" . $row_subjects['subjectName'] . "</option>";
            }
            ?>
        </select>

        <!-- Input field for Class -->
        <label for="class">Class:</label>
        <select name="class" id="class">
            <!-- Fetch and populate classes from the database -->
            <?php
            $sql_classes = "SELECT * FROM classes;";
            $res_classes = mysqli_query($link, $sql_classes);
            while ($row_classes = mysqli_fetch_assoc($res_classes)) {
                echo "<option value='" . $row_classes['class_id'] . "'>" . $row_classes['class_name'] . "</option>";
            }
            ?>
        </select>

        <!-- Input field for Day -->
        <label for="day">Day:</label>
        <select name="day" id="day" required>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
        </select>

        <!-- Input field for Time Slots -->
        <label for="time_slots">Time Slots:</label>
        <input type="text" name="time_slots" id="time_slots" required>

        <button type="submit">Create Schedule</button>
    </form>
</body>
</html>
