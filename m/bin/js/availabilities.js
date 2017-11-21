$(function() {
	var from = $('select[name="from"]');
		from.on('change',function(){
			query(parseInt($(this).val())+1);
		});

	var query = function(value) {
		$.ajax({
			url: $('form').data('dynamic'),
			method: 'POST',
			dataType: 'html',
			data: {value:value},
		    success: function(html) {
				$('select[name="to"]').remove();
				$('input[type="submit"]').before(html);
		    }
		});	
	}

	var squares = $('tbody').find('tr').find('td:gt(0)');
		squares.on('click',function(){
			$(this).toggleClass('green');
		});

	var parse = function() {
		var days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
		var slots = [];
		for(day in days) {
			var td = $('td[data-day="'+days[day]+'"]'), hours = '';
				td.each(function(i){
					hours += ($(this).hasClass('green')) ? parseInt(i)+':'+parseInt(i+1)+';':'';
				});
			slots.push(hours);
		}
		return {monday:slots[0],tuesday:slots[1],wednesday:slots[2],thursday:slots[3],friday:slots[4],saturday:slots[5], sunday:slots[6]};
	}

	var actions = $('a.btn-primary, a.btn-info');
		actions.on('click',function(e){
			var $this = $(this), data = parse();
			$.ajax({
				url: $(this).attr('href'),
				method: 'POST',
				dataType: 'html',
				data: data,
			    success: function(html) {
			    	if ($this.index() == 1) {
			    		$('td.green').removeClass('green');
			    	}
			    	$('#ajax-availabilities-saved').fadeIn();
			    	var timer = setTimeout(function(){
			    		$('#ajax-availabilities-saved').fadeOut();
			    	}, 5000);
			    }
			});	
			e.preventDefault();
		});
});