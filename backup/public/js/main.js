$(function() {



    $('i.mce-ico.mce-i-numlist').trigger('click');
    $('i.mce-ico.mce-i-bullist').trigger('click');




    $('section.result-thumbnails img').on('click', function() {
        var fadeSpeed = 200;
        var src = $(this).attr('src').replace('sm/','lg/');
        $('section.result-hero').fadeOut(fadeSpeed, function() {
            $(this).css({
                'background-image' : 'url('+src+')'
            }).fadeIn(fadeSpeed)
        });
    });



    function addLike(recipeid) {
        var postdata = {
            _token: $('meta[name=_token]').attr('content'),
            recipeid: recipeid
        }
        $.ajax({
            type: 'POST',
            url: '/like/add',
            data: postdata,
            success: function(data) {

                console.log(data);

            }

        })


    }

    $('.glyphicon-heart').on('click', function() {
        var count = parseInt($(this).closest('li').text());
        $(this).closest('li').text(count+1)
        var recipeid = $(this).data('recipeid');
        addLike(recipeid);
    })




    function showOverlay() {
        $('.overlay').addClass('showing');
    }
    function hideOverlay() {
        $('.overlay').removeClass('showing');
    }
    function showSearch() {
        $('.search').addClass('showing');
    }
    function hideSearch() {
        $('.search').removeClass('showing');
    }
    function hideInvite() {
        $('.invite-friend').removeClass('showing');
    }
    function showInvite() {
        $('.invite-friend').addClass('showing');
    }

    $(document).on('click', '.show-invite-friend', function() {
        $('.hide-search').toggleClass('show-search hide-search');
        $(this).toggleClass('show-invite-friend hide-invite-friend')
        hideSearch();
        showInvite();
        showOverlay();
    });
    $(document).on('click', '.hide-invite-friend', function() {
        $(this).toggleClass('show-invite-friend hide-invite-friend');
        hideSearch();
        hideInvite();
        hideOverlay();
    });
    $(document).on('click','.show-search', function() {
        $('.hide-invite-friend').toggleClass('show-invite-friend hide-invite-friend');
        $(this).toggleClass('show-search hide-search');
        hideInvite();
        showSearch();
        showOverlay();
    })
    $(document).on('click','.hide-search', function() {
        $(this).toggleClass('show-search hide-search');
        hideInvite();
        hideSearch();
        hideOverlay();
    });

    $('.overlay').on('click', function() {
        $('.hide-invite-friend').toggleClass('show-invite-friend hide-invite-friend');
        $('.hide-search').toggleClass('show-search hide-search');
        hideOverlay();
        hideSearch();
        hideInvite();
    });


    $('.toggle-share-warning').on('click', function() {
        $('.dialog').fadeToggle();
    });


    $('.invite-friend').on('submit', function(e) {
        var $this = $(this);
        var $form = $(this).find('form');
        var $sender = $form.find('input[name=sender]').val();
        var $recipient = $form.find('input[name=friend_email]');
        var $button = $form.find('button');
        $button.text('SENDING');
        $.ajax({
            type: 'POST',
            url: '/refer',
            data: {
                _token: $('meta[name=_token]').attr('content'),
                sender: $sender,
                recipient: $recipient.val()
            },
            success: function(data) {
                $this.toggleClass('showing');
                hideOverlay();
                $recipient.val('');
                $button.text('SEND');
            }
        })
        e.preventDefault();
    });


    $('.search, .search-noresults').find('form').on('submit', function(e) {

        console.log('noresults');

        e.preventDefault();
        var query = $(this).find('input[name=query]').val();
        location.href = '/search/'+query;
    })



    $('.dialog').on('click', function() {
        $(this).fadeToggle();
    });
    $('.dismiss').on('click', function() {
        $('.dialog').fadeToggle();
    });

    $('.dialog .content').on('click', function(e) {
        e.stopPropagation();
    });

    $('input[name=recipe_tags]').on('blur', function() {
        $(this).val( $(this).val().split(' ') );
    });

    var lastid;

    $('button[name=share]').on('click', function() {

        tinyMCE.triggerSave();

        $.ajax({
            type: 'POST',
            url: $('form[name=share]').attr('action'),
            data: $('form[name=share]').serialize(),

            success: function(data) {
                lastid = data;
                myDropzone.processQueue();
                setTimeout(function() {
                        window.location.href = '/';
                }, 350);
            }
        });
    })


    var myDropzone = new Dropzone('div#myDropzone', {
        url: '/upload',
        autoProcessQueue: false,
        parallelUploads: 5,
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        init: function() {
            this.on('addedfile', function() {

                $('button[name=share]').attr('disabled', false);

            })

            this.on('sending', function(file, xhr, formData) {
                formData.append('media_recipeid', lastid);
                $('button[name=share]').text('Uploading Files...');
            });
            this.on('success', function(file) {
            })
            this.on('queuecomplete', function(file) {
                //$('form[name=share]').submit();
            });
            this.on('error', function(file) {});
        }
    });


    // $('button[name=share]').on('click', function(e) {
    //     myDropzone.processQueue();
    //     e.preventDefault();
    // })




})
