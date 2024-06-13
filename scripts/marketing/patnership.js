

function addPatnership() {
    var chipId = document.getElementById("patnership-chip-Id").value;
    var chipName = document.getElementById("patnership-chip-name").value;
    var companyName = document.getElementById("patnership-company-name").value;
    var patnershipSector = document.getElementById("patnership-sector").value;
    var phoneNumber = document.getElementById("patnership-company-phone-number").value;
    var email = document.getElementById("patnership-email").value;
    var panNumber = document.getElementById("patnership-pan-number").value;
    var address = document.getElementById("patnership-company-address").value;

    $.ajax({
        method: "GET",
        url: "./php/marketing/add/add_patnership.php",
        data: {
            chipId: chipId,
            chipName: chipName,
            companyName: companyName,
            patnershipSector: patnershipSector,
            phoneNumber: phoneNumber,
            email: email,
            panNumber: panNumber,
            address: address
        },
        cache: false,
        success: function(result) {
            if (result === "Patnership Added!") {
                console.log(result);
                document.getElementById("add-patnership").style.display = 'none';
                document.getElementById("pUpdateResult").innerHTML = result;
            } else {
                console.log(result);
                document.getElementById("pUpdateResult").innerHTML = result;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function searchPatnership() {
    var patnershipId = document.getElementById("Id-search-patnership-update").value;
    $.ajax({
        method: "GET",
        url: "./php/marketing/search/search_patnership.php",
        data: {
            patnershipId: patnershipId
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                var details = JSON.parse(result);
                document.getElementById("update-details-patnership").style.display = 'block';
                document.getElementById("previous-patnership-Id").value = details.patnershipId;
                document.getElementById("previous-patnership-chip-Id").value = details.chipId;
                document.getElementById("previous-patnership-chip-name").value = details.chipName;
                document.getElementById("previous-patnership-sector").value = details.patnershipSector;
                document.getElementById("previous-patnership-company-name").value = details.companyName;
                document.getElementById("previous-patnership-company-phone-number").value = details.phoneNumber;
                document.getElementById("previous-patnership-email").value = details.email;
                document.getElementById("previous-patnership-pan-number").value = details.panNumber;
                document.getElementById("previous-patnership-company-address").value = details.address;

            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updatePatnership(button) {
    if (button === "updating") {
        var patnershipId = document.getElementById("previous-patnership-Id").value;
        var chipId = document.getElementById("previous-patnership-chip-Id").value;
        var chipName = document.getElementById("previous-patnership-chip-name").value;
        var companyName = document.getElementById("previous-patnership-company-name").value;
        var patnershipSector = document.getElementById("previous-patnership-sector").value;
        var phoneNumber = document.getElementById("previous-patnership-company-phone-number").value;
        var email = document.getElementById("previous-patnership-email").value;
        var panNumber = document.getElementById("previous-patnership-pan-number").value;
        var address = document.getElementById("previous-patnership-company-address").value;

        $.ajax({
            method: "GET",
            url: "./php/marketing/update/update_patnership.php",
            data: {
                patnershipId: patnershipId,
                chipId: chipId,
                chipName: chipName,
                companyName: companyName,
                patnershipSector: patnershipSector,
                phoneNumber: phoneNumber,
                email: email,
                panNumber: panNumber,
                address: address,
            },
            cache: false,
            success: function(result) {
                if (result === "Patnership Updated!") {
                    document.getElementById("update-details-patnership").style.display = "none";
                    document.getElementById("pUpdateResult").innerHTML = result;
                } else {
                    console.log(result);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        })
    } else if (button === "deleting") {
        var patnershipId = document.getElementById("Id-search-patnership-update").value;
        $.ajax({
            method: "GET",
            url: "./php/marketing/delete/delete_patnership.php",
            data: {
                patnershipId: patnershipId
            },
            cache: false,
            success: function(result) {
                document.getElementById("update-details-patnership").style.display = 'none';
                document.getElementById("pUpdateResult").innerHTML = result;
            }

        })
    }
}

function infoPatnership() {
    var chipName = document.getElementById("chip-name-search-patnership-info").value;
    var email = document.getElementById("comapny-email-search-patnership-info").value;
    //var stockedDate = document.getElementById("date-search-product-stock-info").value;
    //document.getElementById("info-rawmaterial-stock").style.display = 'block';
    $.ajax({
        method: "GET",
        url: "./php/marketing/information/information_patnership.php",
        data: {
            email: email,
            chipName: chipName,
            //stockedDate: stockedDate
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            var details = JSON.parse(result);
            document.getElementById("info-patnership-details").style.display = 'block';
            document.getElementById("info-patnership-Id").innerHTML = details.patnershipId;
            document.getElementById("info-patnership-chip-Id").innerHTML = details.chipId;
            document.getElementById("info-patnership-chip-name").innerHTML = details.chipName;
            document.getElementById("info-patnership-company-name").innerHTML = details.companyName;
            document.getElementById("info-patnership-sector").innerHTML = details.patnershipSector;
            document.getElementById("info-patnership-phone-number").innerHTML = details.phoneNumber;
            document.getElementById("info-patnership-company-email").innerHTML = details.email;
            document.getElementById("info-patnership-pan-number").innerHTML = details.panNumber;
            document.getElementById("info-patnership-company-address").innerHTML = details.address;
        }

    })
}



