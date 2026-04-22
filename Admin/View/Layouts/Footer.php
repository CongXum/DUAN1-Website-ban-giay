<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const links = document.querySelectorAll(".sidebar a");

        links.forEach(link => {
            link.addEventListener("click", function() {

                links.forEach(i => i.classList.remove("active"));

                this.classList.add("active");

            });
        });

    });
</script>

<script>
    <?php if (!empty($_SESSION['success'])): ?>
        toastr.success("<?= $_SESSION['success'] ?>");
    <?php unset($_SESSION['success']);
    endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        toastr.error("<?= $_SESSION['error'] ?>");
    <?php unset($_SESSION['error']);
    endif; ?>
</script>

</body>

</html>