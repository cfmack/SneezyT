define(["jquery-ui", "bootstrap", "jtable", "modules/submit"], function _person_mod($, bootstrap, jtable, submit) {
        return {
            add : function _person_add() {
                // bind on click event to bootstrap button
                var jqResult = $('#add-person-submit button').click( function add_onclick() {
                    submit.person();
                });
            },

            change : function _person_change() {
                var jqResult = $('#change-person-submit button').click( function change_onclick() {
                    submit.change_person();
                });
            },

            inventory : function _person_inventory(columns) {

                $('#person-grid').jtable({
                    title: 'People',
                    paging: true, //Enable paginghttp://192.168.1.10/sneezy/index.php/meal/
                    pageSize: 10, //Set page size (default: 10)
                    sorting: true, //Enable sorting
                    defaultSorting: 'Person DESC', //Set default sorting
                    gotoPageArea: 'none',

                    //MealId as meal_id, MealDate as meal_date, FoodName as food_name
                    actions: {
                        listAction: 	base_url + 'index.php/person/inventory/',
                        deleteAction: 	base_url + 'index.php/person/delete/',
                        updateAction: 	base_url + 'index.php/person/update/',
                        createAction:   ''
                    },

                    fields: {
                        PersonId: {
                            key: true,
                            create: false,
                            edit: false,
                            list: false
                        },
                        PersonName: {
                            title: 'Name'
                        },
                        PersonNote: {
                            title: 'Note'
                        },
                        IsDefault: {
                            title: 'IsDefault'
                        }
                    }
                });

                $('#person-grid').jtable('load');
            }
        };
    }
);