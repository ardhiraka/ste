let SMS = {
    data: '',
    pattern: {
        '...'   : ';',
        '..'    : ' ',
        ',,,'   : ';',
        ',,'    : ';',
        'x'  	: '@',
        'X'     : '@',
        // '/'     : '@',
        'NJ1'	 : '01.10',
        'NJ2'	 : '02.11.20',
        'NJ3'	 : '03.12.21.30',
        'NJ4'	 : '04.13.22.31.40',
        'NJ5'	 : '05.14.23.32.41.50',
        'NJ6'	 : '06.15.24.33.42.51.60',
        'NJ7'	 : '07.16.25.34.43.52.61.70',
        'NJ8'	 : '08.17.26.35.44.53.62.71.80',
        'NJ9'	 : '09.18.27.36.45.54.63.72.81.90',
        'shio01' : '01.13.25.37.49.61.73.85.97',
        'shio02' : '02.14.26.38.50.62.74.86.98',
        'shio03' : '03.15.27.39.51.63.75.87.99',
        'shio04' : '04.16.28.40.52.64.76.88.00',
        'shio05' : '05.17.29.41.53.65.77.89',
        'shio06' : '06.18.30.42.54.66.78.90',
        'shio07' : '07.19.31.43.55.67.79.91',
        'shio08' : '08.20.32.44.56.68.80.92',
        'shio09' : '09.21.33.45.57.69.81.93',
        'shio10' : '10.22.34.46.58.70.82.94',
        'shio11' : '11.23.35.47.59.71.83.95',
        'shio12' : '12.24.36.48.60.72.84.96',
        'UK0'	 : '00.01.02.03.04.05.06.07.08.09',
        'UK1'	 : '10.11.12.13.14.15.16.17.18.19',
        'UK2'	 : '20.21.22.23.24.25.26.27.28.29',
        'UK3'	 : '30.31.32.33.34.35.36.37.38.39',
        'UK4'	 : '40.41.42.43.44.45.46.47.48.49',
        'UK5'	 : '50.51.52.53.54.55.56.57.58.59',
        'UK6'	 : '60.61.62.63.64.65.66.67.68.69',
        'UK7'	 : '70.71.72.73.74.75.76.77.78.79',
        'UK8'	 : '80.81.82.83.84.85.86.87.88.89',
        'UK9'	 : '90.91.92.93.94.95.96.97.98.99',
        'UE0'	 : '00.10.20.30.40.50.60.70.80.90',
        'UE1'	 : '01.11.21.31.41.51.61.71.81.91',
        'UE2'	 : '02.12.22.32.42.52.62.72.82.92',
        'UE3'	 : '03.13.23.33.43.53.63.73.83.93',
        'UE4'	 : '04.14.24.34.44.54.64.74.84.94',
        'UE5'	 : '05.15.25.35.45.55.65.75.85.95',
        'UE6'	 : '06.16.26.36.46.56.66.76.86.96',
        'UE7'	 : '07.17.27.37.47.57.67.77.87.97',
        'UE8'	 : '08.18.28.38.48.58.68.78.88.98',
        'UE9'	 : '09.19.29.39.49.59.69.79.89.99'
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
        hformat: new RegExp("^([JPTS]{1})$"),
        bbformat: new RegExp("^BB([2-4]+);([0-9]{4})@([0-9]+)$"),
        bbsformat: new RegExp("^BBS;([0-9]{4})@([0-9]+)$"),
        headformat: new RegExp("^([A-Za-z0-9;\/.]+)@([0-9]+)$"),
        default: [';', '@']
    },
    code: {
        available: ['CM', 'CN', 'J', 'P', 'T', 'S', 'C', 'M', 'H', 'N/A'],
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
        this.objects = this.data.split('..').join(" ").trim(" ").split(" ");

        return this.objects;
    },
    replace() {
        let app     = this;
        let objects = [];

        this.getObjects().forEach(item => {
            Object.entries(app.pattern).forEach(([search, change]) => {
                item = item.split(search).join(change);
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
            let fullText, theCode, theLoop, thePrice, thePerm;

            if (app.format.bbsformat.test(item)) {
                [fullText, theLoop, thePrice] = app.format.bbsformat.exec(item);

                let loopData = [];
                [2, 3, 4].forEach(number => {
                    let thisPerm = theLoop.split('').permutation(number);
                    loopData.push(thisPerm);
                });

                app.parsing(item, 'N/A', loopData.join('.'), thePrice, 'filtered');
            } else if (app.format.full.test(item)) {
                [fullText, theCode, theLoop, thePrice] = app.format.full.exec(item);

                app.parsing(item, theCode, theLoop, thePrice, 'filtered');
            } else if (app.format.short.test(item)) {
                [fullText, theCode, thePrice] = app.format.short.exec(item);

                app.parsing(item, theCode, theLoop, thePrice, 'filtered');
            } else if (app.format.ncode.test(item)) {
                [fullText, theLoop, thePrice] = app.format.ncode.exec(item);

                app.parsing(item, 'N/A', theLoop, thePrice, 'filtered');
            } else if (app.format.bbformat.test(item)) {
                [fullText, thePerm, theLoop, thePrice] = app.format.bbformat.exec(item);

                let loopData = theLoop.split('').permutation(thePerm);

                app.parsing(item, 'N/A', loopData, thePrice, 'filtered');
            } else if (app.format.headformat.test(item)) {
                [fullText, theCode, thePrice] = app.format.headformat.exec(item);

                let theHead = theCode.split('/');
                let isHeadFormat = new RegExp("^([A-Za-z]+);([0-9]{1,4}(?:\\.[0-9]{1,4})*)$");
                let dHeads = [];
                let dNumbs = [];
                let hCount = {};
                let isCorrect = true;

                theHead.forEach(item => {
                    if (isHeadFormat.test(item)) {
                        [ifull, iHead, iNum] = isHeadFormat.exec(item);
                        dHeads.push(iHead);
                        dNumbs.push(iNum.split('.'));
                    } else {
                        dHeads.push('number');
                        dNumbs.push(item.split('.'));
                    }
                });

                dHeads.forEach(function(i) { hCount[i] = (hCount[i] || 0) + 1;});

                if (hCount.number >= 2 && dHeads.length >= 3) {
                    isCorrect = false;
                } else if (dHeads[0] == 'A') {
                    let isKpExist = dHeads.includes('Kp');

                    if (!isKpExist || hCount.number != 1) {
                        isCorrect = false;
                    }
                } else if (dHeads[0] == 'Kp') {
                    if (!hCount.hasOwnProperty('number') || hCount.number > 2) {
                        isCorrect = false;
                    }
                }

                if (isCorrect) {
                    app.parsing(item, 'N/A', dNumbs.treePath(), thePrice, 'filtered');
                } else {
                    app.filtered.inCorrect.push(item);
                }
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
            } else if (theCode == 'H') {
                if (this.format.hformat.test(index[1])) {
                    this.addToCorrect(theItem, theLoop, theCode, thePrice, property);
                } else {
                    this.addToInCorrect(theItem, property);
                }
            } else if (theCode in ['BB2', 'BB3', 'BB4']) {
                console.log('BB');
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
                    ? code == 'M' || code == 'H'
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
            let item        = code == 'M' || code == 'H'
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
                    } else if (theCode == 'H') {
                        let userChoice  = app.parseChiperText(Object.values(split[1]), 'H');
                        let theNumber   = app.parseChiperNumber(Object.values(app.specialNumber.toString().slice(2)), 'H');

                        theNumber[0].includes(userChoice[0]) ? result[format].win.push(split[1]) : result[format].lose.push(split[1]);
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
    parseChiperText(text, theCode = 'M') {
        let data = [];
        
        if (theCode == 'M') {
            for (let i = 0; i < text.length; i += 2) {
                data.push([this.code.unique[text[i]], this.code.unique[text[i + 1]]])
            }
        } else if (theCode == 'H') {
            data.push(this.code.unique[text[0]]);
        }
        
        return data;
    },
    parseChiperNumber(number, theCode = 'M') {
        let data = [];

        if (theCode == 'M') {
            for (let i = 0; i < number.length; i++) {
                let iNumber         = number[i];
                let stringOddEven   = iNumber % 2 ? 'odd' : 'even';
                let stringBigSmall  = iNumber < 5 ? 'small' : 'big';

                data.push([stringOddEven, stringBigSmall]);
            }
        } else if (theCode == 'H') {
            let theNumber       = number[0] + number[1];
            let stringOddEven   = theNumber % 2 ? 'odd' : 'even';
            let stringBigSmall  = theNumber < 5 ? 'small' : 'big';

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
