var images = ['penguin1.bpm', 'penguin2.bpm'];

var input;

var listlen;

window.onload = function() {
    var select = document.getElementById("selectnewimage");
    
    for (var i=0; i< images.length; i++) {
        var opt = images[i];
        var el = document.createElement("option");
        
        el.textContent = opt;
        el.value = opt;
        select.appendChild(el);
        listlen = i;
    }
    
}

function update() {
    listlen += 1;
    var select = document.getElementById("selectnewimage");
    var opt = images[listlen];
    var el = document.createElement("option");
    el.textContent = opt;
    el.value = opt;
    select.appendChild(el);
}

function myFunction() {
    var x = document.getElementById("myText").value;
    document.getElementById("demo").innerHTML = x;
    document.getElementById("array").innerHTML = images;
    images.push(x);
    document.getElementById("new_array").innerHTML = images;
    update();
    document.getElementById("listlength").innerHTML = listlen;
}