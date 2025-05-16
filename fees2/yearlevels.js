



async function setprogtype() {
    var fd = new FormData();
    fd.append('setprogtype', '');
    var res = await myajax('yearlevelsfunc.php', fd);
    $('#progtype').html(res);
}


function manageylvls() {
    st = $("#progidylvls");
    $.post("yearlevelsfunc.php", {
        setprograms: ""
    },
        function (data, textStatus, jqXHR) {
            $(st).html(data.trim());
            setpgsylvls();
            setprogtype();
        }
    );

}



function setupaddylvl(btn) {
    bool = false;
    $.each($("select.reqsingle"), function (i, v) {
        if ($(v).val() == "" || $(v).val() == undefined) {
            reqfunc($(v));
            bool = true;
            return;
        }
    });
    if (bool) {
        return;
    }
    td = $(btn).closest('td');
    inpt = $(`<input type="text" class="form-control filteropt text-center" placeholder="Search...">`)
    st = $(`<select name="ylid" onchange="addylvl(this)" class="form-control text-center form-control-sm form-select" required>
    </select>`);
    $(td).html(st);
    $(td).prepend(inpt);
    setylvls(st);
}
//add year level
function addylvl(st) {
    progid = $('#progidylvls').val();
    progtype = $('#progtype').val();
    if (progtype === "") {
        reqfuncwtoast($('#progtype'), `Program type is required.`, 3);
        return;
    }
    ylid = $(st).val();
    $.post("yearlevelsfunc.php", {
        progid: ((progid != "") ? progid : ""),
        ylid: ((ylid != "") ? ylid : ""),
        progtype: ((progtype != "") ? progtype : ""),
        addylvl: "",
    },
        function (data, textStatus, jqXHR) {
            if (data.trim() == 'success') {
                tsuccess('Year lvl Added', 3);
                setpgsylvls();
            } else {
                terror(data.trim(), 3);
            }
        }
    );

}
function setylvls(st) {
    progid = $('#progidylvls').val();
    $.post("yearlevelsfunc.php", {
        progid: ((progid != "") ? progid : ""),
        setylvls: "",
    },
        function (data, textStatus, jqXHR) {
            $(st).html(data.trim());
            setsearch();
        }
    );

}


//delete year lvl
function delylvl(btn) {
    pyid = $(btn).val();
    $.post("yearlevelsfunc.php", {
        pyid: ((pyid != "") ? pyid : ""),
        delylvl: "",
    },
        function (data, textStatus, jqXHR) {
            if (data.trim() == 'success') {
                tsuccess('Year lvl Deleted', 3);
                setpgsylvls();
            } else {
                terror(data.trim(), 3);
            }
        }
    );

}






$("#progidylvls, #progtype").change(function (e) {
    e.preventDefault();
    setpgsylvls();
});


function setpgsylvls() {

    entries = $("#entriesylvls").val();
    page = $('#pageylvls');
    progid = $('#progidylvls').val();
    progtype = $('#progtype').val();


    if (progid == "") {
        $('#ylvlstb').html(` <tr>
        <td colspan="3">Select Program</td>
    </tr>`)
        return;
    }
    ayid = $('#ayid').val();
    search = $('#searchylvls').val();
    $.post("yearlevelsfunc.php", {
        entries: ((entries != "") ? entries : ""),
        search: ((search != "") ? search : ""),
        progid: ((progid != "") ? progid : ""),
        progtype: ((progtype != "") ? progtype : ""),
        setpgs: "",
    },
        function (data, textStatus, jqXHR) {
            $(page).html(data.trim());
            settbylvls();
        }
    );
}

function settbylvls() {
    var tb = $('#ylvlstb');
    entries = $("#entriesylvls").val();
    progid = $('#progidylvls').val();
    page = $('#pageylvls').val();
    search = $('#searchylvls').val();
    progtype = $('#progtype').val();
    $(tb).html(loadingsm("Loading..."));
    $.post("yearlevelsfunc.php", {
        entries: ((entries != "") ? entries : ""),
        page: ((page != "") ? page : ""),
        search: ((search != "") ? search : ""),
        progid: ((progid != "") ? progid : ""),
        progtype: ((progtype != "") ? progtype : ""),
        settb: "",
    },
        function (data, textStatus, jqXHR) {
            $(tb).html(data.trim());
            settbsort();

        }
    );

}

$("button[name='prevnxtbtnylvls']").click(function (e) {
    e.preventDefault();
    var l = $('#pageylvls > option').length;
    var s = $('#pageylvls').prop('selectedIndex');
    if (s != l - 1 && $(this).hasClass("next")) {
        s++;
        $('#pageylvls').prop('selectedIndex', s);
        $("#pageylvls").trigger('change');
    } else if ((s <= l - 1 && s > 0) && $(this).hasClass("prev")) {
        s--;
        $('#pageylvls').prop('selectedIndex', s);
        $("#pageylvls").trigger('change');
    } else {
        reqfunc($('#pageylvls'));
    }
});


$('#searchylvls').keyup(function (e) {
    e.preventDefault();
    setpgsylvls();
});

$('#entriesylvls,select.setpgsylvls').change(function (e) {
    e.preventDefault();
    setpgsylvls();
});

$('#pageylvls').change(function (e) {
    e.preventDefault();
    settbylvls();
});