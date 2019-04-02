$("#exam_state").prop("hidden", true);
$("label[for='exam_state']").remove()
let value = $("#author").text();
$("#exam_author").prop("value", value);