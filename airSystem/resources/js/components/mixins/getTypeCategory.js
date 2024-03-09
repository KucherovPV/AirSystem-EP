export default {
    methods: {
        getType(typeCategory) {
            return axios.get(`/api/type/${typeCategory}`)
                .then(response => {
                    return response.data;
                })
                .catch(err => {
                console.error(err);
            })
        },
    },
} ;
