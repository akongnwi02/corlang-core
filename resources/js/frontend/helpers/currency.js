export const currency = {
    format(amount, currency) {

        return amount + ' ' + currency;
        // return new Intl.NumberFormat('en-US', {style: 'decimal', currency: currency}).format(amount);

    }
};
