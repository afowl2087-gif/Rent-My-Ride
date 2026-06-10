document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('reservationModal');

    modal.addEventListener('show.bs.modal', function (event) {

        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const marque = button.getAttribute('data-marque');
        const model = button.getAttribute('data-model');
        const prix = button.getAttribute('data-prix');

        document.getElementById('vehicule-id').value = id;

        document.getElementById('vehicule-info').textContent =
            marque + ' ' + model + ' - ' + prix + ' €/jour';
    });

});