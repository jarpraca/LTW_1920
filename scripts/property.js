'use strict'

// ----------------------   Amenities   ---------------------------
let input = document.getElementById("amenities_input");
let add_button = document.getElementById("amenities_button");
let table = document.getElementById("amenities_table");

add_button.addEventListener('click', function(event) {
    event.preventDefault();
    
    let amenity = document.createElement('tr');
    let name = document.createElement('td');
    name.innerHTML = input.value;

    let button = document.createElement('td');
    let input_button = document.createElement('input');
    input_button.setAttribute("type", "button");
    input_button.setAttribute("class", "remove");
    input_button.setAttribute("value", " X ");
    button.appendChild(input_button);

    input_button.addEventListener('click', function(){
        table.removeChild(amenity);
    })

    amenity.appendChild(name);
    amenity.appendChild(button);
    
    table.append(amenity);
})

// ----------------------   Agenda   ---------------------------
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

// ----------------------   General   ---------------------------
let submit_property = document.getElementById("property_form");

property_form.addEventListener('submit', function(event){

    let amenities=[];
    let amenities_table = table.getElementsByTagName('tr');
    for (let i = 0; i < amenities_table.length; i++) {
        amenities.push(amenities_table[i].getElementsByTagName('td')[0].innerHTML);
    }

    let agenda=[];
    let agenda_table = atable.getElementsByTagName('tr');
    for (let i = 0; i < agenda_table.length; i++) {
        let agenda_from = agenda_table[i].getElementsByTagName('td')[0].innerHTML;
        let agenda_to = agenda_table[i].getElementsByTagName('td')[1].innerHTML;
        agenda.push([agenda_from, agenda_to]);
    }

    let amenities_final = document.getElementById('amenities_array');
    let agenda_final = document.getElementById('agenda_array');

    amenities_final.setAttribute('value', JSON.stringify(amenities));
    agenda_final.setAttribute('value', JSON.stringify(agenda));
})

// ----------------------   Loading   ---------------------------

let editProperty = document.getElementById('editProperty');

window.onload = function(event){
    for (let i = 0; i < amenities_array_var.length; i++) {
        let amenity = document.createElement('tr');
        let name = document.createElement('td');
        name.innerHTML = amenities_array_var[i]['nome'];

        let button = document.createElement('td');
        let input_button = document.createElement('input');
        input_button.setAttribute("type", "button");
        input_button.setAttribute("class", "remove");
        input_button.setAttribute("value", " X ");
        button.appendChild(input_button);

        input_button.addEventListener('click', function(){
            table.removeChild(amenity);
        })

        amenity.appendChild(name);
        amenity.appendChild(button);
        
        table.append(amenity);
    }

    for (let i = 0; i < agenda_array.length; i++) {
        let agenda = document.createElement('tr');
        let from = document.createElement('td');
        from.innerHTML = agenda_array[i][0];
        let to = document.createElement('td');
        to.innerHTML = agenda_array[i][1];
    
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
    }
};