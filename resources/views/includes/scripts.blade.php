<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="/js/dragula.min.js"></script>
<script src="/js/dropzone.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="/js/app.js"></script>    




<script>
	tinymce.init({
        selector:'.editor',
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'bullist',
        content_css: '/css/editor/light/content.min.css'
    });
	tinymce.init({
		selector:'.editorOrdered',
		menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
		toolbar: 'numlist',
		content_css: '/css/editor/light/content.min.css'
	});
</script>
