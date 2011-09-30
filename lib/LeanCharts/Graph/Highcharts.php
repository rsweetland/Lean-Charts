<?php

class LeanCharts_Graph_Highcharts
{
    /**
     * @var array A stat to be rendered
     */
    private $stat;

    /**
     * @var array Date-wise values of the selected stat
     */
    private $data;

    public function __construct($stat, $data)
    {
        $this->stat = $stat;
        $this->data = $data;
    }

    public function render($width = 480, $height = 300, $target = null)
    {
        list($values, $targetValues, $year, $month, $day, $title, $id) = $this->calculateGraphValues($target);

        $output = <<<HTML
        
            <div class="sonar_graph">

                <script type="text/javascript">

                    var chart;

                    $(document).ready(function() {

                        chart = new Highcharts.Chart({

                            chart: {
                                renderTo: '$id',
                                defaultSeriesType: 'line',
                                marginRight: 130,
                                marginBottom: 25
                            },
                            title: {
                                text: null
                            },
                            legend: {
                                enabled: false
                            },
                            xAxis: {
                                type: 'datetime'
                            },
                            yAxis: {
                                title: {
                                    text: 'Values'
                                },
                                plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#808080'
                                }]
                            },
                            series: [{
                                name: '$title',
                                data: [$values],
                                pointStart: Date.UTC({$year}, {$month}, {$day}),
                                pointInterval: 24 * 3600 * 1000 // one day
                            }, {
                                type: 'column',
                                name: 'meaningful event',
                                data: []
                            } , {
                                name: 'target',
                                data: [$targetValues]
                            }]
                        });

                    });

                </script>

		        <div id="$id" style="width: {$width}px; height: {$height}px; margin: 0 auto"></div>

	        </div><!-- end of graph -->
HTML;

        return $output;
    }

    private function calculateGraphValues($target)
    {
        $data = array_reverse($this->data);

        $start = null;

        $dates = array();
        $values = array();
        $targetValues = array();

        foreach ($data as $date => $value) {

            if (!isset($start)) {
                $start = $date;
            }

            $dates[] = date('Y-m-d', strtotime($date));
            $values[] = $value;

            $targetValues[] = $target;
        }

        $dates = implode(", ", $dates);
        $values = implode(",", $values);
        $targetValues = implode(",", $targetValues);

        $time = strtotime($start);
        $year = date('Y', $time);
        $month = date('n', $time) - 1;
        $day = date('j', $time);
        $hour = date('G', $time);

        $title = $this->stat['name'];
        $id = microtime();
        
        return array($values, $targetValues, $year, $month, $day, $title, $id);
    }
}