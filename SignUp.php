<?php 
    include(__DIR__.'/NavBar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmandize | Sign Up</title>
</head>
<body>
    <div class="container gz-div-glow">
        <div class="container gz-div-inner d-flex justify-content-center mx-auto text-center py-5">
            <form method="post">
                <div>
                    <h2 class="text-white display-4" style="font-family: textFont">Sign Up For</h2>
                </div>
                <div class="py-3">
                    <h1 class="glow text-white display-4" style="font-family: logoFont;">Gourmandize</h1>
                </div>
                <div class="form-group ">
                    <input size="30"type="text" placeholder="Username" required />
                </div>
                <div class="form-group">
                    <input size="30" type="text" placeholder="First Name" required/>
                </div>
                <div class="form-group">
                    <input size="30" type="text" placeholder="Last Name" required/>
                </div>
                <div class="form-group">
                    <input id="userEmail" size="30" type="email" placeholder="Email" required onkeyup="checkEmail();"/>
                </div>
                <div class="form-group">
                    <span id="emailMessage" style="font-size: 20px; color:red;"></span>
                    <input id="confirmUserEmail" size="30" type="email" placeholder="Email Confirmation" required onkeyup="checkEmail();"/>
                </div>
                <div class="form-group">
                    <input id="userPassword" size="30" type="password" placeholder="Password" required onkeyup="checkPassword();"/>
                </div>
                <div class="form-group">
                    <span id="passwordMessage" style="font-size: 20px; color:red;"></span>
                    <input id="confirmUserPassword" size="30" type="password" placeholder="Password Confirmation" required onkeyup="checkPassword();"/>
                </div>
                <div class="form-group mx-auto">
                    <button id="submitButton" class="btn btn-outline-light"type="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>
var emailMatch;
var passwordMatch;

var checkEmail = function() {
        if (document.getElementById('userEmail').value ==
            document.getElementById('confirmUserEmail').value) {
            document.getElementById('emailMessage').innerHTML = '';
            emailMatch=false;
        } else {
            document.getElementById('emailMessage').innerHTML = '*';
            emailMatch=true;
        }
        document.getElementById('submitButton').disabled=!(!emailMatch && !passwordMatch)
        console.log(document.getElementById('submitButton').disabled)
}

    var checkPassword = function() {
        if (document.getElementById('userPassword').value ==
            document.getElementById('confirmUserPassword').value) {
            document.getElementById('passwordMessage').innerHTML = '';
            passwordMatch=false;
        } else {
            document.getElementById('passwordMessage').innerHTML = '*';
            passwordMatch=true;
        }
        document.getElementById('submitButton').disabled=!(!emailMatch && !passwordMatch)
        console.log(document.getElementById('submitButton').disabled)
}


</script>