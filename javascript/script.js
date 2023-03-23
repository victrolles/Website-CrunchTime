// When scan is successful fucntion will produce data
function onScanSuccess(qrCodeMessage) {
  // document.getElementById("result").innerHTML =
  //   '<span class="result">' + qrCodeMessage + "</span>";
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "./php/idValidation.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        console.log(xhr.responseText);
      } else {
        console.error('Error: ' + xhr.status);
      }
    }
  };
  xhr.send("id=" + qrCodeMessage);
}

// When scan is unsuccessful fucntion will produce error message
function onScanError(errorMessage) {
  // Handle Scan Error
}

// Setting up Qr Scanner properties
var html5QrCodeScanner = new Html5QrcodeScanner("reader", {
  fps: 10,
  qrbox: 250
});

// in
html5QrCodeScanner.render(onScanSuccess, onScanError);