$(function() {
	var type = ['list','grid'];
	var containers = $('div.list, div.grid');
		containers.eq(0).hide();

	var switcher = $('span.layout-switch').find('a');
		switcher.on('click',function(e){
			var $this = $(this), cls = $this.attr('href').replace('#','');
			for (var i = 0; i < type.length; ++i) {
				var method = (type[i] == cls) ? 'show':'hide',
					action = (type[i] == cls) ? 'add':'remove';
				switcher.eq(i)[action+'Class']('active');
				containers.eq(i)[method]();
			}
			e.preventDefault();
		});


    var form = $('form'), select = $('select');
        select.on('change',function(){
          form.submit();
        });
});