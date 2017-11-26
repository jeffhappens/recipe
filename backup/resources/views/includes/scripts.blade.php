<script src="https://code.jquery.com/jquery-3.2.0.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.2.0.min.js"><\/script>')</script>
<script src="/js/plugins.js"></script>
<script src="/js/dropzone.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
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
<script src="/js/main.js"></script>


<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
    ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
</script>
<script id="dsq-count-scr" src="//newrecipeengine.disqus.com/count.js" async></script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
<div class="overlay"></div>
