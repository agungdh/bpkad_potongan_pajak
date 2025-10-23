Alpine.data('form', () => ({
    formData: {
        nip: '',
        nama: '',
        skpd: '',
        bidang: '',
        password: '',
        password_confirmation: '',
    },
    validationErrors: {},

    async initData() {
        let res = await axios.post(`/profil`);
        let data = res.data;

        data.skpd = data.skpd.skpd;
        data.bidang = data.bidang.bidang;

        for (let key in this.formData) {
            if (data.hasOwnProperty(key)) {
                this.formData[key] = data[key];
            }
        }
    },

    async submit() {
        try {
            await axios.put('/profil', this.formData);

            window.location.href = '/profil';
        } catch (err) {
            if (err.response?.status === 422) {
                this.validationErrors = err.response.data.errors ?? {};
            } else {
                toastr.error('Terjadi kesalahan sistem. Silahkan refresh halaman ini. Jika error masih terjadi, silahkan hubungi Tim IT.');
            }
        }
    },
}));
