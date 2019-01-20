$("#personnal_password").css("display", "none");
$("label[for='personnal_password']").remove();

if ($(".noselect").text() != "DATA_ADMIN")
{
	$("#personnal_email").prop("readonly", true);
	$("#personnal_role").css("display", "none");
	$("label[for='personnal_role']").remove();
	$("#personnal_specialization").css("display", "none");
	$("label[for='personnal_specialization']").remove();
	$("#personnal_hospitalNode").css("display", "none");
	$("label[for='personnal_hospitalNode']").remove();
}

if (!($(".noselect").text() in ["MEDECIN", "INFIRMIERE", "LABORATOIRE"]))
{
	$("#personnal_specialization").css("display", "none");
	$("label[for='personnal_specialization']").remove();
}
$("#personnal_hospitalNode").prepend($('<option>', {value:null, text:''}));