function addingProductStock() {
    var chipId = document.getElementById("product-stock-chip-Id").value;
    var chipName = document.getElementById("product-stock-chip-name").value;
    var producedQuantity = document.getElementById("product-stock-produced-quantity").value;
    var defectedQuantity = document.getElementById("produced-stock-defected-quantity").value;
    var netQuantity = document.getElementById("produced-stock-net-quantity").value;
    var machineryNames = document.getElementById("produced-stock-machinery").value;
    var labourIDs = document.getElementById("produced-stock-labour").value;
    var rawmaterials = document.getElementById("produced-stock-rawmaterial").value;
    var stockedDate = document.getElementById("produced-stock-stocked-date").value;

    $.ajax({
        method: "GET",
        url: "./php/production/add/add_product_stock.php",
        data: {
            chipId: chipId,
            chipName: chipName,
            producedQuantity: producedQuantity,
            defectedQuantity: defectedQuantity,
            netQuantity: netQuantity,
            machineryNames: machineryNames,
            labourIDs: labourIDs,
            rawmaterials: rawmaterials,
            stockedDate: stockedDate,
        },
        cache: false,
        success: function(result) {
            if (result === "Product Stock Added!") {
                console.log(result);
                document.getElementById("addingResult").innerHTML = result;
            } else {
                console.log(result);
                document.getElementById("addingResult").innerHTML = result;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function searchingProductStock() {
    var batchId = document.getElementById("batchId-search-product-stock-update").value;
    $.ajax({
        method: "GET",
        url: "./php/production/search/search_product_stock.php",
        data: {
            batchId: batchId
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                var details = JSON.parse(result);
                document.getElementById("update-details-product-stock").style.display = "block";
                document.getElementById("previous-product-stock-batch-Id").value = details.batchId;
                document.getElementById("previous-product-stock-chip-Id").value = details.chipId;
                document.getElementById("previous-product-stock-chip-name").value = details.chipName;
                document.getElementById("previous-product-stock-produced-quantity").value = details.producedQuantity;
                document.getElementById("previous-produced-stock-defected-quantity").value = details.defectedQuantity;
                document.getElementById("previous-produced-stock-net-quantity").value = details.netQuantity;
                document.getElementById("previous-produced-stock-machinery").value = details.machineryNames;
                document.getElementById("previous-produced-stock-labour").value = details.labourIDs;
                document.getElementById("previous-produced-stock-rawmaterial").value = details.rawmaterials;
                document.getElementById("previous-produced-stock-stocked-date").value = details.stockedDate;

            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updatingProductStock(button) {
    if (button === "updating") {
        var batchId = document.getElementById("previous-product-stock-batch-Id").value;
        var chipId = document.getElementById("previous-produt-stock-chip-Id").value;
        var chipName = document.getElementById("previous-product-stock-chip-name").value;
        var producedQuantity = document.getElementById("previous-product-stock-produced-quantity").value;
        var defectedQuantity = document.getElementById("previous-produced-stock-defected-quantity").value;
        var netQuantity = document.getElementById("previous-produced-stock-net-quantity").value;
        var machineryNames = document.getElementById("previous-produced-stock-machinery").value;
        var labourIDs = document.getElementById("previous-produced-stock-labour").value;
        var rawmaterials = document.getElementById("previous-produced-stock-rawmaterial").value;
        var stockedDate = document.getElementById("previous-produced-stock-stocked-date").value;

        $.ajax({
            method: "GET",
            url: "./php/production/update/update_product_stock.php",
            data: {
                batchId: batchId,
                chipId: chipId,
                chipName: chipName,
                producedQuantity: producedQuantity,
                defectedQuantity: defectedQuantity,
                netQuantity: netQuantity,
                machineryNames: machineryNames,
                labourIDs: labourIDs,
                rawmaterials: rawmaterials,
                stockedDate: stockedDate,
            },
            cache: false,
            success: function(result) {
                if (result === "Product Stock Updated!") {
                    document.getElementById("update-details-product-stock").style.display = "none";
                    document.getElementById("psUpdateResult").innerHTML = result;
                } else {
                    document.getElementById("psUpdatingResultNegative").innerHTML = result;
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        })
    } else if (button === "deleting") {
        var batchId = document.getElementById("batchId-search-product-stock-update").value;
        $.ajax({
            method: "GET",
            url: "./php/production/delete/delete_product_stock.php",
            data: {
                batchId: batchId
            },
            cache: false,
            success: function(result) {
                document.getElementById("update-details-product-stock").style.display = "none";
                document.getElementById("psUpdateResult").innerHTML = result;
            }

        })
    }
}

function productStockInfo() {
    var batchId = document.getElementById("batchId-search-product-stock-info").value;
    //var stockedDate = document.getElementById("date-search-product-stock-info").value;
    $.ajax({
        method: "GET",
        url: "./php/production/information/information_product_stock.php",
        data: {
            batchId: batchId,
            //stockedDate: stockedDate
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            var details = JSON.parse(result);
            document.getElementById("info-productStock").style.display = 'block';
            document.getElementById("info-BatchId").innerHTML = details.batchId;
            document.getElementById("info-chipId").innerHTML = details.chipId;
            document.getElementById("info-chipName").innerHTML = details.chipName;
            document.getElementById("info-produced-quantity").innerHTML = details.producedQuantity;
            document.getElementById("info-defected-quantity").innerHTML = details.defectedQuantity;
            document.getElementById("info-net-quantity").innerHTML = details.netQuantity;
            document.getElementById("info-machinery-names").innerHTML = details.machineryNames;
            document.getElementById("info-labour-names").innerHTML = details.labourIDs;
            document.getElementById("info-rawmaterials").innerHTML = details.rawmaterials;
            document.getElementById("info-stocked-date").innerHTML = details.stockedDate;
        }

    })
}