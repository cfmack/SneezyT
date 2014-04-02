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


define(["jquery-ui", "bootstrap", "modules/submit"], function _feedback_mod($, bootstrap, submit) {
        return {
            initialize : function _feedback_initialize() {
                // bind on click event to bootstrap button
                var jqResult = $('#feedback-submit button').click( function submit_onclick() {
                    submit.feedback();
                });
            }
        };
    }
);