import axios from "axios"

// axios.defaults.baseURL = 'https://127.0.0.1:8000/api'
//axios.defaults.headers.common['Authorization'] = AUTH_TOKEN
axios.defaults.headers.post['Content-Type'] = 'application/json'

export default axios
