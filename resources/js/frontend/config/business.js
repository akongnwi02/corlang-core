export const BUSINESS_CONFIG = {

    CACHE_EXPIRATION: 24 * 60 * 60 * 1000, // 24 hours

    CATEGORY_PREPAID_BILLS_CODE: 'CORPREPAID001',
    CATEGORY_POSTPAID_BILLS_CODE: 'CORPOSTPAID001',

    SERVER_STORAGE_PATH: '/storage',

    APP_REGEX_AMOUNT: /^(?:\d{1,3}(?:,\d{3})+|\d+)(?:\.\d+)?$/,

    // PUSHER
    PUSHER_APP_ID: '963072',
    PUSHER_APP_KEY: 'd1c75a6922f8d392931f',
    PUSHER_APP_SECRET: 'a797bfbb0928413f1164',
    PUSHER_APP_CLUSTER: 'eu',
    PUSHER_APP_FORCE_TLS: false,
    PUSHER_APP_TRANSACTION_EVENT: '.transaction-complete',

    // Transaction Status
    TRANSACTION_SUCCESSFUL: 'success',
    TRANSACTION_FAILED: 'failed',
};
