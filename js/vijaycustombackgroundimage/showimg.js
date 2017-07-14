jQuery.noConflict();
jQuery(document).ready(function() {
    jQuery(".openbgimg").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : false,
        width       : '100%',
        height      : '100%',
        autoSize    : false,
        autoCenter	: true,
        closeClick  : true,
        openEffect  : 'elastic',
        closeEffect : 'elastic'
    });
});
