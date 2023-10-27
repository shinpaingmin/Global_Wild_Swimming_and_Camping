    <!-- footer start  -->
    <footer>
        <div class="footer-column">
            <div>
                <ul>
                    <li><strong>Contact</strong></li>
                    <li>Address: 123 Main Street, Los Angeles, W1A 1AA, United States of America</li>
                    <li><a href="mailto:example@gwsc.com">Email: example@gwsc.com</a></li>
                    <li><a href="tel:+44 20 7123 4567">Phone: +44 20 7123 4567</a></li>
                    <li><strong>Download Mobile App</strong></li>
                    <a href="#"><img src="img/downloadapp.png" alt="download mobile app"></a>
                </ul>
            </div>
            <div>
                <ul>
                    <li><strong>Information</strong></li>
                    <li><a href="availability.php">Availability</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="RssFeed.php">RSS feed</a></li>
                    <br>
                    <li><strong>Social Media</strong></li>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                </ul>
            </div>
            <div>
                <ul>
                    <li><strong>Stay Connected With Us!</strong></li>
                    <li>To get notified about our latest events and promotions.</li>
                    <li>
                        <input type="text" placeholder="example@gmail.com">
                        <a href="mailto:example@gwsc.com" class="subscribe">Subscribe</a>
                    </li>
                    <li class="rules privacy">
                        <a href="terms&conditions.php">Terms & Conditions</a> &nbsp; |  &nbsp;
                        <a href="privacy&policy.php">Privacy & Policies</a>
                    </li>
                    <small>2023 &copy; Global Wild Swimming and Camping</small>
                </ul>
            </div>
        </div>
        <br>
        <p><span id="current-page">You are currently in the Home Page</span> | 
        <?php
            $sql_v = "SELECT view_count FROM `view_count`
                    WHERE view_count_id = 1";

            $result_v = $conn->query($sql_v);

            if($row_v = $result_v->fetch_assoc()) { ?>
                <span id="visitCount"> Visitor Count: <?= $row_v['view_count'] ?></span>
        <?php    }
        ?>
        
        </p>
    </footer>

    <!-- js link  -->
    <script src="js/script.js" defer></script>
</body>
</html>