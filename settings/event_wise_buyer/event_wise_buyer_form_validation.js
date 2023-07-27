

function Event_wise_buyer_Form_Validation()
{


    if(document.getElementById("days").value.trim()=="")
    {
        alert("Please Provide Required Days");
        document.getElementById("days").focus();
        return false;
    }
    else if(document.getElementById("buyer_id").value.trim()=="")
    {
        alert("Please Select Buyer Name");
        document.getElementById("buyer_id").focus();
        return false;
    }
    else if(document.getElementById("event_id").value=="select")
    {
        alert("Please Select Event Name");
        document.getElementById("event_id").focus();
        return false;
    }


}

