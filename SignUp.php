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
                    <input size="30"type="text" placeholder="Username"/>
                </div>
                <div class="form-group">
                    <input size="30" type="text" placeholder="First Name"/>
                </div>
                <div class="form-group">
                    <input size="30" type="text" placeholder="Last Name"/>
                </div>
                <div class="form-group">
                    <input size="30" type="text" placeholder="Email"/>
                </div>
                <div class="form-group">
                    <input size="30" type="text" placeholder="Email Confirmation"/>
                </div>
                <div class="form-group">
                    <input size="30" type="text" placeholder="Password"/>
                </div>
                <div class="form-group">
                    <input size="30" type="text" placeholder="Password Confirmation"/>
                </div>
                <div class="form-group mx-auto">
                    <button class="btn btn-outline-light"type="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>