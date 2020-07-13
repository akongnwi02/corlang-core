export default {
    trigger: function (data) {

        let params = {};
        params.destination = data.destination; // destination account number (e.g Mobile money number)
        params.paymentmethod_code = data.paymentmethod_code; // identifier of payment method

        let uuid = data.uuid; // uuid of the order

        return axios.patch('/api/merchant/pay/' + uuid, params);
    },
}
