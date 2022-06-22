// #region Product Filter
var products = [];
const productfilter = () => {
    products = [];
    document.querySelectorAll(`.productfilter_item`).forEach(filter => {
        if(filter.checked == true) {
            products.push(filter.name);
            document.querySelectorAll(`.prodcat_${filter.value}`).forEach(product => {
                product.classList.add('filtered');
            });
        }
        else {
            document.querySelectorAll(`.prodcat_${filter.value}`).forEach(product => {
                product.classList.remove('filtered');
            });
        }
    })
    remove_non_filtered();
}

const remove_non_filtered = () => {
    document.querySelectorAll('.product').forEach(product => {
        if (products[0] !== undefined) {
            if (product.classList[2] !== "filtered") {
                document.getElementById(product.id).style.display = "none";
                document.querySelector(`.resetfilterdiv`).style.display = "block";
            }
            else {
                document.getElementById(product.id).style.display = "block";
            }
        }
        else {
            document.getElementById(product.id).style.display = "block";
            document.querySelector(`.resetfilterdiv`).style.display = "none";
        }
    })
}
const resetfilter = () => {
    products = [];
    remove_non_filtered();
    document.querySelectorAll(`.productfilter_item`).forEach(filter => {
        filter.checked = false;
    })
}

// #endregion

// #region Title
var titles = [
    "Van Duren Mechanics",
    "De Metaalspecialist",
    "De beste kwaliteit",
    "Van Duren"
];

var i = -1;
setInterval(function(){
    i++;
    document.title = titles[i];
    if (i == (titles.length -1)) {
        i = -1;
    }
  }, 5000);
// #endregion
