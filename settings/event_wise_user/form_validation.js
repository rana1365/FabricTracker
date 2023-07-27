

function Form_Validation_for_ewu()
{


    if(document.getElementById("user_id").value.trim()=="")
    {
        alert("Please Provide user_name");
        document.getElementById("user_id").focus();
        return false;
    }
    else if(document.getElementById("event_id").value.trim()=="")
    {
        alert("Please Provide event_name");
        document.getElementById("event_id").focus();
        return false;
    }


}
