function calculate() {

    // YOUR CODE GOES HERE
    let first_num = document.getElementById("number1").value;
    let sec_num = document.getElementById("number2").value;
    let result = document.getElementById("result");
    first_num = Number(first_num)
    sec_num = parseInt(sec_num)


    if (first_num < sec_num) {
        start = first_num;
        end = sec_num;
    } else {
        start = sec_num;
        end = first_num;
    }

    let sum = 0;
    for (let i = start; i <= end; i++) {
        sum += i;
    }

    result.innerText = "The sum is: " + sum;
    return sum;

}