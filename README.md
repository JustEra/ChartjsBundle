# ChartjsBundle
Chart.js using charts with the canvas element in Symfony

Symfony 2 Bundle that allow us to add charts in our projects, using [Chart.js](http://www.chartjs.org/) library.

## How to use it

Install
-------
Coming soon
```
 php composer.phar require fados/ChartjsBundle
```

register he bundle inthe appKernel.php

```php
   new fados\ChartjsBundle\ChartjsBundle(),
```

Usage
-----

Configure you config.yml

```
chartjs:
    animation:
        duration: 1000
        easing: easeOutQuart
```

Register the routing in `app/config/routing.yml`:

``` yml
# app/config/routing.yml

fados_chartjs:
    resource: "@ChartjsBundle/Resources/Config/routing.xml"
```
The routing file only have Charts tests
http://localhost/xxx/web/app_dev.php/testchart/bar
http://localhost/xxx/web/app_dev.php/testchart/horizontalBar
http://localhost/xxx/web/app_dev.php/testchart/pie
http://localhost/xxx/web/app_dev.php/testchart/line
http://localhost/xxx/web/app_dev.php/testchart/doughnut
http://localhost/xxx/web/app_dev.php/testchart/polarArea

Publish the assets:

$ php app/console assets:install web

Add the required stylesheet and javascripts to your layout:

Javascript on top:    
```
    <script src="{{ asset('js/jquery.min.js') }}"></script>
```    
Javascript:
```
    <script src="{{ asset('bundles/charjsbundle/js/Chart.min.js') }}"></script>
```    
Then, in the template where you wish to display the Chart, add the following twig:

```
{{ chartjs_canvas('myPieChart',graphica.width,graphica.height,graphica) }}
```   
The first parameter is the Canvas id, its mandatory and must be unique, canvas Width, anvas Height and an array, graphica, with an special structure.

Array structure (fados\ChartjsBundle\Model\ChartBuiderData):
```
 $grafica = new ChartBuiderData();
        $graphica->setType(TypeCharjs::CHARJS_BAR);
        $graphica->setLabels(array('Barcelona','New York','Londres','Paris','Berlin','Tokio','El Cairo'));
        $graphica->setData(
          array(
              'Profit' => array(23,45,65,12,34,45,88),
              'Cost' => array(13,34,54,11,34,35,48),
          ));
          $graphica->setBackgroundcolor(
              array(
                  TypeColors::aqua,
                  TypeColors::dark_green
              )
          );
          $graphica->setBordercolor(
                array(
                    TypeColors::aqua,
                    TypeColors::dark_green

                )
          );
          $graphica->getHeight('150px');
          $graphica->getWidth('500px');
```  

There are a couple of help classes related to colors and Charts type:

ChartsType: Define the Charts that you can render:
```  
    CHARJS_BAR = 'bar';
    CHARJS_HORIZONTALBAR = 'horizontalBar';
    CHARJS_RADAR = 'radar';
    CHARJS_LINE = 'line';
    CHARJS_PIE = 'pie';
    CHARJS_DOUGHNUT = 'doughnut';
    CHARJS_POLAR_AREA = 'polarArea';
    CHARJS_BUBBLE = 'bubble';
``` 
TypeColors: Define colors, over 250
``` 
 maroon = '128,0,0';
	dark_red = '139,0,0';
	brown = '165,42,42';
	firebrick = '178,34,34';
	crimson = '220,20,60';
	red = '255,0,0';
	tomato = '255,99,71';
	coral = '255,127,80';
	indian_red = '205,92,92';
	light_coral = '240,128,128';
	dark_salmon = '233,150,122';
	salmon = '250,128,114';
	light_salmon = '255,160,122';
	orange_red = '255,69,0';
	dark_orange = '255,140,0';
	orange = '255,165,0';
	gold = '255,215,0';
 ...
```

You Could build this array by hand or using a service transformer, this service transform database data to an Array data prepared to be rendered by Chart.js:

```
public function transform($type,$data,$fieldLabels,$fieldKpi,$options,$fieldData);
```
Sample:

```
$grafica = $this->get('app.chartjs.transformer_char')->transform(TypeCharjs::CHARJS_PIE,$data,'indicador_id','username',$options,'average')->toArray();
```
This service define needs:

Type of char: 
$type => TypeCharjs::CHARJS_BAR (use fados\ChartjsBundle\Utils\TypeCharjs;)

Databse Data 
$data=>
       0 = {array} [4]
           zone = "Europe"
           kpi = "Number of NIUs"
           average = "1250"
       1 = {array} [4]
           zone = "Asia"
           kpi = "Number of NIUs"
           average = "1225"
       2 = {array} [4]
           zone = "Africa"
           kpi = "Number of NIUs"
           average = "1235"
       }

Labels in the Chrart:
$fieldLabels => 'zone'

Indicator field:
$fieldKpi => 'kpi'

Value Field:
$fieldData => 'average'

$options => graphic options

 This transform will converto to this structure of array:

```
         $result {array} [2]
              labels = {array}[3]
                         [0] = Europe
                         [1] = Asia
                         [2] = Africa
              data  = {array}[1]
                   Number of NIUs = {array}[3]
                          [0] = 1250
                          [1] = 1225
                          [2] = 1235

```

## Twig sample
```
{% extends 'AppBundle:Default:index.html.twig' %}

{% block title %}Sample Chart{% endblock %}

{% block javascript-head %}
    {{ parent() }}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
{% endblock %}

{% block contingut %}
    <div class="container">
        <div class="Absolute-Center centrar">
            <div class="container">
                <h2 style="margin-bottom:20px">Chart</h2>
                <div class="chart">
                <h3>{{ title }}</h3>
                {{ chartjs_canvas('mychar1',grafica.width,grafica.height,grafica) }}
                </div>
            </div>
        </div>
    </div>
{% endblock %}

{% block javascript %}
    {{ parent() }}
    <script src="{{ asset('bundles/charjsbundle/js/Chart.min.js') }}"></script>
{% endblock %}
```
