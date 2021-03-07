let divs = document.querySelectorAll('div.collapsible');

for (let i = 0; i < divs.length; i++) {
    let button = divs[i].querySelector('button');
    button.addEventListener("click", function() {
        let table = this.parentNode.querySelector('table');
        table.hidden = !table.hidden;
    });
}

function isNumeric(str) {
    if (typeof str != "string") return false;
    return !isNaN(str) && !isNaN(parseFloat(str));
}

function sortTable(elem, col) {
    let table = elem.closest('table');
    let tbody = table.tBodies[0]
    let rows = Array.prototype.slice.call(tbody.rows, 0)
    rows = rows.sort(function (a, b) {
        let aVal = a.cells[col].textContent.trim();
        let bVal = b.cells[col].textContent.trim();
        return (isNumeric(aVal)) ? +aVal > +bVal : aVal.localeCompare(bVal);
    })
    for (let i = 0; i < rows.length; ++i) {
        tbody.appendChild(rows[i])
    }
}
