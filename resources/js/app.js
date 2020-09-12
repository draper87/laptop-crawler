require('./bootstrap');
const Handlebars = require("handlebars");
var $ = require( "jquery" );


$(document).ready(function() {

    // chiamata Ajax quando premo il tasto Invia
    $('#bottone').click(function() {
        chiamaLaptops();
    })

    // metto in una variabile il valore scelto dall utente della select "video_card"
    var videocard;
    $("#videocard").change(function(){
        videocard = $('#videocard').val();
    })


    // funzione che fa chiamata Ajax all mia API su laravel
    function chiamaLaptops() {

        $.ajax({
            url: 'http://127.0.0.1:8000/api/laptops',
            method: 'GET',
            data: {
                video_card: videocard,
            },
            success: function(dataResponse) {
                stampaLaptops(dataResponse);
            },
            error: function() {
                alert('il server non funziona');
            }
        })
    }

    // funzione che usa handlebars per stampare i risultati ottenuti dalla chiamata Ajax
    function stampaLaptops(dataResponse) {
        $('.lista').html('');
        const source = $('#entry-template').html(); // questo e il path al nostro template html
        const template = Handlebars.compile(source); // passiamo a Handlebars il percorso del template html

        for (var i = 0; i < dataResponse.length; i++) {
            var context = dataResponse[i];
            var html = template(context);
            $('.lista').append(html);
        }
    }

})
