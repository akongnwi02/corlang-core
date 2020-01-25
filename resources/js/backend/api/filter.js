/*
	Imports the IAT API URL from the config.
*/

export default {
    /*
        GET 	/admin/business/filter
    */
    getFilters: function(){
        return axios.get('/admin/business/filter/api');
    },

}
