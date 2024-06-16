export default {
    methods: {
        getType(namespace = 'admin',typeCategory) {
            return axios.get(`/api/${namespace}/types/${typeCategory}`)
                .then(response => {
                    return response.data;
                })
                .catch(err => {
                    console.error(err);
                })
        },
        getData(url) {
            return axios.get(url)
                .then(response => {

                    return response.data;

                })
                .catch(err => {
                    console.error(err);
                })
        },
        async downloadFile(queryString) {
            try {
                const response = await fetch(`/api/operator/schedules/export/${queryString}`);
                const fileData = await response.json(); // Предполагается, что API возвращает JSON с данными файла в формате base64
                const blob = new Blob([this.base64ToArrayBuffer(fileData.base64)], {type: 'application/octet-stream'});
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'filename.xlsx');
                document.body.appendChild(link);
                link.click();
            } catch (error) {
                console.error('Error downloading file:', error);
            }
        },
        base64ToArrayBuffer(base64) {
            const binaryString = window.atob(base64);
            const len = binaryString.length;
            const bytes = new Uint8Array(len);
            for (let i = 0; i < len; i++) {
                bytes[i] = binaryString.charCodeAt(i);
            }
            return bytes.buffer;
        }
    },
};
