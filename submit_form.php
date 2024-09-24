


<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieving Member’s details
    $full_name = htmlspecialchars($_POST['full_name']);
    $street_address = htmlspecialchars($_POST['street_address']);
    $city = htmlspecialchars($_POST['city']);
    $dob = htmlspecialchars($_POST['dob']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = htmlspecialchars($_POST['email']);

    // Retrieving Enrolment details
    $registered_elector = htmlspecialchars($_POST['registered_elector']);
    $electorate = isset($_POST['electorate']) ? htmlspecialchars($_POST['electorate']) : '';
    $eligible_to_enrol = htmlspecialchars($_POST['eligible_to_enrol']);
    $years_residence = htmlspecialchars($_POST['years_residence']);
    $months_residence = htmlspecialchars($_POST['months_residence']);
    $overseas_date = isset($_POST['overseas_date']) ? htmlspecialchars($_POST['overseas_date']) : '';

    // Retrieving Membership details
    $membership_fee = isset($_POST['membership_fee']) ? true : false;
    $authorise_record = isset($_POST['authorise_record']) ? true : false;
    $authorise_release = isset($_POST['authorise_release']) ? true : false;
    $signature = htmlspecialchars($_POST['signature']);
    $date_signed = htmlspecialchars($_POST['date_signed']);

    // Validation for required fields (basic server-side validation)
    if (empty($full_name) || empty($street_address) || empty($city) || empty($dob) || empty($telephone) || empty($email) ||
        empty($registered_elector) || empty($eligible_to_enrol) || empty($years_residence) || empty($months_residence) ||
        empty($signature) || empty($date_signed)) {
        echo "Please fill in all the required fields.";
    } else {
        // Process the form data (for example, save it to a database or send an email)
          // Email to send the form data to
    $to = "ngatiruanui@hotmail.com";  // Replace with your email

    // Email subject
    $subject = "New Membership Form Submission";

    // Email body content
    $message = "
        <html>
        <head>
            <title>New Membership Form Submission</title>
        </head>
        <body>
            <h2>Member's Details</h2>
            <p><strong>Full Name:</strong> $full_name</p>
            <p><strong>Address:</strong> $street_address, $city</p>
            <p><strong>Date of Birth:</strong> $dob</p>
            <p><strong>Telephone:</strong> $telephone</p>
            <p><strong>Email:</strong> $email</p>
            
            <h2>Enrolment Details</h2>
            <p><strong>Registered Elector:</strong> $registered_elector</p>";
            
    if (!empty($electorate)) {
        $message .= "<p><strong>Electorate:</strong> $electorate</p>";
    }

    $message .= "
            <p><strong>Eligible to Enrol:</strong> $eligible_to_enrol</p>
            <p><strong>Years in NZ:</strong> $years_residence</p>
            <p><strong>Months in NZ:</strong> $months_residence</p>";

    if (!empty($overseas_date)) {
        $message .= "<p><strong>Last Date in NZ (if overseas):</strong> $overseas_date</p>";
    }

    $message .= "
            <h2>Membership Details</h2>
            <p><strong>Membership Fee Paid:</strong> $membership_fee_paid</p>
            <p><strong>Authorise Record:</strong> $authorise_record</p>
            <p><strong>Authorise Release:</strong> $authorise_release</p>
            <p><strong>Signature:</strong> $signature</p>
            <p><strong>Date Signed:</strong> $date_signed</p>
        </body>
        </html>
    ";

    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: no-reply@kiwiunion.com' . "\r\n";  // Change the from email address
    $headers .= 'Reply-To: ' . $email . "\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Your membership form has been successfully submitted!";
    } else {
        echo "There was a problem sending your form. Please try again.";
    }
}  
        // Sample output to show data has been retrieved
        echo "<h2>Membership Form Details:</h2>";
        echo "<p><strong>Full name:</strong> $full_name</p>";
        echo "<p><strong>Address:</strong> $street_address, $city</p>";
        echo "<p><strong>Date of Birth:</strong> $dob</p>";
        echo "<p><strong>Telephone:</strong> $telephone</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        
        echo "<h3>Enrolment Details:</h3>";
        echo "<p><strong>Registered Elector:</strong> $registered_elector</p>";
        if (!empty($electorate)) {
            echo "<p><strong>Electorate:</strong> $electorate</p>";
        }
        echo "<p><strong>Eligible to Enrol:</strong> $eligible_to_enrol</p>";
        echo "<p><strong>Residence Duration:</strong> $years_residence years, $months_residence months</p>";
        if (!empty($overseas_date)) {
            echo "<p><strong>Last Date in NZ (if overseas):</strong> $overseas_date</p>";
        }

        echo "<h3>Membership Details:</h3>";
        echo "<p><strong>Membership Fee Paid:</strong> " . ($membership_fee ? "Yes" : "No") . "</p>";
        echo "<p><strong>Authorise Record:</strong> " . ($authorise_record ? "Yes" : "No") . "</p>";
        echo "<p><strong>Authorise Release:</strong> " . ($authorise_release ? "Yes" : "No") . "</p>";
        echo "<p><strong>Signature:</strong> $signature</p>";
        echo "<p><strong>Date Signed:</strong> $date_signed</p>";
    }
}
?>
