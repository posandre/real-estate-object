jQuery(document).ready(function ($) {
    $('#options_source').on('change', function() {
        if (this.value === 'remote-site') {
            $('.current-site-options').addClass('hidden');
            $('.remote-site-options').removeClass('hidden');
        } else {
            $('.current-site-options').removeClass('hidden');
            $('.remote-site-options').addClass('hidden');
        }
    });
});