function addCustomer() {
    var customerName = document.getElementById("customer-name").value;
    var address = document.getElementById("customer-address").value;
    var phoneNumber = document.getElementById("customer-phone-number").value;
    var email = document.getElementById("customer-email").value;
    var panNumber = document.getElementById("customer-pan-number").value;
    $.ajax({
        method: "GET",
        url: "./php/sales/add/add_customer.php",
        data: {
            customerName: customerName,
            address: address,
            phoneNumber: phoneNumber,
            email: email,
            panNumber: panNumber,
        },
        cache: false,
        success: function(result) {
            if (result === "Customer Added!") {
                console.log(result);
                document.getElementById("add-customer").style.display = 'none';
                document.getElementById("addCustomerResult").innerHTML = result;
            } else {
                console.log(result);
                document.getElementById("addCustomerResult").innerHTML = result;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function searchCustomer() {
    var email = document.getElementById("email-search-customer-update").value;
    $.ajax({
        method: "GET",
        url: "./php/sales/search/search_customer.php",
        data: {
            email: email
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                var details = JSON.parse(result);
                document.getElementById("update-customer-details").style.display = 'block';
                document.getElementById("previous-customer-name").value = details.customerName;
                document.getElementById("previous-customer-address").value = details.address;
                document.getElementById("previous-customer-phone-number").value = details.phoneNumber;
                document.getElementById("previous-customer-email").value = details.email;
                document.getElementById("previous-customer-pan-number").value = details.panNumber;

            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updateCustomer(button) {
    if (button === "updating") {
        var customerName = document.getElementById("previous-customer-name").value;
        var address = document.getElementById("previous-customer-address").value;
        var phoneNumber = document.getElementById("previous-customer-phone-number").value;
        var email = document.getElementById("previous-customer-email").value;
        var panNumber = document.getElementById("previous-customer-pan-number").value;

        $.ajax({
            method: "GET",
            url: "./php/sales/update/update_customer.php",
            data: {
                customerName: customerName,
                address: address,
                phoneNumber: phoneNumber,
                email: email,
                panNumber: panNumber,
            },
            cache: false,
            success: function(result) {
                if (result === "Customer Updated!") {
                    document.getElementById("update-customer-details").style.display = "none";
                    document.getElementById("cUpdateResult").innerHTML = result;
                } else {
                    document.getElementById("cUpdateResultNegative").innerHTML = result;
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        })
    } else if (button === "deleting") {
        var email = document.getElementById("email-search-customer-update").value;
        $.ajax({
            method: "GET",
            url: "./php/sales/delete/delete_customer.php",
            data: {
                email: email
            },
            cache: false,
            success: function(result) {
                document.getElementById("update-customer-details").style.display = 'none';
                document.getElementById("cUpdateResult").innerHTML = result;
            }

        })
    }
}

function infoCustomer() {
    var email = document.getElementById("email-search-customer-info").value;
    //var stockedDate = document.getElementById("date-search-product-stock-info").value;
    //document.getElementById("info-rawmaterial-stock").style.display = 'block';
    $.ajax({
        method: "GET",
        url: "./php/sales/information/information_customer.php",
        data: {
            email: email,
            //stockedDate: stockedDate
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            var details = JSON.parse(result);
            document.getElementById("info-customer-details").style.display = 'block';
            document.getElementById("info-customer-name").innerHTML = details.customerName;
            document.getElementById("info-customer-address").innerHTML = details.address;
            document.getElementById("info-customer-phone-number").innerHTML = details.phoneNumber;
            document.getElementById("info-customer-email").innerHTML = details.email;
            document.getElementById("info-customer-pan-number").innerHTML = details.panNumber;
        }

    })
}