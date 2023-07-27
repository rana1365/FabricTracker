

function Buyer_Form_Validation_Buyer()
{
	if(document.getElementById("buyer_name").value.trim()=="")
	{
		alert("Please Provide buyer Name");
		document.getElementById("buyer_name").focus();
		return false;
	}

}
