define(["jquery-ui", "bootstrap", "timepicker", "jtable"], function ($, bootstrap, timepicker, jtable) {
    return {
        initialize : function _hour_reaction(type) {
            $('#hours-from-reaction-start-date').datepicker({
                timeFormat: "hh:mm tt"
            });

            $('#hours-from-reaction-end-date').datepicker({
                timeFormat: "hh:mm tt"
            });

            // bind autocomplete
            $( "#hours-from-reaction-type" ).autocomplete({
                source: base_url + "index.php/reaction/get_types",
                minLength: 1
            });

            $('#retrieve-hours-from-reaction-submit .download').click(function (e) {
                var startDate = $('#hours-from-reaction-start-date').val();
                startDate = startDate.replace(/\//g, '-');
                if (startDate == "") {
                    startDate = '01-01-1970';
                }

                var endDate = $('#hours-from-reaction-end-date').val();
                endDate = endDate.replace(/\//g, '-');
                if (endDate == "") {
                    endDate = '01-01-2020';
                }

                var gaps = $('#hours-from-reaction-gap').val();
                var scale = $('#hours-from-reaction-scale').val();
                var type = $('#hours-from-reaction-type').val();
                var min = $('#hours-from-reaction-min-eaten').val();
                var food = $('#hours-from-reaction-food-filter').val();
                var initial_hour = $('#hours-from-reaction-initial-hour').val();

                if (food == '')
                {
                    food = 'no-filter';
                }
                food = encodeURIComponent(food);


                var url = base_url + 'index.php/result/download_hours_from_reaction/' + gaps + '/' + scale + '/' + startDate + '/' + endDate + '/' + type + '/' + min + '/' + initial_hour + '/' + food + '/';
                window.open(url, '_blank');

            });

            $('#retrieve-hours-from-reaction-submit .send').click(function (e) {
                var startDate = $('#hours-from-reaction-start-date').val();
                startDate = startDate.replace(/\//g, '-');
                if (startDate == "") {
                    startDate = '01-01-1970';
                }

                var endDate = $('#hours-from-reaction-end-date').val();
                endDate = endDate.replace(/\//g, '-');
                if (endDate == "") {
                    endDate = '01-01-2020';
                }

                var gaps = $('#hours-from-reaction-gap').val();
                var scale = $('#hours-from-reaction-scale').val();
                var type = $('#hours-from-reaction-type').val();
                var min = $('#hours-from-reaction-min-eaten').val();
                var food = $('#hours-from-reaction-food-filter').val();
                var initial_hour = $('#hours-from-reaction-initial-hour').val();

                if (food == '')
                {
                    food = 'no-filter';
                }
                food = encodeURIComponent(food);


                var columns = {
                    FoodName:{key:true,title:"Food",create:false,edit:false},
                    NumOfFood:{key:false,title:"Times Eaten",create:false,edit:false}
                };

                // @todo correct this duplication of logic in both js and php
                var floor = Math.floor(100/((gaps*2)+2));
                var hour =  parseInt(initial_hour);
                for (var i=1;i<=gaps;i++) {
                    var h;
                    if (scale == 'quadratic') {
                        h = Math.pow(hour,2);
                    }
                    else if (scale == 'exponential') {
                        h = Math.pow(2,hour);
                    }
                    else {
                        h = hour;
                    }

                    columns["NumOf" + h +"Reactions"] = {key:false,title: "# " + h + " h",create:false,edit:false,width: floor + "%"};
                    columns["PercentOf" + h +"Reactions"] = {key:false,title: "% " + h + " h",create:false,edit:false,width: floor + "%"};

                    hour = hour + 1;
                }

                var grid = $('#hours-from-reaction-grid');

                // remove any previous jtable instance
                if (!grid.is(':empty')) {
                    grid.jtable('destroy');
                }


                // redefine the jtable
                grid.jtable({
                    title: 'Number of reaction after food by hour',
                    paging: true, //Enable paginghttp://192.168.1.10/sneezy/index.php/meal/
                    pageSize: 10, //Set page size (default: 10)
                    sorting: true, //Enable sorting
                    defaultSorting: 'NumOfFood DESC', //Set default sorting
                    gotoPageArea: 'none',

                    actions: {
                        listAction:   base_url + 'index.php/result/retrieve_hours_from_reaction/' + gaps + '/' + scale + '/' + startDate + '/' + endDate + '/' + type + '/' + min + '/' + initial_hour + '/' + food + '/',
                        deleteAction: '',
                        updateAction: '',
                        createAction: ''
                    },

                    fields: columns
                });

                // load the jtable
                grid.jtable('load');

            });
        }
    };
});