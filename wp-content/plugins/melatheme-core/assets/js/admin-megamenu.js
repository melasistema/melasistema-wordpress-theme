jQuery(document).ready(function($) {
    // Function to toggle visibility of CMB2 fields
    function toggleCmb2MegaMenuFields() {
        var $contentTypeSelect = $('#_melatheme_core_megamenu_content_type');
        var selectedContentType = $contentTypeSelect.val();

        var $imageField = $('.cmb2-id--melatheme-core-megamenu-image');
        var $textField = $('.cmb2-id--melatheme-core-megamenu-text-content');
        var $shortcodeField = $('.cmb2-id--melatheme-core-megamenu-shortcode');

        // Hide all fields initially
        $imageField.hide();
        $textField.hide();
        $shortcodeField.hide();

        // Show fields based on selected content type
        if (selectedContentType === 'wysiwyg') {
            $textField.show();
        } else if (selectedContentType === 'image') {
            $imageField.show();
            $textField.show();
        } else if (selectedContentType === 'shortcode') {
            $shortcodeField.show();
        }
    }

    // Run on page load
    toggleCmb2MegaMenuFields();

    // Run on change of the content type select field
    $(document).on('change', '#_melatheme_core_megamenu_content_type', toggleCmb2MegaMenuFields);
});
