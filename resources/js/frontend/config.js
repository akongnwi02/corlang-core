/*
	Defines the API route we are using.
*/
let api_url = '';

/*
  Depending on the environment, define the API URL.
*/
switch( process.env.NODE_ENV ){
    case 'development':
        api_url = 'https://iat-server.herokuapp.com/admin';
        break;
    case 'production':
        api_url = 'https://iat-server.herokuapp.com/admin';
        break;
}

/*
  Export the IAT URL configuration.
*/
export const IAT_CONFIG = {
    API_URL: api_url,
};
