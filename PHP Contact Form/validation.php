<?php
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $profession = filter_var($_POST['profession'], FILTER_SANITIZE_STRING);
    $education = filter_var($_POST['education'], FILTER_SANITIZE_STRING);
    $currentWorkplace = filter_var($_POST['currentWorkplace'], FILTER_SANITIZE_STRING);
    $workplaceAddress = filter_var($_POST['workplaceAddress'], FILTER_SANITIZE_STRING);

    $errorMessage = '';
    $passed = true;

    if(empty($name) || empty($email) || empty($age) || empty($gender) || empty($address) || empty($profession) || empty($education) || empty($currentWorkplace) || empty($workplaceAddress)) {
        $passed = false;
        $errorMessage =  'One or more fields are empty. Please fill up all of them.';
    }
    else {
        if(is_string($name) === false) {
            $passed = false;
            $errorMessage .= '<li>Invalid name!</li>';
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $passed = false;
            $errorMessage .= '<li>Invalid email!</li>';
        }

        if(filter_var($age, FILTER_VALIDATE_INT)) {
            if($age < 1 || $age > 100) {
                $passed = false;
                $errorMessage .= '<li>Invalid age range!</li>';
            }
        } 
        else {
            $passed = false;
            $errorMessage .= '<li>Invalid age!</li>';
        } 

        if(is_string($gender)) {
            if($gender === 'none') {
                $passed = false;
                $errorMessage .= '<li>No gender chosen!</li>';
            }
        } 
        else {
            $passed = false;
            $errorMessage .= '<li>Invalid gender!</li>';
        } 

        if(is_string($address) === false) {
            $passed = false;
            $errorMessage .= '<li>Invalid address!</li>';
        }

        if(is_string($profession) === false) {
            $passed = false;
            $errorMessage .= '<li>Invalid profession!</li>';
        }

        if(is_string($education)) {
            if($education === 'none') {
                $passed = false;
                $errorMessage .= '<li>No education attainment chosen!</li>';
            }
        }
        else {
            $passed = false;
            $errorMessage .= '<li>Invalid education attainment!</li>';
        }

        if(is_string($currentWorkplace) === false) {
            $passed = false;
            $errorMessage .= '<li>Invalid workplace!</li>';
        }

        if(is_string($workplaceAddress) === false) {
            $passed = false;
            $errorMessage .= '<li>Invalid workplace address!</li>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Contact Form - Confirmation Page</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <?php if($passed) {?>
                <h1 class="title">Thank you for filling out the form!</h1>
                <h2 style="text-align: center">Confirmed Details</h2>
                <table style="margin: 20px auto;">
                    <tr>
                        <td>Name :</td>
                        <td><?php echo $name ?></td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td><?php echo $email ?></td>
                    </tr>
                    <tr>
                        <td>Age :</td>
                        <td><?php echo $age ?></td>
                    </tr>
                    <tr>
                        <td>Gender :</td>
                        <td><?php echo $gender ?></td>
                    </tr>
                    <tr>
                        <td>Complete Address :</td>
                        <td><?php echo $address ?></td>
                    </tr>
                    <tr>
                        <td>Profession :</td>
                        <td><?php echo $profession ?></td>
                    </tr>
                    <tr>
                        <td>Highest Educational Attainment :</td>
                        <td><?php 
                            $newEducation = '';
                            $education = preg_split('/(?=[A-Z])/', $education);
                            foreach($education as $words) {
                                $newEducation .= ucwords($words).' ';
                            }
                            echo $newEducation;
                        ?></td>
                    </tr>
                    <tr>
                        <td>Current Workplace :</td>
                        <td><?php echo $currentWorkplace?></td>
                    </tr>
                    <tr>
                        <td>Workplace Address :</td>
                        <td><?php echo $workplaceAddress?></td>
                    </tr>
                </table>
            <?php } else { ?>
                <div style="display: block" class="error"><?php echo $errorMessage ?></div>
            <?php } ?>
            <div class="return-container">
                <button class="return-btn"><a href="index.html">Return to form</a></button>
            </div>
        </div>
    </div>
</body>
</html>

    

