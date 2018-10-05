jQuery(document).ready(function($) {
  $(".repeater").repeater({
    initEmpty: false,

    defaultValues: {
      "text-input": ""
    },

    show: function() {
      $(this).slideDown();
    },

    hide: function(deleteElement) {
      if (confirm("Are you sure you want to delete this element?")) {
        $(this).slideUp(deleteElement);
      }
    },

    isFirstItemUndeletable: false
  });
});
