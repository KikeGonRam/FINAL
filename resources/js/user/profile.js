// resources/js/user/profile.js

document.addEventListener("DOMContentLoaded", function () {
    const successMessage = document.querySelector(".alert-success");
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.opacity = "0";
        }, 3000);
    }
});
