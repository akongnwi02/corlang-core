export const helper = {
    handleException(error) {

        if (error.response.data.code == 401 || error.response.data.code == 403) {

            window.location.replace('/login')
        }
    },
};
