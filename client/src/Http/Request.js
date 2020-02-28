import axios from 'axios';

import apiConfig from './../config/api';

class Request {

  http() {
    return axios.create(apiConfig);
  }

}

export default Request;
