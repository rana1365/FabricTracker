

function Event_Form_Validation()
{


    if(document.getElementById("event_name").value.trim()=="")
    {
        alert("Please Provide Event Name");
        document.getElementById("event_name").focus();
        return false;
    }

}

