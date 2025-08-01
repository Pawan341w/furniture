<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Scan QR Code</title>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f9f9f9;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
    }

    h2 {
      color: #202124;
      margin-bottom: 30px;
    }

    #scanButton {
      background-color: #1a73e8;
      color: white;
      border: none;
      border-radius: 50%;
      width: 80px;
      height: 80px;
      font-size: 36px;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s;
    }

    #scanButton:hover {
      background-color: #1669c1;
    }

    .material-icons {
      font-size: 36px;
    }

    #reader {
      margin-top: 30px;
      width: 700px;
      max-width: 100%;
      display: none;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    #result {
      margin-top: 20px;
      font-size: 16px;
      color: #555;
    }
  </style>
</head>
<body>

  <h2>Scan QR Code</h2>

  <button id="scanButton" title="Start QR Scanner">
    <span class="material-icons">qr_code_scanner</span>
  </button>

  <div id="reader"></div>
  <div id="result">Tap the button to start scanning</div>

  <script>
    let qrScanner;

    document.getElementById("scanButton").addEventListener("click", function () {
      this.style.display = "none"; // hide button after click
      document.getElementById("reader").style.display = "block";
      document.getElementById("result").innerText = "Scanning...";

      const reader = new Html5Qrcode("reader");

      Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
          let backCam = devices.find(device =>
            device.label.toLowerCase().includes('back') ||
            device.label.toLowerCase().includes('environment')
          );
          const cameraId = backCam ? backCam.id : devices[0].id;

          reader.start(
            cameraId,
            {
              fps: 10,
              qrbox: 600
            },
            qrMessage => {
              document.getElementById("result").innerText = "Scanned: " + qrMessage;

              reader.stop().then(() => {
                window.location.href = qrMessage;
              }).catch(err => {
                console.error("Stop error:", err);
              });
            },
            errorMessage => {
              // silent on scan error
            }
          ).catch(err => {
            console.error("Start failed: ", err);
            document.getElementById("result").innerText = "Unable to access camera.";
          });

        } else {
          document.getElementById("result").innerText = "No camera found.";
        }
      }).catch(err => {
        console.error("Camera error: ", err);
        document.getElementById("result").innerText = "Camera access failed.";
      });
    });
  </script>

</body>
</html>
