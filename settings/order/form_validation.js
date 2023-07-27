

function Department_Form_Validation()
{


    if(document.getElementById("order_id").value.trim()=="")
    {
        alert("Please Provide order_id");
        document.getElementById("order_id").focus();
        return false;
    }
    else if(document.getElementById("buyer_delivery_date").value.trim()=="")
    {
        alert("Please Provide buyer_delivery_date");
        document.getElementById("buyer_delivery_date").focus();
        return false;
    }
    else if(document.getElementById("buyer_delivery_slot").value.trim()=="")
    {
        alert("Please Provide buyer_delivery_slot");
        document.getElementById("buyer_delivery_slot").focus();
        return false;
    }
    else if(document.getElementById("buyer_id").value.trim()=="")
    {
        alert("Please Provide buyer_id");
        document.getElementById("buyer_id").focus();
        return false;
    }
    else if(document.getElementById("order_qty").value.trim()=="")
    {
        alert("Please Provide order_qty");
        document.getElementById("order_qty").focus();
        return false;
    }
    else if(document.getElementById("color").value.trim()=="")
    {
        alert("Please Provide color");
        document.getElementById("color").focus();
        return false;
    }


}

