/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
        config.language = 'vi';
	// config.uiColor = '#AADC6E';
        config.filebrowserBrowseUrl = '../../js/ckfinder/ckfinder.html';
        config.filebrowserImageBrowseUrl = '../../js/ckfinder/ckfinder.html?type=Images';
        config.filebrowserFlashBrowseUrl = '../../js/ckfinder/ckfinder.html?type=Flash';
        config.filebrowserUploadUrl = '../../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
        config.filebrowserImageUploadUrl = '../../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
        config.filebrowserFlashUploadUrl = '../../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
