 

  Highcharts.setOptions({
      lang: {
            drillUpText: '< 返回 “{series.name}”'
      }
});

   var width = $("#map").css("width");
   width = parseInt(width.substring(0,width.indexOf("px")));
   console.log(width);
var map = null,
      geochina = 'https://data.jianshukeji.com/jsonp?filename=geochina/';
$.getJSON(geochina + 'china.json&callback=?', function(mapdata) {
      var data = [];
      // 随机数据
      Highcharts.each(mapdata.features, function(md, index) {
            var tmp = {
                  name: md.properties.name,
                  value: Math.floor((Math.random() * 100) + 1) // 生成 1 ~ 100 随机值
            };
            if(md.properties.drilldown) {
                  tmp.drilldown = md.properties.drilldown;
            }
            data.push(tmp);
      });
      map = new Highcharts.Map('map', {
            chart: {
                  events: {
                        drilldown: function(e) {
                              this.tooltip.hide();
                              console.log(e);
                              // 异步下钻
                              if (e.point.drilldown) {
                                    var pointName = e.point.properties.fullname;
                                    // map.showLoading('下钻中，请稍后...');
                                    // 获取二级行政地区数据并更新图表
                                    $.getJSON(geochina +   e.point.drilldown + '.json&callback=?', function(data) {
                                          data = Highcharts.geojson(data);
                                          Highcharts.each(data, function(d) {
                                                if(d.properties.drilldown) {
                                                      d.drilldown = d.properties.drilldown;
                                                }
                                                d.value = Math.floor((Math.random() * 100) + 1); // 生成 1 ~ 100 随机值
                                          });
                                          map.hideLoading();
                                          map.addSeriesAsDrilldown(e.point, {
                                                name: e.point.name,
                                                data: data,
                                                dataLabels: {
                                                      enabled: true,
                                                      format: '{point.name}'
                                                }
                                          });
                                          map.setTitle({
                                                text: pointName
                                          });
                                    });
                              }
                        },
                        drillup: function() {
                              map.setTitle({
                                    text: '中国'
                              });
                        }
                  }
            },
            title: {
                  text: '中国地图'
            },
            subtitle: {
                  useHTML: true,
                  text: ''
            },

         //设置功能
            mapNavigation: {
                  enabled: true,
                        enableTouchZoom: false ,// 在开启导航器的情况下关闭移动端手势操作
                  buttonOptions: {
                        verticalAlign: 'bottom'
                  }
            },

            tooltip: {
                  useHTML: true,
                  headerFormat: '<table ><tr><td>{point.name}</td></tr>',
                  pointFormat: '<tr><td>全称</td><td>{point.properties.fullname}</td></tr>' +
                  '<tr><td>行政编号:</td><td>{point.properties.areacode}</td></tr>' +
                  '<tr><td>父级:</td><td>{point.properties.parent}</td></tr>' +
                  '<tr><td>经纬度:</td><td>{point.properties.longitude},{point.properties.latitude}</td></tr>' +
                  '<tr><td>商品数量:</td><td>{这里放数据}</td></tr>'+
                        '<tr><td>发货数量:</td><td>16</td></tr>'+
                        '<tr><td>经销商数量:</td><td>88</td></tr>'+
                        '<tr><td>收货数量:</td><td>{min}</td></tr>'+
                        '<tr><td>商品数量:</td><td>{max}</td></tr>',
                  footerFormat: '</table>',


               //
                  positioner: function () {
                     return { x: 0.73 * width, y: 250 };
                  }
            },

         //这里是下条栏数据显示
         //     colorAxis: {
         //         min: 0,
         //         minColor: 'Beige',
         //         maxColor: 'PowDerBlue',
         //         labels:{
         //             style:{
             //                "background color":"Ivory", "color":"LightSkyBlue","fontWeight":"bold"
         //             }
         //         }
         //     },


            colorAxis: {
                min: 0,
            max: 100,
                minColor: 'rgb(255,255,255)',
                maxColor: '#006cee',
                labels:{
                               style:{
                                   "background color":"Ivory", "color":"LightSkyBlue","fontWeight":"bold"
                               }
                           }
            },
         //显示地图省份
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.properties.fullname}'
                        //map.showLoading('下钻中，请稍后...')
                    }
                }
            },
         series: [{
                  data: data,
                  mapData: mapdata,
                  joinBy: 'name',
                  name: '中国地图',
                  states: {
                        hover: {
                              color: 'Turquoise'
                        }
                  }
            }]

      });
});