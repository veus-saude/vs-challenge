import Storage from 'js-storage';

const storage = Storage.localStorage;
const token = storage.get('access_token');

export default {
  baseURL: 'http://localhost/api/v1',
  timeout: 4000,
  headers: {
    'Authorization': `Bearer ${token}`
  }
}
