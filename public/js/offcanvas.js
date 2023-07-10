const myOffcanvas = document.getElementById('offcanvasScrolling');
const bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);

document.querySelector('.filter-offcanvas').addEventListener('click', function () {
  bsOffcanvas.toggle()
})

$(document).ready(function () {
  $('#offcanvasScrolling .form-control, #offcanvasScrolling .form-choice').click(function (event) {
    event.stopPropagation();
  });
});
