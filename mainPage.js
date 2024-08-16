// mainPage.js
const imageUrls = [
    'https://muslimhands.ca/_ui/images/fc575db486cb.jpg',
    'https://friarworks.org/wp-content/uploads/2017/08/boy-60710_1920.jpg'
  ];

  // Add this before the existing JavaScript code
const circularImage = document.querySelector('.circular-image');
let currentIndex = 0;

function changeImage() {
  // Fade out the current image
  circularImage.style.opacity = 0;

  // Wait for the fade-out transition to complete
  setTimeout(() => {
    // Change the image source
    circularImage.src = imageUrls[currentIndex];

    // Fade in the new image
    circularImage.style.opacity = 1;

    // Update the index for the next iteration
    currentIndex = (currentIndex + 1) % imageUrls.length;
  }, 500); // Adjust the duration to match the transition duration
}

// Call the changeImage function every two seconds
setInterval(changeImage, 2000);

// Modify your existing functions
function fadeIn(element) {
    element.classList.add('fade-in');
    element.classList.remove('fade-out');
    overlay.style.display = 'block';
    setTimeout(() => {
        overlay.style.opacity = 1;
    }, 10);
}

function fadeOut(element) {
    element.classList.add('fade-out');
    element.classList.remove('fade-in');
    overlay.style.opacity = 0;
    setTimeout(() => {
        overlay.style.display = 'none';
    }, 500); // Adjust the duration to match the transition duration
}

// Modify your existing openModal and closeModal functions
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    fadeIn(modal);
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    fadeOut(modal);
}

// Add this code after your existing JavaScript code
const eyeIcon = document.getElementById('eyeIcon');
const passwordInput = document.getElementById('password');

eyeIcon.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
});

const eyeIconTwo = document.getElementById('eyeIconTwo');
const passwordInputTwo = document.getElementById('newPassword'); // Use the correct ID for the password input in the signup modal

eyeIconTwo.addEventListener('click', function () {
    const type = passwordInputTwo.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInputTwo.setAttribute('type', type);
});


document.getElementById('loginBtn').addEventListener('click', function () {
    openModal('loginModal');
});

document.getElementById('signupBtn').addEventListener('click', function () {
    openModal('signupModal');
});

// Add this after your existing JavaScript code
document.getElementById('bodyLoginBtn').addEventListener('click', function () {
    openModal('loginModal');
});

document.getElementById('bodySignupBtn').addEventListener('click', function () {
    openModal('signupModal');
});

document.getElementById('bodyDonateNowBtn').addEventListener('click', function () {
    openModal('signupModal');
});