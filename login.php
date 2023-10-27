<?php
    include "utilities/header.php";
    include "db_connection/db_config.php";
    include "utilities/process-login.php";
    include "utilities/process-register.php";
    
?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <!-- form box start  -->
    <section class="login">
        <div class="form-box">

            <!-- login form  -->
               
            <form id="login" class="input-group" method="POST">
                <h1 class="title-blue">Login</h1>
                <?php if($is_invalid): ?>
                    <p class="alert failed">Invalid Login</p>
                <?php endif; ?> 
                <input type="email" name="login_email" class="input-field" placeholder="Email Address" value="<?= htmlspecialchars($_POST['login_email'] ?? "") ?>" required>
                <input type="password" name="password" class="input-field" placeholder="Password" required>
                <input type="checkbox" name="rememberMe" class="check-box" checked disabled>
                <span>Remember Me</span>

                <!-- social medias  -->
                <div class="social-icons">
                    <i class="fa-brands fa-google"></i>
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-twitter"></i>
                </div>
                <?php
                    if(isset($_SESSION['locked']) && $_SESSION['locked'] === true) {
                        isset($_SESSION['lockedTime']) ? $_SESSION['lockedTime'] : $_SESSION['lockedTime'] = time();
                        echo '<script>';
                        echo 'var locked = "' . $_SESSION['locked'] . '";';
                        echo 'var login_attempts = "' . $_SESSION['login_attempts'] . '"';
                        echo '</script>';
                        ?>
                            <p id="locked" class="alert failed"></p>
                        <?php }
                        else { ?>
                        <button type="submit" name="login" class="submit-btn">Login</button>
                <?php }?>
                
            </form>

            <!-- registration form  -->
            <form id="register" class="input-group" method="POST" novalidate>
                <h1 class="title-blue">Register</h1>
                <?php if($register_failed): ?>
                    <p class="alert failed">Registration Failed</p>
                <?php endif; ?> 
                <?php if(isset($email_taken)): ?>
                    <p class="alert failed">This email has already been taken</p>
                <?php endif; ?> 
                <?php if(isset($success)): ?>
                    <p class="success"><?= $success ?></p>
                <?php endif; ?> 
                <input type="text" name="firstname" class="input-field" placeholder="First Name" value="<?= $_POST['firstname'] ?? "" ?>">
                <?php if(isset($firstname_required)): ?>
                    <p class="alert"><?= $firstname_required ?></p>
                <?php endif; ?>
                <input type="text" name="lastname" class="input-field" placeholder="Last Name (Surname)" value="<?= $_POST['lastname'] ?? "" ?>">
                <?php if(isset($lastname_required)): ?>
                    <p class="alert"><?= $lastname_required ?></p>
                <?php endif; ?>
                <input type="email" name="email" class="input-field" placeholder="Email Address" value="<?= $_POST['email'] ?? "" ?>">
                <?php if(isset($email_required)): ?>
                    <p class="alert"><?= $email_required ?></p>
                <?php endif; ?>
                <input type="password" name="password" class="input-field" placeholder="Password">
                <?php if(isset($password_required)): ?>
                    <p class="alert"><?= $password_required ?></p>
                <?php endif; ?>
                <input type="password" name="confirmPassword" class="input-field" placeholder="Confirm Password">
                <?php if(isset($password_match)): ?>
                    <p class="alert"><?= $password_match ?></p>
                <?php endif; ?>
                <input type="number" name="phoneNumber" class="input-field" placeholder="Phone Number (optional)" value="<?= $_POST['phoneNumber'] ?? "" ?>">
                <?php if(isset($phone_required)): ?>
                    <p class="alert"><?= $phone_required ?></p>
                <?php endif; ?>
                <input type="checkbox" name="checkbox" class="check-box" checked>
                <span>I agree to the <a href="terms&conditions.php">Terms & Conditions</a></span>
                <?php if(isset($terms_required)): ?>
                    <p class="alert"><?= $terms_required ?></p>
                <?php endif; ?>
                <br>
                <div class="g-recaptcha" data-sitekey="6Led1JUoAAAAAMPiuKrlQNC1Q0zt4u_LWlFp590g"></div>
                <?php if(isset($g_recaptcha_required)): ?>
                    <p class="alert"><?= $g_recaptcha_required ?></p>
                <?php endif; ?>
                <button type="submit" name="register" class="submit-btn">Register</button>
            </form>
        </div>
    </section>

<?php
    include "utilities/footer.php";
?>