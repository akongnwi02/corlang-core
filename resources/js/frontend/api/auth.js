export default {
    me: function () {
        return axios.get('/api/auth/me');
    }
}
