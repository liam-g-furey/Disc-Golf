function collapse(gameNum) {
    let children = document.querySelector(`div#${gameNum}`).childNodes;
    for (let i = 0; i < children.length; i++) {
        if (!children[i].classList.contains("keep")) {
            children[i].hidden = !children[i].hidden;
        }
    }
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
