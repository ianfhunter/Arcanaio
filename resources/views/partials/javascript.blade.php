<script src="{{ url('/js/app.js') }}"></script>
<script src="{{ url('/js/all.js') }}"></script>
<script src="/js/trumbowyg.min.js"></script>
<script src="/js/trumbowyg.table.min.js"></script>
<script src="/js/modernizr.js"></script>

<script>
	$.trumbowyg.svgPath = '/css/icons.svg';

	$('.trumbowyg').trumbowyg({
	   btns: ['strong', 'em', 'formatting', 'unorderedList', 'orderedList','table'],
	   autogrow: false
	});
</script>
