define(["jquery-ui"], function ($) {
    return {
        initialize : function _home_initialize() {
            var types = [
                'food',
                'medicine',
                'environment',
                'reaction'
            ];

            types.forEach(function(type) {
                $('#welcome-button-' + type).click(function (e) {
                    // this currently requires the bootstrap menu to open up on android
                    $('#nav-' + type).click();
                });
            });

            var links = [
                'disclaimer',
                'license',
                'our-story'
            ];

            links.forEach(function(link) {
                $('#' + link + '-home-link').click(function (e) {
                    $('#nav-' + link).click();
                });
            });

        }
    };
});