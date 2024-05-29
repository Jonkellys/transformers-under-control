$(document).ready(function(){
  $("#table").DataTable({
    "pagingType": "full_numbers",
    "lengtMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
  ],
    language: {
      search: "Search",
      searchPlaceholder: "",
      info: "Showing page _PAGE_ of _PAGES_",
      emptyTable: "No records found",
      infoEmpty: "No records found",
      infoFiltered: " - Result filtered of _MAX_ records",
      zeroRecords: "No matches found <br> (Try with other word)",
      lengthMenu: "",
      paginate: {
        first: "<i class='bx bx-chevrons-left bx-sm align-middle'></i>",
        last: "<i class='bx bx-chevrons-right bx-sm align-middle'></i>",
        next: "<i class='bx bx-chevron-right bx-sm align-middle'></i>",
        previous: "<i class='bx bx-chevron-left bx-sm align-middle'></i>",
      },
    }
  });

  $("#table1").DataTable({
    "pagingType": "full_numbers",
    "lengtMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
  ],
    language: {
      search: "Search",
      searchPlaceholder: "",
      info: "Showing page _PAGE_ of _PAGES_",
      emptyTable: "No records found",
      infoEmpty: "No records found",
      infoFiltered: " - Result filtered of _MAX_ records",
      zeroRecords: "No matches found <br> (Try with other word)",
      lengthMenu: "",
      paginate: {
        first: "<i class='bx bx-chevrons-left bx-sm align-middle'></i>",
        last: "<i class='bx bx-chevrons-right bx-sm align-middle'></i>",
        next: "<i class='bx bx-chevron-right bx-sm align-middle'></i>",
        previous: "<i class='bx bx-chevron-left bx-sm align-middle'></i>",
      },
    }
  });
});
