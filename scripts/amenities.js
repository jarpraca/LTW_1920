'use strict'

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
