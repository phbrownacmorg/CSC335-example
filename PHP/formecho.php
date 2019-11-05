<!DOCTYPE html >
<html lang="en" xml:lang="en">
  <head>
    <title>Echo form input</title>
    <meta http-equiv="Content-Type"
          content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <link rev="made" href="mailto:peter.brown@converse.edu" />

    <style type="text/css" id="internalStyle">
      h1 { text-align: center; }
      td.value { text-indent: 1em; }
    </style>
  </head>
  <body>
    <h1>Echo form input</h1>
    
    <p>This page merely echoes the form input submitted to it.  HTML
      special characters are escaped first, to provide at least modest
      protection against malicious inputs.</p>

    <?php
      
      function phb_clean_string($instring) {
          return htmlentities(trim(substr($instring, 0, 1024)), ENT_QUOTES | ENT_HTML5);
          //return nl2br(htmlentities(trim(substr($instring, 0, $phb_max_input)),
            //                        ENT_HTML5));
      }

      function inputData() {
          //var_dump($_SERVER);
          $data = array();
          if ($_GET) {
              $data = $_GET;
              $data['_phb_form_method'] = 'GET';
          }
          elseif ($_POST) {
              $data = $_POST;
              $data['_phb_form_method'] = 'POST';
          }
          elseif ($_SERVER['argv']) {
              $data = $_SERVER['argv'];
              $data['_phb_form_method'] = 'argv';
          }
          //var_dump($data);
          return $data;
      }

      function array_as_table_body($arr) {
          $tbody = '';
          foreach ($arr as $key => $value) {
              if ($key !== '_phb_form_method') {
                  $tbody = $tbody . '<tr><td class="key">' . phb_clean_string($key) . '</td>';
                  $tbody = $tbody . '<td class="value">' . phb_clean_string($value) . '</td></tr>\n';
              }
          }
          return $tbody;
      }

      $phb_data = inputData();
    ?>
    
    <h2>Form Data: <?php echo $phb_data['_phb_form_method']; ?></h2>

    <?php
      if ($phb_data) {
    ?>
    <table>
      <tr><th>Variable</th><th>Value</th></tr>
      <?php
          echo array_as_table_body($phb_data);
      ?>
    </table>
    <?php
      }
    ?>

      <p>
	Last modified: <!-- hhmts start -->2016-02-08 20:52:47
</p></body></html>
