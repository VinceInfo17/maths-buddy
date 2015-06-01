/*
  Maths Buddy JS
*/

$(document).ready(function() {
    hash_change_div();

    $(window).bind('hashchange', function(e) {
        hash_change_div();
    });

    detect_hash_dynamic_menu();

    $(window).scroll(function() {
        detect_hash_dynamic_menu();
    });


    function detect_hash_dynamic_menu() {
        if ($("#maths_window").css('display') == 'block') {
            if ($('#maths').visible()) {
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
            } else if ($('#variable-aleatoire').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#variable-aleatoire-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#test-khi-2').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#test-khi-2-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#loi-uniforme').visible()) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#loi-uniforme-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#troisieme-degre').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#troisieme-degre-menu").addClass("active_jquery"); //Add "active" class to selected tab
            } else if ($('#footer').visible(true)) {
                $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
                $("#troisieme-degre-menu").addClass("active_jquery"); //Add "active" class to selected tab
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


    function hash_change_div() {
        var anchor = document.location.hash;
        if (anchor === '#top' || anchor === '#manuel' || anchor === '#menu' || anchor === '#webapp' || anchor === '#about' || anchor === '#contact') {
            //Normal menu
            $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
            if ($("#maths_window").css('display') == 'block') {
                $("#maths_window").css({
                    "display": "none"
                });
                $("#main_window").css({
                    "display": "block"
                });
                $("html, body").animate({
                    scrollTop: $(anchor).offset().top
                }, 70);
            } else {
                $("html, body").animate({
                    scrollTop: $(anchor).offset().top
                }, 70);
            }
            $(".sub-menu-main-window").animate({
                height: "40px"
            });
            $(".sub-menu-maths-window").animate({
                height: "0px"
            });
        } else if (anchor === '') {
            //Top menu selected
            $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
            $("#top-menu").addClass("active_jquery"); //Add "active" class to selected tab
            $("#maths_window").css({
                "display": "none"
            });
            $("#main_window").css({
                "display": "block"
            });
            $(".sub-menu-main-window").animate({
                height: "40px"
            });
            $(".sub-menu-maths-window").animate({
                height: "0px"
            });
        } else {
            //Maths menu
            $("#nav li a.active_jquery").removeClass("active_jquery"); //Remove any "active" class
            if ($("#maths_window").css('display') == 'none') {
                $("#maths_window").css({
                    "display": "block"
                });
                $("#main_window").css({
                    "display": "none"
                });
                $("html, body").animate({
                    scrollTop: $(anchor).offset().top
                }, 70);
            } else {
                $("html, body").animate({
                    scrollTop: $(anchor).offset().top
                }, 70);
            }
            $(".sub-menu-main-window").animate({
                height: "0px"
            });
            $(".sub-menu-maths-window").animate({
                height: "40px"
            });
        }
        detect_hash_dynamic_menu();
    }

    //Set radio button
    $("#type-saisie-loi-poisson").buttonset();
    $("#type-saisie-loi-normale").buttonset();
    //Dynamic radio button
    //Loi poisson
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
    //Loi normale
    $('#radio-type-saisie-loi-normale-1').click(function() {
        $("#inferior-egale-loi-normale").css({
            "display": "block"
        });
        $("#superior-egale-loi-normale").css({
            "display": "none"
        });
        $("#min-max-loi-normale").css({
            "display": "none"
        });
        $("#superior-loi-normale").css({
            "display": "none"
        });
    });
    $('#radio-type-saisie-loi-normale-2').click(function() {
        $("#inferior-egale-loi-normale").css({
            "display": "none"
        });
        $("#superior-egale-loi-normale").css({
            "display": "block"
        });
        $("#min-max-loi-normale").css({
            "display": "none"
        });
        $("#superior-loi-normale").css({
            "display": "none"
        });
    });
    $('#radio-type-saisie-loi-normale-3').click(function() {
        $("#inferior-egale-loi-normale").css({
            "display": "none"
        });
        $("#superior-egale-loi-normale").css({
            "display": "none"
        });
        $("#min-max-loi-normale").css({
            "display": "block"
        });
        $("#superior-loi-normale").css({
            "display": "none"
        });
    });
    $('#radio-type-saisie-loi-normale-4').click(function() {
        $("#inferior-egale-loi-normale").css({
            "display": "none"
        });
        $("#superior-egale-loi-normale").css({
            "display": "none"
        });
        $("#min-max-loi-normale").css({
            "display": "none"
        });
        $("#superior-loi-normale").css({
            "display": "block"
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
            '" style="padding-bottom:0.5em"><input id="statistiques_numero_' +
            currentVal + '" name="statistiques_numero_' +
            currentVal + '" placeholder="Nombre" class="dynamic-element" style="display: inline;" type="text"></input><a class="button button-dynamic" style="float: right;" onClick="$(this).Remove_Row(' +
            currentVal + ', 1);">-</a></div>'
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
            currentVal + '"><table class="dynamic-element" style="float: left; margin-bottom:10px;"><tr><td class="padding-left-td"><input id="v_aleatoire_x_' +
            currentVal + '" class="input-text-v-aleatoire" name="v_aleatoire_x_' +
            currentVal + '" placeholder="X" type="text"></input></td><td><input id="v_aleatoire_proba_x_' +
            currentVal + '" class="input-text-v-aleatoire" name="v_aleatoire_proba_x_' +
            currentVal + '" placeholder="Probabilité de X" type="text"></input></td></tr></table><a class="button button-dynamic" style="float: right;" onClick="$(this).Remove_Row(' +
            currentVal + ', 2);">-</a></div>'
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


    $('.parameter-second-degre').click(function() {
      if ($(".parameters-div").css('height') == '75px') {
        $(".parameters-div").animate({
                height: "0px",
                marginTop: "0em"
        });
      }else{
        $(".parameters-div").animate({
                height: "75px",
                marginTop: "1em"
        });
      }
    });
    
    //AJAX Calls

    $("#form-second-degre").submit(function(event) {
        // Stop form from submitting normally
        event.preventDefault();
        var postData = $(this).serializeArray();
        $( "#result-second-degre" ).html( '<img src="images/ajax_loading.gif" alt="Chargement...">' );
        $.ajax(
        {
            url : 'assets/ajax/second_degre.php?api=0',
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $( "#result-second-degre" ).html( data );
                if (!$('#bottom-result-second-degre').visible(true)) {
                    $("html, body").animate({
                        scrollTop: $('#bottom-result-second-degre').offset().top +
                            -$(window).height() + 50
                    }, 500);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                $( "#result-second-degre" ).html( "" );
                $( "#dialog-error-ajax" ).dialog({
                  height: "auto",
                  width: "auto",
                  modal: true,
                  resizable: false,
                  draggable: false,
                  dialogClass: 'success-dialog'
                }); 
            }
        });
    });

});

