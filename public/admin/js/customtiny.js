var editor_LTR = {
	path_absolute : "/",
	selector: "textarea.ltrEditor",
	plugins: [
		"advlist autolink lists link image charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen",
		"insertdatetime media nonbreaking save table contextmenu directionality",
		"emoticons template paste textcolor colorpicker textpattern",
		"advlist directionality autolink autosave link image lists charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"table contextmenu textcolor paste textcolor"
	],
	toolbar: "insertfile undo redo | styleselect | fontselect | fontsizeselect | forecolor | backcolor| bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | rtl | ltr ",
	content_css: ['//fonts.googleapis.com/css?family=Indie+Flower'],
  font_formats: 'Arial Black=arial black,avant garde;Indie Flower=indie flower, cursive;Times New Roman=times new roman,times;',
	relative_urls: false,
	file_browser_callback : function(field_name, url, type, win) {
		var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
		var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

		var cmsURL = editor_LTR.path_absolute + 'filemanager?field_name=' + field_name;
		if (type == 'image') {
			cmsURL = cmsURL + "&type=Images";
		} else {
			cmsURL = cmsURL + "&type=Files";
		}

		tinyMCE.activeEditor.windowManager.open({
			file : cmsURL,
			title : 'Filemanager',
			width : x * 0.8,
			height : y * 0.8,
			resizable : "yes",
			close_previous : "no"
		});
	}
};

var editor_RTL = {
	path_absolute : "/",
	selector: "textarea.rtlEditor",
	directionality: "rtl",
	plugins: [
		"advlist autolink lists link image charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen",
		"insertdatetime media nonbreaking save table contextmenu directionality",
		"emoticons template paste textcolor colorpicker textpattern",
		"advlist directionality autolink autosave link image lists charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"table contextmenu textcolor paste textcolor"
	],
	toolbar: "insertfile undo redo | styleselect | fontselect | fontsizeselect | forecolor | backcolor| bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | rtl | ltr ",
	relative_urls: false,
	content_css: ['//fonts.googleapis.com/css?family=Indie+Flower'],
  font_formats: 'Arial Black=arial black,avant garde;Indie Flower=indie flower, cursive;Times New Roman=times new roman,times;',
	file_browser_callback : function(field_name, url, type, win) {
		var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
		var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

		var cmsURL = editor_RTL.path_absolute + 'filemanager?field_name=' + field_name;
		if (type == 'image') {
			cmsURL = cmsURL + "&type=Images";
		} else {
			cmsURL = cmsURL + "&type=Files";
		}

		tinyMCE.activeEditor.windowManager.open({
			file : cmsURL,
			title : 'Filemanager',
			width : x * 0.8,
			height : y * 0.8,
			resizable : "yes",
			close_previous : "no"
		});
	}
};

tinymce.init(editor_LTR);
tinymce.init(editor_RTL);
