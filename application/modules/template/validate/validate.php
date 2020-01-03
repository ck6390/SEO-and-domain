
<script>
function phonenumber(inputtxt) {
var phoneno = /^\d{10}$/;
if(inputtxt.value.match(phoneno)) {
return true;
}
else {
alert("Not a valid Phone Number. Please enter a 10 digit Phone Number.");
inputtxt.value = "";
inputtxt.focus();
return false;
}
}
//Email Address Format-Validation -->
function ValidateEmail(inputText) {
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(inputText.value.match(mailformat)) {
return true;
}
else {
alert("You have entered an invalid email address! E.g - yourname@gmail.com");
inputText.value = "";
inputText.focus();
return false;
}
}
</script>