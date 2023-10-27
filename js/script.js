// Getting current page 
const pathname = window.location.pathname;

// hamburger menu
const menu_btn = document.getElementById('menu-btn');
const overlay = document.getElementById('overlay');
const mobile_menu = document.getElementById("mobile-menu");

menu_btn.addEventListener('click', () => {
    menu_btn.classList.toggle('open');      // toggle menu btn
    overlay.classList.toggle('overlay-show');       // toggle overlay layer
    document.body.classList.toggle('stop-scrolling');       // stop browser scrolling
    mobile_menu.classList.toggle('show');
})

//for login page
if(pathname === "/Global_Wild_Swimming_and_Camping/login.php") {
    document.querySelector("header").classList.add("active");
    document.getElementById("current-page").innerText = "You are currently in the Login Page";

    // login attempt
    const lockedElement = document.getElementById("locked");

    // if the login attempts exceed 3 times
    if(locked) {
        let count = sessionStorage.getItem('count');

        if (count === null) {
        count = 600;
        sessionStorage.setItem('count', count);
        }

        const interval = setInterval(() => {
            if(count >= 0) {
                let minutes = Math.floor(count/60);
                let seconds = count % 60;
                count !== 0 ? lockedElement.innerHTML = `Please wait for ${minutes} minutes and ${seconds} seconds.` : "Please wait ...";
                count = count - 1;
                sessionStorage.setItem('count', count);
            } else {
                clearInterval(interval);
                sessionStorage.removeItem('count');
                location.reload();
            }
        }, 1000);
    }
}



// control header background color on ScrollY
const header = document.querySelector("header");

if(pathname === "/Global_Wild_Swimming_and_Camping/" || 
    pathname === "/Global_Wild_Swimming_and_Camping/features.php" || 
    pathname === "/Global_Wild_Swimming_and_Camping/index.php" ) {
    document.addEventListener("scroll", () => {
        window.scrollY > 0? header.classList.add("active") : header.classList.remove("active");
    })
}

// for home page
// for slider navigation
if (pathname === "/Global_Wild_Swimming_and_Camping/" || pathname === "/Global_Wild_Swimming_and_Camping/index.php") {

    // view count 
    if(!(performance.navigation.type == performance.navigation.TYPE_RELOAD)) {
        fetch("visitCountServer.php")
            .then(res => res.text())
            .then(text => document.getElementById("visitCount").innerHTML = text)
            .catch(err => console.log(err))
            .finally(() => console.log("AJAX done"));
    }

    const btns = document.querySelectorAll(".nav-btn");

    const slideshow = document.querySelector(".slideshow");

    const contents = document.querySelectorAll(".content");

    var counter = 1;    // counter for autoplay

    // function for click event handler
    const activeHandler = function(time) {
        counter = time;             // reset counter, for autoplay

        btns.forEach((btn) => {
            btn.classList.remove("active");
        });

        contents.forEach((content) => {
            content.classList.remove("active");
        });

        btns[time].classList.add("active");
        contents[time].classList.add("active");

        for (let index = 1; index < 5; index++) {
            slideshow.classList.remove("translateX-" + index);
        }

        slideshow.classList.add("translateX-" + (time+1));
    }

    // add eventlistener to each button
    btns.forEach((btn, i) => {
        btn.addEventListener("click", () => {
            activeHandler(i);
        })
    })

    // autoplay slide after 10ms
    setInterval(() => {
        btns.forEach((btn) => {
            btn.classList.remove("active");
        })

        btns[counter].click();

        counter++;
        
        if(counter > 3) {
            counter = 0;
        }
    }, 10000)

    
}

// for explore page

if(pathname === "/Global_Wild_Swimming_and_Camping/explore.php") {
    document.querySelector("header").classList.add("active");
    document.getElementById("current-page").innerText = "You are currently in the Explore Page";
}

// for detail page 

if(pathname === "/Global_Wild_Swimming_and_Camping/detail.php") {
    document.querySelector("header").classList.add("active");
    document.getElementById("current-page").innerText = "You are currently in the Detail Page";
}

// for contact page

if(pathname === "/Global_Wild_Swimming_and_Camping/contact.php") {
    document.querySelector("header").classList.add("active");
    document.getElementById("current-page").innerText = "You are currently in the Contact Page";
}

// for availability page

if(pathname === "/Global_Wild_Swimming_and_Camping/availability.php") {
    document.querySelector("header").classList.add("active");
    document.getElementById("current-page").innerText = "You are currently in the Availability Page";

    // disable previous dates in calendar
    
    const date = new Date();
    let tdate = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getUTCFullYear();
    if(tdate < 10) {
        tdate = "0" + tdate;
    }
    if(month < 10) {
        month = "0" + month;
    }
    let minDate = year + "-" + month + "-" + tdate;

    const dates = document.querySelectorAll("#date");
    
    dates.forEach(date => {
        date.setAttribute('min', minDate);
    });
    
    // confirm box for booking
    function confirmSubmit() {
        // Display a confirmation dialog
        let result = confirm("Are you sure you want to proceed booking?");
            
        // If the user confirmed, submit the form
        if (result) {
            return true;
        }
        
        // If the user didn't confirm, cancel the form submission
        return false;
    }
}



// for review page

if(pathname === "/Global_Wild_Swimming_and_Camping/reviews.php") {
    document.querySelector("header").classList.add("active");
    document.getElementById("current-page").innerText = "You are currently in the Reviews Page";
}

// for local attractions page

if(pathname === "/Global_Wild_Swimming_and_Camping/localAttractions.php") {
    document.querySelector("header").classList.add("active");
    document.getElementById("current-page").innerText = "You are currently in the Local Attractions Page";
}

// for booking history page

if(pathname === "/Global_Wild_Swimming_and_Camping/history.php") {
    document.querySelector("header").classList.add("active");
    document.getElementById("current-page").innerText = "You are currently in the Booking History Page";

    // confirm box for booking
    function confirmSubmit() {
        // Display a confirmation dialog
        let result = confirm("Are you sure you want to cancel this booking?");
            
        // If the user confirmed, submit the form
        if (result) {
            return true;
        }
        
        // If the user didn't confirm, cancel the form submission
        return false;
    }
}

// for privacy policy page

if(pathname === "/Global_Wild_Swimming_and_Camping/privacy&policy.php" ) {
    document.querySelector("header").classList.add("active");
    document.getElementById("current-page").innerText = "You are currently in the Privacy & Policy Page";
}

// for terms & conditions page

if(pathname === "/Global_Wild_Swimming_and_Camping/terms&conditions.php" ) {
    document.querySelector("header").classList.add("active");
    document.getElementById("current-page").innerText = "You are currently in the Terms & Condtions Page";
}

//  for features page

if(pathname === "/Global_Wild_Swimming_and_Camping/features.php" ) {
    document.getElementById("current-page").innerText = "You are currently in the Features Page";
}

// for information page

if(pathname === "/Global_Wild_Swimming_and_Camping/information.php") {
    document.querySelector("header").classList.add("active");
    document.getElementById("current-page").innerText = "You are currently in the Information Page";
}
