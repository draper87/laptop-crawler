require('./bootstrap');
const Handlebars = require("handlebars");
// var $ = require( "jquery" );


$(document).ready(function() {

    // chiamata Ajax quando premo il tasto Invia
    $('#bottone').click(function() {
        chiamaLaptops();
        // eseguo scroll "ritardato", in modo che risulti piu fluido
        setTimeout(function() {
            $('html, body').animate({
                scrollTop: $("#show").offset().top
            }, 1000);
        }, 500);

    })

    // metto in una variabile il valore scelto dall utente della select "video_card"
    var videocard;
    $("#videocard").change(function(){
        videocard = $('#videocard').val();
    })

    // metto in una variabile il valore scelto dall utente della select "cpu"
    var cpu;
    $("#cpu").change(function(){
        cpu = $('#cpu').val();
    })

    // metto in una variabile il valore scelto dall utente della select "ram"
    var ram;
    $("#ram_memory").change(function(){
        ram = $('#ram_memory').val();
    })


    // funzione che fa chiamata Ajax all mia API su laravel
    function chiamaLaptops(page) {

            $.ajax({
                url: 'http://127.0.0.1:8000/api/laptops',
                method: 'GET',
                data: {
                    video_card: videocard,
                    cpu: cpu,
                    ram: ram,
                    ramchecked: ramchecked,
                    display: mySlider.getValue(),
                    price: mySliderPrice.getValue(),
                    page: page,
                },
                success: function(dataResponse) {
                    // sessionStorage.setItem('url', this.url);
                    // console.log(sessionStorage.getItem('url'));
                    numeroPagina(dataResponse["current_page"], dataResponse["last_page"]);
                    stampaLaptops(dataResponse);
                    console.log(dataResponse);
                },
                error: function() {
                    alert('il server non funziona');
                }
            })
        }


    // back button
    $('#back-button').click(function() {
        window.history.back();
    })


    // funzione che usa handlebars per stampare i risultati ottenuti dalla chiamata Ajax
    function stampaLaptops(dataResponse) {
        $('.lista').html('');
        const source = $('#entry-template').html(); // questo e il path al nostro template html
        const template = Handlebars.compile(source); // passiamo a Handlebars il percorso del template html

        for (var i = 0; i < dataResponse.data.length; i++) {
            var context = dataResponse.data[i];
            // se non è disponibile un immagine per il laptop viene caricata quella di default
            if(context['image_path'] === null) {
                context['image_path'] = "images/laptop.jpg";
            }
            var html = template(context);
            $('.lista').append(html);
        }
        stampaPagination(dataResponse['total'], dataResponse['current_page'], dataResponse['last_page']);
    }

    // logica per la numerazione delle pagine
    // dichiaro le mia variabili globali
    var currentPage;
    var lastPage;
    var paginaSuccessiva;
    var paginaIndietro;
    // scrivo la logica per la numerazione delle pagine
    function numeroPagina(pagina, ultimaPagina) {
        currentPage = pagina;
        lastPage = ultimaPagina;
        if (currentPage < lastPage && currentPage !== 1) {
            paginaSuccessiva = pagina + 1;
            paginaIndietro = pagina - 1;
        }
        else if (currentPage === 1 && currentPage !== lastPage) {
            paginaSuccessiva = pagina + 1;
        } else {
            paginaIndietro = pagina - 1;
        }

    }
    // aggiungo un event listener per il bottone next
    $(document).on('click', '.next', function () {
        if (currentPage !== lastPage) {
            chiamaLaptops(paginaSuccessiva);
        }
    });
    // aggiungo un event listener per il bottone previous
    $(document).on('click', '.previous', function () {
        if (currentPage !== 1) {
            chiamaLaptops(paginaIndietro);
        }

    });

    // stampo a schermo i bottoni della pagination
    function stampaPagination(total, current, last) {
        $('#pagina').html('');
        var html = "<p>Found " + total + " results. Page " + current + " of " + last + "</p><ul class=\"pagination \"><li class=\"page-item\"><a class=\"page-link previous\">Indietro</a></li>" + " <li class=\"page-item\"><a class=\"page-link next\" >Avanti</a></li></ul>";
        $('#pagina').append(html);
    }



    // range slider per il display size
    var mySlider;
    var mySliderPrice;
    window.onload = function () {

        mySlider = new rSlider({
            target: '#sliderdisplay',
            values: [10.1, 13.3, 14, 15.6, 16.1, 17, 17.3],
            range: true,
            set: null,
            scale:    false,
            labels:   false,
            tooltip:  true,
            onChange: function (vals) {
                // console.log(vals);
            }
        });

        mySliderPrice = new rSlider({
            target: '#sliderprice',
            values: [0, 500, 750, 1000, 1250, 1500, 1750, 2000, 2500, 3000, 4000, 6000],
            range: true,
            set: null,
            scale:    false,
            labels:   false,
            tooltip:  true,
            onChange: function (valsPrice) {
                // console.log(valsPrice);
            }
        });

    };

    $('.js-basic-single-videocard').select2({
        placeholder: "Select your videocard",
        allowClear: true
    });

    $('.js-basic-single-cpu').select2({
        placeholder: "Select your CPU",
        allowClear: true
    });

    $('.js-basic-multiple-ram').select2({
        placeholder: "Select your ram amount",
        allowClear: true
    });

    // Switch script
    $('#rambettercheckbox').lc_switch('', '');
    var ramchecked = 0;
    $('body').delegate('#rambettercheckbox', 'lcs-on', function() {
        ramchecked = 1;
        // console.log(ramchecked);
    });
    $('body').delegate('#rambettercheckbox', 'lcs-off', function() {
        ramchecked = 0;
        // console.log(ramchecked);
    });

    $('#videocardbettercheckbox').lc_switch('', '');

    $('#cpubettercheckbox').lc_switch('', '');




    // La parte qui sotto è relativa al tema, non toccare!!
    // Enable Bootstrap tooltips via data-attributes globally
    $('[data-toggle="tooltip"]').tooltip();

    // Enable Bootstrap popovers via data-attributes globally
    $('[data-toggle="popover"]').popover();

    $(".popover-dismiss").popover({
        trigger: "focus"
    });

    // Activate Feather icons
    // feather.replace();

    // Activate Bootstrap scrollspy for the sticky nav component
    $("body").scrollspy({
        target: "#stickyNav",
        offset: 82
    });

    // Scrolls to an offset anchor when a sticky nav link is clicked
    $('.nav-sticky a.nav-link[href*="#"]:not([href="#"])').click(function() {
        if (
            location.pathname.replace(/^\//, "") ==
            this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate({
                        scrollTop: target.offset().top - 81
                    },
                    200
                );
                return false;
            }
        }
    });

    // Collapse Navbar
    // Add styling fallback for when a transparent background .navbar-marketing is scrolled
    var navbarCollapse = function() {
        if($(".navbar-marketing.bg-transparent.fixed-top").length === 0) {
            return;
        }
        if ($(".navbar-marketing.bg-transparent.fixed-top").offset().top > 0) {
            $(".navbar-marketing").addClass("navbar-scrolled");
        } else {
            $(".navbar-marketing").removeClass("navbar-scrolled");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);


})


