import Request from '../Http/Request';
import UserService from './UserService';

/**
 * classe que gerencia os serviços referente ao usuário
 */
class AuthService extends Request{

  /**
   * envia uma requisição
   *
   * @param {*} username
   * @param {*} password
   */
  login(username, password) {
    return new Promise((res, rej) => {
      this.http().post('/auth/login', { username, password })
      .then(response => {

        let loginData = response.data;

        try {
          UserService.setUser(loginData)
          .then(() => {
            res(loginData);
          });
        } catch (error) {
          console.log(error);
          rej(error);
        }

      })
      .catch(response => {
        let status = response.response.status;
        let error = response.response.data.error;

        if(status === 401) {
          rej(error);
        }
      });
    })
  }

  /**
   * envia uma requisição para criação de um novo
   * registro de usuário.
   *
   * @param {*} data
   */
  register(data) {
    return this.http().post('/auth/register', data);
  }

  verify() {
    return new Promise((res, rej) => {
      this.http().get('/auth/user')
      .then(response => {
        console.log(response.data);
      })
      .catch(() => {
        rej({ error: 'usuário não autenticado' })
      })
    });
  }
}

export default new AuthService();
