document.addEventListener("DOMContentLoaded", function () {

    /* ================= PHONE SECTION ================= */

    const phoneInput = document.getElementById("phoneInput");
    const continueBtn = document.getElementById("continueBtn");
    const phoneSection = document.getElementById("phoneSection");
    const otpSection = document.getElementById("otpSection");
    const displayNumber = document.getElementById("displayNumber");

    if (phoneInput && continueBtn) {

        // Enable button after 10 digits
        phoneInput.addEventListener("input", function () {

            const phone = phoneInput.value.replace(/\D/g, '');
            phoneInput.value = phone; // allow only numbers

            if (phone.length === 10) {
                continueBtn.disabled = false;
                continueBtn.classList.remove("btn-secondary");
                continueBtn.classList.add("btn-primary");
            } else {
                continueBtn.disabled = true;
                continueBtn.classList.remove("btn-primary");
                continueBtn.classList.add("btn-secondary");
            }
        });

        // Show OTP Section
        continueBtn.addEventListener("click", function () {
            displayNumber.textContent = "+91 " + phoneInput.value;
            phoneSection.style.display = "none";
            otpSection.style.display = "block";
        });
    }

    /* ================= OTP SECTION ================= */

    const otpInputs = document.querySelectorAll(".otp-box");
    const verifyBtn = document.getElementById("verifyBtn");

    if (otpInputs.length > 0) {

        otpInputs.forEach((input, index) => {

            // Only allow numbers & move forward
            input.addEventListener("input", function () {

                this.value = this.value.replace(/[^0-9]/g, '');

                if (this.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }

                checkOTP();
            });

            // Move backward on backspace
            input.addEventListener("keydown", function (e) {

                if (e.key === "Backspace" && this.value === '' && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });

        });

        function checkOTP() {
            let otp = "";

            otpInputs.forEach(input => {
                otp += input.value;
            });

            if (otp.length === 6) {
                verifyBtn.disabled = false;
                verifyBtn.classList.remove("btn-secondary");
                verifyBtn.classList.add("btn-primary");
            } else {
                verifyBtn.disabled = true;
                verifyBtn.classList.remove("btn-primary");
                verifyBtn.classList.add("btn-secondary");
            }
        }

    }

});


document.addEventListener('DOMContentLoaded', function () {
  new Splide('#promoSlider', {
    perPage: 3,
    gap: 20,
    arrows: true,
    pagination: false,
    breakpoints: {
      992: { perPage: 2 },
      576: { perPage: 1 }
    }
  }).mount();
});