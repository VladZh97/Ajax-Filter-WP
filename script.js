(function($) {
  $(document).ready(function() {
      $(document).on('click', '.category__link', function(e) {
          e.preventDefault();
          var category = $(this).data('category');

          $.ajax({
              url: my_ajax_object.ajax_url,
              data: {action: 'filter', category: category},
              type: 'post',
              success: function(result) {
                  $('.js-filter').html(result);
              },
              error: function(result) {
                  console.warn(result);
              }
          })
      })
  })
})(jQuery)