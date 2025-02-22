(function($) {
  'use strict';

  if ($(".js-example-basic-single").length) {
    $(".js-example-basic-single").select2();
  }
  if ($(".selPasien").length) {
    $( "#selPasien" ).select2({
      ajax: { 
        url: "search",
        type: "get",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            search: params.term // search term
          };
        },
        processResults: function (response) {
          return {
            results: response
          };
        },
        cache: true
      }

    });
  }
  if ($(".js-example-basic-multiple").length) {
    $(".js-example-basic-multiple").select2();
  }
})(jQuery);