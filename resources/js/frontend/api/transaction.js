/*
	Imports the IAT API URL from the config.
*/

export default {
    /*
        GET 	/admin/business/transaction
    */
    getTransactions: function(params){
        return axios.get( '/admin/business/transaction/api', {params:params} );
    },

    downloadTransactions: function (filterString) {
        window.open('/admin/business/transaction/api/download?' + filterString);
    },
    /*
        GET 	/admin/business/transaction/{slug}
    */
    getTransaction: function( slug ){
        return axios.get( '/admin/business/transaction/api/' + slug );
    },
}
