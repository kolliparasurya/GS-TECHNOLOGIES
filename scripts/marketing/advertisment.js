


function addAdvertisment() {
    var platformName = document.getElementById("advertisment-platform-name").value;
    var chipId = document.getElementById("advertisment-chip-Id").value;
    var chipName = document.getElementById("advertisment-chip-name").value;
    $.ajax({
        method: "GET",
        url: "./php/marketing/add/add_advertisment.php",
        data: {
            platformName: platformName,
            chipId: chipId,
            chipName: chipName
        },
        cache: false,
        success: function(result) {
            if (result === "Advertisment Added!") {
                console.log(result);
                document.getElementById("update-details-advertisment").style.display = 'none';
                document.getElementById("addAdvertismentResult").innerHTML = result;
            } else {
                console.log(result);
                document.getElementById("addAdvertismentResult").innerHTML = result;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function searchAdvertisment() {
    var advertismentId = document.getElementById("Id-search-advertisment-update").value;
    $.ajax({
        method: "GET",
        url: "./php/marketing/search/search_advertisment.php",
        data: {
            advertismentId: advertismentId
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                var details = JSON.parse(result);
                document.getElementById("update-details-advertisment").style.display = 'block';
                document.getElementById("previous-advertisment-Id").value = details.advertismentId;
                document.getElementById("previous-advertisment-platform-name").value = details.platformName;
                document.getElementById("previous-advertisment-chip-Id").value = details.chipId;
                document.getElementById("previous-advertisment-chip-name").value = details.chipName;

            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updateAdvertisment(button) {
    if (button === "updating") {
        var advertismentId = document.getElementById("previous-advertisment-Id").value;
        var platformName = document.getElementById("previous-advertisment-platform-name").value;
        var chipId = document.getElementById("previous-advertisment-chip-Id").value;
        var chipName = document.getElementById("previous-advertisment-chip-name").value;

        $.ajax({
            method: "GET",
            url: "./php/marketing/update/update_advertisment.php",
            data: {
                advertismentId: advertismentId,
                platformName: platformName,
                chipId: chipId,
                chipName: chipName,
            },
            cache: false,
            success: function(result) {
                if (result === "Advertisment Updated!") {
                    document.getElementById("update-details-advertisment").style.display = "none";
                    document.getElementById("aUpdateResult").innerHTML = result;
                } else {
                    document.getElementById("aUpdateResultNegative").innerHTML = result;
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        })
    } else if (button === "deleting") {
        var advertismentId = document.getElementById("Id-search-advertisment-update").value;
        $.ajax({
            method: "GET",
            url: "./php/marketing/delete/delete_advertisment.php",
            data: {
                advertismentId: advertismentId
            },
            cache: false,
            success: function(result) {
                document.getElementById("update-details-advertisment").style.display = 'none';
                document.getElementById("aUpdateResult").innerHTML = result;
            }

        })
    }
}

function infoAdvertisment() {
    var advertismentId = document.getElementById("Id-search-advertisment-info").value;
    //var stockedDate = document.getElementById("date-search-product-stock-info").value;
    //document.getElementById("info-rawmaterial-stock").style.display = 'block';
    console.log(advertismentId);
    $.ajax({
        method: "GET",
        url: "./php/marketing/information/information_advertisment.php",
        data: {
            advertismentId: advertismentId,
            //stockedDate: stockedDate
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            var details = JSON.parse(result);
            document.getElementById("info-advertisment-details").style.display = 'block';
            document.getElementById("info-advertisment-Id").innerHTML = details.advertismentId;
            document.getElementById("info-advertisment-platform-name").innerHTML = details.platformName;
            document.getElementById("info-advertisment-chip-Id").innerHTML = details.chipId;
            document.getElementById("info-advertisment-chip-name").innerHTML = details.chipName;
        }

    })
}