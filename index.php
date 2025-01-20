<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body style="
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    background-color: #1e1e1e;
    justify-content: center;
    align-items: center;
    height: 100vh;">
    <div class="login-container" style="background: rgba(54, 54, 54, 0.8); padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px;">
        <div class="login-form">
            <h2 style="text-align: center; color: #ffff; margin-bottom: 1.5rem;">Login</h2>
            <form action="login.php" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
                <label for="Username" class="form-label" style="color: #ffff;">Username</label>
                <div class="input-group">
                    <input type="text" name="Username" class="form-control" id="Username" placeholder="Masukkan username" required style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px; width: 100%; font-size: 1rem; box-sizing: border-box;">
                </div>
                <label for="Password" class="form-label" style="color: #ffff;">Password</label>
                <div class="input-group">
                    <input type="password" name="Password" class="form-control" id="Password" placeholder="Masukkan password" required style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px; width: 100%; font-size: 1rem; box-sizing: border-box;">
                </div>
                <button type="submit" class="btn btn-primary w-100" style="padding: 0.8rem; background: #ff0800; border: none; border-radius: 4px; color: #fff; font-size: 1rem; cursor: pointer; transition: background 0.3s;">
                    Login
                </button>
            </form>
            <p class="mt-3 text-center" style="text-align: center; color: #ffff; margin-top: 1rem;">Belum punya akun? <a href="register.php" style="color: #0080fe; text-decoration: none; font-weight: bold;">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
