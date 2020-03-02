/*
    GET 	/admin/business/payment/{slug}
*/

export default {
    quote: function(data){

        let params = {};

        params.destination = data.destination; // destination account number (e.g Mobile money number)
        params.destination_code = data.destination_code; // identifier of destination
        params.source = data.source; // payment method account number
        params.source_code = data.source_code; // identifier of payment method
        params.amount = amount; // amount
        params.currency_code = data.currency_code; // currency code
        params.reference = data.reference; // special reference provided by customer
        params.is_prepaid = data.is_prepaid; // prepaid or post paid service
        params.name = data.name; // customer name
        params.phone = data.phone; // customer phone
        params.email = data.email; // customer email
        params.address = data.address; // customer address

        return axios.get('/api/quote', {params: params});
    },
}
