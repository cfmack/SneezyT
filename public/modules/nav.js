define(["jquery-ui", "bootstrap"], function ($, bootstrap) {
        return {
            initialize: function() {
                var arr = ['food', 'reaction','environment','medicine'];

                var length = arr.length;
                var type = null;

                for (var i = 0; i < length; i++) {
                    type = arr[i];

                    $('#nav-' + type).click({type: type}, function (e) {
                        $('.nav li').removeClass('active');
                        $(this).closest('li').addClass('active');

                        $('.content-pane .content-category-container').addClass('hide');
                        $('.content-pane #container-' +  e.data.type).removeClass('hide');
                        $('.content-pane #container-' +  e.data.type).load(base_url + 'index.php/' +  e.data.type + '/category',{},function(str){});
                        $('.navbar-inner .btn').click();
                    });

                }

                $('#nav-timeline').click(function (e) {
                    $('.nav li').removeClass('active');
                    $(this).closest('li').addClass('active');

                    $('.content-pane .content-category-container').addClass('hide');
                    $('.content-pane #container-timeline').removeClass('hide');
                    $('.content-pane #container-timeline').load(base_url + 'index.php/result/timeline',{},function(str){});
                    $('.navbar-inner .btn').click();
                });

                $('#nav-hours-from-reaction').click(function (e) {
                    $('.nav li').removeClass('active');
                    $(this).closest('li').addClass('active');

                    $('.content-pane .content-category-container').addClass('hide');
                    $('.content-pane #container-hours-from-reaction').removeClass('hide');
                    $('.content-pane #container-hours-from-reaction').load(base_url + 'index.php/result/hours_from_reaction',{},function(str){});
                    $('.navbar-inner .btn').click();
                });

                $('#nav-type-merge').click(function (e) {
                    $('.nav li').removeClass('active');
                    $(this).closest('li').addClass('active');

                    $('.content-pane .content-category-container').addClass('hide');
                    $('.content-pane #container-type-merge').removeClass('hide');
                    $('.content-pane #container-type-merge').load(base_url + 'index.php/maintain/merge_type',{},function(str){});
                    $('.navbar-inner .btn').click();
                });

                $('#nav-person').click(function (e) {
                    $('.nav li').removeClass('active');
                    $(this).closest('li').addClass('active');

                    $('.content-pane .content-category-container').addClass('hide');
                    $('.content-pane #container-person').removeClass('hide');
                    $('.content-pane #container-person').load(base_url + 'index.php/person',{},function(str){});
                    $('.navbar-inner .btn').click();
                });

                $('#nav-logout').click(function (e) {
                    //window.location.replace(base_url + 'index.php/welcome/logout');
                });

                $('#nav-logout-menu').click(function (e) {
                    window.location.replace(base_url + 'index.php/welcome/logout');
                });
            }
        }
    }
);