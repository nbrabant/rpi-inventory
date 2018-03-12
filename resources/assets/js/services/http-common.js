
module.exports = axios.create({
    baseURL: 'api/',
    headers: {
        Authorization: 'Bearer {token}'
    }
})
