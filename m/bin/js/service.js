if (!location.origin) {
	location.origin = location.protocol + "//" + location.host;
}

$(function() {
	var select = $('select:eq(0)');
		select.on('change',function(){
			var $this = $(this), id = $this.val();
			query(id);
		});

	var query = function(id) {
		$.ajax({
			url: location.origin + '/sous-categorie/liste',
			method: 'POST',
			dataType: 'html',
			data: {id:id},
		    success: function(html) {
				$('select:gt(0)').remove();
				$('div#dynamic').append(html);
		    }
		});	
	}
});