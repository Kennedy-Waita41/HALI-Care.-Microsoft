let ticket_display = document.getElementById("Ticket-number")
function newTicket(){
    

    makeRequest("../../../api/consultation/add.php",new FormData(), checkResult, false,false,true);
}

function checkResult(response){
    if(response.status != "OK"){
        showError(response.message);
        return;
    }
    showSuccess("You have a Consultation")
    let ticketObj = JSON.parse (response.message);
    ticket_display.innerHTML = `Your Ticket Number is `+ticketObj.ticket;

    //location.href = 'login.php'
}
