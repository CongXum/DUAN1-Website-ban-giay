<div class="container text-center mt-5">
    <h3>Quét QR để thanh toán</h3>

    <p><strong>Số tiền:</strong> <?= number_format($amount) ?> đ</p>
    <p><strong>Nội dung:</strong> <?= $content ?></p>

    <!-- QR -->
    <div class="my-4">
        <img src="<?= $qr_url ?>" width="300" class="img-fluid rounded shadow">
    </div>

    <!-- Nút đẹp -->
    <div class="mt-3">
        <button onclick="markPaid(this)" 
                class="btn btn-success px-4 py-2 fw-bold d-flex align-items-center justify-content-center gap-2"
                style="min-width:220px; margin:auto;">
            <span class="btn-text">✅ Tôi đã thanh toán</span>
            <span class="spinner-border spinner-border-sm d-none"></span>
        </button>
    </div>

    <p class="mt-3 text-muted">Đang chờ thanh toán...</p>
</div>

<script>
function markPaid(btn) {
    if (btn.classList.contains("disabled")) return;

    const text = btn.querySelector(".btn-text");
    const spinner = btn.querySelector(".spinner-border");

    // disable nút
    btn.classList.add("disabled");
    text.innerText = "Đang xác nhận...";
    spinner.classList.remove("d-none");

    // ⏳ delay giả lập 2.5 giây
    setTimeout(() => {
        fetch("index.php?page=mark-paid&order_id=<?= $order_id ?>")
            .then(() => {
                window.location.href = "index.php?page=order-detail&id=<?= $order_id ?>";
            });
    }, 2500);
}
</script>