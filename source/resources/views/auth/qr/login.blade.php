<html>
<head>
    <style>

        canvas {
            padding-left: 0;
            padding-right: 0;
            margin-left: auto;
            margin-right: auto;
            display: block;
            width: 50%;
        }

    </style>
</head>
<body>
    <div id="app">
        <div style="text-align:center;font-size:35px;">QRコードを読みとって自動ログインできます</div>
        <br>
        <canvas id="canvas"></canvas>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.min.js"></script>
    <script src="/js/jsQR/dist/jsQR.js"></script>
    <script>

        new Vue({
            el: '#app',
            data: {
                video: null,
                canvas: null,
                context: null,
                uuid: '',
                completed: false
            },
            computed: {
                hasUuid() {

                    return (this.uuid !== '');

                }
            },
            methods: {
                renderFrame() {

                    requestAnimationFrame(this.renderFrame);   // 描画を繰り返す

                    if(!this.hasUuid && !this.completed) { // まだQRコードが読み込まれていない場合

                        const video = this.video;
                        const canvas = this.canvas;
                        const context = this.context;

                        if(video.readyState === video.HAVE_ENOUGH_DATA) {

                            canvas.height = video.videoHeight;
                            canvas.width = video.videoWidth;
                            context.drawImage(video, 0, 0, canvas.width, canvas.height);
                            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                            const code = jsQR(imageData.data, imageData.width, imageData.height);
                            
                            if(code) {
                                this.uuid = code.data;
                                axios.post('/auth/qr_login', { uuid: this.uuid })
                                    .then((response) => {
                                        
                                        // console.log(response);
                                        const result = response.data.result;
                                        const user = response.data.user;
                                        if(result) {
                                            console.log(result);
                                            console.log(user);
                                            this.completed = true;
                                            alert('「'+ user.name +'」さん、おはようございます！');
                                            // location.href = '/user'; // ここでリダイレクト

                                        } else {

                                            console.log('ログイン失敗..');

                                        }

                                    })
                                    .catch((error) => {})
                                    .then(() => {

                                        this.uuid = '';

                                    });

                            }

                        }

                    }

                }
            },
            mounted() {

                this.video = document.createElement('video');
                this.canvas = document.getElementById('canvas');
                this.context = this.canvas.getContext('2d');

                navigator.mediaDevices.getUserMedia({ video: true })
                    .then((stream) => {

                        this.video.srcObject = stream;
                        this.video.play();
                        requestAnimationFrame(this.renderFrame);

                    });

            }
        });

    </script>
</body>
</html>
