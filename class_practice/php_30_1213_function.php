
<pre>
    <?php 
        // input reference -> modify variable--
        function swap(&$a, &$b){
            $a +=100;
            $c = $a;
            echo "$a, $b, $c<br>";
            $a = $b;
            echo "$a, $b, $c<br>";
            $b = $c;
            echo "$a, $b, $c<br>";
        }

        $m = 100;
        $n = 'abc';

        swap($m, $n);
        echo "$m, $n<br>";
        
        // input copy--
        function swap2($a, $b){
            $a +=100;
            $c = $a;
            echo "$a, $b, $c<br>";
            $a = $b;
            echo "$a, $b, $c<br>";
            $b = $c;
            echo "$a, $b, $c<br>";
        }

        $p = 100;
        $q = 'abc';

        swap2($p, $q);
        echo "$p, $q<br>";

        $g1 = 1000;
        $g2 = 2000;

        function fun1(){
            // echo "$g1, $g2"; // undefined
            global $g1, $g2;
            echo "hi $g1, $g2";
        };

        fun1();
    
    
     ?>
</pre>