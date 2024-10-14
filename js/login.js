$(document).ready(function() {
    $('#open-eye').on('click', function(){
        var passwordField = $('#password');

        // Toggle the type attribute
        var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);


        $('#open-eye').toggleClass('hidden');
        $('#closed-eye').toggleClass('hidden');
    })    

    $('#closed-eye').on('click', function(){
        var passwordField = $('#password');

        // Toggle the type attribute
        var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);


        $('#open-eye').toggleClass('hidden');
        $('#closed-eye').toggleClass('hidden');
    })    
});