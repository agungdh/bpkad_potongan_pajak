Alpine.data('form', () => ({
    formData: {
        skpd: '',
    },
    validationErrors: {},

    async initData(uuid) {
        let res = await axios.get(`/skpd/${uuid}`);
        let data = res.data;

        for (let key in this.formData) {
            if (data.hasOwnProperty(key)) {
                this.formData[key] = data[key];
            }
        }
    },

    async submit() {
        let formData = new FormData();

        for (let key in this.formData) {
            formData.append(key, this.formData[key]);
        }

        try {
            if (uuid) {
                formData.append('_method', 'PUT');

                await axios.post(`/skpd/${uuid}`, formData);
            } else {
                await axios.post('/skpd', formData);
            }

            window.location.href = '/skpd';
        } catch (err) {
            if (err.response?.status === 422) {
                this.validationErrors = err.response.data.errors ?? {};
            } else {
                toastr.error('Terjadi kesalahan sistem. Silahkan refresh halaman ini. Jika error masih terjadi, silahkan hubungi Tim IT.');
            }
        }
    },
}));
