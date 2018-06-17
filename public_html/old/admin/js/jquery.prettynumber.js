(function($) {
	$.fn.prettynumber = function(options) {
		var opts = $.extend({}, $.fn.prettynumber.defaults, options);
		return this.each(function() {
			$this = $(this);
			var o = $.meta ? $.extend({}, opts, $this.data()) : opts;
			var str = $this.html();
			var arr = str.split('.');
			if(arr.length == 2) {
				arr[0] = arr[0].toString().replace(new RegExp("(^\\d{"+(arr[0].toString().length%3||-1)+"})(?=\\d{3})"),"$1"+o.delimiter).replace(/(\d{3})(?=\d)/g,"$1"+o.delimiter);
				$this.html('$ ' + arr[0] + ',' + arr[1]);
			}
			if(arr.length == 1) {
				$this.html(arr[0].toString().replace(new RegExp("(^\\d{"+(arr[0].toString().length%3||-1)+"})(?=\\d{3})"),"$1"+o.delimiter).replace(/(\d{3})(?=\d)/g,"$1"+o.delimiter));
				$this.html('$ ' + $this.html());
			}
		});
	};
	$.fn.prettynumber.defaults = {
		delimiter       : '.'	
	};
})(jQuery);