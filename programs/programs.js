
//delete program
function delprog(btn) {
    progid = $(btn).val();
    $.post("yearlevelsfunc.php", {
        progid: progid,
        delprog: ""
    },
        function (data, textStatus, jqXHR) {
            if (data.trim() == "Success") {
                tsuccess(`Program deleted.`);
                pages($("#entries").val(), $("#page"), $("#search").val(), "programstb");
            } else {
                terror(data.trim());
            }
        }
    );

}

async function manual(btn) {
    var fd = new FormData();
    fd.append('manual', '');
    var res = await myajax('yearlevelsfunc.php', fd);
    modalxl(`Manual`, res);
}

function setaddprogram(btn) {
    tr = $(btn).closest("tr");
    elem = `<td colspan="2">
    <label for="progcode" class="fw-bold">Program Code</label>
    <input type="text" class="form-control " onkeyup="this.value = this.value.toUpperCase();" in="Program Code" title="must be 3 characters or more" name="progcode" id="progcode" minlength="3" maxlength="10" required>
    </td>
    <td>
        <label for="progdesc" class="fw-bold">Program Description</label>
        <input type="text" class="form-control" name="progdesc" in="Program Description" title="must be 5 characters or more" id="progdesc" minlength="5" maxlength="200" required>
    </td>
    <td>
        <label for="progduration" in="" title="Select Program Duration" class="fw-bold">Program Duration</label>
        <select name="progduration" id="progduration" class="form-control" required>
            <option value="">Select Duration</option>
            <option value="1">1 Year</option>
            <option value="2">2 Years</option>
            <option value="4">4 Years</option>
            <option value="5">5 Years</option>

        </select>
    </td>

    <td colspan="2" class="align-middle">
        <button class="btn btn-sm btn-success" onclick="addprogram(this);"><span>Submit </span><i class="bi bi-check-circle"></i></button>

        <button class="btn btn-sm btn-danger" onclick="cancelbtn(this);"><span>Cancel </span><i class="bi bi-x-circle"></i></button>
    </td>`;
    $(tr).html(elem);
}

function addprogram(btn) {
    tr = $(btn).closest("tr");
    td = $(btn).closest("td");
    btns = $(td).html();
    var t = $("#programstb");
    $(td).html(loadingsm());
    tf = true;
    $.each($(tr).find('input,select').filter('[required]'), function (i, v) {

        if ($(v).val() == "") {
            tf = false;
        }
        if ($(v).val().length < $(v).attr("minlength")) {
            twarning($(v).attr('in') + " " + $(v).attr('title'));
            tf = false;
        }
    });
    var datas = $(tr).find('input,select').filter('[required]').serializeArray();
    datas.push({ name: "addprogram", value: "" });
    if (tf) {
        $.post("yearlevelsfunc.php",
            datas,
            function (data, textStatus, jqXHR) {
                if (data.trim() == "Added") {
                    tsuccess(`Program added.`);
                    $(td).html(btns);
                    pages($("#entries").val(), $("#page"), $("#search").val(), "programstb");
                } else {
                    terror(data.trim());
                    $(td).html(btns);
                }

            }
        );
    } else {
        twarning(`Fillup all fields.`);
        $(td).html(btns);
    }
}


