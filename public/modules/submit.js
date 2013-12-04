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

        download : function _submit_download(type) {
            var p = {};

            if ($('#' + type + '-download-start-container').is(':visible')) {
                p[type + '-start'] = $('#' + type + '-download-start').val();
            }
            else {
                p[type + '-start'] = $('#' + type + '-download-start-wheel').val();
            }

            if ($('#' + type + '-download-end-container').is(':visible')) {
                p[type + '-end'] = $('#' + type + '-download-end').val();
            }
            else {
                p[type + '-end'] = $('#' + type + '-download-end-wheel').val();
            }

            p[type + '-start'] = p[type + '-start'].replace(/\//g, '-');
            p[type + '-end'] = p[type + '-end'].replace(/\//g, '-');

            window.open(base_url + 'index.php/' + type + '/download/' + p[type + '-start'] + '/' + p[type + '-end'] + '/', '_blank');

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
        },

        person : function _submit_person() {
            var p = {};
            p['name'] = $('#person-name').val();
            if (p['name'].trim() != '')
            {

                p['default'] = 'false';
                if ($('#person-default').is(':checked')) {
                    p['default'] = 'true';
                }
                p['note'] = $('#person-note').val();

                $.post( base_url + 'index.php/person/add', p ).done(function( data ) {
                    $('#person-grid').jtable('load');
                 });

                $( '#person-note').val('');
                $( '#person-name').val('').focus();
            }
            else
            {
                alert('You must add a name');
            }
        },

        change_person : function _submit_change_person() {
            var p = {};

            p['PersonId'] = $('input[name=persons]:checked', '#person-change-form').val()
            p['PersonName'] = $('input[name=persons]:checked', '#person-change-form').next().text();

            $('#person-change-response').load(base_url +  'index.php/person/do_change',p,function(str){
                $('#current-person-notification').text(p['PersonName']);

                setTimeout(function() {
                    $('#person-change-response').empty();
                } ,1500);
            });
        }

    };
});