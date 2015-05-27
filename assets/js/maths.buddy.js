/*
  Maths Buddy JS
*/

$(document).ready(function() {

    hash_change_div(1);

    $(window).bind('hashchange', function(e) {
        hash_change_div(0);
    });

    detect_hash_dynamic_menu();

    $(window).scroll(function() {
        detect_hash_dynamic_menu();
    });


    function detect_hash_dynamic_menu() {
        if ($("#maths_window").css('display') == 'block') {
            if ($('#maths').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#maths-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#second-degre').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#second-degre-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#statistiques').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#statistiques-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#loi-binomiale').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#loi-binomiale-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#loi-normale').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#loi-normale-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#loi-poisson').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#loi-poisson-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#variable-aleatoire').visible()) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#variable-aleatoire-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#test-khi-2').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#test-khi-2-menu").addClass("active_jquery"); //Add "active" class to selected tab
            }
        } else {
            if ($('#top').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#top-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#manuel').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#manuel-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#menu').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#menu-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#webapp').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#webapp-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#about').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#about-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#contact').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#contact-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#footer').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#contact-menu").addClass("active_jquery"); //Add "active" class to selected tab
            }
        }
    }


    function hash_change_div(type) {
        var anchor = document.location.hash;
        if (anchor === '#top' || anchor === '#manuel' || anchor === '#menu' || anchor === '#webapp' || anchor === '#about' || anchor === '#contact') {
            //Normal menu
            $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
            $(".sub-menu-main-window").animate({
                height: "40px"
            });
            $(".sub-menu-maths-window").animate({
                height: "0px"
            });
            if ($("#maths_window").css('display') == 'block') {
                $("#maths_window").css({
                    "display": "none"
                });
                $("#main_window").css({
                    "display": "block"
                });
                $("html, body").animate({
                    scrollTop: $(anchor).offset().top
                }, 100);
            }else{
              //Type allow us to disable animate on load
              if(type == 0){
                  $("html, body").animate({
                    scrollTop: $(anchor).offset().top
                }, 150);
                }
            }
        } else if (anchor === '') {
            //Top menu selected
            $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
            $("#top-menu").addClass("active_jquery"); //Add "active" class to selected tab
            $(".sub-menu-main-window").animate({
                height: "40px"
            });
            $(".sub-menu-maths-window").animate({
                height: "0px"
            });
            if ($("#maths_window").css('display') == 'block') {
                $("#maths_window").css({
                    "display": "none"
                });
                $("#main_window").css({
                    "display": "block"
                });
                $("html, body").animate({
                    scrollTop: $(anchor).offset().top
                }, 100);
            }else{
              //Type allow us to disable animate on load and scrolling
              if(type == 0){
                  $("html, body").animate({
                    scrollTop: $(anchor).offset().top
                }, 150);
                }
            }
        } else {
            //Maths menu
            $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
            $(".sub-menu-main-window").animate({
                height: "0px"
            });
            $(".sub-menu-maths-window").animate({
                height: "40px"
            });
            if ($("#maths_window").css('display') == 'none') {
                $("#maths_window").css({
                    "display": "block"
                });
                $("#main_window").css({
                    "display": "none"
                });
                $("html, body").animate({
                    scrollTop: $(anchor).offset().top
                }, 100);
            }else{
              //Type allow us to disable animate on load
              if(type == 0){
                  $("html, body").animate({
                    scrollTop: $(anchor).offset().top
                }, 150);
                }
            }
        }
        detect_hash_dynamic_menu();
    }

    //Set radio button
    $("#type-saisie-loi-poisson").buttonset();
    $("#type-saisie-loi-normale").buttonset();
    //Dynamic radio button
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
        //Modify hidden value for AJAX POST
        var currentVal = parseInt($("#nombre_vars_statistiques").val());
        if (!isNaN(currentVal)) {
            currentVal = currentVal + 1;
            $("#nombre_vars_statistiques").val(currentVal);
        }
        //Add div
        $('#add-div-statistiques').append('<div id="add-otf-statistiques_' +
            currentVal +
            '"><a class="button scrolly button-remove-statistiques" onClick="$(this).Remove_Row(' +
            currentVal +
            ', 1);" style="float: right; padding-top: 12.5px; padding-bottom: 12.5px;padding-left:29px;padding-right:29px; font-size:1.5em;">-</a><div style="padding-right: .5em;padding-bottom:2em;position:absolute;width:62%;"><input type="text" name="statistiques_numero_' +
            currentVal + '" id="statistiques_numero_' + currentVal +
            '" placeholder="Nombre" style="width:100%"/></div><br/><br/></div>'
        );
        //Copy & reset values on the newly created div
        $("#statistiques_numero_" + currentVal).val($("#statistiques_numero_1").val());
        $("#statistiques_numero_1").val("");
        //If send button isn't visible
        if (!$('#send-button-statistiques').visible()) {
            $("html, body").animate({
                scrollTop: $('#send-button-statistiques').offset().top +
                    -$(window).height() + 130
            }, 150);
        }
    });

    $.fn.Remove_Row = function(id, type) {
        if (type == 1) {
            var currentVal = parseInt($("#nombre_vars_statistiques").val());
            if (!isNaN(currentVal)) {
                currentVal = currentVal - 1;
                $("#nombre_vars_statistiques").val(currentVal);
            }
            $(this).closest("#add-otf-statistiques_" + id).remove();
        } else if (type == 2) {
            var currentVal = parseInt($("#nombre_vars_v_aleatoire").val());
            if (!isNaN(currentVal)) {
                currentVal = currentVal - 1;
                $("#nombre_vars_v_aleatoire").val(currentVal);
            }
            $(this).closest("#add-otf-v-aleatoire_" + id).remove();
        }
    };

    $('.button-add-v-aleatoire').click(function() {
        var currentVal = parseInt($("#nombre_vars_v_aleatoire").val());
        if (!isNaN(currentVal)) {
            currentVal = currentVal + 1;
            $("#nombre_vars_v_aleatoire").val(currentVal);
        }
        $('#add-div-v-aleatoire').append('<div id="add-otf-v-aleatoire_' +
            currentVal +
            '"><a class="button scrolly button-remove-statistiques" onClick="$(this).Remove_Row(' +
            currentVal +
            ', 2);" style="float: right; padding-top: 12.5px; padding-bottom: 12.5px;padding-left:29px;padding-right:29px; font-size:1.5em;">-</a><div style="padding-right: .5em;padding-bottom:2em;position:absolute;width:62%;"><table><tr><td style="border-right: 10px solid transparent;-webkit-background-clip: padding;-moz-background-clip: padding;background-clip: padding-box;"><input id="v_aleatoire_x_' +
            currentVal +
            '" name="v_aleatoire_x_' +
            currentVal +
            '" placeholder="X" style="width:100%" type="text"></td><td><input id="v_aleatoire_proba_x_' +
            currentVal +
            '" name="v_aleatoire_proba_x_' +
            currentVal +
            '" placeholder="Probabilité de X" style="width:100%" type="text"></td></tr></table></div><br/><br/></div>'
        );
        //Copy & reset values on the newly created div
        $("#v_aleatoire_x_" + currentVal).val($("#v_aleatoire_x_1").val());
        $("#v_aleatoire_proba_x_" + currentVal).val($("#v_aleatoire_proba_x_1").val());
        $("#v_aleatoire_x_1").val("");
        $("#v_aleatoire_proba_x_1").val("");

        if (!$('#send-button-v-aleatoire').visible()) {
            $("html, body").animate({
                scrollTop: $('#send-button-v-aleatoire').offset().top +
                    -$(window).height() + 130
            }, 150);
        }
    });
});
