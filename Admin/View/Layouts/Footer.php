<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // nhẹ thôi, không màu mè
    document.querySelectorAll('.sidebar a').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.sidebar a').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

</body>

</html>