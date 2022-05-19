require('axios');

const changeShippingCostBtn = document.querySelector('#change_shipment_cost_button');

document.addEventListener('submit', (event) => {
    changeShippingCostBtn.disabled = true;
});
