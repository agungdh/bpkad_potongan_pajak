Alpine.data('form', () => ({
    formData: {
        skpd: '',
        bidang: '',
    },
    validationErrors: {},

    async initData(uuid) {
        let res = await axios.get(`/bidang/${uuid}`);
        let data = res.data;

        data.skpd = data.skpd.uuid;

        for (let key in this.formData) {
            if (data.hasOwnProperty(key)) {
                this.formData[key] = data[key];
            }
        }

        $('#skpd').val(data.skpd).change();
    },

    async submit() {
        let formData = new FormData();

        for (let key in this.formData) {
            formData.append(key, this.formData[key]);
        }

        try {
            if (uuid) {
                formData.append('_method', 'PUT');

                await axios.post(`/bidang/${uuid}`, formData);
            } else {
                await axios.post('/bidang', formData);
            }

            window.location.href = '/bidang';
        } catch (err) {
            if (err.response?.status === 422) {
                this.validationErrors = err.response.data.errors ?? {};
            } else {
                toastr.error('Terjadi kesalahan sistem. Silahkan refresh halaman ini. Jika error masih terjadi, silahkan hubungi Tim IT.');
            }
        }
    },
}));
