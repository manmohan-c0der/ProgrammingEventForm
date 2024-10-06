<?php
  $server = "localhost";
  $username = "root";
  $password = "";

  // Create a connection to the database
  $con = mysqli_connect($server, $username, $password);

  // Check the connection
  if (!$con) {
    die("Connection to the database failed due to " . mysqli_connect_error());
  }

  // Initialize $insert as false
  $insert = false;

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure that the form fields are set before accessing them
    if (isset($_POST['name'], $_POST['year'], $_POST['phone'], $_POST['email'], $_POST['course'], $_POST['desc'])) {
      $name = $_POST['name'];
      $year = $_POST['year'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $course = $_POST['course'];
      $desc = $_POST['desc'];

      // SQL query to insert the data into the database
      $sql = "INSERT INTO `eventdb`.`student` (`name`, `year`, `phone`, `email`, `course`, `description`, `date`) 
              VALUES ('$name', '$year', '$phone', '$email', '$course', '$desc', current_timestamp());";

      // Execute the SQL query and check for success
      if ($con->query($sql) === true) {
        // If the query is successful, set $insert to true
        $insert = true;

        // Redirect to the same page to avoid form resubmission on refresh
        // header("Location: " . $_SERVER['PHP_SELF']);
        // exit(); // Ensure script stops after redirection
      } else {
        // Output error if query fails
        echo "Error: $sql <br> $con->error";
      }
    } else {
      echo "Please fill in all the form fields.";
    }
  }

  // Close the connection
  $con->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Programming Event Registration form</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style2.css" />
  </head>
  <body>
    <img class="bg" src="bg.png" alt="smsimg" />
    <div class="container">
      <h1>Welcome to SMS Lucknow Programming Event Registration form</h1>
      <p>
        Enter your details and submit the form to confirm your participation in the SMS Programming Event
      </p>
      <?php
        if ($insert ==true) {
          echo "<p class='submsg'>
            Thanks for submitting this form. We are happy to see you at the Programming Event!
          </p>";
          echo $insert;
        }
      ?>
      <form action="index.php" method="post">
        <input
          type="text"
          name="name"
          id="name"
          placeholder="Enter your name here"
          required
        />
        <input
          type="text"
          name="year"
          id="year"
          placeholder="Enter your year here"
          required
        />
        <input
          type="text"
          name="phone"
          id="phone"
          placeholder="Enter your phone number here"
          required
        />
        <input
          type="email"
          name="email"
          id="email"
          placeholder="Enter your email here"
          required
        />
        <input
          type="text"
          name="course"
          id="course"
          placeholder="Enter your course here"
          required
        />
        <textarea
          name="desc"
          id="desc"
          placeholder="Enter any additional details here"
        ></textarea>
        <button class="btn" type="submit">Submit</button>
      </form>
      <script src="script.js"></script>
    </div>
  </body>
</html>
