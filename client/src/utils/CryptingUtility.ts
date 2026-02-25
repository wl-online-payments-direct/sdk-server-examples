const generateRandomString = (length = 36) => {
    // for older browsers
    return typeof crypto !== 'undefined' && crypto.randomUUID
        ? crypto.randomUUID()
        : Math.random().toString(length).slice(2, 11);
};

export default { generateRandomString };
