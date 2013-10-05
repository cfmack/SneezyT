require.config({
    baseUrl: 'public',
    deps: ["main"],
    paths: {
        "jquery"        :   'lib/jquery-ui/js/jquery-1.9.1',
        "jquery-ui"     :   'lib/jquery-ui/js/jquery-ui-1.10.2.custom.min',
        "timepicker"    :   'lib/jquery-ui/js/jquery-ui-timepicker-addon',
        "jtable"        :   'lib/jtable/jquery.jtable.min',
        "fulltable"     :   'lib/fullcalendar/fullcalendar.min',
        "bootstrap"     :   "lib/bootstrap/js/bootstrap"
    },
    shim: {
        "jquery-ui": {
            exports: "$",
            deps: ['jquery']
        },
        "timepicker" : {
            deps: ['jquery', "jquery-ui"]
        },
        "jtable" : {
            deps: ['jquery', "jquery-ui"]
        },
        "fulltable" : {
            deps: ['jquery', "jquery-ui"]
        },
        "bootstrap": ['jquery']
    }
});
