
        <?php 
        $data = array(
             '20065266',
             '20065265',
             '20065264'
        );
        $id = count($data);
            for ($i=0; $i< $id; $i++)
            {
                $url = 'urlpdf/'.$data[$i].'/2005';
                echo '<script type="text/javascript">window.location.replace("'.$url.'");</script>';
                // if ($_SERVER['REQUEST_URI'] == $url)
                // {
                //     echo '<script type="text/javascript">window.location.assign("/index.php");</script>';
                // }
                // else
                // {
                //     echo"";
                // }
            }
        // $count = count($data);
        // for ($i=0; $i < $count; $i++) { 
        //     if ($i < $count) {
        //         $url = 'urlpdf/'.$data[$i].'/2005';
        //         $statusCode = '303';
        //          header('Location: ' . $url, true, $statusCode);
        //         }
        //         else 
        //         {
        //             $url = 'urlpdf/'.$data[$i].'/2005';
        //             $statusCode = '303';
        //              header('Location: ' . $url, true, $statusCode);
        //              die();

        //     }
        // }
        // foreach ($data as $d) {
        //     // var_dump($d);
        //      // dd($url);
        //      // echo $d;
        //     }
        //     die();
            // echo $d;
        // dd($data);
        ?>
 