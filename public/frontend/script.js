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

/* ================= CATEGORIES MODAL ================= */

const serviceCategories = {
  'Salon Services': [
    { name: 'Woman Salon & Spa', icon: '✨' },
    { name: 'Men Salon', icon: '🧔' },
    { name: 'Kids Hair Cut', icon: '👧' },
    { name: 'Makeup & Styling', icon: '💄' }
  ],
  'Appliance Repair': [
    { name: 'AC Repair', icon: '❄️' },
    { name: 'Microwave Repair', icon: '🔧' },
    { name: 'Refrigerator Repair', icon: '🧊' },
    { name: 'Washing Machine Repair', icon: '🧺' }
  ],
  'Home Cleaning': [
    { name: 'Full House Cleaning', icon: '🧹' },
    { name: 'Kitchen Cleaning', icon: '🍳' },
    { name: 'Bathroom Cleaning', icon: '🛁' },
    { name: 'Deep Cleaning', icon: '✨' }
  ],
  'Pest Control': [
    { name: 'Termite Control', icon: '🐜' },
    { name: 'Cockroach Control', icon: '🪳' },
    { name: 'Mosquito Spray', icon: '🦟' },
    { name: 'Rodent Control', icon: '🐭' }
  ],
  'Plumbing': [
    { name: 'Water Leak Repair', icon: '💧' },
    { name: 'Pipe Installation', icon: '🔧' },
    { name: 'Drain Cleaning', icon: '🚰' },
    { name: 'Faucet Repair', icon: '🚰' }
  ],
  'Painting': [
    { name: 'Interior Painting', icon: '🎨' },
    { name: 'Exterior Painting', icon: '🏠' },
    { name: 'Wall Texture & Design', icon: '🖼️' },
    { name: 'Waterproofing', icon: '💦' }
  ]
};

document.addEventListener('click', function(e) {
  if (e.target.closest('[data-bs-target="#categoriesModal"]')) {
    const serviceButton = e.target.closest('[data-service]');
    if (serviceButton) {
      const serviceName = serviceButton.getAttribute('data-service');
      const categories = serviceCategories[serviceName] || [];
      
      // Update modal title
      document.getElementById('categoryTitle').textContent = serviceName;
      
      // Generate category items
      const grid = document.getElementById('categoriesGrid');
      grid.innerHTML = '';
      
      categories.forEach(category => {
        const col = document.createElement('div');
        col.className = 'col-6 col-md-4 col-lg-3';
        col.innerHTML = `
          <button class="category-item border-0 bg-white rounded shadow-sm p-4 text-center w-100" style="cursor: pointer; transition: all 0.3s;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">${category.icon}</div>
            <h6 class="fw-semibold mb-0" style="font-size: 0.9rem;">${category.name}</h6>
          </button>
        `;
        grid.appendChild(col);
      });
    }
  }
});

// Add hover effect to category items
document.addEventListener('mouseover', function(e) {
  if (e.target.closest('.category-item')) {
    e.target.closest('.category-item').style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
    e.target.closest('.category-item').style.transform = 'translateY(-3px)';
  }
});

document.addEventListener('mouseout', function(e) {
  if (e.target.closest('.category-item')) {
    e.target.closest('.category-item').style.boxShadow = '';
    e.target.closest('.category-item').style.transform = '';
  }
});

// Redirect to services page on category click
document.addEventListener('click', function(e) {
  if (e.target.closest('.category-item')) {
    window.location.href = '/services';
  }
});