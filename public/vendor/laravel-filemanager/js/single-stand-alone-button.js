(function( $ ){

  $.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';

      var path_input = $(this).closest('.form-group').find($('.' + $(this).data('input')));
      var path_preview = $(this).closest('.form-group').find($('.' + $(this).data('preview')));

      window.open(route_prefix + '?type=' + type, 'FileManager', 'width=1800,height=600');

      window.SetUrl = function (items) {
        var file_path = items.map(function (item) {
          return item.url;
        }).join(',');

        // set the value of the desired input to image url
        path_input.val('').val(file_path).trigger('change');

        // clear previous preview
        path_preview.html('');

        // set or change the preview image src
        items.forEach(function (item) {
          path_preview.append(
            $('<img>').css('height', '5rem').attr('src', item.thumb_url)
          );
        });

        // trigger change event
        path_preview.trigger('change');
      };
      return false;
    });
  }

})(jQuery);
