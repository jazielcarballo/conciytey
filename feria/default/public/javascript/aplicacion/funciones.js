/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {

    /* $('#seleccionar_todos').toggle(function() {
     $('input:checkbox').attr('checked', 'checked');
     $(this).val('uncheck all');
     }, function() {
     $('input:checkbox').removeAttr('checked');
     $(this).val('check all');
     })*/



    $(".eliminar_seleccionados").on('click', function(event) {
        event.preventDefault();
        $(".form_lista").submit();
    });
});


handle_side_menu();

function handle_side_menu() {
    $("#menu-toggler").on("click", function() {
        $("#sidebar").toggleClass("display");
        $(this).toggleClass("display");
        return false;
    });
    var a = false;
    $("#sidebar-collapse").on("click", function() {
        $("#sidebar").toggleClass("menu-min");
        $(this.firstChild).toggleClass("icon-double-angle-right");
        a = $("#sidebar").hasClass("menu-min");
        if (a) {
            $(".open > .submenu").removeClass("open");
        }
    });
    $(".nav-list").on("click", function(d) {
        if (a) {
            return;
        }
        var c = $(d.target).closest(".dropdown-toggle");
        if (c && c.length > 0) {
            var b = c.next().get(0);
            if (!$(b).is(":visible")) {
                $(".open > .submenu").each(function() {
                    if (this != b && !$(this.parentNode).hasClass("active")) {
                        $(this).slideUp(200).parent().removeClass("open");
                    }
                });
            }
            $(b).slideToggle(200).parent().toggleClass("open");
            return false;
        }
    });
}




$(".tooltip_a").tooltip();
 
       
  

   
  
