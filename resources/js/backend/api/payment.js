/*
	Imports the IAT API URL from the config.
*/

export default {
    /*
        GET 	/admin/business/payment
    */
    getPayments: function(params){
        return axios.get( '/admin/business/payment/api', {params: params });
    },

    downloadPayments: function (filterString) {
        // return axios.get();
        window.open('/admin/business/payment/api/download?' + filterString);
    },

    /*
        GET 	/admin/business/payment/{slug}
    */
    getPayment: function( slug ){
        return axios.get('/admin/business/payment/api/' + slug );
    },

}
