/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	config.language = 'es';
	//config.uiColor = '#AADC6E';
	config.toolbar = 'MyToolbar';
	config.resize_enabled = false;
	config.toolbarCanCollapse = false;
 
	config.toolbar_MyToolbar =
	[		
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		'/',
		{ name: 'styles', items : [ 'Format','Font','FontSize' ] },
		{ name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'document', items : [  ] },		
		{ name: 'forms', items : [  ] },
		{ name: 'colors', items : [  ] },
		{ name: 'tools', items : [  ] }
	];
};
