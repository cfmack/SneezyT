define(["jquery-ui", "bootstrap"], function ($, bootstrap) {
    return {
        add : function _submit_add(type) {
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
        },

        merge : function _submit_merge() {
            var p = {};
            p['type-merge-from'] = $('#type-merge-from').val();
            p['type-merge-to'] = $('#type-merge-to').val();

            $('#merge-response').load(base_url + 'index.php/maintain/merge',p,function(str){
                setTimeout(function() {
                    $('#merge-response').empty();
                } ,1500);
            });

            $( '#type-merge-to').val('');
            $( '#type-merge-from').val('').focus();
        }
    };
});