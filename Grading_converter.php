<?php
// Function to determine university grading scale
function getUniversityGrade($score) {
    if ($score > 100 || $score < 0) {
        return "Error: Invalid grade. Please enter a grade between 0 and 100.";
    } elseif ($score >= 97) {
        return "1.0";
    } elseif ($score >= 94) {
        return "1.25";
    } elseif ($score >= 91) {
        return "1.5";
    } elseif ($score >= 88) {
        return "1.75";
    } elseif ($score >= 85) {
        return "2.0";
    } elseif ($score >= 82) {
        return "2.25";
    } elseif ($score >= 79) {
        return "2.5";
    } elseif ($score >= 76) {
        return "2.75";
    } elseif ($score >= 75) {
        return "3.0"; // Passing Grade
    } else {
        return "5.0"; // Failing Grade
    }
}

// Process form submission
$grade = null;
$resultMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['grade'])) {
        $grade = trim($_POST['grade']);

        // Input Validation
        if (!is_numeric($grade)) {
            $resultMessage = "Error: Invalid input. Please enter a numeric grade.";
        } else {
            $grade = intval($grade);
            $universityGrade = getUniversityGrade($grade);

            // Format the response message
            if ($grade < 75) {
                $resultMessage = "The grade is $grade, which is a Fail and converts to a university grade of $universityGrade.";
            } elseif ($universityGrade === "Error: Invalid grade.") {
                $resultMessage = $universityGrade;
            } else {
                $resultMessage = "The grade is $grade, and the university grade is $universityGrade.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Grading System</title>
</head>
<body>
    <center>
    <h1>University Grade Conversion Tool</h1>
    <form method="POST" action="">
        <label for="grade">Enter the grade (0-100):</label>
        <input type="text" id="grade" name="grade" required>
        <button type="submit">Submit</button>
    </form>

    <?php if (!empty($resultMessage)): ?>
        <p><?php echo htmlspecialchars($resultMessage); ?></p>
    <?php endif; ?>
    </center>
</body>
</html>
