define(["jquery-ui", "bootstrap", "timepicker"], function ($, bootstrap, timepicker) {
    return {
        send : function _add_submit(type) {
            var p = {};
            p[type] = $('#' + type + '-types').val();
            p[type + '-date'] = $('#' + type + '-date').val();
            if ($('#' + type + '-date-container').is(':visible')) {
                p[type + '-date'] = $('#' + type + '-date').val();
            }
            else {
                p[type + '-date'] = $('#' + type + '-date-wheel').val();
            }
            p[type + '-note'] = $('#' + type + '-note').val();

            $('#' + type + '-response').load(base_url + 'index.php/' + type + '/insert',p,function(str){
                setTimeout(function() {
                    $('#' + type + '-response').empty();
                } ,1500);
            });

            $( '#' + type + '-note').val('');
            $( '#' + type + '-types').val('').focus();
        }
    };
});