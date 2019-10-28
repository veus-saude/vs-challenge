const jsonParse = (value) => {
    try {
        return JSON.parse(value);
    } catch (e) {
        return {};
    }
};

const stringfy = (value) => {
    try {
        return JSON.stringify(value);
    } catch (e) {
        return '{}';
    }
};

const getLocalStorage = (key) => {
    const localStorage = window.localStorage;
    let sgStorage = localStorage.getItem('sgStorage');
    if (!sgStorage) {
        sgStorage = {};
        localStorage.setItem('sgStorage', '{}');
    } else {
        sgStorage = jsonParse(sgStorage);
    }

    if (key && sgStorage[key]) {
        return sgStorage[key];
    }
    return sgStorage;
};

const setLocalStorage = (key, value) => {
    const localStorage = window.localStorage;
    const sgStorage = getLocalStorage();
    sgStorage[key] = value;
    localStorage.setItem('sgStorage', stringfy(sgStorage));
};

export default { jsonParse, stringfy, getLocalStorage, setLocalStorage };