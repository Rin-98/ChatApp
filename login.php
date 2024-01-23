<?php 
    session_start();
    if (isset($_SESSION['unique_id'])) { // if user login
        header("location: users.php");
    }
?>
<?php include_once "header.php"; ?>
<body>
    
    <div class="wrapper">
        <section class="form login">
            <header>Chat App</header>
            <form action="#">
                <div class="error-txt"></div>
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="Enter Your Email">
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter Your Password">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="field button">
                        <input type="submit" value="Login">
                    </div>
            </form>
            <div class="link">
                Don't Have an Account? <a href="index.php">Signup</a> here
            </div>
        </section>
    </div>
    <script src="javascript\pass-show-hide.js"></script>
    <script src="javascript\login.js"></script>
</body>
</html>