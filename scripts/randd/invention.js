




function addInvention() {
    var scientistId = document.getElementById("invention-scientist-id").value;
    var scientistName = document.getElementById("invention-scientist-name").value;
    var chipId = document.getElementById("invention-chip-Id").value;
    var chipName = document.getElementById("invention-chip-name").value;
    var date = document.getElementById("invention-date").value;
    var place = document.getElementById("invention-place").value;
    $.ajax({
        url: "./php/randd/add/add_invention.php",
        method: "GET",
        data: {
            scientistId: scientistId,
            scientistName: scientistName,
            chipId: chipId,
            chipName: chipName,
            date: date,
            place: place
        },
        cache: false,
        success: function(result) {
            if (result === "Invention Added!") {
                console.log(result);
                document.getElementById("add-invention").style.display = 'none';
                document.getElementById("addInventionResult").innerHTML = result;
            } else {
                console.log(result);
                document.getElementById("addInventionResult").innerHTML = result;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function searchInvention() {
    var inventionId = document.getElementById("search-invention-update").value;
    $.ajax({
        method: "GET",
        url: "./php/randd/search/search_invention.php",
        data: {
            inventionId: inventionId
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                var details = JSON.parse(result);
                document.getElementById("update-details-invention").style.display = 'block';
                document.getElementById("previous-invention-id").value = inventionId;
                document.getElementById("previous-invention-scientist-id").value = details.scientistId;
                document.getElementById("previous-invention-scientist-name").value = details.scientistName;
                document.getElementById("previous-invention-chip-Id").value = details.chipId;
                document.getElementById("previous-invention-chip-name").value = details.chipName;
                document.getElementById("previous-invention-date").value = details.date;
                document.getElementById("previous-invention-place").value = details.place;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updateInvention(button) {
    if (button === "updating") {
        var scientistId = document.getElementById("previous-scientist-id").value;
        var scientistName = document.getElementById("previous-scientist-name").value;
        var chipId = document.getElementById("previous-invention-chip-Id").value;
        var chipName = document.getElementById("previous-invention-chip-name").value;
        var date = document.getElementById("previous-invention-date").value;
        var place = document.getElementById("previous-invention-place").value;

        $.ajax({
            method: "GET",
            url: "./php/randd/update/update_invention.php",
            data: {
                scientistIds: scientistId,
                scientistNames: scientistName,
                chipId: chipId,
                chipName: chipName,
                date: date,
                place: place
            },
            cache: false,
            success: function(result) {
                if (result === "Invention Updated!") {
                    document.getElementById("update-details-invention").style.display = "none";
                    document.getElementById("iUpdateResult").innerHTML = result;
                } else {
                    document.getElementById("iUpdateResultNegative").innerHTML = result;
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        })
    } else if (button === "deleting") {
        var inventionId = document.getElementById("search-invention-update").value;
        $.ajax({
            method: "GET",
            url: "./php/randd/delete/delete_invention.php",
            data: {
                inventionId: inventionId
            },
            cache: false,
            success: function(result) {
                document.getElementById("update-details-invention").style.display = 'none';
                document.getElementById("iUpdateResult").innerHTML = result;
            }

        })
    }
}

function infoInvention() {
    var chipName = document.getElementById("chip-name-search-invention-info").value;
    var scientistId = document.getElementById("scientist-id-search-invention-info").value;
    //document.getElementById("info-rawmaterial-stock").style.display = 'block';
    $.ajax({
        method: "GET",
        url: "./php/randd/information/information_invention.php",
        data: {
            chipName: chipName,
            scientistId: scientistId
            //stockedDate: stockedDate
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            var details = JSON.parse(result);
            document.getElementById("info-invention-details").style.display = 'block';
            document.getElementById("info-invention-Id").innerHTML = details.inventionId;
            document.getElementById("info-invention-scientist-Id").innerHTML = details.scientistId;
            document.getElementById("info-invention-scientist-name").innerHTML = details.scientistName;
            document.getElementById("info-invention-chip-Id").innerHTML = details.chipId;
            document.getElementById("info-invention-chip-name").innerHTML = details.chipName;
            document.getElementById("info-invention-date").innerHTML = details.date;
            document.getElementById("info-invention-place").innerHTML = details.place;
        }

    })
}