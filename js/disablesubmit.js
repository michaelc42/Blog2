
//disables the form button, to prevent multiple database queries
$('form').submit(function(){
    // On submit disable its submit button
    $('input[type=submit]', this).attr('disabled', 'disabled');
});