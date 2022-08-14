(function($) {
  'use strict';
  $(function() {
    $('#course-listing').DataTable({
      //searching: false,
      //ordering:  false,
      //info: false,
      //paginate: false});
      "columnDefs": [{ "orderable": false, "targets": 6 }]
    });
    $('#section-listing').DataTable({
      //searching: false,
      //ordering:  false,
      //info: false,
      //paginate: false});
      "columnDefs": [{ "orderable": false, "targets": 3 }]
    });
    $('#semester-listing').DataTable({
      //searching: false,
      //ordering:  false,
      //info: false,
      //paginate: false});
      "columnDefs": [{ "orderable": false, "targets": 5 }]
    });
    $('#faculty-listing').DataTable({
      //searching: false,
      //ordering:  false,
      //info: false,
      //paginate: false});
      "columnDefs": [{ "orderable": false, "targets": 5 }]
    });
    $('#department-listing').DataTable({
      //searching: false,
      //ordering:  false,
      //info: false,
      //paginate: false});
      "columnDefs": [{ "orderable": false, "targets": 6 }]
    });
    $('#deptcourse-listing').DataTable({
      //searching: false,
      //ordering:  false,
      //info: false,
      //paginate: false});
      "columnDefs": [{ "orderable": false, "targets": 4 }]
    });
    $('#userreg-listing').DataTable({
      //searching: false,
      //ordering:  false,
      //info: false,
      //paginate: false});
      "columnDefs": [
        { "orderable": false, "targets": 1 },
        { "orderable": false, "targets": 7 }
      ]
    });
    $('#coursereg-listing').DataTable({
      //searching: false,
      //ordering:  false,
      //info: false,
      //paginate: false});
      "columnDefs": [
        { "orderable": false, "targets": 6 }
      ]
    });
    $('#tutionfee-listing').DataTable({
      //searching: false,
      //ordering:  false,
      //info: false,
      //paginate: false});
      "columnDefs": [
        { "orderable": false, "targets": 7 }
      ]
    });
    $('#paymentledger-listing').DataTable({
      //searching: false,
      //ordering:  false,
      //info: false,
      //paginate: false});
    });
  });
})(jQuery);