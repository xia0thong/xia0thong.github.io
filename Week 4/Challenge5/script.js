let score = 0;
let matchedPairs = 0;
let totalPairs = 0;
let firstCard = null;
let secondCard = null;
let lockBoard = false;

function generate_board() {

    //============================================================================
    // Task 1
    // Retrieve the friend name(s) from the 'friends' multi-select dropdown menu
    //============================================================================

    // Array to contain the names of user-selected friend(s)
    // For example, if the user selected 'Darryl' and 'Yin Kit',
    //   this array's value will be:
    //      [ 'darryl', 'yinkit' ]
    //

    let friends = [];
    let selectElement = document.getElementById('friends');
    
    for (let selectOption of selectElement.options) {
        if (selectOption.selected) {
            friends.push(selectOption.value);
        }
    }

    // Display user's selection in Developer Tools --> Console.
    console.log(friends);

    // Reset state
    score = 0;
    matchedPairs = 0;
    firstCard = null;
    secondCard = null;
    lockBoard = false;
    document.getElementById('game-score').textContent = 'Total Score: 0';

    //============================================================================
    // Task 2
    // Given one or more selected friends and given 4 fruit names,
    //   generate a 'randomized' Array of finalized card names.
    // 
    // Card names are as follows:
    //    apple_brandon.png
    //    banana_brandon.png
    //    kiwi_brandon.png
    //    orange_brandon.png
    //
    // where 'brandon' can be replaced with another friend's name,
    // e.g.
    //    apple_nick.png
    // (and so on)
    //
    // Display all 4 fruit cards of one or more selected friends.
    //
    // NOTE: Each card must be displayed TWO and ONLY TWO times (thus, a "pair")
    //       (such that the user can attempt to 'match').
    //
    // Check out this utility function (declared at the bottom of this file)
    //   for randomizing the order of Array elements.
    //        shuffleArray()
    //============================================================================
    const fruits = ['apple', 'banana', 'kiwi', 'orange'];

    let allCards = [];

    for (let i = 0; i < friends.length; i++) {
        let friend = friends[i];

        for (let j = 0; j < fruits.length; j++) {
            let fruit = fruits[j];
            let cardFile = fruit + "_" + friend + ".png";

            allCards.push(cardFile);
            allCards.push(cardFile);
        }
    }

    let shuffledDeck = shuffleArray(allCards);
    totalPairs = allCards.length / 2;

    //============================================================================
    // Task 3
    // Display the cards in <div id="game-board">
    //
    // For this, we will make use of Template Literal (using backticks).
    //
    // NOTE: The game board will always have 4 columns and N rows, where N denotes
    //       (number of selected friends) x 2.
    //
    //       For example, if I chose 'Brandon', 'Darryl', and 'Nick' (3 friends),
    //         then the newly generated game board will be
    //         6 (rows) by 4 (columns).
    //============================================================================
    const num_cols = fruits.length;
    const num_rows = friends.length * 2;

    console.log("# of columns: " + num_cols)
    console.log("# of rows: " + num_rows);

    let idx = 0;
    let html = '<table style="border-collapse:collapse;margin:auto"><tbody>';

    for (let r = 0; r < num_rows; r++) {
        html += '<tr>';
        for (let c = 0; c < num_cols; c++) {
            let file = shuffledDeck[idx++];
            html += `
        <td style="padding:10px; text-align:center;">
          <img class="card"
               src="cards/hidden.png"
               data-file="${file}">
        </td>`;
        }
        html += '</tr>';
    }
    html += '</tbody></table>';

    // Replace placeholder sample with the generated board
    result_str = html;

    // DO NOT MODIFY THE FOLLOWING
    // Replace the innerHTML of <div id="game-board">
    //   with a newly prepared HTML string (result_str).
    document.getElementById('game-board').innerHTML = result_str;

    // Click handlers
    let cards = document.querySelectorAll('#game-board img.card');

    for (let i = 0; i < cards.length; i++) {
        cards[i].addEventListener('click', onCardClick);
    };
}

function flipCard(img) {
    img.src = 'cards/' + img.dataset.file;
}
function hideCard(img) {
    img.src = 'cards/hidden.png';
}

function onCardClick(e) {
    let img = e.currentTarget;

    if (lockBoard) {
        return
    };
    if (img.classList.contains('matched')) {
        return
    };
    if (img === firstCard) {
        return
    };

    flipCard(img);

    if (!firstCard) {
        firstCard = img;
        return;
    }

    secondCard = img;
    lockBoard = true;

    let isMatch = firstCard.dataset.file === secondCard.dataset.file;

    if (isMatch) {
        score += 1;
        matchedPairs += 1;
        firstCard.classList.add('matched');
        secondCard.classList.add('matched');
        firstCard.style.opacity = '0.5';
        secondCard.style.opacity = '0.5';
        document.getElementById('game-score').textContent = 'Total Score: ' + score;

        firstCard = null;
        secondCard = null;
        lockBoard = false;

        if (matchedPairs === totalPairs) {
            document.getElementById('game-score').textContent = 'All Matched, Congratulations!';
        }
    }
    else {
        setTimeout(function () {
            hideCard(firstCard);
            hideCard(secondCard);
            firstCard = null;
            secondCard = null;
            lockBoard = false;
        }, 2000);
    }
}

// Utility Function
// DO NOT MODIFY
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]]; // Swap elements
    }
    return array;
}
