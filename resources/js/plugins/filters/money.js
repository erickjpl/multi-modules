import Vue from 'vue'

export default Vue.filter('money', (value) => {
    // We get cents, and return a formatted dollar amount.
    //
    // neither Intl.NumberFormat nor toLocaleString
    // seems to be working, so doing a nasty hacky thing
    // return '$' + (value / 100).toLocaleString({
    //     style: 'currency',
    //     currency: 'USD',
    //     minimumFractionDigits: 2,
    //     maximumFractionDigits: 2,
    // });

    /* function reverse(str) {
        return str.split('').reverse().join('');
    }

    function num2str(num) {
        var str = num+"";
        return reverse(reverse(str).replace(/\d{3}/g,'$&,').replace(/\,$/,''));
    }

    const ds = (num2str(value / 100)+'.00').split('.');

    return '$' + ds[0] + '.' + (ds[1]+'00').substring(0,2); */
    
    return `$ ${value}`;
})