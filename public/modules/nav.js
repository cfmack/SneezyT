/*
 Copyright (C) 2013-2014 Charles Mack

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>
 */

define(["jquery-ui", "bootstrap"], function ($, bootstrap) {
        return {
            initialize: function(that) {

                $('#nav-home').click(function (e) {
                    $('.nav li').removeClass('active');
                    $('.content-pane .content-category-container').addClass('hide');
                    $('#container-home').removeClass('hide');
                });


                $('#nav-logout-menu').click(function (e) {
                    window.location.replace(base_url + 'index.php/welcome/logout');
                });

                // run tab function once
                that.tab(that);

                // bind tab to body resize
                $( window ).resize(function() {
                    that.tab(that);
                });
            },

            /**
             * This can probably be moved to backbone or something similar.   To bind a click to a new tab, add it here
             * @param that
             *
             */
            bindTabs : function _bindTab(that) {
                var tabs = {
                    food : base_url + 'index.php/food/category',
                    reaction : base_url + 'index.php/reaction/category',
                    environment : base_url + 'index.php/environment/category',
                    treatment : base_url + 'index.php/treatment/category',
                    calendar : base_url + 'index.php/result/calendar',
                    'hours-from-reaction' :  base_url + 'index.php/result/hours_from_reaction',
                    'type-merge' : base_url + 'index.php/maintain/merge_type',
                    person : base_url + 'index.php/person',
                    'disclaimer' : base_url + 'index.php/welcome/disclaimer',
                    'feedback' : base_url + 'index.php/feedback/view',
                    'license' : base_url + 'index.php/welcome/license',
                    'our-story' : base_url + 'index.php/welcome/ourstory',
                    'person-change' : base_url + 'index.php/person/change'
                };

                // cycle through all tabs
                for (var key in tabs){
                    if (tabs.hasOwnProperty(key)) {
                        var d = {};
                        d.section = key;
                        d.uri = tabs[key];
                        $('#nav-' + d.section).click(d, that.show);
                    }
                }
            },

            /**
             * This is the primary function called when a tab is clicked
             *
             * @param event
             * @private
             */
            show : function _showTab(event) {
                $('.nav li').removeClass('active');
                $(this).closest('li').addClass('active');

                $('.content-pane .content-category-container').addClass('hide');
                $('#container-' + event.data.section).removeClass('hide');
                $('#container-' + event.data.section).html('<i class="fa fa-spinner fa-spin fa-2x"></i>'); // clear out to make sure it re-attaches to buttons
                $('#container-' + event.data.section).load(event.data.uri,{},function(str){});
                $('.navbar-inner .btn').click();
            },

            /**
             * Run all the tab logic and resize where appropriate based on screen size
             *
             * @param that
             * @private
             */
            tab : function _resizeTab(that) {

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

                            // Get the outer HTML.
                            var html = jqLastTabParent.prop('outerHTML');

                            // Remove the tab from 'More' Dropdown, which will remove any bound events as well
                            jqLastTabParent.remove();

                            // Add tab to header to the left of the 'More' dropdown
                            $('.navbar .primary').append(html);
                        }

                }

            // We need to rebind the Tab click handler.
            that.bindTabs(that);
        }

    }
});