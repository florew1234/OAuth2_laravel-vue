import axios from 'axios'
const auth = {
  Headers: {
    'content-type': 'application/json'
  }
}

export async function userLogin(email, password) {
  const requestOptions = {
    email: email,
    password: password
  }
  const response = await axios.post('http://127.0.0.1:8000/api/login', requestOptions, { auth })
  const result = await response.data
}

export async function userRegister(name, email, password, password_confirmation) {
  const requestOptions = {
    name: name,
    email: email,
    password: password,
    password_confirmation: password_confirmation
  }

  const response = await axios.post('http://127.0.0.1:8000/api/register', requestOptions, { auth })
  const result = await response.data
}

export async function userlogout(id) {
  const response = await axios.post('http://127.0.0.1:8000/api/logout', id)
  const result = await response.data
}
