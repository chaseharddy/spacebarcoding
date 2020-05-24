function load_table(parentNode, paginationId, name, excludeID = true) {
    var data = new Data();
    data.get(name, (responseText) => {
        json = JSON.parse(responseText);
        var response = [];
        var headers = data.getDestination(name).headers;
        for (var i = 0; i < json.length; i++) {
            var row = [];
            var id = -1;
            var keys = Object.keys(json[i]);
            for (var k = 0; k < keys.length; k++) {
                if (!excludeID && keys[k] == "id" || keys[k] != "id")
                    row.push(json[i][keys[k]]);
                else
                    id = json[i][keys[k]];
            }
            /* setup delete */
            row.push(`
                <i data-toggle="modal"
                onclick="setDelete('`+id+`', 
                '`+parentNode+`'
                ,'`+paginationId+`'
                ,'`+name+`')"
                data-target="#remove-user-modal" class="fas fa-trash-alt">
                </i`);
            response.push(row);
        }
        headers.push("");
        data = {
            "head": headers,
            "body": response,
            "foot": headers
        }
        create_table(document.getElementById(parentNode), true, true, false, data);
        var config = {
            table: document.getElementById(parentNode).getElementsByTagName("table")[0],
            box: document.getElementById(paginationId),
            active_class: "btn btn-primary"
        };
        paginator(config);
    })
}

function setDelete(rowId, parentNode, paginationId, name) {
    var data = new Data();
    document.getElementById('remove-row-button').onclick = () => {
        data.delete(rowId, name, () => {
            load_table(parentNode, paginationId, name);
        });
    };
}


function create_table(parentNode, head, body, foot, data) {
    if (typeof head == "undefined") {
        head = true;
    }
    if (typeof body == "undefined") {
        body = true;
    }
    if (typeof foot == "undefined") {
        foot = true;
    }

    var table = document.createElement("table");
    table.classList.add("table");
    var tr, th, td;
    // header
    tr = document.createElement("tr");
    var headers = data.head || [];
    for (var i = 0; i < headers.length; i++) {
        th = document.createElement("th");
        th.innerHTML = headers[i];
        tr.appendChild(th);
    }
    if (head) {
        var thead = document.createElement("thead");
        thead.classList.add("thead-dark");
        thead.appendChild(tr);
        table.appendChild(thead);
    } else {
        table.appendChild(tr);
    }
    // end header

    // body
    var table_body = data.body || [];
    if (body) {
        var tbody = document.createElement("tbody");
    }
    for (var i = 0; i < table_body.length; i++) {
        tr = document.createElement("tr");
        for (var j = 0; j < table_body[i].length; j++) {
            td = document.createElement("td");
            td.innerHTML = table_body[i][j];
            tr.appendChild(td);
        }
        if (body) {
            tbody.appendChild(tr);
        } else {
            table.appendChild(tr);
        }
    }
    if (body) {
        table.appendChild(tbody);
    }
    // end body

    // footer
    if (foot) {
        var tfoot = document.createElement("tfoot");
        tr = document.createElement("tr");
        var footer = data.foot || [];
        for (var i = 0; i < footer.length; i++) {
            th = document.createElement("th");
            th.innerHTML = footer[i];
            tr.appendChild(th);
        }
        tfoot.appendChild(tr);
        table.appendChild(tfoot);
    }
    // end footer

    if (parentNode) {
        parentNode.innerHTML = "";
        parentNode.appendChild(table);
    }
    //return table;
}
