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

</body>

</html>