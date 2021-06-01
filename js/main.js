$(function () {


initAvatarBox();

function initAvatarBox() {
    const avatarWidth = $('.avatar').width();
    const avatarHeight = $('.avatar').height();


    $('.frame-box').css({width : avatarWidth, height: avatarHeight});

    if(avatarWidth < avatarHeight) {
        $('.frame-foto-before').css({bottom: -avatarHeight,
            width: avatarWidth,
            height: avatarHeight
        });
        $('.frame-foto-after').css({bottom: avatarWidth,
            width: avatarWidth,
            // top: 0,
            height: avatarHeight
        });
        $('.frame-foto').css({width: avatarWidth, height: avatarWidth});
       
    } 
    else {
        $('.frame-foto-before').css({left: avatarHeight,
            width: 1100 + 'px',
            top: 0,
            height: avatarHeight
        });
        $('.frame-foto-after').css({left: - 1100 + 'px',
            width: 1100 + 'px',
            top: 0,
            height: avatarHeight
        });
        $('.frame-foto').css({width: avatarHeight, height: avatarHeight});
    }
}

$('.frame-foto').on('mousedown', (e) => {

    if($('.avatar').width() > $('.avatar').height()) {
        const firstPos = e.screenX;
        const pos = $(e.target).position().left;    

        document.onmousemove = (e) => {
            const delta = e.screenX - firstPos;
            const value = pos + delta;
            
            if (value < 0) {
                $('.frame-foto').css({left: 0});
            } 
            else if (value > $('.avatar').width() - $('.avatar').height()){
                return false
            }
            else {
                $('.frame-foto').css({left: value + 'px'});
            }
            
        }
    } 
    else {
        const firstPos = e.screenY;
        const pos = $(e.target).position().top;

        document.onmousemove = (e) => {
            const delta = e.screenY - firstPos;
            const value = pos + delta;
            
            if (value < 0) {
                $('.frame-foto').css({top: 0});
            } 
            else if (value > $('.avatar').height() - $('.avatar').width()){
                return false
            }
            else {
                $('.frame-foto').css({top: value + 'px'});
            }
            
        }
    }

    document.onmouseup = () => {
        document.onmousemove = null;
    }

});

$('.btn').on('click', () => {
    const x = $('.frame-foto').position().left;
    const y =  $('.frame-foto').position().top;
    const file = $('.avatar').attr('src');
    const size = $('.frame-foto').width();

    $.ajax({
        url: 'avatar.php',
        data: {
            x: x,
            y: y,
            file: file,
            size: size
        },
        type: 'POST',
        success: function (res) {
            if (!res) {
                alert('Ошибка');
            }
            $('.frame-box').fadeOut();
            $('.btn').fadeOut();
            alert(res);
        },
        error: function () {
            alert('Error');
        }
    });
});


});
