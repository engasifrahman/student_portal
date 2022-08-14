(function($) {
  'use strict';
  $(function() {
    $('#course-listing').DataTable({
      //searching: false,
      //ordering:  false,
      //info: false,
      //paginate: false});
      "columnDefs": [{ "orderable": false, "targets": 5 }];
    });
  });
})(jQuery);