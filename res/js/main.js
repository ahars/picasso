$(document).ready(function() {
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

    function doPresentation(){
        id = location.hash.replace("#", "");
        switch(id){
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
                $('#menu-calendrier').trigger('click');
                break;
            default:
                $('#menu-weekbieres').trigger('click');
                break;
        }
    }

    interval = setInterval(doPresentation, 30000);

    $('.box').hover(function(ev){
        clearInterval(interval);
    }, function(ev){
        interval = setInterval( doPresentation, 30000);
    });

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
                    location.hash = "#"+element.id;
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