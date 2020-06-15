export default {
    quote: function (data) {

        let params = {};
        params.destination = data.destination; // destination account number (e.g Mobile money number)
        params.service_code = data.service_code; // identifier of destination
        params.amount = data.amount; // amount
        params.currency_code = data.currency_code; // currency code
        params.items = data.items; // optional array of items

        params.auth_payload = data.auth_payload;

        params.name = data.name; // customer name
        params.phone = data.phone; // customer phone
        params.email = data.email; // customer email
        params.address = data.address; // customer address

        return axios.post('/api/quote', params);
    },

    confirm: function (data) {

        let params = {};
        params.quote_id = data.id; // id of the quote

        return axios.post('/api/confirm', params);
    },

    configuration: function(){
        return axios.get('/api/configuration');
    },

    transactions: function () {
        return axios.get('/api/transaction');
    },

    account: function () {
        return axios.get('/api/account');
    },

    payout: function (data) {
        let params = {};
        params.paymentmethod_code = data.paymentmethod_code;
        params.currency_code = data.currency_code;
        params.amount = data.amount;
        params.name = data.name;
        params.account = data.account;

        return axios.post('/api/payout', params);
    },

    getPayouts: function () {
        return axios.get('/api/payout');
    },

    cancelPayout: function (uuid) {
        return axios.patch(`/api/payout/${uuid}/cancel`);
    },

    transaction: function (uuid) {
        return axios.get('/api/transaction/' + uuid);
    },

    deleteTransaction: function (uuid) {
        return axios.delete('/api/transaction/' + uuid);
    }
}
