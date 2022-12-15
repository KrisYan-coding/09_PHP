
<pre>
    <?php 
        class Person{
            var $name;
            public $mobile;
            private $sno = 'secrect';
        }

        $p = new Person;
        $p->name = 'Kris';
        $p->mobile = '09125632563';
        // $p->sno = '123'; // Uncaught Error: Cannot access private property Person::$sno

        print_r($p);

        class Person2{
            var $name;

            function __construct($n)
            {
                $this->name = $n;
                echo $this->name . '建立<br/>';
            }

            function __destruct()
            {
                echo $this->name . '解構<br/>';
            }
        }
    
     ?>
</pre>