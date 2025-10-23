import Alpine from 'alpinejs';
import axios from 'axios';
import Swal from 'sweetalert2';
import toastr from 'toastr';
window.Alpine = Alpine;
window.axios = axios;
window.Swal = Swal;
window.toastr = toastr;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.emptySelectWithPlaceholder = (element, placeholder) => {
    element.empty();
    element.append(new Option(placeholder, ''));
};

window.emptySelectWithPlaceholderAndInit = (element, placeholder, value = '') => {
    emptySelectWithPlaceholder(element, placeholder);
    element.val(value).change();
};

window.selectWithDataset = (element, placeholder, data) => {
    emptySelectWithPlaceholder(element, placeholder);

    for (let i = 0; i < data.length; i++) {
        element.append(new Option(data[i].bidang, data[i].uuid));
    }
};

window.selectWithDatasetAndInit = (element, placeholder, data, value = '') => {
    selectWithDataset(element, placeholder, data);

    element.val(value).change();
};
