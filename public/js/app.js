$(function() {



    setTimeout(function() {
        $('.notification').fadeOut();    
    }, 5000);
    




/*    $('.instructions-list ol li, .ingredients-list ul li').on('click', function() {
        $(this).text('');
    });

    var defaultIngredient = 'Example ingredient';
    var defaultInstruction = 'Example instruction';

    $('.instructions-list ol').on('blur', function(e) {

        $(this).find('li').each(function(k, v) {
            if($(v).text() ) {

            }
            
        })

    })
*/


    $('.recipe-thumbnail-list li').on('click', function() {
        var orig = $(this).find('img').attr('src');
        var img = orig.replace('/xs/','/lg/');


        $('.recipe-hero-image').css({
            'background': 'url('+img+') no-repeat center center fixed',
            'background-size': 'cover'

        });
        
    })


	$('.card').on('click', function() {
		location.href = $(this).data('href');
	});

	$(document).on('click', '.kitchen-view', function(e) {
		e.preventDefault();
		$(this).toggleClass('kitchen-view full-view');
		$(this).text('Full View');
		$('.recipe-hero-image').addClass('inactive');
	})

	$(document).on('click', '.full-view', function(e) {
		e.preventDefault();
		$(this).toggleClass('full-view kitchen-view');
		$(this).text('Kitchen View');
		$('.recipe-hero-image').removeClass('inactive');
	});


	$('form#search').on('submit', function(e) {
		e.preventDefault();
		var q = $(this).find('input[name=query]').val();		
		location.href = '/search/'+q;
	});





	$('.navbar-burger').on('click', function() {
        $(this).toggleClass('is-active');
		$('.navbar-menu').toggleClass('is-active');
	});


    $('form.edit-recipe').find('button.delete-tag').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var postdata = {
            _token: $('meta[name="_token"]').attr('content'),
            tagid: $(this).data('tagid'),
            recipeid: $(this).data('recipeid')
        }
        $.ajax({
            type: 'POST',
            url: '/tag/delete',
            data: postdata,
            success: function(response) {
                $this.parent().remove();
            }
        });
    });

    
    $('form.edit-recipe').find('div.delete-image').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var postdata = {
            _token: $('meta[name="_token"]').attr('content'),
            media_filename: $(this).data('mediafilename'),
            media_recipeid: $(this).data('mediarecipeid')
        }
        $.ajax({
            type: 'POST',
            url: '/image/delete',
            data: postdata,
            success: function(response) {
                $this.parent().remove();
            }
        });
    });


    $('form.create-recipe').find('i.mce-ico.mce-i-numlist').trigger('click');
    $('form.create-recipe').find('i.mce-ico.mce-i-bullist').trigger('click');

    $('input[name=recipe_tags]').on('blur', function() {
        $(this).val( $(this).val().split(' ') );
    });


    var myDropzone = new Dropzone('div#myDropzone', {
    	url: '/recipe/upload/image',
    	parallelUploads: 5,
    	headers: {
    		'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    	},
    	init: function() {
    		this.on('addedfile', function(file) {
    			$('<input/>', {
    				type: 'hidden',
    				name: 'uploads[]',
    				value: file.name
    			}).appendTo('form[name=share]');

    			$('button[name=share]').attr('disabled', false);
    		})
    		this.on('sending', function(file, xhr, formData) {
    			//formData.append('media_recipeid', lastid);
    			//$('button[name=share]').text('Uploading Files...');
    		});
    		this.on('success', function(file, response) {
    			console.log(response);
    		})
    		this.on('queuecomplete', function(file) {
            });
            this.on('error', function(file) {});
        }
    });





    $('form[name=share]').on('submit', function(e) {
        var f = $(this).find('.ingredient-textarea').val();
        var g = $(this).find('.instructions-textarea').val();
        $('<input/>', {
            type: 'hidden',
            name: 'ingredients',
            value: f
        }).appendTo( $(this) );

        $('<input/>', {
            type: 'hidden',
            name: 'instructions',
            value: g
        }).appendTo( $(this) )

    })
});







window.onload = function() {
    var drake = dragula([
        document.getElementById('draggable')
    ]);

    drake.on('drop', function(e) {
        console.log(e);

    })
};

