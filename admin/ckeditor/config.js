/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	config.filebrowserBrowseUrl = 'http://localhost/jmw/proyek/baru/19-01-1-humas/admin/kcfinder/browse.php?opener=ckeditor&type=files';
	config.filebrowserUploadUrl = 'http://localhost/jmw/proyek/baru/19-01-1-humas/admin/kcfinder/upload.php?opener=ckeditor&type=files';
	config.filebrowserImageBrowseUrl = 'http://localhost/jmw/proyek/baru/19-01-1-humas/admin/kcfinder/browse.php?opener=ckeditor&type=images';
	config.filebrowserFlashBrowseUrl = 'http://localhost/jmw/proyek/baru/19-01-1-humas/admin/kcfinder/browse.php?opener=ckeditor&type=flash';
	config.filebrowserImageUploadUrl = 'http://localhost/jmw/proyek/baru/19-01-1-humas/admin/kcfinder/upload.php?opener=ckeditor&type=images';
	config.filebrowserFlashUploadUrl = 'http://localhost/jmw/proyek/baru/19-01-1-humas/admin/kcfinder/upload.php?opener=ckeditor&type=flash';
   
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	//config.extraPlugins = 'imageuploader';
	config.extraPlugins = 'dragresize';
	
	
	config.width = '100%';
	config.height = '700'; 
	
	
	config.contentsCss = 'ckeditor/customfonts/fonts.css';
	config.font_names = 'Philosopher/Philosopher;' + config.font_names;
	config.font_names = 'Advent Pro/Advent Pro;' + config.font_names;
	config.font_names = 'Mr De Haviland/Mr De Haviland;' + config.font_names;
	config.font_names = 'Overlock/Overlock;' + config.font_names;
};


