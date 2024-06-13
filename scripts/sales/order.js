function addOrder() {
    var chipId = document.getElementById("chip-id").value;
    var chipName = document.getElementById("chip-name").value;
    var customerName = document.getElementById("order-customer-name").value;
    var panNumber = document.getElementById("order-customer-pan-number").value;
    var quantity = document.getElementById("quantity").value;
    var date = document.getElementById("order-date").value;

    $.ajax({
        method: "GET",
        url: "./php/sales/add/add_order.php",
        data: {
            chipId: chipId,
            chipName: chipName,
            customerName: customerName,
            panNumber: panNumber,
            quantity: quantity,
            date: date
        },
        cache: false,
        success: function(result) {
            if (result === "Order Added!") {
                console.log(result);
                document.getElementById("update-order").style.display = 'none';
                document.getElementById("addOrderResult").innerHTML = result;
            } else {
                console.log(result);
                document.getElementById("addOrderResult").innerHTML = result;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function searchOrder() {
    var orderId = document.getElementById("search-order-update").value;
    $.ajax({
        method: "GET",
        url: "./php/sales/search/search_order.php",
        data: {
            orderId: orderId
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                if(result == "present"){
                    document.getElementById('cancel-and-finished-update-order-button').style.display = 'block';
                }else if(result == "Not In Activ Orders"){
                    document.getElementById('oUpdateResult').innerHTML = result;
                }
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updateOrder(button) {
    if (button === "finished") {
        var orderId = document.getElementById("search-order-update").value;
        var distributedDate = document.getElementById('date-order-update').value;
        $.ajax({
            method: "GET",
            url: "./php/sales/update/update_labour.php",
            data: {
                orderId: orderId,
                distributedDate: distributedDate
            },
            cache: false,
            success: function(result) {
                
                if (result === "Order Finished!") {
                    document.getElementById("cancel-and-finished-update-order-button").style.display = "none";
                    document.getElementById("oUpdateResult").innerHTML = result;
                } else {
                    document.getElementById("oUpdateResult").innerHTML = result;
                }
            }

        })
    } else if (button === "cancelled") {
        var orderId = document.getElementById("search-order-update").value;
        var cancelledDate = document.getElementById("date-order-update").value;
        $.ajax({
            method: "GET",
            url: "./php/sales/delete/delete_order.php",
            data: {
                orderId: orderId,
                cancelledDate: cancelledDate
            },
            cache: false,
            success: function(result) {
                if (result === "Order Cancelled!") {
                    document.getElementById("cancel-and-finished-update-order-button").style.display = "none";
                    document.getElementById("oUpdateResult").innerHTML = result;
                } else {
                    console.log(result)
                    document.getElementById("oUpdateResultNegative").innerHTML = result;
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        })
    }
}

function infoOrder() {
    var orderId = document.getElementById("orderid-search-order-info").value;
    //var email = document.getElementById("email-search-labour-info").value;
    $.ajax({
        method: "GET",
        url: "./php/sales/information/information_order.php",
        data: {
            orderId: orderId,
            //email: email
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            if(result == "Order Id not matched"){
                document.getElementById("infoResultNegative").innerHTML = result;
            }else{
                var details = JSON.parse(result);
                console.log(details.mark);
                if(details.mark == "order"){
                    document.getElementById("info-order-details").style.display = 'block';
                    document.getElementById("info-order-Id").innerHTML = details.orderId;
                    document.getElementById("info-order-chip-Id").innerHTML = details.chipId;
                    document.getElementById("info-order-chip-name").innerHTML = details.chipName;
                    document.getElementById("info-order-customer-name").innerHTML = details.customerName;
                    document.getElementById("info-order-pan-number").innerHTML = details.panNumber;
                    document.getElementById("info-order-quantity").innerHTML = details.quantity;
                    document.getElementById("info-order-date").innerHTML = details.date;
                }else if(details.mark == "distributed"){
                    document.getElementById("info-distribution-details").style.display = 'block';
                    document.getElementById("info-distribution-Id").innerHTML = details.distributionId;
                    document.getElementById("info-distribution-order-Id").innerHTML = details.orderId;
                    document.getElementById("info-distribution-chip-Id").innerHTML = details.chipId;
                    document.getElementById("info-distribution-chip-name").innerHTML = details.chipName;
                    document.getElementById("info-distribution-customer-name").innerHTML = details.customerName;
                    document.getElementById("info-distribution-pan-number").innerHTML = details.panNumber;
                    document.getElementById("info-distribution-quantity").innerHTML = details.quantity;
                    document.getElementById("info-distribution-order-date").innerHTML = details.date;
                    document.getElementById("info-distribution-date").innerHTML = details.distributionDate;
            }else if(details.mark == "cancelled"){
                document.getElementById("info-order-details").style.display = 'block';
                    document.getElementById("info-cancellation-order-Id").innerHTML = details.orderId;
                    document.getElementById("info-cancellation-chip-Id").innerHTML = details.chipId;
                    document.getElementById("info-cancellation-chip-name").innerHTML = details.chipName;
                    document.getElementById("info-cancellation-customer-name").innerHTML = details.customerName;
                    document.getElementById("info-cancellation-pan-number").innerHTML = details.panNumber;
                    document.getElementById("info-cancellation-quantity").innerHTML = details.quantity;
                    document.getElementById("info-cancellation-order-date").innerHTML = details.date;
                    document.getElementById("info-cancellation-Id").innerHTML = details.cancelledOrderId;
                    document.getElementById("info-cancellation-date").innerHTML = details.cancelledDate;
            }
            }
        }

    })
}