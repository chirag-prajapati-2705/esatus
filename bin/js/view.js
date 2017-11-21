$(function() {
    var list = $('ul.four-items').children(), content = $('div.four-contents').children();
        list.on('click',function(){
          var index = $(this).index();
          list.removeClass('active').eq(index).addClass('active');
          content.removeClass('active').eq(index).addClass('active');
      });
});