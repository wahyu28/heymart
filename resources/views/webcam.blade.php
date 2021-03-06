<html>

<head>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" id="aku" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-6">
            <video id="preview" width="100%"></video>
        </div>
        <div class="col-md-6">
            <label>SCAN QR CODE</label>
            <input type="text" name="text" id="text" readonyy="" placeholder="scan qrcode" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    <div class="container">
        <div class="row">
            
        </div>
    </div>

    <script>
        document.getElementById("aku").onclick = function() {myFunction()};

        function myFunction() {
            let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
            Instascan.Camera.getCameras().then(function(cameras){
                if(cameras.length > 0 ){
                    scanner.start(cameras[0]);
                } else{
                    alert('No cameras found');
                }

            }).catch(function(e) {
                console.error(e);
            });

            scanner.addListener('scan',function(c){
                document.getElementById('text').value=c;
            });
        }
        

    </script>
</body>

</html>