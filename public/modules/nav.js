define(["jquery-ui", "bootstrap"], function ($, bootstrap) {
        return {
            initialize: function(that) {
                var arr = ['food', 'reaction','environment','medicine'];

                var length = arr.length;
                var type = null;

                for (var i = 0; i < length; i++) {
                    type = arr[i];

                    $('#nav-' + type).click({cat: type}, function (e) {
                        $('.nav li').removeClass('active');
                        $(this).closest('li').addClass('active');

                        $('.content-pane .content-category-container').addClass('hide');
                        $('.content-pane #container-' +  e.data.cat).removeClass('hide');
                        $('.content-pane #container-' +  e.data.cat).html('<i class="fa fa-spinner fa-spin fa-2x"></i>'); // clear out to make sure it re-attaches to buttons
                        $('.content-pane #container-' +  e.data.cat).load(base_url + 'index.php/' +  e.data.cat + '/category',{},function( response, status, xhr ) {
                            if ( status == "error" ) {
                                var msg = "Sorry but there was an error: ";
                                console.log( msg + xhr.status + " " + xhr.statusText );
                            }
                        });
                        $('.navbar-inner .btn').click();
                    });

                }

                /*
                    Does not quite work yet as it does not work after navigating to a category
                    I think it has something to do with the "brand" class
                 */
                $('#nav-home').click(function (e) {
                    console.log('clicked home');
                    $('.nav li').removeClass('active');
                    $('.content-pane .content-category-container').addClass('hide');
                    $('#container-home').removeClass('hide');
                });

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

                $('#nav-calendar').click(function (e) {
                    $('.nav li').removeClass('active');
                    $(this).closest('li').addClass('active');

                    $('.content-pane .content-category-container').addClass('hide');
                    $('.content-pane #container-calendar').removeClass('hide');
                    $('.content-pane #container-calendar').load(base_url + 'index.php/result/calendar',{},function(str){});
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

                $('#nav-person-change').click(function (e) {
                    $('.nav li').removeClass('active');
                    $(this).closest('li').addClass('active');

                    $('.content-pane .content-category-container').addClass('hide');
                    $('.content-pane #container-person-change').removeClass('hide');
                    $('.content-pane #container-person-change').load(base_url + 'index.php/person/change',{},function(str){});
                    $('.navbar-inner .btn').click();
                });


                $('#nav-logout-menu').click(function (e) {
                    window.location.replace(base_url + 'index.php/welcome/logout');
                });

                // run tab function once
                that.tab();

                // bind tab to body resize
                $( window ).resize(function() {
                    that.tab();
                });
            },

            tab : function _resizeTab() {
                //alert('resize');


                    // We only want to resize if we have a More menu.
                if ($('.secondary .dropdown-menu').find('a').size() > 0) {

                        // Establish pseudo constants for resizing thresholds
                        var WRAP_THRESHOLD = 450;
                        var MIN_NUM_TABS = 0;
                        var MAX_NUM_TABS = 4;

                        /*
                         * This loop removes tabs from the Header and places them in the More dropdown
                         * until we're at an width under the accepted threshold.
                         */
                        var counter = 0;
                        while (($(window).width() - $('.navbar .primary').width()) < WRAP_THRESHOLD && $('.navbar .primary-tab').size() > MIN_NUM_TABS ) {

                            if (counter >= 10)
                            {
                                break;
                            }

                            counter += 1;

                            // gather the tab elements
                            var jsPrimaryTab = $('.navbar .primary-tab');

                            var primaryCount = jsPrimaryTab.size();
                            var jqLastTab = jsPrimaryTab.eq(primaryCount - 1);
                            var jqLastTabParent = jqLastTab.closest('li');

                            // Apply the correct style
                            jqLastTab.toggleClass('primary-tab secondary-tab');

                            /*
                            if (jqLastTabParent.hasClass('active')) {
                                $('#navbar-more').text(jqLastTab.text());
                                $('li.dropdown').addClass('active');
                            }
                            */

                            // Get the outer HTML.
                            var html = jqLastTabParent.prop('outerHTML');

                            // Remove the tab from Header
                            jqLastTabParent.remove();

                            // Place the removed tab in the 'More' Dropdown
                            $('.secondary .dropdown-menu').prepend(html);

                        }

                        /*
                         * This loop removes tabs from the More dropdown and places them in the Header
                         * until we're at an width close to, but not over the accepted threshold.
                         */

                        counter = 0;

                        while ((($(window).width() - $('.navbar .primary').width()) >= WRAP_THRESHOLD) && ($('.navbar .secondary-tab').size() > MIN_NUM_TABS) && $('.navbar .primary-tab').size() < MAX_NUM_TABS) {

                            if (counter >= 10)
                            {
                                break;
                            }

                            counter += 1;

                            // gather the tab elements
                            var jsSecondaryTab = $('.navbar .secondary-tab');
                            var secondaryCount = jsSecondaryTab.size();
                            var jqLastTab = jsSecondaryTab.eq(0);
                            var jqLastTabParent = jqLastTab.closest('li');

                            // Apply the correct style
                            jqLastTab.toggleClass('primary-tab secondary-tab');

                            /*
                            if (jqLastTab.text() === $('#navbar-more').text()) {
                                $('#navbar-more').text('More');
                                $('li.dropdown.active').removeClass('active');
                                jqLastTabParent.addClass('active');
                            }
                            */

                            // Get the outer HTML.
                            var html = jqLastTabParent.prop('outerHTML');

                            // Remove the tab from 'More' Dropdown, which will remove any bound events as well

                            // this is jacked
                            jqLastTabParent.remove();

                            // Add tab to header to the left of the 'More' dropdown
                            $('.navbar .primary').append(html);
                        }

                }

            // We need to rebind the Tab click handler.
        }

    }
});