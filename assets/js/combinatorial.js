Array.prototype.combinations = function(number) {
    var combs, head, tailcombs;

    if (number > this.length || number <= 0) return [];

    if (number == this.length) return [this];

    if (number == 1) {
        combs = [];

        for (i = 0; i < this.length; i++) {
            combs.push([this[i]]);
        }

        return combs;
    }

    combs = [];

    for (var i = 0; i < this.length - number + 1; i++) {
        head = this.slice(i, i+1);
        tailcombs = this.slice(i + 1).combinations(number - 1);

        for (var j = 0; j < tailcombs.length; j++) {
            combs.push(head.concat(tailcombs[j]));
        }
    }
    return combs;
};

Array.prototype.permutations = function() {
    if (this.length === 0) {
        return [[]];
    }

    var result = [];

    for (var i = 0; i < this.length; i++) {
        var copy = Object.create(this);
        var head = copy.splice(i, 1);
        var rest = copy.permutations();

        for (var j = 0; j < rest.length; j++) {
            var next = head.concat(rest[j]);
            result.push(next);
        }
    }

    return result;
};

Array.prototype.arrangements = function(number) {
    var combinations = this.combinations(number);
    var arrangements = [];

    combinations.forEach(function(combination) {
        var ps = combination.permutations();

        ps.forEach(function(number) {
            arrangements.push(number);
        });
    });

    return arrangements.sort();
};

Array.prototype.permutation = function(number) {
    var permutations    = this.arrangements(number);
    var converts        = [];

    permutations.forEach(function(data) {
        converts.push(data.join(''));
    })

    return converts.join('.');
}

Array.prototype.treePath = function() {
    let array   = this;
    let result  = [];

    function recursive(node = 0, prefix = []) {
        let rootData    = array[node];
        let nextNode    = node + 1;

        if (typeof rootData != 'undefined') {
            for (let i = 0; i < rootData.length; i++) {
                recursive(nextNode, prefix.concat([rootData[i]]));
            }
        } else {
            result.push(prefix.join(''));
        }
    }

    for (let i = 0; i < (this.length - 1); i++) {
        array = this.slice(i);
        recursive();
    }

    return result.join('.');
}
