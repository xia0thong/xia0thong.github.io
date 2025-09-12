let button = document.getElementById('justin-btn');
let result = document.getElementById("result");

// Task 1
// Add an event listner to the button (the user drags his mouse over the button)
button.addEventListener("mouseover", function () {
    result.innerText = "Welcome to My Heart";
    result.style.backgroundColor = "pink";
    result.style.color = "blue";
});

// Task 2
// Add an event listner to the button (the user drags his mouse out of the button)
button.addEventListener("mouseout", function () {
    result.innerText = "Don't Leave Me Please";
    result.style.backgroundColor = "black";
    result.style.color = "red";
});

// using onmouseover and onmouseout

// function func1() {
//     // called when the user mouve over
//     let result_div = document.getElementById("result");

//     // backgroundColor
//     result_div.style.backgroundColor = "pink";

//     // textColor
//     result_div.style.color = "blue";

//     // innertext
//     result_div.innerText = "Welcome to My Heart";
// }

// function func2() {
//     // called when the user mouve out
//     let result_div = document.getElementById("result");

//     // backgroundColor
//     result_div.style.backgroundColor = "black";

//     // textColor
//     result_div.style.color = "red";

//     // innertext
//     result_div.innerText = "Don't Leave Me Please";
// }