
document.querySelectorAll('.plus').forEach(btn => {
    btn.addEventListener('click', function () {
        let input = this.parentElement.querySelector('.qty-input');
        input.value = parseInt(input.value) + 1;
    });
});

document.querySelectorAll('.minus').forEach(btn => {
    btn.addEventListener('click', function () {
        let input = this.parentElement.querySelector('.qty-input');
        let value = parseInt(input.value);
        if (value > 1) input.value = value - 1;
    });
});


document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('change', function () {

        let value = parseInt(this.value);

        if (value === 0) {
            let confirmDelete = confirm("Bạn có chắc muốn xóa sản phẩm này?");

            if (!confirmDelete) {
                // Nếu không đồng ý → trả lại = 1
                this.value = 1;
            }
        }
    });
});