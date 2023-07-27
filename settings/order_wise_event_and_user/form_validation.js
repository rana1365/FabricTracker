function Form_Validation_for_oweau()
{
    if(document.getElementById("order_id").value.trim()=="")
    {
        alert("Please Provide order_id");
       var a = document.getElementById("order_id").focus();
       alert(a);
        return false;
    }
    if(document.getElementById("events_collab_id").value.trim()=="")
    {
        alert("Please Provide events_collab_id");
        document.getElementById("events_collab_id").focus();
        return false;
    }
    if(document.getElementById("event_wise_user_id").value.trim()=="")
    {
        alert("Please Provide event_wise_user_id");
        document.getElementById("event_wise_user_id").focus();
        return false;
    }
    if(document.getElementById("approval_date").value.trim()=="")
    {
        alert("Please Provide approval_date");
        document.getElementById("approval_date").focus();
        return false;
    }
    if(document.getElementById("plan_date").value.trim()=="")
    {
        alert("Please Provide plan_date");
        document.getElementById("plan_date").focus();
        return false;
    }
}

