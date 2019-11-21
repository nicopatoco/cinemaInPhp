function multiply() {
    a = Number(document.getElementById('QTY').value);
    b = Number(document.getElementById('PPRICE').value);
    c = a * b;
    d=0;

    if(a > 2)
    {
        d = c * 0.15;
        c = a * b - d;
    }

    document.getElementById('TOTAL').value = c;
    document.getElementById('DISCOUNT').value = d;
}