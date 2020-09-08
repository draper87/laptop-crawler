require('./bootstrap');
const Handlebars = require("handlebars");
var $ = require( "jquery" );


$(document).ready(function() {

    $('#bottone').click(function() {
        chiamaLaptops();
    })

    var videocard;
    $("#videocard").change(function(){
        videocard = $('#videocard').val();
        console.log(videocard);
    })



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
