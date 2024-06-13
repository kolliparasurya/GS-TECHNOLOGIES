function addMachinery() {
    var machineryName = document.getElementById("machinery-name").value;
    var use = document.getElementById("machinery-use").value;

    $.ajax({
        method: "GET",
        url: "./php/production/add/add_machinery.php",
        data: {
            machineryName: machineryName,
            use: use,
        },
        cache: false,
        success: function(result) {
            if (result === "Machinery Added!") {
                console.log(result);
                document.getElementById("addMachineryResult").innerHTML = result;
            } else {
                console.log(result);
                document.getElementById("addMachineryResult").innerHTML = result;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function searchMachinery() {
    var machineryId = document.getElementById("Id-search-machinery-update").value;
    $.ajax({
        method: "GET",
        url: "./php/production/search/search_machinery.php",
        data: {
            machineryId: machineryId
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                var details = JSON.parse(result);
                document.getElementById("update-details-machinery").style.display = "block";
                document.getElementById("previous-machinery-Id").value = details.machineryId;
                document.getElementById("previous-machinery-name").value = details.machineryName;
                document.getElementById("previous-machinery-use").value = details.use;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updateMachinery(button) {
    if (button === "updating") {
        var mahcineryId = document.getElementById("previous-machinery-I").value;
        var machineryName = document.getElementById("previous-machinery-name").value;
        var use = document.getElementById("previous-machinery-use").value;
        $.ajax({
            method: "GET",
            url: "./php/production/update/update_machinery.php",
            data: {
                mahcineryId: mahcineryId,
                machineryName: machineryName,
                use: use,
            },
            cache: false,
            success: function(result) {
                if (result === "Machinery Updated!") {
                    document.getElementById("update-details-machinery").style.display = "none";
                    document.getElementById("mUpdateResultNegative").innerHTML = result;
                } else {
                    document.getElementById("mUpdateResult").innerHTML = result;
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        })
    } else if (button === "deleting") {
        var machineryId = document.getElementById("Id-search-machinery-update").value;
        $.ajax({
            method: "GET",
            url: "./php/production/delete/delete_machinery.php",
            data: {
                machineryId: machineryId
            },
            cache: false,
            success: function(result) {
                document.getElementById("update-details-machinery").style.display = "none";
                document.getElementById("mUpdateResult").innerHTML = result;
            }

        })
    }
}

function infoMachinery() {
    var machineryName = document.getElementById("name-search-machinery-info").value;
    //var email = document.getElementById("email-search-labour-info").value;
    $.ajax({
        method: "GET",
        url: "./php/production/information/information_machinery.php",
        data: {
            machinery: machineryName,
            //email: email
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            var details = JSON.parse(result);
            document.getElementById("info-machinery-details").style.display = 'block';
            document.getElementById("info-machinery-Id").innerHTML = details.machineryId;
            document.getElementById("info-machinery-name").innerHTML = details.machineryName;
            document.getElementById("info-machinery-use").innerHTML = details.use;
        }
    })
}