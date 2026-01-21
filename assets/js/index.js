
$(document).ready(function () {
  $('#flightForm').submit(function (e) {
    let isValid = true;
    $('input').removeClass('is-invalid');

    const source = $('#source').val().trim();
    const destination = $('#destination').val().trim();
    const date = $('#date').val().trim();
    const airline = $('#airline').val().trim();

    if (!source) {
      $('#source').addClass('is-invalid');
      isValid = false;
    }

    if (!destination) {
      $('#destination').addClass('is-invalid');
      isValid = false;
    }

    if (source && destination && source === destination) {
      $('#destination').addClass('is-invalid');
      $('#destination').next('.invalid-feedback').text('Source and destination cannot be the same.');
      isValid = false;
    }

    if (!date) {
      $('#date').addClass('is-invalid');
      isValid = false;
    }

    if (!airline) {
      $('#airline').addClass('is-invalid');
      isValid = false;
    }

    if (!isValid) {
      e.preventDefault(); // prevent form from submitting
    }
  });
});

