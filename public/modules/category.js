define(["jquery-ui", "bootstrap", "timepicker", "jtable", "modules/submit"], function ($, bootstrap, timepicker, jtable, submit) {
        return {
            initialize : function _category_initialize(type) {
                $('#container-' + type + ' .category-button').click({cat: type}, function (e) {

                    // how the one that contains the role of this button
                    var key = $(this).data('role');

                    // hide all panes
                    $('#container-' + e.data.cat + ' .content-pane-container').addClass('hide');

                    $('#container-' + e.data.cat + ' .container-pane-' + key).removeClass('hide');



                    // only per click should we load the jtable
                    if (key == 'inventory') {
                        $('#' + e.data.cat + '-grid').jtable('load');
                    }

                });
            },
            add : function _category_add(type) {
                // date picker
                if (window.screen.availWidth > 960) {
                    var jqDate = $('#' + type +'-date').datetimepicker({
                        timeFormat: "hh:mm tt"
                    });

                    jqDate.datetimepicker('setDate', (new Date()));
                }

                // bind on click event to bootstrap button
                var jqResult = $('#add-' + type + '-submit button').click( function add_onclick() {
                    submit.add(type);
                });

                // bind autocomplete
                $( "#" + type + "-types" ).autocomplete({
                    source: base_url + "index.php/" + type + "/get_types",
                    minLength: 1
                });

            },
            download : function _category_download(type) {

                // date picker
                if (window.screen.availWidth > 960) {
                    var startDate = $('#' + type +'-download-start').datepicker({
                        timeFormat: "hh:mm tt"
                    });

                    var today = new Date();
                    var lastWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 7);

                    startDate.datepicker('setDate', (lastWeek));
                }

                // date picker
                if (window.screen.availWidth > 960) {
                    var endDate = $('#' + type +'-download-end').datepicker({
                        timeFormat: "hh:mm tt"
                    });

                    endDate.datepicker('setDate', (new Date()));
                }

                // bind on click event to bootstrap button
                var jqResult = $('#category-download-' + type + '-submit button').click( function category_download_onclick() {
                    submit.download(type);
                });
            },
            inventory : function _category_inventory(type, columns) {

                var cap = type.toLowerCase();
                cap = cap.charAt(0).toUpperCase() + cap.substring(1);

                $('#' + type + '-grid').jtable({
                    title: cap + ' Inventory',
                    paging: true, //Enable paginghttp://192.168.1.10/sneezy/index.php/meal/
                    pageSize: 10, //Set page size (default: 10)
                    sorting: true, //Enable sorting
                    defaultSorting: type + 'Date DESC', //Set default sorting
                    gotoPageArea: 'none',

                    //MealId as meal_id, MealDate as meal_date, FoodName as food_name
                    actions: {
                        listAction: 	base_url + 'index.php/' + type + '/retrieve_inventory/',
                        deleteAction: 	base_url + 'index.php/' + type + '/delete/',
                        updateAction: 	base_url + 'index.php/' + type + '/update/',
                        createAction:   ''
                    },

                    fields: columns

                });
            },
            merge : function _category_merge() {
                $( "#type-merge-from" ).autocomplete({
                    source: base_url + "index.php/food/get_types",
                    minLength: 1
                });

                $( "#type-merge-to" ).autocomplete({
                    source: base_url + "index.php/food/get_types",
                    minLength: 1
                });

                $("#type-merge-submit button").click( function() {
                    submit.merge();
                });
            }
        };
    }
);