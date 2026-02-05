
function validateForm() {
const user = document.getElementById('username').value;
const pass = document.getElementById('password').value;


if (user === '' || pass === '') {
alert('Please fill in all fields');
return false;
}
return true;
}
