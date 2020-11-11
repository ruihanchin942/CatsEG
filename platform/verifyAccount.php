<?php
if(!isset($_GET['id']) || !isset($_GET['username']) || !isset($_GET['pwd'])) {
    header('Location: index.php?error=Error verifying account'); // redirect to the login page.
}
$errorMessage = "";
if(isset($_GET['error'])){
    $errorMessage = $_GET['error'];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Verify Account</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="verifyAccountHandler.php" method="post">
    <img class="mb-4" src="img/logo.png" alt="" width="300" height="200">
    <input type="hidden" name="username" value="<? echo $_GET['username'];?>" >
    <input type="hidden" name="status" value="0">
    <label for="inputPassword" class="sr-only">New Password</label>
    <input type="password" style="background-color: #BCE8E3" id="inputPassword" class="form-control" placeholder="Password" name="pwd" required>
    <input type="hidden" value="<?echo $_GET['id'];?>" name="id"">
    <button class="btn btn-lg btn-primary btn-block" name= "update" type="submit">Verify</button>
</form>
<script type="text/javascript">
    <?php
        if($errorMessage != ""){
            echo "alert({$errorMessage})";
        }
    ?>
</script>
</body>
</html>

