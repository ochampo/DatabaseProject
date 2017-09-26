var _chart4_plot_properties;
$(document).ready(function(){ 
_chart4_plot_properties = {
  "title":{
    "text":"Filled Line Plot with Stroked Line and Custom Fill Color","show":1
  },"axes":{
    "xaxis":{
      "pad":1,"properties":"xaxis"
    }
  },"animate":true,"animateReplot":true,"seriesDefaults":{
    "fill":true,"fillAndStroke":true,"showMarker":false,"shadow":false,"fillColor":"rgb(220,202,110)"
  }
}



$.jqplot.config.enablePlugins = true;
$.jqplot.config.defaultHeight = 300;
$.jqplot.config.defaultWidth  = 400;
 _chart4= $.jqplot("chart4", [[1,4,3,2,5,9,9,5,8,3,2,9,2,10,5,6]], _chart4_plot_properties);


});
