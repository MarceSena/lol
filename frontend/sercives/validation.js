function validation() {
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(async function (form) {
      form.classList.add('was-validated')
      form.checkValidity() ? error = false : error = true
    })
}




