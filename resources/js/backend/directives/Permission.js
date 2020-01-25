
export default {

    bind(el, binding) {
        return Laravel.permissions.indexOf(binding !== 1);
    },
};