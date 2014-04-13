$(document).ready(function(event) {
    var loadurl = "http://assos.utc.fr/asso/articles/picasso";

    function scrollableElement(els) {
        for (var i = 0, argLength = arguments.length; i <argLength; i++) {
            var el = arguments[i],
            $scrollElement = $(el);
            if ($scrollElement.scrollTop()> 0) {
                return el;
            } else {
                $scrollElement.scrollTop(1);
                var isScrollable = $scrollElement.scrollTop()> 0;
                $scrollElement.scrollTop(0);
                if (isScrollable) {
                    return el;
                }
            }
        }
        return [];
    }

    // Variable de gestion du scroll automatique
    var timeOutPresentation; 
    var timeOutInactifUser;

    // Fonction permettant le passage d'une section à l'autre
    function doPresentation(){
        id = location.hash.replace("#", "");
        switch(id){
            case 'news':
                $('#menu-calendrier').trigger('click');
                break;
            case 'calendrier':
                $('#menu-weekbieres').trigger('click');
                break;
            case 'weekbieres':
                $('#menu-goodies').trigger('click');
                break;
            case 'goodies':
                $('#menu-tarifs').trigger('click');
                break;
            case 'tarifs':
                $('#menu-news').trigger('click');
                break;
            default:
                $('#menu-calendrier').trigger('click');
                break;
        }
        timeOutPresentation = setTimeout(doPresentation, 30000);
    }

    // Fonction permettant de désactiver le scroll automatique tant que l'utilisateur est actif (la souris bouge)
    function disablePresentation() {
        clearTimeout(timeOutPresentation);
        $('html').unbind("mousemove");
        timeOutInactifUser = setTimeout(enablePresentation, 30000);

    }

    // Fonction permettant d'activer le scoll automatique. (jusqu'a que la souris bouge)
    function enablePresentation() {
        $('html').mousemove(disablePresentation);
        timeOutPresentation = setTimeout(doPresentation, 30000);
    }

    // Si l'utilisateur est dans un box alors on arrête les timers.
    $('.box').hover(function(ev){
        clearTimeout(timeOutPresentation);
        clearTimeout(timeOutInactifUser);
    }, function(ev){
        disablePresentation();
    });

    // Activation du scroll automatique au début.
    enablePresentation();

    $('.slides').each(function(i) {
        var height = $(this).height();
        var windowheight = $(window).height();
        $(this).css('padding-bottom', (windowheight - height)/2 + 'px');
        $(this).css('padding-top', (windowheight - height)/2 + 'px');
        var position = $(this).position();
        $(this).scrollspy({
                min: position.top,
                max: position.top + height,
                onEnter: function(element, position) {
                    $('#menu-'+element.id).parent().addClass('active');
                    // Permet de changer l'url en fonction d'où l'utilisateur se trouve sur la page
                    // Desactiver permet de regler des problème de saut de page. 
                    //location.hash = "#"+element.id; 
                },
                onLeave: function(element, position) {
                    $('.menu-left li').removeClass('active');
                }
        });
    });

    var scrollElem = scrollableElement('html', 'body');

    $('a[href*=#]').each(function() {
        var target = $(this).attr('href');
        if ($(target).length>0) {
            var targetOffset = $(target).offset().top;
            $(this).click(function(event) {
                event.preventDefault();
                $(scrollElem).animate({scrollTop: targetOffset}, 600, 'easeInOutExpo', function() {
                    location.hash = target;
                });
            });
        }
    });
   
    $('.block').on('mouseenter',function(event){
        event.preventDefault();
        $(this).find('.detail').show();
    });

    $('.block').on('mouseleave',function(event){
        event.preventDefault();
        $('.detail').hide();
    });

    $.get(loadurl,function(data){
        console.log(data);
    },'html');
});
