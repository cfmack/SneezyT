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
        add : function _submit_add(type) {
            var p = {};
            p[type] = $('#' + type + '-types').val();

            if (p[type]) {
                p[type + '-date'] = $('#' + type + '-date').val();

                if ($('#' + type + '-date-container').is(':visible')) {
                    p[type + '-date'] = $('#' + type + '-date').val();
                }
                else {
                    p[type + '-date'] = $('#' + type + '-date-wheel').val();
                }
                p[type + '-note'] = $('#' + type + '-note').val();
                p[type + '-amount'] = $('#' + type + '-amount').val();

                $('#' + type + '-response').load(base_url + 'index.php/' + type + '/insert',p,function(str){
                    setTimeout(function() {
                        $('#' + type + '-response').empty();
                    } ,4000);
                });

                $( '#' + type + '-note').val('');
                $( '#' + type + '-amount').val('');
                $( '#' + type + '-types').val('').focus();
            } else {

                $('#' + type + '-response').html('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>' +
                    '<span>Please add a ' +
                    type +
                    '</span></div>');

            }
        },

        download : function _submit_download(type, action) {
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

            if (action == 'download' ) {
                window.open(base_url + 'index.php/' + type + '/download/' + p[type + '-start'] + '/' + p[type + '-end'] + '/', '_blank');
            }
            else {
                $('#' + type + '-email-response').load(base_url + 'index.php/' + type + '/email/' + p[type + '-start'] + '/' + p[type + '-end'] + '/', p,function(str){
                    setTimeout(function() {
                        $('#' + type + '-email-response').empty();
                    } ,4000);
                });
            }
        },

        merge : function _submit_merge() {
            var p = {};
            p['type-merge-from'] = $('#type-merge-from').val();
            p['type-merge-to'] = $('#type-merge-to').val();

            $('#merge-response').load(base_url + 'index.php/maintain/merge',p,function(str){
                setTimeout(function() {
                    $('#merge-response').empty();
                } ,4000);
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

        feedback : function _submit_feedback() {
            var p = {};
            p['feedback'] = $('#feedback-comment').val();

            if (p['feedback']) {

                $('#feedback-response').load(base_url + 'index.php/feedback/submit',p,function(str){
                    setTimeout(function() {
                        $('#feedback-response').empty();
                    } ,4000);
                });

                $('#feedback-comment').val('');

            } else {

                $('#feedback-response').html('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>' +
                    '<span>Please add your feedback</span></div>');

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
                } ,4000);
            });
        }

    };
});