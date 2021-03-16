function loadJSON(filename) {
    return new Promise(function (res, rej) {
        let xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
        xobj.onload = function() {
            if (this.status == 200) {
                res(JSON.parse(xobj.response));
            } else {
                rej({
                    status: this.status,
                    statusText: xobj.statusText
                });
            }
        };
        xobj.onerror = function() {
            rej({
                status: this.status,
                stausText: xobj.statusText
            });
        };
        xobj.open("GET", filename, true);
        xobj.send();
    })
}

function loadGames(season) {
    return loadJSON(`data/raw${season}.json`);
}

function parseDate(date_string) {
    let parts = date_string.split('-');
    return new Date(parts[0], parts[1] - 1, parts[2]);
}

function getMostRecentGame(games) {
    let mostRecent = games[0]
    games.forEach(game => {
        if (parseDate(game.date) >= parseDate(mostRecent.date)) {
            mostRecent = game;
        }
    });
    return mostRecent;
}

function populateTable(table_id) {
    loadGames(1).then(function(games) {
        let game = getMostRecentGame(games);
        let div = document.getElementById(table_id);

        // Info elements
        let course = document.createElement('h2')
        course.innerText = game.courseID;
        let date = document.createElement('p')
        date.innerText = parseDate(game.date).toDateString()
        div.appendChild(course);
        div.appendChild(date);

        // Table elements
        let table = document.createElement('table');
        let thead = document.createElement('thead');
        let tbody = document.createElement('tbody');

        // Populate table header
        let counter = 0;
        let tr = document.createElement('tr');
        let col0 = document.createElement('th');
        col0.innerText = 'Player';
        tr.appendChild(col0);
        game.players[0].scores.forEach(hole => {
            let th = document.createElement('th');
            th.innerText = `Hole ${counter}`;
            tr.appendChild(th);
            counter += 1;
        });
        thead.appendChild(tr);
        table.appendChild(thead);

        // Populate table body
        game.players.forEach(p => {
            let tr = document.createElement('tr');
            let td = document.createElement('td');
            td.innerText = p.name;
            tr.appendChild(td);
            p.scores.forEach(s => {
                td = document.createElement('td');
                td.innerText = s;
                tr.appendChild(td);
            });
            tbody.appendChild(tr);
        });
        table.appendChild(tbody);
        div.appendChild(table);        
    })
}