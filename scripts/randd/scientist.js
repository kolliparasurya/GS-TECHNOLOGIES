




function addScientist() {
    var name = document.getElementById("scientist-name").value;
    var phoneNumber = document.getElementById("scientist-phone-number").value;
    var email = document.getElementById("scientist-email").value;
    var degree = document.getElementById("scientist-degree").value;
    var address = document.getElementById("scientist-address").value;
    var DOB = document.getElementById("scientist-dob").value;
    $.ajax({
        url: "./php/randd/add/add_scientist.php",
        method: "GET",
        data: {
            name: name,
            phoneNumber: phoneNumber,
            email: email,
            degree: degree,
            address: address,
            DOB: DOB
        },
        cache: false,
        success: function(result) {
            if (result === "Scientist Added!") {
                console.log(result);
                document.getElementById("add-invention").style.display = 'none';
                document.getElementById("addScientistResult").innerHTML = result;
            } else {
                console.log(result);
                document.getElementById("addScientistResult").innerHTML = result;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function searchScientist() {
    var scientistId = document.getElementById("search-scientist-update").value;
    $.ajax({
        method: "GET",
        url: "./php/randd/search/search_scientist.php",
        data: {
            scientistId: scientistId
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                var details = JSON.parse(result);
                document.getElementById("update-scientist-details").style.display = 'block';
                document.getElementById("previous-scientist-Id").value = details.scientistId;
                document.getElementById("previous-scientist-name").value = details.name;
                document.getElementById("previous-scientist-phone-number").value = details.phoneNumber;
                document.getElementById("previous-scientist-email").value = details.email;
                document.getElementById("previous-scientist-degree").value = details.degree;
                document.getElementById("previous-scientist-address").value = details.address;
                document.getElementById("previous-scientist-dob").value = details.dob;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updateScientist(button) {
    if (button === "updating") {
        var scientistId = document.getElementById("previous-scientist-Id").value;
        var name = document.getElementById("previous-scientist-name").value;
        var phoneNumber = document.getElementById("previous-scientist-phone-number").value;
        var email = document.getElementById("previous-scientist-email").value;
        var degree = document.getElementById("previous-scientist-degree").value;
        var address = document.getElementById("previous-scientist-address").value;
        var dob = document.getElementById("previous-scientist-dob").value;

        $.ajax({
            method: "GET",
            url: "./php/randd/update/update_scientist.php",
            data: {
                scientistId: scientistId,
                name: name,
                phoneNumber: phoneNumber,
                email: email,
                degree: degree,
                address: address,
                dob: dob
            },
            cache: false,
            success: function(result) {
                if (result === "Scientist Updated!") {
                    document.getElementById("update-scientist-details").style.display = "none";
                    document.getElementById("sUpdateResult").innerHTML = result;
                } else {
                    document.getElementById("sUpdateResultNegative").innerHTML = result;
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        })
    } else if (button === "deleting") {
        var scientistId = document.getElementById("search-scientist-update").value;
        $.ajax({
            method: "GET",
            url: "./php/randd/delete/delete_scientist.php",
            data: {
                scientistId: scientistId
            },
            cache: false,
            success: function(result) {
                document.getElementById("update-scientist-details").style.display = 'none';
                document.getElementById("sUpdateResult").innerHTML = result;
            }

        })
    }
}

function infoScientist() {
    var email = document.getElementById("email-search-scientist-info").value;
    //document.getElementById("info-rawmaterial-stock").style.display = 'block';
    $.ajax({
        method: "GET",
        url: "./php/randd/information/information_scientist.php",
        data: {
            email: email,
            //stockedDate: stockedDate
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            var details = JSON.parse(result);
            document.getElementById("info-scientist-details").style.display = 'block';
            document.getElementById("info-scientist-Id").innerHTML = details.scientistId;
            document.getElementById("info-scientist-name").innerHTML = details.name;
            document.getElementById("info-scientist-email").innerHTML = details.email;
            document.getElementById("info-scientist-degree").innerHTML = details.degree;
            document.getElementById("info-scientist-address").innerHTML = details.address;
            document.getElementById("info-scientist-dob").innerHTML = details.dob;
            document.getElementById("info-scientist-phone-number").innerHTML = details.phoneNumber;
        }

    })
}