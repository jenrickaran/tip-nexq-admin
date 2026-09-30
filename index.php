<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NexQ</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <main>
        <section>
            <img src="public/png/tip-logo.png" alt="NexQ Logo">
            <h1>Nexs<span>Q</span></h1>
            <h2>Queue Notification System</h2>
            <p>Student Accounting Office</p>
            <br>
            <br>
            <h2>Smart Queue. Less Wait. Better Experience.</h2>
            <p>NexQ helps the Student Accounting Office manage lines efficiently and provide a better service experience.</p>
        </section>

        <section>
            <div>
                <h1>Welcome!</h1>
                <p>Please sign in to continue.</p>
            </div>

            <form action="app/controller/userController.php" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter your username">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password">
                <div>
                    <div>
                        <input type="checkbox" name="rememberme" id="rememberme">
                        <label for="rememberme">Remember me</label>
                    </div>

                    <div>
                        <a href="#">Forgot password?</a>
                    </div>
                </div>
                <button type="submit">LOGIN</button>
            </form>
        </section>
    </main>
</body>
</html>