function setupprogram(btn) {
    tr = $(btn).closest("tr");

    var tds = $(tr).find("td");
    elem = `    <td colspan="2">
    <label for="progcode" class="fw-bold">Program Code</label>
    <input type="text" value="`+ $(tds[1]).html() + `" class="form-control " onkeyup="this.value = this.value.toUpperCase();" in="Program Code" title="must be 3 characters or more" name="progcode" id="progcode" minlength="3" maxlength="10" required>
</td>
<td>
    <label for="progdesc" class="fw-bold">Program Description</label>
    <input type="text" value="`+ $(tds[2]).html() + `" class="form-control" name="progdesc" in="Program Description" title="must be 5 characters or more" id="progdesc" minlength="5" maxlength="200" required>
</td>
<td>
    <label for="progduration" class="fw-bold">Program Duration</label>
    <select name="progduration" id="progduration" in="Select Program Duration" title="" class="form-control" minlength="1" required>
        <option value="">Select Duration</option>
        <option value="1" `+ ($(tds[3]).html() == '1' ? 'selected' : '') + ` >1 Year</option>
        <option value="2" `+ ($(tds[3]).html() == '2' ? 'selected' : '') + ` >2 Years</option>
        <option value="4" `+ ($(tds[3]).html() == '4' ? 'selected' : '') + `>4 Years</option>
        <option value="5" ` + ($(tds[3]).html() == '5' ? 'selected' : '') + `>5 Years</option>
    </select>
</td>
<td>
     <label for="progavailability" class="fw-bold">Availability</label>
    <select name="progavailability" id="progavailability" in="Select Program Duration" title="" class="form-control" value="4" minlength="1" required>
        <option value="Available" `+ ($(tds[4]).html() == 'Available' ? 'selected' : '') + `>Available</option>
        <option value="Unavailable" `+ ($(tds[4]).html() == 'Unavailable' ? 'selected' : '') + `>Unavailable</option>
    </select>
</td>
<td  class="align-middle">
    <button type="submit" class="btn btn-sm btn-success" onclick="upprogram(this);" value="`+ $(btn).val() + `"><span>Save </span><i class="bi bi-check-circle"></i></button>

    <button class="btn btn-sm btn-danger" onclick="cancelbtn(this);"><span>Cancel </span><i class="bi bi-x-circle"></i></button>
</td>`;
    $(tr).html(elem);
}

function cancelbtn(btn) {
    tb($("#entries").val(), $("#page").val(), $("#search").val(), "programstb");
}


function upprogram(btn) {
    tr = $(btn).closest("tr");
    td = $(btn).closest("td");
    btns = $(td).html();
    var t = $("#programstb");
    $(td).html(loadingsm());
    tf = true;
    $.each($(tr).find('input,select').filter('[required]'), function (i, v) {

        if ($(v).val() == "") {
            tf = false;
        }
        if ($(v).val().length < $(v).attr("minlength")) {
            twarning($(v).attr('in') + " " + $(v).attr('title'));
            tf = false;
        }
    });
    var datas = $(tr).find('input,select').filter('[required]').serializeArray();
    datas.push({ name: "upprogram", value: "" });
    datas.push({ name: "progid", value: $(btn).val() });
    if (tf) {
        $.post("yearlevelsfunc.php",
            datas,
            function (data, textStatus, jqXHR) {
                if (data.trim() == "Success") {
                    tsuccess(`Program updated.`);
                    $(td).html(btns);
                    pages($("#entries").val(), $("#page"), $("#search").val(), "programstb");
                } else {
                    terror(data.trim());
                    $(td).html(btns);
                }

            }
        );
    } else {
        twarning(`Fillup all fields.`);
        $(td).html(btns);
    }
}


function pages(entries, page, search, tbn) {
    $.post("../pgntb/pages.php",
        {
            pages: "",
            e: entries,
            s: search,
            t: tbn
        },
        function (data) {
            $(page).html(data.trim());
            tb(entries, page.val(), search, tbn);
        }
    );
}

function tb(entries, page, search, tb) {
    tbdy = '#' + tb + ' > tbody';
    console.log(tbdy);
    $(tbdy).html(loadingsm());
    $.post("../pgntb/tbs.php",
        {
            tb: "",
            e: entries,
            p: page,
            s: search,
            t: tb
        },
        function (data) {
            $(tbdy).html(data.trim());
            settbsort();
        }
    );

}

$(document).ready(function () {
    $("button.next,button.prev").click(function (e) {
        div = $(this).closest("div.card-body");
        t = $(div).find("table");

        var l = $('#page > option').length;
        var s = $('#page').prop('selectedIndex');

        if (s != l - 1 && $(this).hasClass("next")) {
            s++;
            $('#page').prop('selectedIndex', s);
            tb($("#entries").val(), $("#page").val(), $("#search").val(), "programstb");
        } else if ((s <= l - 1 && s > 0) && $(this).hasClass("prev")) {
            s--;
            $('#page').prop('selectedIndex', s);
            tb($("#entries").val(), $("#page").val(), $("#search").val(), "programstb");
        }
    });

    let timeoutId;

    $("#search").keyup(function (e) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function () {
            pages($("#entries").val(), $("#page"), $("#search").val(), "programstb");
        }, 500); // Schedule a call to setpgs() after 500 milliseconds
    });


    pages($("#entries").val(), $("#page"), $("#search").val(), "programstb");

    $("button.export").click(function (e) {
        htmltb_to_excel('xlsx', $(this).attr("targettb"));
    });

});