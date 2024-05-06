function clearTable() {
    $('#colorManagementTable').find('tbody').detach()
    $('#colorManagementTable').append($('<tbody>'));
}

function getTable(rdata) {
            let minCount = 2;
            let returnCount = rdata.length;
            for(let i=0; i<rdata.length; i++) {
                let cId = JSON.stringify(rdata[i]["Id"]);
                let cName = JSON.stringify(rdata[i]["Name"]);
                let hexVal = JSON.stringify(rdata[i]["HexValue"]);
                
                cId = cId.slice(1,-1);
                cName = cName.slice(1,-1);
                hexVal = hexVal.slice(1,-1);

                $('#colorManagementTable tbody').append('<tr>');
                $('#colorManagementTable tbody').append('<td>' + cName + '</td>');
                $('#colorManagementTable tbody').append('<td>' + hexVal + '</td>');
                $('#colorManagementTable tbody').append('<td style="background-color:' + hexVal+ ';">' + '</td>');
                $('#colorManagementTable tbody').append('<td><button id="' + cId + '"' + 'type="button" onClick="editColor(this.id)">Edit</button>'  + '</td>');
                if (returnCount >=minCount) {
                    $('#colorManagementTable tbody').append('<td><button id="' + cId + '"' + 'type="button" onClick="removeColor(this.id)">Remove</button>'  + '</td>');
                }
                else {
                    $('#colorManagementTable tbody').append('<td>' + '</td>');
                }
                $('#colorManagementTable tbody').append('</tr>');
            }
            
        }

function appendAddButton() {
    $('#colorManagementTable').append('<tr>');
                $('#colorManagementTable tbody').append('<td colspan="5"><button id="TableAddColorButton" onClick="showAdder()">Add New Color</button>' + '</td>');
                $('#colorManagementTable tbody').append('</tr>');

}

function updateEditForm(oneColor) {
    let cId = JSON.stringify(oneColor[0]["Id"]);
    let cName = JSON.stringify(oneColor[0]["Name"]);
    let hexVal = JSON.stringify(oneColor[0]["HexValue"]);

    cId = cId.slice(1,-1);
    cName = cName.slice(1,-1);
    hexVal = hexVal.slice(1,-1);

    $('#CidField').val(cId);
    $('#oldName').text(cName);
    $('#oldHex').text(hexVal);
    $('#newEditName').val(cName);
    $('#newEditHex').val(hexVal);
    
}

    function hideEditor() {
        $("#EditFormDiv").hide();
        $('#StatusMessage').text("");
    }

    function hideAdder() {
        $("#AddFormDiv").hide();
        $('#StatusMessage').text("");
    }

    function showAdder() {
        $("#AddFormDiv").show();
        $('#StatusMessage').text("");
    }


    function editColor(clicked_id) {
        $.ajax({
            url: "CI.php",
            type: "POST",
            data: {getColor: "True", Cid:clicked_id},
            dataType: "json",
            success: function (oneColor) {
            updateEditForm(oneColor);
            $('#StatusMessage').text("");
            }
            });

        $("#EditFormDiv").show();
    }

    function sumbitEdit() {
        let editId = $('#CidField').val();
        let editName = $('#newEditName').val();
        let editHex = $('#newEditHex').val();
    
        $.ajax({
            url: "CI.php",
            type: "POST",
            data: {editColor: "True", newName:editName, newHex:editHex, Cid:editId},
            dataType: "json",
            success: function (editData) {
            hideEditor();
            clearTable()
            getTable(editData);
            appendAddButton();
            $('#StatusMessage').text("Successfully edited color.");
            },
            error: function() {
            $('#StatusMessage').text("This name or hex value is already taken or is formatted incorrectly.");
            }
            });

    }

    function removeColor(clicked_id) {
        if (confirm("Are you sure you want to remove this color? This operation cannot be undone.")) {

            $.ajax({
            url: "CI.php",
            type: "POST",
            data: {removeColor: "True", Cid:clicked_id},
            dataType: "json",
            success: function (newData) {
            clearTable()
            getTable(newData);
            appendAddButton();
            $('#StatusMessage').text("Color removed successfully.");
            }
            });
        }   
    }

    function addColors() {
        let addName = $('#colorName').val();
        let addHex = $('#colorHex').val();


        $.ajax({
        url: "CI.php",
        type: "POST",
        data: {addColor: "True", addName:addName, addHex:addHex},
        dataType: "json",
        success: function (addedData) {
        clearTable()
        getTable(addedData);
        appendAddButton();
        hideAdder();
        $('#StatusMessage').text("Color added successfully.");
        },
        error: function() {
            $('#StatusMessage').text("Unable to add color. This name or hex may already be taken.");
        }

        });
        
            
    }




    $(document).ready(function(){
        $("#EditFormDiv").hide();
        $("#AddFormDiv").hide();



        $.ajax({
        url: "CI.php",
        type: "POST",
        data: {listColor: "True"},
        dataType: "json",
        success: function (rdata) {
            getTable(rdata);
            appendAddButton();
        }
        });
        

    });