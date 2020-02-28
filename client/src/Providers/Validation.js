import { extend } from 'vee-validate';

class Validation {
  init() {
    this.rules();
  }

  rules() {
    extend('required', {
      validate(value){
        return {
          required: true,
          valid: ['', null, undefined].indexOf(value) === -1,
        }
      },
      message: 'este campo é obrigatório',
      computesRequired: true,
    });

    extend('email', {
      validate(value) {
        return {
          valid: ['@', '.'].indexOf(value) === -1,
        }
      },
      message: 'você não digitou um e-mail válido',
    })
  }
}

export default new Validation();
