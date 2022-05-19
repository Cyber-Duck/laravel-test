require('axios');

// request to API to calculate cost
const getSellerCost = event => {
    event.preventDefault();
    const typeVal = type.value;
    const QuantityVal = quantity.value;
    const unitCostVal = unitCost.value;

    if(typeVal && QuantityVal && unitCostVal){
        recordSaleButton.disabled = true
        axios.post(
            `/api/calculate-cost/${typeVal}`,
            {
                'unit_price': unitCostVal,
                'quantity': QuantityVal
            }
        )
        .then(response => {
            sellersCost.value = response.data.toFixed(2);
            recordSaleButton.disabled = false;
        })
        .catch(error => alert(error)); // A flash alert would be more useful here if I had more time.
    }
}

// Get sellers price based on input changes via AJAX.
const type = document.querySelector('#selectCoffeeType');
const quantity = document.querySelector('#quantity');
const unitCost = document.querySelector('#unit_cost');
const sellersCost = document.querySelector('.selling-price');
const recordSaleButton = document.querySelector('#record_sale_button');
const createSaleForm = document.querySelector('#create_sale_form');

type.addEventListener('change', event => {
    getSellerCost(event);
});

quantity.addEventListener('input', event => {
    getSellerCost(event);
});

unitCost.addEventListener('input', event => {
    getSellerCost(event);
});

document.addEventListener('submit', () => {
    recordSaleButton.disabled = true;
});
