Array.prototype.combinations = function(p) {
    var combs, head, tailcombs;

    if (p > this.length || p <= 0) {
        return [];
    }

    if (p == this.length) {
        return [this];
    }

    if (p == 1) {
        combs = [];
        for (i = 0; i < this.length; i++) {
            combs.push([this[i]]);
        }
        return combs;
    }

    combs = [];
    for (var i = 0; i < this.length - p + 1; i++) {
        head = this.slice(i, i+1);
        tailcombs = this.slice(i + 1).combinations(p - 1);
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

Array.prototype.arrangements = function(p) {
    var combinations = this.combinations(p);
    var arrangements = [];
    combinations.forEach(function(combination) {
        var ps = combination.permutations();
        ps.forEach(function(p) {
            arrangements.push(p);
        });
    });
    return arrangements.sort();
};
