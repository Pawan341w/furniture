    <footer class="footer">
 <div id="scanTrigger" class="scan-trigger">

<img
  src="{{ asset('assets/images/icons/scan.png') }}"
  alt="Scan QR Code"
  style="width: 35px; height: 35px; cursor: pointer;"
  id="scanTrigger"
/></div>

<div id="scanOverlay" class="scan-overlay" style="display: none;">
    <div id="scannerContainer" class="scanner-container">
        <div id="reader"></div>
        <div id="result" class="scan-result">Scanning...</div>
    </div>
</div>


            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025 <a href="https://waplia.com/" target="_blank">Waplia</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
        </div>
      </div>
    </div>

  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    let reader;

    const scanButton = document.getElementById("scanTrigger");
    const overlay = document.getElementById("scanOverlay");
    const resultBox = document.getElementById("result");

    scanButton.addEventListener("click", function () {
        scanButton.style.display = "none"; // hide icon
        overlay.style.display = "flex";    // show modal
        resultBox.innerText = "Scanning...";

        reader = new Html5Qrcode("reader");

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                let backCam = devices.find(device =>
                    device.label.toLowerCase().includes('back') ||
                    device.label.toLowerCase().includes('environment')
                );
                const cameraId = backCam ? backCam.id : devices[0].id;

                reader.start(
                    cameraId,
                    { fps: 10, qrbox: 250 },
                    qrMessage => {
                        resultBox.innerText = "Scanned: " + qrMessage;

                        reader.stop().then(() => {
                            overlay.style.display = "none";
                            scanButton.style.display = "block"; // show icon again
                            window.location.href = qrMessage;
                        });
                    },
                    errorMessage => {
                        // silently ignore
                    }
                ).catch(err => {
                    resultBox.innerText = "Camera access failed.";
                });
            } else {
                resultBox.innerText = "No camera found.";
            }
        }).catch(err => {
            resultBox.innerText = "Camera access failed.";
        });
    });

    // Close scanner when clicking outside the scanner box
    overlay.addEventListener("click", function (e) {
        if (e.target === overlay) {
            overlay.style.display = "none";
            scanButton.style.display = "block";
            if (reader) {
                reader.stop().catch(() => {});
            }
        }
    });
</script>


    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/jquery.cookie.js"></script>
    <script src="../assets/js/dashboard.js"></script>


    @yield('script')

  </body>

</html>
