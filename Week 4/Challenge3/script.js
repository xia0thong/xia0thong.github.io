// DO NOT MODIFY THIS FUNCTION SIGNATURE
function show(button_element) {
    /* TAs' photo files are inside the subfolder "photos/"
        - brandon.jpg
        - darryl.jpg
        - nick.jpg
        - yinkit.jpg
    */

    // Fun Facts of TAs
    const facts = {
        "brandon":
            "Outside of his time at SMU, Brandon plays in the English Premier League, where fans affectionately refer to him as 'Sonny.' Be sure to cheer for him the next time you catch him on TV!",

        "darryl":
            "Well, it's not Darryl's fault he was born handsome! Fans everywhere just can't resist him. If you spot him on campus, don't forget to shout 'Oppa Darryl!'",

        "nick":
            "Nick is a man of many talents and many secrets. As a freelance nuclear physicist for North Korea, the number of weapons of mass destruction he's been involved with... well, let's just say it's off the charts.",

        "yinkit":
            "Once upon a time, a kind-looking woman wandered the streets of Pyongyang, offering free water bottles to unsuspecting residents. Little did they know, the 'water' was actually poison. Now living in secret in Singapore, she once tried to poison her professor's kittens - who, against all odds, miraculously survived."
    }

    // YOUR CODE GOES BELOW
    let taKey = button_element.id;
    let factBox = document.getElementById("ta-fun-fact");
    let taPhoto = document.getElementById("ta-photo");
    let allButtons = document.getElementsByTagName('button');

    // Task 1
    factBox.textContent = facts[taKey];

    // Task 2
    switch (taKey) {
        case 'brandon':
            taPhoto.src = `photos/brandon.jpg`;
            break;
        case 'darryl':
            taPhoto.src = `photos/darryl.jpg`;
            break;
        case 'nick':
            taPhoto.src = `photos/nick.jpg`;
            break;
        case 'yinkit':
            taPhoto.src = `photos/yinkit.jpg`;
            break;
        default:
            taPhoto.src = `photos/default.jpg`;
    }

    // Task 3
    for (let btn of allButtons) {
        btn.style.backgroundColor = "darkblue";
        btn.style.color = "white";
    }

    button_element.style.backgroundColor = "aqua";
    button_element.style.color = "black";

}