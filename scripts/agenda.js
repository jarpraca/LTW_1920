'use strict'

let aadd_button = document.getElementById("agenda_button");

let date_from = document.getElementById("agenda_input_from");
let date_to = document.getElementById("agenda_input_to");

let atable = document.getElementById("agenda");

aadd_button.addEventListener('click', function(event) {
    event.preventDefault();
    
    let agenda = document.createElement('tr');
    let from = document.createElement('td');
    from.innerHTML = date_from.value;
    let to = document.createElement('td');
    to.innerHTML = date_to.value;

    let button = document.createElement('td');
    let input_button = document.createElement('input');
    input_button.setAttribute("type", "button");
    input_button.setAttribute("class", "remove");
    input_button.setAttribute("value", " X ");
    button.appendChild(input_button);

    input_button.addEventListener('click', function(){
        atable.removeChild(agenda);
    })

    agenda.appendChild(from);
    agenda.appendChild(to);
    agenda.appendChild(button);
    
    atable.append(agenda);
})
