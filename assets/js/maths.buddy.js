/*
	Maths Buddy JS
*/
$(document).ready(function() {



$(window).scroll(function () {
     var anchor = document.location.hash;
     if (anchor === '#maths') {
      if($('#maths').visible()){
       $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
       $("#maths-menu").addClass("active_jquery"); //Add "active" class to selected tab
      }
      }else{
       if($('#top').visible()){
        $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
        $("#top-menu").addClass("active_jquery"); //Add "active" class to selected tab
       }else if ($('#manuel').visible()){
        $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
        $("#manuel-menu").addClass("active_jquery"); //Add "active" class to selected tab
       }else if($('#menu').visible()){
        $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
        $("#menu-menu").addClass("active_jquery"); //Add "active" class to selected tab
       }else if($('#webapp').visible()){
        $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
        $("#webapp-menu").addClass("active_jquery"); //Add "active" class to selected tab
       }else if($('#about').visible()){
        $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
        $("#about-menu").addClass("active_jquery"); //Add "active" class to selected tab
       }else if($('#contact').visible()){
        $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
        $("#contact-menu").addClass("active_jquery"); //Add "active" class to selected tab
       }
      }
});



    var anchor = document.location.hash;
    if (anchor === '#maths') {
        $("#maths_window").css({
            "display": "block"
        });
        $("#main_window").css({
            "display": "none"
        });
        //Fix desynchro div - to be updated
        $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
        $("#maths-menu").addClass("active_jquery"); //Add "active" class to selected tab
    } else {
        $("#maths_window").css({
            "display": "none"
        });
        $("#main_window").css({
            "display": "block"
        });
    }
    $("html, body").animate({
        scrollTop: $(anchor).offset().top
    }, 400);
    $(window).bind('hashchange', function(e) {
        var anchor = document.location.hash;
        if (anchor === '#maths') {
            $("#maths_window").css({
                "display": "block"
            });
            $("#main_window").css({
                "display": "none"
            });
            //Fix desynchro div - to be updated
            $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
            $("#maths-menu").addClass("active_jquery"); //Add "active" class to selected tab
        } else {
            $("#maths_window").css({
                "display": "none"
            });
            $("#main_window").css({
                "display": "block"
            });
        }
        $("html, body").animate({
            scrollTop: $(anchor).offset().top
        }, 400);
    });
});
$("#type-saisie-loi-poisson").buttonset();
$("#type-saisie-loi-normale").buttonset();
$('#radio-type-loi-poisson-1').click(function() {
    $("#lambda_poisson").css({
        "display": "none"
    });
    $("#p_poisson").css({
        "display": "block"
    });
});
$('#radio-type-loi-poisson-2').click(function() {
    $("#lambda_poisson").css({
        "display": "block"
    });
    $("#p_poisson").css({
        "display": "none"
    });
});
$('.button-add-statistiques').click(function() {
    var currentVal = parseInt($("#nombre_vars_statistiques").val());
    if (!isNaN(currentVal)) {
        currentVal = currentVal + 1;
        $("#nombre_vars_statistiques").val(currentVal);
    }
    $('#add-div-statistiques').append('<div id="add-otf-statistiques_' +
        currentVal +
        '"><a class="button scrolly button-remove-statistiques" onClick="$(this).Remove_Statistiques_Row(' +
        currentVal +
        ');" style="float: right; padding-top: 0.348em; padding-bottom: 0.388em;padding-left:0.792em;padding-right:0.792em;font-size:1.5em;">-</a><div style="padding-right: .5em;padding-bottom:2em;position:absolute;width:62%;"><input type="text" name="statistiques_numero_' +
        currentVal + '" id="statistiques_numero_"' + currentVal +
        ' placeholder="Nombre" style="width:100%"/></div><br/><br/></div>'
    );
    if (!$('#send-button-statistiques').visible()) {
        $("html, body").animate({
            scrollTop: $('#send-button-statistiques').offset().top +
                -$(window).height() + 130
        }, 400);
    }
});
$.fn.Remove_Statistiques_Row = function(id) {
    var currentVal = parseInt($("#nombre_vars_statistiques").val());
    if (!isNaN(currentVal)) {
        currentVal = currentVal - 1;
        $("#nombre_vars_statistiques").val(currentVal);
    }
    $(this).closest("#add-otf-statistiques_" + id).remove();
};
