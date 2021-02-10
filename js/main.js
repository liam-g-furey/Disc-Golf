let divs = document.querySelectorAll('div.collapsible');

for (let i = 0; i < divs.length; i++) {
  let button = divs[i].querySelector('button');
  button.addEventListener("click", function() {
    let table = this.parentNode.querySelector('table');
    table.hidden = !table.hidden;
  });
}