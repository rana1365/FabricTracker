

function Edit_buyer_Form_Validation()
{
    if(document.getElementById("buyer_name").value.trim()=="")
    {
        alert("Please Provide buyer Name");
        document.getElementById("buyer_name").focus();
        return false;
    }
  


}
