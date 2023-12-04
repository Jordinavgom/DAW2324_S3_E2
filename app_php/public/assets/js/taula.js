$(document).ready(function () {
    // Verificar si hi ha dades al localStorage
    console.log("hola");
    const moviesData = JSON.parse(localStorage.getItem('movies'));
    if (moviesData && moviesData.length > 0) {
        loadTable(moviesData);
    } else {
        const url = '../public/assets/JSON/products.json';
        fetch(url)
            .then(response => response.json())
            .then(movies => {
                localStorage.setItem('movies', JSON.stringify(movies));
                loadTable(movies);
            });
    }
});

function loadTable(movies) {
    $('#taula').DataTable({
        data: movies.data,
        columns: [
            {
                data: 'null',
                "render": function (data, type, row) {
                    return '<img src="' + row.images[0].thumb + '" style="width:150px; height:150px">';
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    return '<a href="./product?id=' + row.id + '" target="_blank">' + row.name + '</a>';
                }
            }
        ]
    });
    $('#taula tbody').on('click', '.delete-button', function () {
        const id = $(this).data('id');
        localStorage.removeItem(id);
        // Obtenir les dades de localStorage
        const localStorageData = JSON.parse(localStorage.getItem('movies')) || [];

        // Mantenim unicament els elements que no coincideixen amb el ID eliminat
        const updatedData = localStorageData.filter(item => item.id !== id);

        // Guardem les dades actualitzades a localStorage
        localStorage.setItem('movies', JSON.stringify(updatedData));

        // Eliminar la fila de la taula
        table.row($(this).parents('tr')).remove().draw();
    });
}