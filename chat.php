<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])) {
        header("location: login.php");
    }
?>

<?php include_once "header.php"; ?>
<body>
    
    <div class="wrapper">
        <section class="chat-area">
            <header>
            <?php 
                include_once "php/config.php";
                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                }
            ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $row['img'] ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                    <p><?php echo $row['status'] ?></p>
                </div>
                <div class="setting">
                    <button name="phone" id="phone-call"><i class="fa-solid fa-phone"></i></button>
                    <button name="video hidden" id="video-call"><i class="fa-solid fa-video"></i></button>
                    <button id="info"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                </div>
            </header>
            <div class="chat-box">
                
            </div>
            <form action="" class="typing-area">
                <button class="call" name="camera" id="camera"><i class="fa-solid fa-camera"></i></button>
                <button class="call" name="image" id="image"><i class="fa-solid fa-image"></i></button>
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message...">
                <button class="send"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </section>
    </div>
    <script src="javascript/chat.js"></script>
</body>
</html>