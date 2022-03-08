<html>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <!--<script src="plotly-2.9.0.min.js"></script>
-->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>
    <body>
    <div class="navbar"><span>Slider tester</span></div>
    <div class="wrapper">
    <input id="slider" value="0" type="range" min="0" max="100" step="1"> <!--
       oninput="console.log(this.value)" onchange="console.log(this.value)"> -->

        <div id="chart"></div>

        <div class="modes">
          <div class="mtoprow">
              <input type="button" id="mode1" value="Mode1" onclick="changeMode(parseInt(1));">
          </div>

        </div>

        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script>

          function changeMode(mode){

            if (mode == 0) {
              return 0
            } else if (mode == 1){
              console.log(mode);
              driver = parseInt(50);
            };
          };

          function getData() {
            console.log(document.getElementById("slider").value + driver);
            return document.getElementById("slider").value;
          };

          let driver = 0;

            let power = getData();

            var layout = {
              title: 'Power over time',
              showlegend: false
            };

            Plotly.newPlot('chart',[{
                y:[(getData() + driver)],
                type:'line'}],
                layout, {staticPlot: true}
            );

            var cnt = 1;

            setInterval(function(){

                Plotly.extendTraces('chart',{ y:[[getData()]]}, [0]);
                cnt++;
                if(cnt > 100) {
                    Plotly.relayout('chart',{
                        xaxis: {
                            range: [cnt-100,cnt]
                        }
                    });
                }
            },10);
        </script>

        <script type="text/javascript">
        // Mode 1 changemode

        let x = 0;

        function mode1(x){

            setTimeout(function(){
              //x++;
              let x = (Math.pow(cnt,2) * -1) + 100
              if (x <= 0) {
                cnt = 0;
                return 0;
              } else {
                document.getElementById("slider").value = x;
              }

              if (x < 100){
                mode1(x)}

            }, 1000);
          };
        </script>
    </div>
    </body>
</html>
