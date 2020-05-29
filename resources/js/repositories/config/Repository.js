import axios from 'axios'

const BASE_URL = process.env.MIX_APP_URL

export default axios.create({
    BASE_URL,
    // headers: {},
    timeout: 5000
})
