let SMS = {
    data: '',
    pattern: {
        '...'   : ';',
        '..'    : ';',
        ',,,'   : ';',
        ',,'    : ';',
        'x'     : '@',
        '/'     : '@'
    },
    format: {
        full: new RegExp("^([a-zA-Z.]+);([0-9.]+)@([0-9]+)$"),
        short: new RegExp("^([a-zA-Z.]+)@([0-9]+)$"),
        ncode: new RegExp("^([0-9]{2,4}(?:\\.[0-9]{2,4})*)@([0-9]+)$"),
        loop: new RegExp("^[0-9]+(\\.[0-9]+)*$"),
        digit1: new RegExp("^[0-9]{1}(\\.[0-9]{1})*$"),
        digit2: new RegExp("^[0-9]{2}(\\.[0-9]{2})*$"),
        digit3: new RegExp("^[0-9]{3}(\\.[0-9]{3})*$"),
        mformat: new RegExp("^([JPTS]{2}(?:|[JPTS]{2}))$"),
        default: [';', '@']
    },
    code: {
        available: ['CM', 'CN', 'J', 'P', 'T', 'S', 'C', 'M', 'N/A'],
        head: ['AS', 'KP', 'K', 'C'],
        unique: {
            J: 'odd',
            P: 'even',
            T: 'big',
            S: 'small'
        },
        indexNumber: {
            J: 3,
            P: 3,
            T: 2,
            S: 2,
            C: {
                Head: {AS: 0, KP: 1, K: 2, E: 3}
            }
        }
    },
    number: {
        even: [0, 2, 4, 6, 8],
        odd: [1, 3, 5, 7, 9],
        big: [5, 6, 7, 8, 9],
        small: [0, 1, 2, 3, 4],
    },
    objects: [],
    replaced: [],
    messages: {
        correct: {},
        inCorrect: []
    },
    isFilter: false,
    filtered: {
        rawInCorrect: true,
        correct: [],
        inCorrect: []
    },
    specialNumber: 0,
    matchResult: {},
    setData(message) {
        this.restart();

        this.data = message;

        return this;
    },
    setNumber(number) {
        this.specialNumber = number;

        return this;
    },
    getObjects() {
        this.objects = this.data.split(' ');

        return this.objects;
    },
    replace() {
        let app     = this;
        let objects = [];

        this.getObjects().forEach(item => {
            Object.entries(app.pattern).forEach(([search, change]) => {
                item = item.replace(search, change);
            });
            
            objects.push(item);
        });

        app.replaced = objects;

        return objects;
    },
    filter() {
        let app = this;

        app.isFilter = true;

        this.replace().forEach(item => {
            let fullText, theCode, theLoop, thePrice;

            if (app.format.full.test(item)) {
                [fullText, theCode, theLoop, thePrice] = app.format.full.exec(item);

                app.parsing(item, theCode, theLoop, thePrice, 'filtered');
            } else if (app.format.short.test(item)) {
                [fullText, theCode, thePrice] = app.format.short.exec(item);

                app.parsing(item, theCode, theLoop, thePrice, 'filtered');
            } else if (app.format.ncode.test(item)) {
                [fullText, theLoop, thePrice] = app.format.ncode.exec(item);

                app.parsing(item, 'N/A', theLoop, thePrice, 'filtered');
            } else {
                app.filtered.inCorrect.push(item);
            }
        });

        app.objects = app.filtered.correct;

        return app;
    },
    parse() {
        let app = this;
        let objects;
      
        if (app.isFilter) {
            objects = app.objects;
        } else {
            objects = app.getObjects();
        }

        objects.forEach(item => {
            let fullText, theCode, theLoop, thePrice;

            if (app.format.full.test(item)) {
                [fullText, theCode, theLoop, thePrice] = app.format.full.exec(item);

                app.parsing(item, theCode, theLoop, thePrice);
            } else if (app.format.short.test(item)) {
                [fullText, theCode, thePrice] = app.format.short.exec(item);

                app.parsing(item, theCode, theLoop, thePrice);
            } else if (app.format.ncode.test(item)) {
                [fullText, theLoop, thePrice] = app.format.ncode.exec(item);

                app.parsing(item, 'N/A', theLoop, thePrice);
            } else {
                app.messages.inCorrect.push(item);
            }
        });
      
      return app;
    },
    parsing(theItem, theCode, theLoop, thePrice, property = 'messages') {
        let index   = theCode.split('.');
        theCode     = index[0].toUpperCase();
        let isJitu  = (index.length > 1 && theCode == 'C') ? true : false;
        let maxLoop = 999;

        if (this.code.available.includes(theCode)) {
            if (theCode in this.code.unique) {
                if (typeof theLoop != "undefined") {
                    this.addToInCorrect(theItem, property);
                } else {
                    let data = '';

                    if (property == 'messages') {
                        data = this.number[this.code.unique[theCode]];
                    }

                    this.addToCorrect(theItem, data, theCode, thePrice, property);
                }
            } else if (isJitu) {
                let theHead = isJitu ? index[1].toUpperCase() : false;

                if (this.code.head.includes(theHead)) {
                    this.mustHaveDigit(1, theItem, theCode + " " + theHead, theLoop, thePrice, property);
                } else {
                    this.addToInCorrect(theItem, property);
                }
            } else if (theCode == 'C') {
                this.mustHaveLoop(theItem, theCode, theLoop, thePrice, 1, 8, property);
            } else if (theCode == 'CM') {
                this.mustHaveLoop(theItem, theCode, theLoop, thePrice, 2, maxLoop, property);
            } else if (theCode == 'CN') {
                this.mustHaveLoop(theItem, theCode, theLoop, thePrice, 3, maxLoop, property);
            } else if (theCode == 'N/A') {
                this.addToCorrect(theItem, theLoop, theCode, thePrice, property);
            } else if (theCode == 'M') {
                if (this.format.mformat.test(index[1])) {
                    this.addToCorrect(theItem, theLoop, theCode, thePrice, property);
                } else {
                    this.addToInCorrect(theItem, property);
                }
            }
        } else {
            this.addToInCorrect(theItem, property);
        }
    },
    mustHaveDigit(digit, theItem, theCode, theLoop, thePrice, property = 'messages') {
        if (this.format['digit' + digit].test(theLoop)) {
            this.addToCorrect(theItem, theLoop, theCode, thePrice, property);
        } else {
            this.addToInCorrect(theItem, property);
        }
    },
    mustHaveLoop(theItem, theCode, theLoop, thePrice, digit = 1, maxLoop = 999, property = 'messages') {
        if (typeof theLoop == "undefined") {
            this.addToInCorrect(theItem, property);
        } else if (theLoop.split('.').length > maxLoop) {
            this.addToInCorrect(theItem, property);
        } else {
            this.mustHaveDigit(digit, theItem, theCode, theLoop, thePrice, property);
        }
    },
    addToCorrect(format, data, code, price, property = 'messages'){
        let app     = this;

        if (property == 'messages') {
            if (!app.messages.correct.hasOwnProperty(format)) {
                app.messages.correct[format] = [];
            }

            let items   = Array.isArray(data)
                ? data
                : typeof data == "undefined"
                    ? ['N/A']
                    : data.split('.');

            items.forEach(item => {
                let message = item == "N/A"
                    ? code == 'M'
                        ? app.searchCode(format, true).code + " " + app.searchCode(format, true).head + " " + price
                        : code + " " + price
                    : code == "N/A"
                        ? item + " " + price
                        : code + " " + item + " " + price;

                app.messages.correct[format].push(message);
            });
        } else if (property == 'filtered') {
            code = code.replace(' ', '.');
            let separator   = app.format.default;
            let item        = code == 'M'
                ? format
                : code == 'N/A'
                    ? data + separator[1] + price
                    : (typeof data == "undefined" || data == '')
                        ? code + separator[1] + price
                        : code + separator[0] + data + separator[1] + price;

            app.filtered.correct.push(item);
        }
    },
    addToInCorrect(item, property = 'messages') {
        if (property == 'messages') {
            this[property].inCorrect.push(item);
        } else {
            let theItem = this.filtered.rawInCorrect
                ? this.objects[this.replaced.indexOf(item)]
                : item;

            this[property].inCorrect.push(theItem);
        }
    },
    match() {
        let app = this;

        if (app.specialNumber) {
            let result      = {};
            let theSpecial  = app.specialNumber.toString();

            for (let format in app.messages.correct) {
                if (!result.hasOwnProperty(format)) {
                    result[format] = {
                        win: [],
                        lose: []
                    };
                }

                app.messages.correct[format].forEach(item => {
                    let split   = item.split(' ');
                    let theCode = Number.isInteger(parseInt(split[0])) ? 'N/A' : split[0];
                    let isHead  = theCode == 'C' && isNaN(parseInt(split[1])) ? true : false;
                    let theHead = isHead ? split[1] : false;
                    let theNumber = split[split.length - 2];

                    if (theCode == 'C') {
                        if (isHead) {
                            let number = theSpecial.charAt(app.code.indexNumber['C'].Head[theHead]);
                            number.includes(theNumber) ? result[format].win.push(theNumber) : result[format].lose.push(theNumber);
                        } else {
                            theSpecial.includes(theNumber) ? result[format].win.push(theNumber) : result[format].lose.push(theNumber);
                        }
                    } else if (theCode == 'CM' || theCode == 'CN') {
                        let arrayOfNumber = [];

                        for (var i = 0; i < theNumber.length; i++) {
                            arrayOfNumber.push(theSpecial.includes(theNumber.charAt(i)));
                        }

                        arrayOfNumber.every(isTrue => {return isTrue === true}) ? result[format].win.push(theNumber) : result[format].lose.push(theNumber);
                    } else if (theCode == 'M') {
                        let userChoice  = app.parseChiperText(Object.values(split[1]));
                        let theNumber   = app.parseChiperNumber(Object.values(app.specialNumber.toString().slice(2)));
                        let theMatch    = [];

                        let i = 0;
                        userChoice.forEach(item => {
                            let codeString      = split[1].slice(i, i + 2);
                            [index1, index2]    = item;
                            i1IsTrue = theNumber[0].includes(index1);
                            i2IsTrue = theNumber[1].includes(index2);
                            
                            theMatch[codeString] = i1IsTrue && i2IsTrue;

                            theMatch[codeString] ? result[format].win.push(codeString) : result[format].lose.push(codeString);
                            i += 2;
                        });
                    } else if (theCode == 'N/A') {
                        let alias = theNumber.length + 'd';

                        if (result[format].hasOwnProperty('win')) delete result[format].win;
                        if (result[format].hasOwnProperty('lose')) delete result[format].lose;

                        if (!result[format].hasOwnProperty(alias)) {
                            result[format][alias] = {win: [], lose: []};
                        }

                        theSpecial.includes(theNumber) ? result[format][alias].win.push(theNumber) : result[format][alias].lose.push(theNumber);
                    } else {
                        let index = app.code.indexNumber[theCode];

                        theSpecial.charAt(index).includes(theNumber) ? result[format].win.push(theNumber) : result[format].lose.push(theNumber);
                    }
                });
            }

            app.matchResult = result;
        } else {
            console.error('Anda harus menggunakan method setNumber() sebelum match()!');
        }
    },
    parseChiperText(text) {
        let data = [];
        
        for (let i = 0; i < text.length; i += 2) {
            data.push([this.code.unique[text[i]], this.code.unique[text[i + 1]]])
        }
        
        return data;
    },
    parseChiperNumber(number) {
        let data = [];

        for (let i = 0; i < number.length; i++) {
            let iNumber         = number[i];
            let stringOddEven   = iNumber % 2 ? 'odd' : 'even';
            let stringBigSmall  = iNumber < 5 ? 'small' : 'big';

            data.push([stringOddEven, stringBigSmall]);
        }

        return data;
    },
    searchCode(format, object = false) {
        let fullText, theCode, theLoop, thePrice;

        if (this.format.full.test(format)) {
            [fullText, theCode, theLoop, thePrice] = this.format.full.exec(format);
        } else if (this.format.short.test(format)) {
            [fullText, theCode, thePrice] = this.format.short.exec(format);
        } else if (this.format.ncode.test(format)) {
            theCode = 'N/A';
            [fullText, theLoop, thePrice] = this.format.ncode.exec(format);
        }

        let code = theCode.split('.');

        if (object) {
            return {
                code: code[0],
                head: code.length > 1 ? code[1] : false,
                full: code[0] + (code.length > 1 ? '.' + code[1] : '')
            }
        } else {
            return code[0];
        }
    },
    searchPrice(format) {
        let fullText, theCode, theLoop, thePrice;

        if (this.format.full.test(format)) {
            [fullText, theCode, theLoop, thePrice] = this.format.full.exec(format);
        } else if (this.format.short.test(format)) {
            [fullText, theCode, thePrice] = this.format.short.exec(format);
        } else if (this.format.ncode.test(format)) {
            [fullText, theLoop, thePrice] = this.format.ncode.exec(format);
        }

        return thePrice;
    },
    restart() {
        this.data                   = '';
        this.objects                = [];
        this.replaced               = [];
        this.messages.correct       = {};
        this.messages.inCorrect     = [];
        this.isFilter               = false;
        this.filtered.rawInCorrect  = true;
        this.filtered.correct       = [];
        this.filtered.inCorrect     = [];
        this.specialNumber          = 0;
        this.matchResult            = {};
    }
};
