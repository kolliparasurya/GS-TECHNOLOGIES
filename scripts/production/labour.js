function addLabour() {
    var labourName = document.getElementById("labour-name").value;
    var divsion = document.getElementById("labour-division").value;
    var phoneNumber = document.getElementById("labour-phone-number").value;
    var email = document.getElementById("labour-email").value;
    var address = document.getElementById("labour-address").value;

    $.ajax({
        method: "GET",
        url: "./php/production/add/add_labour.php",
        data: {
            chiplabourNameId: labourName,
            divsion: divsion,
            phoneNumber: phoneNumber,
            email: email,
            address: address,
        },
        cache: false,
        success: function(result) {
            if (result === "Labour Added!") {
                console.log(result);
                document.getElementById("addLabourResult").innerHTML = result;
            } else {
                console.log(result);
                document.getElementById("addLabourResult").innerHTML = result;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function searchLabour() {
    var labourId = document.getElementById("Id-search-labour-update").value;
    $.ajax({
        method: "GET",
        url: "./php/production/search/search_labour.php",
        data: {
            labourId: labourId
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                var details = JSON.parse(result);
                document.getElementById("update-details-labour").style.display = "block";
                document.getElementById("previous-labour-Id").value = details.labourId;
                document.getElementById("previous-labour-name").value = details.labourName;
                document.getElementById("previous-labour-division").value = details.division;
                document.getElementById("previous-labour-phone-number").value = details.phoneNumber;
                document.getElementById("previous-labour-email").value = details.email;
                document.getElementById("previous-labour-address").value = details.address;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updateLabour(button) {
    if (button === "updating") {
        var labourId = document.getElementById("previous-labour-Id").value;
        var labourName = document.getElementById("previous-labour-name").value;
        var division = document.getElementById("previous-labour-division").value;
        var phoneNumber = document.getElementById("previous-labour-phone-number").value;
        var email = document.getElementById("previous-labour-email").value;
        var address = document.getElementById("previous-labour-address").value;

        $.ajax({
            method: "GET",
            url: "./php/production/update/update_labour.php",
            data: {
                labourId: labourId,
                labourName: labourName,
                division: division,
                phoneNumber: phoneNumber,
                email: email,
                address: address,
            },
            cache: false,
            success: function(result) {
                if (result === "Labour Updated!") {
                    document.getElementById("update-details-labour").style.display = "none";
                    document.getElementById("lUpdateResultNegative").innerHTML = result;
                } else {
                    document.getElementById("lUpdateResult").innerHTML = result;
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        })
    } else if (button === "deleting") {
        var labourId = document.getElementById("previous-labour-Id").value;
        $.ajax({
            method: "GET",
            url: "./php/production/delete/delete_labour.php",
            data: {
                labourId: labourId
            },
            cache: false,
            success: function(result) {
                document.getElementById("update-details-labour").style.display = "none";
                document.getElementById("lUpdateResult").innerHTML = result;
            }

        })
    }
}

function infoLabour() {
    var email = document.getElementById("email-search-labour-info").value;
    //var email = document.getElementById("email-search-labour-info").value;
    $.ajax({
        method: "GET",
        url: "./php/production/information/information_labour.php",
        data: {
            email: email,
            //email: email
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            var details = JSON.parse(result);
            document.getElementById("info-labour-details").style.display = 'block';
            document.getElementById("info-labour-Id").innerHTML = details.labourId;
            document.getElementById("info-labour-name").innerHTML = details.labourName;
            document.getElementById("info-labour-division").innerHTML = details.division;
            document.getElementById("info-labour-phone-number").innerHTML = details.phoneNumber;
            document.getElementById("info-labour-email").innerHTML = details.email;
            document.getElementById("info-labour-address").innerHTML = details.address;
        }

    })
}