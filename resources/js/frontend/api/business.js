export default {
    quote: function (data) {

        let params = {};
        params.destination = data.destination; // destination account number (e.g Mobile money number)
        params.service_code = data.service_code; // identifier of destination
        params.amount = data.amount; // amount
        params.currency_code = data.currency_code; // currency code
        params.account = data.account; // payment method account number
        params.paymentmethod_code = data.paymentmethod_code; // identifier of payment method
        params.items = data.items; // optional array of items

        params.name = data.name; // customer name
        params.phone = data.phone; // customer phone
        params.email = data.email; // customer email
        params.address = data.address; // customer address
        params.reference = data.reference; // special reference provided by customer

        return axios.post('/api/quote', params);
    },

    confirm: function (data) {

        let params = {};
        params.quote_id = data.id; // id of the quote

        return axios.post('/api/confirm', params);
    },

    configuration: function(){
        return axios.get('/api/configuration');
    }
}
