function forceNumber(e) {
    var keyCode = e.keyCode ? e.keyCode : e.which;
    if((keyCode < 48 || keyCode > 58) && keyCode != 188) {
        return false;
    }
    return true;
}

function numberWithCommas(n){
    n = n.replace(/,/g, "");
    var s=n.split('.')[1];
    (s) ? s="."+s : s="";
    n=n.split('.')[0];
    while(n.length>3){
        s=","+n.substr(n.length-3,3)+s;
        n=n.substr(0,n.length-3)
    }
    return n+s;
}