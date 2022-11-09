<script type="text/javascript">var onloadCallback = function() {grecaptcha.render('grecaptcha', {'sitekey' : '6Ldax8IZAAAAAFVt5Ss9FrdQIXmP59_cKZbJaeiZ'});};</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<script>
    function validateForm() {
        var recaptcha = document.forms["form"]["g-recaptcha-response"].value
        if (recaptcha === "") {
            alert("Пожалуйста, заполните reCAPTCHA");
            return false;
        }
    }
</script>
