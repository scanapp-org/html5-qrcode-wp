function onScanSuccess(decodedText, decodedResult) {
    // handle the scanned code as you like, for example:
    console.log(`Code matched = \${decodedText}`, decodedResult);
}

function onScanFailure(error) {
    // handle scan failure, usually better to ignore and keep scanning.
    // for example:
    console.warn(`Code scan error = \${error}`);
}

// Note: If you change the DOM element id here (example: "html5_qrcode_reader")
// Also, change this in ../html5-qrcode-wp.php.
let html5QrcodeScanner = new Html5QrcodeScanner(
    "html5_qrcode_reader",
    // TODO(mebjas): Load all these values using data arguments in DOM element.
    { fps: 10, qrbox: {width: 250, height: 250} },
    /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);