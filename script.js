update = document.getElementsByClassName("update");

Array.from(update).forEach((element) => {
  element.addEventListener("click", (edit) => {
    tr = edit.target.parentNode.parentNode;
    title = tr.getElementsByTagName("td")[0].innerText;
    description = tr.getElementsByTagName("td")[1].innerText;
    // console.log(title, description);
    update_Task_Title.value = title;
    update_Task_Description.value = description;
    useridupdate.value = edit.target.id;
    // console.log("Its wokring ", edit.target.id);
    $("#updateModal").modal("toggle");
  });
});

Delete = document.getElementsByClassName("delete");

Array.from(Delete).forEach((myelement) => {

  myelement.addEventListener("click" , (del) =>{

    delete_task_id.value = del.target.id;


    $("#deleteModal").modal("toggle");
  });

});


$(document).ready(function(){
  $("#floatingInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#task_table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});