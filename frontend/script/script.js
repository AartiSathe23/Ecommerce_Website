document.addEventListener("DOMContentLoaded", function() {
    var timer = 60;
    var countdown;

    function startTimer() {
        timer = 60;
        document.getElementById("timer").textContent = timer;
        document.getElementById("resendBtn").classList.remove("enabled");
        countdown = setInterval(function() {
            timer--;
            document.getElementById("timer").textContent = timer;
            if (timer <= 0) {
                clearInterval(countdown);
                document.getElementById("resendBtn").disabled = false;
                document.getElementById("resendBtn").classList.add("enabled");
            }
        }, 1000);
    }

    startTimer();

    document.getElementById("resendBtn").addEventListener("click", function() {
        if (timer <= 0) {
            requestOTP();
            this.disabled = true;
        }
    });

    document.getElementById("verifyBtn").addEventListener("click", function() {
        var otp = Array.from(document.querySelectorAll('.digit')).map(input => input.value).join('');
        fetch('http://localhost:8000/backend/verify_otp.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'otp=' + encodeURIComponent(otp)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById("snackbar").classList.add("show");
                setTimeout(function() { document.getElementById("snackbar").classList.remove("show"); }, 3000);
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });

    function requestOTP() {
        // Simulate OTP request and reset timer
        fetch('http://localhost:8000/backend/send_otp.php')
            .then(response => response.json())
            .then(data => {
                console.log('New OTP sent:', data.otp); // For testing purposes
                startTimer();
            })
            .catch(error => console.error('Error:', error));
    }
});
