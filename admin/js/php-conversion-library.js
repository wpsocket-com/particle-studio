jQuery(document).ready(function() {
    var my_json_str = php_params.plugin_info.replace(/&quot;/g, '"');
    var my_php_arr = jQuery.parseJSON(my_json_str);
});