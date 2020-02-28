import Storage from 'js-storage';

class UserService {

  constructor() {
    this.storage = Storage.sessionStorage;
  }

  setUser(user) {
    return new Promise((res, rej) => {
      if (this.storage.set(user)) {
        res({ message: 'usuário criado com sucesso' });
      }
      else
      {
        rej({ message: 'erro ao criar a sessão do usuário.' });
      }
    })
  }

  destroy() {
    this.storage.removeAll(true);
  }
}

export default new UserService();
