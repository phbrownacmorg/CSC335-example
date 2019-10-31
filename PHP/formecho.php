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
          return htmlentities(trim(substr($instring, 0, 1024)), ENT_HTML5);
          //return nl2br(htmlentities(trim(substr($instring, 0, $phb_max_input)),
            //                        ENT_HTML5));
      }

      $phb_form_method = 'None';
      $phb_data = array();
      if ($_GET) {
         $phb_form_method = 'GET';
         $phb_data = $_GET;
      }
      elseif ($_POST) {
         $phb_form_method = 'POST';
         $phb_data = $_POST;
      }
      //var_dump($phb_data);
    ?>
    
    <h2>Form Data: <?php echo $phb_form_method; ?></h2>

    <?php
      if ($phb_data) {
    ?>
    <table>
      <tr><th>Variable</th><th>Value</th></tr>
      <?php
      foreach ($phb_data as $key => $value) {
          echo '<tr><td class="key">' . phb_clean_string($key) . "</td>";
          echo '<td class="value">' . phb_clean_string($value) . "</td></tr>\n";
      }
      ?>
    </table>
    <?php
      }
    ?>

      <p>
	Last modified: <!-- hhmts start -->2016-02-08 20:52:47
</p></body></html>
