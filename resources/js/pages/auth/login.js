Alpine.data('form', () => ({
    formData: {
        username: '',
        password: '',
    },
    validationErrors: {},
    isSubmitting: false,

    async submit() {
        try {
            this.isSubmitting = true;

            let res = await axios.post('/login', this.formData);

            window.location.href = res.data;
        } catch (err) {
            if (err.response?.status === 422) {
                toastr.error('Username atau password salah');
            } else {
                toastr.error('Terjadi kesalahan saat mengirim data');
            }
        } finally {
            this.isSubmitting = false;
        }
    },
}));
