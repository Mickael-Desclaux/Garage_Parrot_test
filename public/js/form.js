function loadPage() {
    const formData = $('#car_filter').serialize();

    $.ajax({
        url: '/filtered_cars',
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            const carList = $('#car-list');
            carList.empty();

            response.car.forEach(function (car) {
                let html = '<div class="card m-4 car-card">';
                // Ajoute les informations de la voiture au HTML généré
                html += `<img src="../images/cars/${car.image}" alt="${car.brand} ${car.model}"class="car-card-img"">`;
                html += '<div class="card-body">';
                html += '<h3 class="card-title text-center">' + car.brand + ' ' + car.model + '</h3>';
                html += '<p class="card-text text-center">' + car.year + '</p>';
                html += '<p class="card-text text-center">' + car.price + '€</p>';
                html += '<div class="d-flex justify-content-center">';
                html += '<a href="' + car.detailLink + '" class="btn btn-danger stretched-link d-flex justify-content-center" id="car-detail-btn">Détails</a>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                carList.append(html); // Ajoute le HTML de la voiture à la liste des voitures
            });


        },
        error: function (xhr, status, error) {
            console.error("Erreur AJAX : " + status + " - " + error);
        }
    });
}

$(document).ready(function () {
    const resetBtn = document.getElementById('car_filter_reset');
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            document.getElementById('car_filter').reset();
            loadPage();
        });
    }

    $('#car_filter').on('submit', function (e) {
        e.preventDefault();
        loadPage();
    });
});
