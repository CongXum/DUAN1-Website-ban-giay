document.getElementById("checkoutForm").addEventListener("submit", function(e) {
    let isValid = true;

    // reset lỗi
    document.querySelectorAll(".error").forEach(el => el.innerText = "");

    let name = document.querySelector("[name='name']").value.trim();
    let email = document.querySelector("[name='email']").value.trim();
    let phone = document.querySelector("[name='phone']").value.trim();
    let address = document.querySelector("[name='address']").value.trim();

    if (name === "") {
        document.getElementById("error-name").innerText = "Vui lòng nhập tên";
        isValid = false;
    }

    if (email === "" || !email.includes("@")) {
        document.getElementById("error-email").innerText = "Email không hợp lệ";
        isValid = false;
    }

    if (phone === "" || phone.length < 9) {
        document.getElementById("error-phone").innerText = "SĐT không hợp lệ";
        isValid = false;
    }

    if (address === "") {
        document.getElementById("error-address").innerText = "Vui lòng nhập địa chỉ";
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
    }
});