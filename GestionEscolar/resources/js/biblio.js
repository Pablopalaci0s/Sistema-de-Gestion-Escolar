const searchInput = document.getElementById('searchInput');
const librosContainer = document.getElementById('librosContainer');

searchInput.addEventListener('input', function () {
    const searchTerm = this.value.trim();
    if (searchTerm !== '') {
        fetch(`biblioteca_estudiante.php?id=<?php echo $estudiante_id; ?>&q=${searchTerm}`)
            .then(response => response.text())
            .then(data => {
                librosContainer.innerHTML = data;
            });
    } else {
        fetch(`biblioteca_estudiante.php?id=<?php echo $estudiante_id; ?>`)
            .then(response => response.text())
            .then(data => {
                librosContainer.innerHTML = data;
            });
    }
});