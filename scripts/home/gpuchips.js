function addingChip() {
    var chipName = document.getElementById("chip-name").value;
    var chipStage = document.getElementById("stages").value;
    var chipApplication = document.getElementById("chip-application").value;
    var chipGPUType = document.getElementById("types").value;
    var chipProcessSize = document.getElementById("chip-process-size").value;
    var chipTransistors = document.getElementById("chip-transistors").value;
    var chipDieSize = document.getElementById("chip-die-size").value;
    var chipFoundry = document.getElementById("chip-foundry").value;
    var chipDate = document.getElementById("chip-added-date").value;
    var chipShadingUnits = document.getElementById("chip-shading-units").value;
    var chipTMUs = document.getElementById("chip-TMUs").value;
    var chipCores = document.getElementById("chip-cores").value;
    var chipMemoryBus = document.getElementById("chip-memory-bus").value;
    var chipMemoryType = document.getElementById("chip-memory-type").value;
    var chipBandWidth = document.getElementById("chip-band-width").value;
    var chipBaseClockSpeed = document.getElementById("chip-base-clock-speed").value;
    var chipMemoryClockSpeed = document.getElementById("chip-memory-clock-speed").value;
    $.ajax({
        method: "GET",
        url: "./php/home/adding_chip.php",
        data: {
            chipName: chipName,
            chipStage: chipStage,
            chipApplication: chipApplication,
            chipGPUType: chipGPUType,
            chipProcessSize: chipProcessSize,
            chipTransistors: chipTransistors,
            chipDieSize: chipDieSize,
            chipFoundry: chipFoundry,
            chipDate: chipDate,
            chipShadingUnits: chipShadingUnits,
            chipTMUs: chipTMUs,
            chipCores: chipCores,
            chipMemoryBus: chipMemoryBus,
            chipMemoryType: chipMemoryType,
            chipBandWidth: chipBandWidth,
            chipBaseClockSpeed: chipBaseClockSpeed,
            chipMemoryClockSpeed: chipMemoryClockSpeed
        },
        cache: false,
        success: function(result) {
            if (result === "Chip Added!") {
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

function searchingChip() {
    var chipId = document.getElementById("search-chip-update").value;
    $.ajax({
        method: "GET",
        url: "./php/home/search_chip.php",
        data: {
            chipId: chipId
        },
        cache: false,
        success: function(result) {
            if (result) {
                console.log(result);
                var details = JSON.parse(result);
                document.getElementById("update-details-chip").style.display = "block";
                document.getElementById("update-chip-id").value = details.chip_ID;
                document.getElementById("update-chip-name").value = details.name;
                document.getElementById("update-stages").value = details.stage;
                document.getElementById("update-chip-application").value = details.application;
                document.getElementById("update-types").value = details.gpu_type;
                document.getElementById("update-chip-process-size").value = details.process_size;
                document.getElementById("update-chip-transistors").value = details.transistors;
                document.getElementById("update-chip-die-size").value = details.die_size;
                document.getElementById("update-chip-foundry").value = details.foundry;
                document.getElementById("udate-chip-added-date").value = details.added_date;
                document.getElementById("update-chip-shading-units").value = details.shading_units;
                document.getElementById("update-chip-TMUs").value = details.TMUs;
                document.getElementById("update-chip-cores").value = details.cores;
                document.getElementById("update-chip-memory-bus").value = details.memory_bus;
                document.getElementById("update-chip-memory-type").value = details.memory_type;
                document.getElementById("update-chip-band-width").value = details.band_width;
                document.getElementById("update-chip-base-clock-speed").value = details.base_clock;
                document.getElementById("update-chip-memory-clock-speed").value = details.memory_clock;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    })
}

function updatingChip(button) {
    if (button === "chipUpdating") {
        var chip_ID = document.getElementById("update-chip-id").value;
        var chipName = document.getElementById("update-chip-name").value;
        var chipStage = document.getElementById("update-stages").value;
        var chipApplication = document.getElementById("update-chip-application").value;
        var chipGPUType = document.getElementById("update-types").value;
        var chipProcessSize = document.getElementById("update-chip-process-size").value;
        var chipTransistors = document.getElementById("update-chip-transistors").value;
        var chipDieSize = document.getElementById("update-chip-die-size").value;
        var chipFoundry = document.getElementById("update-chip-foundry").value;
        var chipDate = document.getElementById("udate-chip-added-date").value;
        var chipShadingUnits = document.getElementById("update-chip-shading-units").value;
        var chipTMUs = document.getElementById("update-chip-TMUs").value;
        var chipCores = document.getElementById("update-chip-cores").value;
        var chipMemoryBus = document.getElementById("update-chip-memory-bus").value;
        var chipMemoryType = document.getElementById("update-chip-memory-type").value;
        var chipBandWidth = document.getElementById("update-chip-band-width").value;
        var chipBaseClockSpeed = document.getElementById("update-chip-base-clock-speed").value;
        var chipMemoryClockSpeed = document.getElementById("update-chip-memory-clock-speed").value;
        $.ajax({
            method: "GET",
            url: "./php/home/updating_chip.php",
            data: {
                chip_ID: chip_ID,
                chipName: chipName,
                chipStage: chipStage,
                chipApplication: chipApplication,
                chipGPUType: chipGPUType,
                chipProcessSize: chipProcessSize,
                chipTransistors: chipTransistors,
                chipDieSize: chipDieSize,
                chipFoundry: chipFoundry,
                chipDate: chipDate,
                chipShadingUnits: chipShadingUnits,
                chipTMUs: chipTMUs,
                chipCores: chipCores,
                chipMemoryBus: chipMemoryBus,
                chipMemoryType: chipMemoryType,
                chipBandWidth: chipBandWidth,
                chipBaseClockSpeed: chipBaseClockSpeed,
                chipMemoryClockSpeed: chipMemoryClockSpeed
            },
            cache: false,
            success: function(result) {
                if (result === "Chip Updated!") {
                    document.getElementById("update-details-chip").style.display = "none";
                    document.getElementById("updatingResult").innerHTML = result;
                } else {
                    document.getElementById("updatingResultNegative").innerHTML = result;
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        })
    } else if (button === "chipDeleting") {
        var chip_ID = document.getElementById("update-chip-id").value;
        $.ajax({
            method: "GET",
            url: "./php/home/deleting_chip.php",
            data: {
                chip_ID: chip_ID
            },
            cache: false,
            success: function(result) {
                document.getElementById("updatingResult").innerHTML = result;
            }

        })
    }
}

function chipInformation(button) {
    var chipName = document.getElementById("search-chip-info").value;
    $.ajax({
        method: "GET",
        url: "./php/home/information_chip.php",
        data: {
            chipName: chipName
        },
        dataType: 'text',
        success: function(result) {
            console.log(result);
            let details = JSON.parse(result);
            console.log(details.TMUs);

            document.getElementById("informationOfChip").style.display = 'block';
            document.getElementById("chip_info").innerHTML = details.chip_ID;
            document.getElementById("name_info").innerHTML = details.name;
            document.getElementById("stage_info").innerHTML = details.stage;
            document.getElementById("application_info").innerHTML = details.application;
            document.getElementById("gpu_type_info").innerHTML = details.gpu_type;
            document.getElementById("processor_size_info").innerHTML = details.process_size;
            document.getElementById("transistors_info").innerHTML = details.transistors;
            document.getElementById("die_size-info").innerHTML = details.die_size;
            document.getElementById("foundry-info").innerHTML = details.foundry;
            document.getElementById("date-info").innerHTML = details.added_date;
            document.getElementById("shadingUnits-info").innerHTML = details.shading_units;
            document.getElementById("tmus-info").innerHTML = details.TMUs;
            document.getElementById("cores-info").innerHTML = details.cores;
            document.getElementById("memoryBus-info").innerHTML = details.memory_bus;
            document.getElementById("memoryType-info").innerHTML = details.memory_type;
            document.getElementById("bandWidth-info").innerHTML = details.band_width;
            document.getElementById("baseClockSpeed-info").innerHTML = details.base_clock;
            document.getElementById("memoryCloackSpeed-info").innerHTML = details.memory_clock;

        }

    })
}