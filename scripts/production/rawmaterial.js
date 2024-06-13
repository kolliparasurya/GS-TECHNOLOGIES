function addRawmaterial() {
    var rawmaterialName = document.getElementById("rawmaterial-name").value;
    $.ajax({
        method: "GET",
        url: "./php/production/add/add_rawmaterial.php",
        data: {
            rawmaterialName: rawmaterialName,
        },
        cache: false,
        success: function(result) {
            if (result === "Rawmaterial Added!") {
                console.log(result);
                document.getElementById("addRawmaterialResult").innerHTML = result;
            } else {
                console.log(result);
                document.getElementById("addRawmaterialResult").innerHTML = result;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function searchRawmaterial() {
    var batchId = document.getElementById("id-search-rawmaterial-update").value;
    $.ajax({
        method: "GET",
        url: "./php/production/search/search_rawmaterial.php",
        data: {
            batchId: batchId
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                var details = JSON.parse(result);
                document.getElementById("update-details-rawmaterial").style.display = 'block';
                document.getElementById("previous-rawmaterial-Id").value = details.rawmaterialId;
                document.getElementById("previous-rawmaterial-name").value = details.rawmaterialName;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updateRawmaterial(button) {
    if (button === "updating") {
        var rawmaterialId = "";
        var rawmaterialName =""; 
        if(document.getElementById("previous-rawmaterial-Id").value ){
            var rawmaterialId = document.getElementById("previous-rawmaterial-Id").value;

        }if(document.getElementById("previous-rawmaterial-name").value){
            var rawmaterialName = document.getElementById("previous-rawmaterial-name").value;
        }


        $.ajax({
            method: "GET",
            url: "./php/production/update/update_rawmaterial.php",
            data: {
                rawmaterialId: rawmaterialId,
                rawmaterialName: rawmaterialName,
            },
            cache: false,
            success: function(result) {
                if (result === "Rawmaterial Updated!") {
                    document.getElementById("update-details-rawmaterial").style.display = "none";
                    document.getElementById("rmUpdateResult").innerHTML = result;
                } else {
                    document.getElementById("rmUpdatingResultNegative").innerHTML = result;
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        })
    } else if (button === "deleting") {
        var batchId = document.getElementById("previous-stock-rawmaterial-batch-id").value;
        $.ajax({
            method: "GET",
            url: "./php/production/delete/delete_rawmaterial_stock.php",
            data: {
                batchId: batchId
            },
            cache: false,
            success: function(result) {
                document.getElementById("update-details-rawmaterial-stock").style.display = 'none';
                document.getElementById("rmsUpdateResult").innerHTML = result;
            }

        })
    }
}

function infoRawmaterial() {
    var rawmaterialId = document.getElementById("name-search-rawmaterial-info").value;
    var rawmaterialName = document.getElementById("Id-search-rawmaterial-info").value;
    if(chipId != null && chipName == null){

    }

    $.ajax({
        method: "GET",
        url: "./php/production/information/information_rawmaterial.php",
        data: {
            rawmaterialId: rawmaterialId,
            rawmaterialName: rawmaterialName
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            var details = JSON.parse(result);
            document.getElementById("infoRawmaterial").style.display = 'block';
            document.getElementById("rawmaterial-id-info").innerHTML = details.rawmaterialId;
            document.getElementById("rawmaterial-name-info").innerHTML = details.rawmaterialName;
        }

    })
}