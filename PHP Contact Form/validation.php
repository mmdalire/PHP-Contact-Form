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
    $passed = false;

    if(empty($name) || empty($email) || empty($age) || empty($gender) || empty($address) || empty($profession) || empty($education) || empty($currentWorkplace) || empty($workplaceAddress)) {
        $errorMessage =  'One or more fields are empty. Please fill up all of them.';
    }
    else {
        if(is_string($name) === false) {
            $errorMessage .= '<li>Invalid name!</li>';
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorMessage .= '<li>Invalid email!</li>';
        }

        if(filter_var($age, FILTER_VALIDATE_INT)) {
            if($age < 1 || $age > 100) {
                $errorMessage .= '<li>Invalid age range!</li>';
            }
        } 
        else {
            $errorMessage .= '<li>Invalid age!</li>';
        } 

        if(is_string($gender)) {
            if($gender === 'none') {
                $errorMessage .= '<li>No gender chosen!</li>';
            }
        } 
        else {
            $errorMessage .= '<li>Invalid gender!</li>';
        } 

        if(is_string($address) === false) {
            $errorMessage .= '<li>Invalid address!</li>';
        }

        if(is_string($profession) === false) {
            $errorMessage .= '<li>Invalid profession!</li>';
        }

        if(is_string($education)) {
            if($education === 'none') {
                $errorMessage .= '<li>No education attainment chosen!</li>';
            }
        }
        else {
            $errorMessage .= '<li>Invalid education attainment!</li>';
        }

        if(is_string($currentWorkplace) === false) {
            $errorMessage .= '<li>Invalid workplace!</li>';
        }

        if(is_string($workplaceAddress) === false) {
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
            <?php } else { ?>
                <div style="display: block" class="error"><?php echo $errorMessage ?></div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

    

