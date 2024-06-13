function addingRawmaterialStock() {
    var rawmaterialName = document.getElementById("stock-rawmaterial-name").value;
    var rawmaterialId = document.getElementById("stock-rawmaterial-Id").value;
    var quantity = document.getElementById("stock-rawmaterial-quantity").value;
    var stockedDate = document.getElementById("stock-rawmaterial-date").value;
    $.ajax({
        method: "GET",
        url: "./php/production/add/add_rawmaterial_stock.php",
        data: {
            rawmaterialName: rawmaterialName,
            rawmaterialId: rawmaterialId,
            quantity: quantity,
            stockedDate: stockedDate,
        },
        cache: false,
        success: function(result) {
            if (result === "Rawmaterial Stock Added!") {
                console.log(result);
                document.getElementById("addRawmaterialStockResult").innerHTML = result;
            } else {
                console.log(result);
                document.getElementById("addRawmaterialStockResult").innerHTML = result;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function searchRawmaterialStock() {
    var batchId = document.getElementById("batchId-search-rawmaterial-stock-update").value;
    $.ajax({
        method: "GET",
        url: "./php/production/search/search_rawmaterial_stock.php",
        data: {
            batchId: batchId
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                var details = JSON.parse(result);
                document.getElementById("update-details-rawmaterial-stock").style.display = 'block';
                document.getElementById("previous-stock-rawmaterial-batch-id").value = details.batchId;
                document.getElementById("previous-stock-rawmaterial-name").value = details.rawmaterialName;
                document.getElementById("previous-stock-rawmaterial-Id").value = details.rawmaterialId;
                document.getElementById("previous-stock-rawmaterial-quantity").value = details.quantity;
                document.getElementById("previous-stock-rawmaterial-stocked-date").value = details.stockedDate;

            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updateRawmaterialStock(button) {
    if (button === "updating") {
        var batchId = document.getElementById("previous-stock-rawmaterial-batch-id").value;
        var rawmaterialName = document.getElementById("previous-stock-rawmaterial-name").value;
        var rawmaterialId = document.getElementById("previous-stock-rawmaterial-Id").value;
        var quantity = document.getElementById("previous-stock-rawmaterial-quantity").value;
        var stockedDate = document.getElementById("previous-stock-rawmaterial-stocked-date").value;

        $.ajax({
            method: "GET",
            url: "./php/production/update/update_rawmaterial_stock.php",
            data: {
                batchId: batchId,
                rawmaterialName: rawmaterialName,
                rawmaterialId: rawmaterialId,
                producedQuantity: quantity,
                stockedDate: stockedDate,
            },
            cache: false,
            success: function(result) {
                if (result === "Rawmaterial Stock Updated!") {
                    document.getElementById("update-details-rawmaterial-stock").style.display = "none";
                    document.getElementById("rmsUpdateResult").innerHTML = result;
                } else {
                    document.getElementById("rmsUpdatingResultNegative").innerHTML = result;
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

function rawmaterialStockInfo() {
    var batchId = document.getElementById("batchId-search-rawmaterial-stock-info").value;
    //var stockedDate = document.getElementById("date-search-product-stock-info").value;
    //document.getElementById("info-rawmaterial-stock").style.display = 'block';
    $.ajax({
        method: "GET",
        url: "./php/production/information/information_rawmaterial_stock.php",
        data: {
            batchId: batchId,
            //stockedDate: stockedDate
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            var details = JSON.parse(result);
            document.getElementById("info").style.display = 'block';
            document.getElementById("info-rawmaterial-stock-BatchId").innerHTML = details.batchId;
            document.getElementById("info-rawmaterial-stock-rawmaterialId").innerHTML = details.rawmaterialId;
            document.getElementById("info-rawmaterial-stock-rawmaterial-name").innerHTML = details.rawmaterialName;
            document.getElementById("info-rawmaterial-stock-quantity").innerHTML = details.quantity;
            document.getElementById("info-rawmaterial-stock-stocked-date").innerHTML = details.stockedDate;
        }

    })
}