/*
	Imports the IAT API URL from the config.
*/
import { IAT_CONFIG } from '../config.js';

export default {
    /*
        GET 	/admin/business/landlord
    */
    getLandlords: function(params){
        return axios.get( '/admin/business/landlord/api', {params: params });
    },

    downloadLandlords: function (filterString) {
        // return axios.get();
        window.open('/admin/business/landlord/api/download?' + filterString);
    },

    /*
        GET 	/admin/business/landlord/{slug}
    */
    getLandlord: function( slug ){
        return axios.get('/admin/business/landlord/api/' + slug );
    },

}
