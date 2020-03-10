/*
    GET 	/admin/business/payment/{slug}
*/

export default {
    quote: function(data){

        let params = {};

        params.destination = data.destination; // destination account number (e.g Mobile money number)
        params.destination_code = data.destination_code; // identifier of destination
        params.amount = data.amount; // amount
        params.currency_code = data.currency_code; // currency code
        params.items = data.items; // optional array of items

        return axios.post('/api/quote', params);
    },

    pay: function (data) {
        let params = {};

        params.name = data.name; // customer name
        params.phone = data.phone; // customer phone
        params.email = data.email; // customer email
        params.address = data.address; // customer address
        params.reference = data.reference; // special reference provided by customer
        params.source = data.source; // payment method account number
        params.source_code = data.source_code; // identifier of payment method
    }
}
