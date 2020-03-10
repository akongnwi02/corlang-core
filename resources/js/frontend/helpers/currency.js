export const currency = {
    format(amount, currency) {

        return new Intl.NumberFormat('en-US', {style: 'currency', currency: currency}).format(amount);

        // return amount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' ' + currency;
    }
};
