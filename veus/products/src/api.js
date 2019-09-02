const apiUrl = 'http://localhost:8000/api/v1';
const token = 'api_token=65pkcPKezxE2hDMsO6l6jWzwuUyM8ze1oAQVTl18EdijSBCiN0ZsXr9eSSj9';
document.title = "Veus Products 1.0";
export default {
  products: apiUrl+'/products',
  'token': token
}