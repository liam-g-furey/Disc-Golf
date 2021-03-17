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

function printDate(date_obj) {
    let opts = { year: 'numeric', month: 'long', day: 'numeric' };
    return date_obj.toLocaleDateString('en-US', opts);
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

function populateGame(div_id, game) {
    let div = document.getElementById(div_id);

    // Info elements
    let elem = document.createElement('p');
    elem.innerText = `${game.course.location}: ${game.course.name}`;
    elem.classList.add('name', 'keep');
    div.appendChild(elem);
    elem = document.createElement('p');
    elem.innerText = printDate(parseDate(game.date));
    elem.classList.add('date', 'keep');
    div.appendChild(elem);
    elem = document.createElement('p');
    elem.innerText = 'Winner(s): ' + game.winners.join(', ');
    elem.classList.add('winners');
    elem.hidden = true;
    div.appendChild(elem);

    // Table elements
    let table = document.createElement('table');
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');
    table.classList.add('gameTable');
    table.hidden = true;

    // Populate table header
    let counter = 1;
    let tr = document.createElement('tr');
    let th = document.createElement('th');
    th.innerText = 'Player';
    tr.appendChild(th);
    th = document.createElement('th');
    th.innerText = 'Total'
    tr.appendChild(th);
    game.players[0].scores.forEach(hole => {
        th = document.createElement('th');
        th.innerText = `Hole ${counter}`;
        tr.appendChild(th);
        counter += 1;
    });
    thead.appendChild(tr);
    table.appendChild(thead);

    // Populate table body
    tr = document.createElement('tr');
    let td = document.createElement('td');
    td.innerText = 'Par';
    tr.appendChild(td);
    td = document.createElement('td');
    td.innerText = game.course.par;
    tr.appendChild(td);
    game.course.holes.forEach(h => {
        td = document.createElement('td');
        td.innerText = h;
        tr.appendChild(td);
    })
    tbody.appendChild(tr);
    game.players.forEach(p => {
        tr = document.createElement('tr');
        td = document.createElement('td');
        td.innerText = p.name;
        tr.appendChild(td);
        td = document.createElement('td');
        td.innerText = p.total;
        tr.appendChild(td)
        p.scores.forEach(s => {
            td = document.createElement('td');
            td.innerText = s;
            tr.appendChild(td);
        });
        tbody.appendChild(tr);
    });
    table.appendChild(tbody);
    div.appendChild(table);
}

function populateLastGame(div_id) {
    loadGames(1).then(function(games) {
        let game = getMostRecentGame(games);
        populateGame(div_id, game);
    });
}

function populateGames(div_id) {
    loadGames(1).then(function(games) {
        let counter = 0;
        let container = document.getElementById(div_id);
        games.forEach(game => {
            let collapsible = document.createElement('div');
            collapsible.classList.add('collapsible');
            container.appendChild(collapsible);

            let button = document.createElement('button');
            button.setAttribute('onclick', `collapse('game${counter}')`);
            button.innerText = 'Show Game';
            collapsible.appendChild(button);

            let game_div = document.createElement('div');
            game_div.id = `game${counter}`;
            collapsible.appendChild(game_div);

            populateGame(`game${counter}`, game);
            counter += 1;
        })
    })
}

function populateStats(season, div_id) {
    loadJSON(`data/stats${season}.json`).then(function(stats) {
        let div = document.getElementById(div_id);
        
        // Info element
        let elem = document.createElement('p');
        elem.innerText = `Season ${season}`;
        div.appendChild(elem);

        // Table elements
        let table = document.createElement('table');
        let thead = document.createElement('thead');
        let tbody = document.createElement('tbody');

        // Populate table header
        let headers = ['Player', 'Wins', 'Average', 'Best', 'Worst'];
        let tr = document.createElement('tr');
        headers.forEach(header => {
            let th = document.createElement('th')
            th.innerText = header;
            tr.appendChild(th);
        })
        thead.appendChild(tr);
        table.appendChild(thead);

        // Populate table body
        Object.keys(stats).forEach(player => {
            tr = document.createElement('tr');
            let td = document.createElement('td');
            td.innerText = player;
            tr.appendChild(td);
            Object.keys(stats[player]).forEach(stat => {
                td = document.createElement('td');
                td.innerText = stats[player][stat];
                tr.appendChild(td);
            });
            tbody.appendChild(tr);
        });
        table.appendChild(tbody);
        div.appendChild(table);
    });
}