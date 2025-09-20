/* Task 6 - API call */
function get_all_drinks() {
    console.log("[START] get_all_drinks()");

    const api_endpoint_url = 'http://localhost/DrinksAPI/api/drink/read.php'; // local file
    const api_endpoint_root = 'http://localhost/DrinksAPI/';



    axios.get(api_endpoint_url).
        then(response => {
            console.log("Axios call completed successfully!");
            // console.log(response.data.drinks);
            // console.log(response.data.records)

            let section_results = document.getElementById('results');

            // Build a string of Bootstrap cards
            let result_str = ``;
            let drinks_array = response.data.records; // Array of drink objects
            // console.log(drinks_array); // Array of drink objects

            /*
            loop through drinks_array
            - each item is a drink
            - each drink should be a bootstrap card, each card will be a "col"
            */

            // Task 4 - Display Drinks
            //   Each drink is a Bootstrap card
            // Replace all the hard-coded strings with actual values as read from the JSON file

            for (let drink of drinks_array) { // drink is an Object

                console.log(drink);
                // http://localhost/DrinksAPI/photos/vrwquq1478252802.jpg
                result_str += `
                    <div class="col">
                        <div class="card h-100">
                            <img src="${api_endpoint_root}${drink.photo_url}" 
                                 class="card-img-top"
                                 alt="${drink.name}">
                            <div class="card-body">
                                <h5 class="card-title">
                                    ${drink.name}
                                </h5>
                                <p class="card-text small text-muted mb-0">
                                    ${drink.category} • ${drink.alcoholic}
                                </p>
                            </div>
                        </div>
                    </div>
                `;
            }

            // console.log(result_str);

            // Inject the cards into the #results section
            section_results.innerHTML = result_str;
        }).
        catch(error => {
            // console.log(error.message);

            // Task 5 - Data can't be loaded, display alert
            //   "Failed to load drinks data."
            // YOUR CODE GOES HERE
            document.getElementById("alerts").innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        Failed to load drinks data.
                    </div>
                    `;

        });

    console.log("[END] get_all_drinks()");
}


/* Task 7 - Category Dropdown Menu */
function populate_category_dropdown() {
    console.log("[START] populate_category_dropdown()");

    const api_endpoint_url = 'http://localhost/DrinksAPI/api/drink/category.php'; // API endpoint

    axios.get(api_endpoint_url).
        then(response => {

            console.log("Axios call completed successfully!");

            // YOUR CODE GOES HERE
            let select = document.getElementById('category');
            let payload =
                (response.data && (response.data.records || response.data.categories)) ||
                response.data ||
                [];

            let categories = [];
            if (Array.isArray(payload)) {
                for (let item of payload) {
                    if (typeof item === 'string') {
                        categories.push(item);
                    } else if (item && typeof item === 'object') {
                        if (item.category) categories.push(item.category);
                        else if (item.name) categories.push(item.name);
                    }
                }
            }

            const uniqueSorted = [...new Set(
                categories
                    .filter(Boolean)
                    .map(c => String(c).trim())
            )].sort((a, b) => a.localeCompare(b));

            // Build a Set of existing option values to avoid duplicates on re-run
            let existingValues = new Set(Array.from(select.options).map(o => o.value));

            // Append options
            for (let cat of uniqueSorted) {
                if (existingValues.has(cat)) continue;
                let opt = document.createElement('option');
                opt.value = cat;
                opt.textContent = cat;
                select.appendChild(opt);
            }


        }).
        catch(error => {
            console.log(error.message);
        });

    console.log("[END] populate_category_dropdown()");
}


/* Task 8 - Category Dropdown Event Listener */
function render_drink_cards(drinksArray) {
    const api_endpoint_root = 'http://localhost/DrinksAPI/';
    const section_results = document.getElementById('results');

    let result_str = '';
    for (let drink of drinksArray) {
        result_str += `
      <div class="col">
        <div class="card h-100">
          <img src="${api_endpoint_root}${drink.photo_url}"
               class="card-img-top"
               alt="${drink.name}">
          <div class="card-body">
            <h5 class="card-title">${drink.name}</h5>
            <p class="card-text small text-muted mb-0">
              ${drink.category} • ${drink.alcoholic}
            </p>
          </div>
        </div>
      </div>`;
    }
    section_results.innerHTML = result_str;
}

function handleCategoryChange(e) {
    const selected = e.target.value; // "" means All
    const alerts = document.getElementById('alerts');
    const results = document.getElementById('results');

    // Clear any previous alerts
    alerts.innerHTML = '';

    if (!selected) {
        // Show all drinks again
        get_all_drinks();
        return;
    }

    results.innerHTML = '<div class="col"><div class="text-muted small">Loading…</div></div>';
    const api_search_url = `http://localhost/DrinksAPI/api/drink/search.php?c=${encodeURIComponent(selected)}`;

    axios.get(api_search_url)
        .then(response => {
            const drinks = (response.data && (response.data.records || response.data.drinks)) || [];

            if (!Array.isArray(drinks) || drinks.length === 0) {
                results.innerHTML = '';
                alerts.innerHTML = `
          <div class="alert alert-warning" role="alert">
            No drinks found in the “${selected}” category.
          </div>`;
                return;
            }

            render_drink_cards(drinks);
        })
        .catch(err => {
            console.log(err.message);
            results.innerHTML = '';
            alerts.innerHTML = `
        <div class="alert alert-danger" role="alert">
          Failed to load drinks for the selected category.
        </div>`;
        });
}

document.getElementById('category').addEventListener('change', handleCategoryChange);


/* Task 9 - Alcoholic Dropdown Event Listener */
function handleAlcoholicChange(e) {
    const selected = e.target.value;
    const alerts = document.getElementById('alerts');
    const results = document.getElementById('results');
    const api_search_url = `http://localhost/DrinksAPI/api/drink/search.php?a=${encodeURIComponent(selected)}`;

    alerts.innerHTML = '';

    if (!selected) {
        get_all_drinks();
        return;
    }

    axios.get(api_search_url)
        .then(response => {
            const drinks = (response.data && (response.data.records || response.data.drinks)) || [];

            if (!Array.isArray(drinks) || drinks.length === 0) {
                results.innerHTML = '';
                alerts.innerHTML = `
          <div class="alert alert-warning" role="alert">
            No drinks found in the “${selected}” alcoholic.
          </div>`;
                return;
            }

            render_drink_cards(drinks);
        })
        .catch(err => {
            console.log(err.message);
            results.innerHTML = '';
            alerts.innerHTML = `
        <div class="alert alert-danger" role="alert">
          Failed to load drinks for the selected alcoholic.
        </div>`;
        });
}

document.getElementById('alcoholic').addEventListener('change', handleAlcoholicChange);


/* Task 10 - Name search input Event Listener */
function debounce(fn, delay = 300) {
    let timer;
    return function (...args) {
        clearTimeout(timer);
        timer = setTimeout(() => fn.apply(this, args), delay);
    };
}

function handleNameInput(e) {
    const q = e.target.value.trim();
    const alerts = document.getElementById('alerts');
    const results = document.getElementById('results');

    alerts.innerHTML = '';

    if (!q) {
        get_all_drinks();
        return;
    }

    results.innerHTML = '<div class="col"><div class="text-muted small">Searching…</div></div>';

    const api_search_url = `http://localhost/DrinksAPI/api/drink/search.php?n=${encodeURIComponent(q)}`;

    axios.get(api_search_url)
        .then(response => {
            let drinks = (response.data && (response.data.records || response.data.drinks)) || [];

            drinks = drinks.filter(d => String(d.category || '').toLowerCase() === 'cocktail');

            if (!Array.isArray(drinks) || drinks.length === 0) {
                results.innerHTML = '';
                alerts.innerHTML = `
          <div class="alert alert-warning" role="alert">
            No cocktail drinks found with “${q}”.
          </div>`;
                return;
            }

            render_drink_cards(drinks);
        })
        .catch(err => {
            console.log(err.message);
            results.innerHTML = '';
            alerts.innerHTML = `
        <div class="alert alert-danger" role="alert">
          Failed to search drinks by name.
        </div>`;
        });
}

document.getElementById('name_search').addEventListener('input', debounce(handleNameInput, 300));



// DO NOT MODIFY THE BELOW LINES
get_all_drinks();
populate_category_dropdown();