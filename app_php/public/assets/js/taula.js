$(document).ready(function () {
    // Verificar si hi ha dades al localStorage
    const moviesData = JSON.parse(localStorage.getItem('movies'));
    if (moviesData && moviesData.length > 0) {
        loadTable(moviesData);
    } else {
        const url = 'https://thronesapi.com/api/v2/Characters';
        fetch(url)
            .then(response => response.json())
            .then(movies => {
                localStorage.setItem('movies', JSON.stringify(movies));
                loadTable(movies);
            });
    }
});

function loadTable(movies) {
    const table = $('#taula').DataTable({
        data: movies,
        columns: [
            { data: 'firstName' },
            { data: 'lastName' },
            { data: 'fullName' },
            { data: 'id' },
            {
                data: 'imageUrl',
                "render": function (data) {
                    return '<img src="' + data + '" style="width:150px; height:150px">';
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    return '<button class="delete-button" data-id="' + row.id + '">Eliminar</button>';
                }
            }
        ],
        columnDefs: [
            {
                targets: -1,
                orderable: false,
                className: 'dt-center',
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